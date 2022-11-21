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
    $item = $_POST['item'];
    $admin =$_POST['admin'];
    

    if(empty($nome)) {
        $erro = "<script>alert('Preencha o nome...');</script>";
    }
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "<script>alert('Preencha o email...');</script>";
    }

    if(!empty($nascimento)) { 
        $pedacos = explode('/', $nascimento);
        if(count($pedacos) == 3) {
            $nascimento = implode ('-', array_reverse($pedacos));
        } else {
            $erro = "<script>alert('A data de nascimento deve seguir o padrão dia/mes/ano.');</script>";
        }
    }

    if(!empty($telefone)) {
        $telefone = limpar_texto($telefone);
        if(strlen($telefone) != 11)
            $erro = "<script>alert('O telefone deve ser preenchido no padrão (11) 98888-8888...');</script>";
    }

    if($erro) {
        echo  $erro;
        }
        else{
            $sql_code = "UPDATE cadastro_pessoas
            SET nome = '$nome', 
            email = '$email', 
            telefone = '$telefone',
            nascimento = '$nascimento',
            item = '$item',
            admin = '$admin'
            WHERE id = '$id'";
            $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
            if($deu_certo) {
                echo "<script>alert('Cadastro Atulizado com sucesso!!');</script>";
                unset($_POST);
                
            };
        };
        
};
        
    



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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>

    <form method="POST" action="" class="container main-center col-sm-4">
    <h2 class="text-center alert alert-warning">Atualizar Cadastro</h2>
         
            <label  class="form-label"><b>Nome:</b></label>
            <input class="form-control"  value="<?php echo $cadastro['nome']; ?>" name="nome" type="text">
        <p>
            <label  class="form-label"><b>E-mail:</b></label>
            <input class="form-control" value="<?php echo $cadastro['email']; ?>" name="email" type="text">
        </p>
        <p>
            <label  class="form-label"><b>Senha:</b></label>
            <input class="form-control" value="" name="senha" type="password">
        </p>
        <p>
            <label  class="form-label"><b>Telefone:</b></label>
            <input class="form-control" class="form-control" value="<?php if(!empty($cadastro['telefone'])) echo formatar_telefone($cadastro['telefone']); ?>"  placeholder="(11) 98888-8888" name="telefone" type="text">
        </p>
        <p>
            <label  class="form-label"><b>Data de Nascimento:</b></label>
            <input class="form-control" value="<?php if(!empty($cadastro['nascimento'])) echo formatar_data($cadastro['nascimento']); ?>"  name="nascimento" type="text">
        </p>
        <p>
                <label  class="form-label"><b>Item que deseja emprestar:</b></label>
                <input class="form-control" value="<?php echo $cadastro['item']; ?>" name="item" type="text">
            
         </p>
         <p>
                <label><b>Tipo de Usuário:</b></label>
                <input name="admin" value="1" type="radio" class="form-check-input" > User-Admin
                <input name="admin" value="0" checked type="radio" class="form-check-input" > User-Normal
            </p>
                <button type="submit" class="btn btn-success btn-lg"><b>Salvar Cadastro</b></button>      
                <a href="tabela_cadastro.php" class="btn btn-primary btn-lg"><b>Voltar para lista</b></a>
            
    </form>

</body>
</html>

<style>

</style>