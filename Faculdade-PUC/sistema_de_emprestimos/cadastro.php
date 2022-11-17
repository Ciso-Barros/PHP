<?php

function limpar_texto($str){ 
    return preg_replace("/[^0-9]/", "", $str); 
}

if(count($_POST) > 0) {

    include('conexao.php');
    
    $erro = false;
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $nascimento = $_POST['nascimento'];

    // Verifica se o campo nome está com algum dado
    if(empty($nome)) {
        $erro = "Preencha o campo nome";
    }

    // Verifica se o Email é válido
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Preencha o campo e-mail";
    }

    // Define o formato de preenchimento da data
    if(!empty($nascimento)) { 
        $pedacos = explode('/', $nascimento);
        if(count($pedacos) == 3) {
            $nascimento = implode ('-', array_reverse($pedacos));
        } else {
            $erro = "A data de nascimento deve seguir o padrão dia/mes/ano.";
        }
    }

    //  Chama a função para retirar tudo que não é número e salvar no banco sem poluição.
    if(!empty($telefone)) {
        $telefone = limpar_texto($telefone);
        if(strlen($telefone) != 11)
            $erro = "O telefone deve ser preenchido no padrão (11) 98888-8888";
    }


    // Inserindo os dados no Banco de Dados
    if($erro) {
        echo "<h1><p><b>ERRO: $erro</b></p></h1>";
    } else {
        $sql_code = "INSERT INTO cadastro_pessoas (nome, email, telefone, nascimento, data) VALUES ('$nome', '$email', '$telefone', '$nascimento', NOW())";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if($deu_certo) {
            echo "<h1><p><b>Usuário cadastrado com sucesso!!!</b></p></h1>";
            unset($_POST);
        }
    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="assets/css/cadastro.css">
    
</head>
<body>
    <form method="POST" action="#"  id="container">
    <h2>Cadastro</h2>
            <p>
                <label><b>Nome:</b></label>
                <input value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" name="nome" type="text">
            </p>
            <p>
                <label><b>E-mail:</b></label>
                <input value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" name="email" type="text">
            </p>
            <p>
                <label><b>Telefone:</b></label>
                <input value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone']; ?>"  placeholder="(11) 98888-8888" name="telefone" type="text">
            </p>
            <p>
                <label><b>Data de Nascimento:</b></label>
                <input placeholder="dd/mm/aa" value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento']; ?>"  name="nascimento" type="text">
            </p>
            <p>
                <button type="submit"><b>Salvar Cadastro</b></button>
            </p>
                <a href="tabela_cadastro.php" id="ancora"><b>Voltar para lista</b></a>
    </form>
</body>
</html>

