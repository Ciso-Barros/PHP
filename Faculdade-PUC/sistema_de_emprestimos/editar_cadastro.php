<?php

include('conexao.php');
$id = intval($_GET['id']);

function limpar_texto($str){ 
    return preg_replace("/[^0-9]/", "", $str); 
}

if(count($_POST) > 0) {

    $erro = false;
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $nascimento = $_POST['nascimento'];

    if(empty($nome)) {
        $erro = "Preencha o nome";
    }
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Preencha o e-mail";
    }

    if(!empty($nascimento)) { 
        $pedacos = explode('/', $nascimento);
        if(count($pedacos) == 3) {
            $nascimento = implode ('-', array_reverse($pedacos));
        } else {
            $erro = "A data de nascimento deve seguir o padrão dia/mes/ano.";
        }
    }

    if(!empty($telefone)) {
        $telefone = limpar_texto($telefone);
        if(strlen($telefone) != 11)
            $erro = "O telefone deve ser preenchido no padrão (11) 98888-8888";
    }

    if($erro) {
        echo "<p><b>ERRO: $erro</b></p>";
    } else {
        $sql_code = "UPDATE cadastro_pessoas
        SET nome = '$nome', 
        email = '$email', 
        telefone = '$telefone',
        nascimento = '$nascimento'
        WHERE id = '$id'";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if($deu_certo) {
            echo "<h1><p><b>cadastro atualizado com sucesso!!!</b></p></h1>";
            unset($_POST);
        }
    }

}

$sql_cadastro = "SELECT * FROM cadastro_pessoas WHERE id = '$id'";
$query_cadastro = $mysqli->query($sql_cadastro) or die($mysqli->error);
$cadastro = $query_cadastro->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
    <link rel="stylesheet" href="assets/css/cadastro.css">

</head>
<body>
    
    <form method="POST" action="" id="container">
    <h2>Atualizar Cadastro</h2
        <p>
            <label><b>Nome:</b></label>
            <input value="<?php echo $cadastro['nome']; ?>" name="nome" type="text">
        </p>
        <p>
            <label><b>E-mail:</b></label>
            <input value="<?php echo $cadastro['email']; ?>" name="email" type="text">
        </p>
        <p>
            <label><b>Telefone:</b></label>
            <input value="<?php if(!empty($cadastro['telefone'])) echo formatar_telefone($cadastro['telefone']); ?>"  placeholder="(11) 98888-8888" name="telefone" type="text">
        </p>
        <p>
            <label><b>Data de Nascimento:</b></label>
            <input value="<?php if(!empty($cadastro['nascimento'])) echo formatar_data($cadastro['nascimento']); ?>"  name="nascimento" type="text">
        </p>
        <p>
            <button type="submit"><b>Salvar Cadastro</b></button>
        </p>
        <a href="tabela_cadastro.php" id="ancora"><b>Voltar para a lista</b></a>
    </form>
</body>
</html>

<style>

</style>