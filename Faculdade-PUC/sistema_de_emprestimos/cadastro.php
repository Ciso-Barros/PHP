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
    $senha_descriptografada = $_POST['senha'];
    $item = $_POST['item'];
    $admin = $_POST['admin'];

    if(strlen($senha_descriptografada) < 6 && strlen($senha_descriptografada) > 16){
        $erro = "<script>alert('A senha deve ter entre 6 e 16 caracteres.');</script>";
    }
        


    // Verifica se o campo nome está com algum dado
    if(empty($nome)) {
        $erro = $erro = "<script>alert('Preencha o nome...');</script>";
    }

    // Verifica se o Email é válido
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "<script>alert('Email incorreto ou não preenchido...');</script>";
    }

    // Define o formato de preenchimento da data
    if(!empty($nascimento)) { 
        $pedacos = explode('/', $nascimento);
        if(count($pedacos) == 3) {
            $nascimento = implode ('-', array_reverse($pedacos));
        } else {
            $erro = "<script>alert('A data de nascimento deve seguir o padrão dia/mês/ano.');</script>";
        }
    }

    //  Chama a função para retirar tudo que não é número e salvar no banco sem poluição.
    if(!empty($telefone)) {
        $telefone = limpar_texto($telefone);
        if(strlen($telefone) != 11)
            $erro = "<script>alert('O telefone deve ser preenchido no padrão (11) 98888-8888');</script>";
    }


    // Inserindo os dados no Banco de Dados
    if($erro) {
        echo  $erro;
    } else {
        $senha = password_hash($senha_descriptografada, PASSWORD_DEFAULT);
        $sql_code = "INSERT INTO cadastro_pessoas (nome, email, senha, telefone, nascimento, data, item, admin) 
        VALUES ('$nome', '$email', '$senha', '$telefone', '$nascimento', NOW(), '$item','$admin')";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if($deu_certo) {
            // echo "<h1><p><b>Usuário cadastrado com sucesso!!!</b></p></h1>";
            echo  "<script>alert('Usuário cadastrado com sucesso!!');</script>";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    

</head>
<body>
    
    <form method="POST" action="#"  class="container main-center col-sm-4">
    <h1 class="text-center alert alert-dark">Cadastro</h1>
            <p>
                <label><b>Nome:</b></label>
                <input  class="form-control"   value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" name="nome" type="text">
            </p>
            <p>
                <label><b>E-mail:</b></label>
                <input  class="form-control"   value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" name="email" type="text">
            </p>
            <p>
                <label><b>Senha:</b></label>
                <input  class="form-control" value="" name="senha" type="password">
            </p>
            <p>
                <label><b>Telefone:</b></label>
                <input class="form-control" value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone']; ?>"  placeholder="(11) 98888-8888" name="telefone" type="text">
            </p>
            <p>
                <label><b>Data de Nascimento:</b></label>
                <input class="form-control" placeholder="dd/mm/aa" value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento']; ?>"  name="nascimento" type="text">
            </p>
            <p>
                
                <label><b>Item que deseja emprestar:</b></label>
                <input class="form-control" value="<?php if(isset($_POST['item'])) echo $_POST['item']; ?>" name="item" type="text">
            </p>
            <p>
                <label><b>Tipo de Usuário:</b></label>
                <input name="admin" value="1" type="radio" class="form-check-input" > User-Admin
                <input name="admin" value="0" checked type="radio" class="form-check-input" > User-Normal
            </p>
                <button type="submit" class="btn btn-success btn-lg"><b>Salvar Cadastro</b></button>
                <a href="tabela_cadastro.php" class="btn btn-primary btn-lg" ><b>Voltar para lista</b></a>
    </form>
</body>
</html>

