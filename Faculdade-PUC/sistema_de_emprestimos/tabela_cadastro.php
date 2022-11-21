<?php 
include('conexao.php');

if (!isset($_SESSION)){
    session_start();
}

if (!isset($_SESSION['usuario'])){
    header("Location: index.php");
    die();
}


// Seleciona a tabela cadastro_pessoas
$sql_clientes = "SELECT * FROM cadastro_pessoas";
$query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
$num_clientes = $query_clientes->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cadastros</title>
    <link rel="stylesheet" href="assets/css/cadastro.css">
    <link rel="stylesheet" href="assets/css/tabela.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
</head>
<body>
    <div class="container">
    <h1 class="text-center">Lista de Cadastros</h1>
    <h2 class="text-center">Estes são os cadastros salvos no sistema<br></h2> 
    
    <?php if($_SESSION['admin']) { ?> 
        <h3 class="text-center alert alert-info">Usuário <b>Administrador:</b> Você pode editar os registros. </h3>
         <a href="cadastro.php" class="btn btn-primary btn-lg">Realizar um novo cadastro</a>
    <?php } ?> 
    <?php if(!$_SESSION['admin']) { ?>
        <h3 class="text-center alert alert-info">Usuário <b>Comum:</b> você só pode visualizar os registros</h3>
    <?php } ?>
    </div>
     
    
    <div class="container">
   
    <table class="table table-striped custab">
        <thead>
            <th>ID</th>
            <th>Tipo de Usuário</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Nascimento</th>
            <th>Data</th>
            <th>Item Emprestado</th>
            <?php if($_SESSION['admin']) { ?> 
            <th>Ações</th>
            <?php } ?>
        </thead>
        <tbody>
            <?php if($num_clientes == 0) { ?>
                <tr>
                    <td colspan="<?php if ($_SESSION['admin'])  echo 9; else echo 8;?> ">Nenhum cliente foi cadastrado</td>
                </tr>
            <?php 
            } else {
                while ($cadastro = $query_clientes->fetch_assoc()) {
                
                $telefone = "Não informado";
                if(!empty($cadastro['telefone'])) {
                    $telefone = formatar_telefone($cadastro['telefone']);
                }
                $nascimento = "Não informada";
                if(!empty($cadastro['nascimento'])) {
                    $nascimento = formatar_data($cadastro['nascimento']);
                }
                $data_cadastro = date("d/m/Y H:i", strtotime($cadastro['data']));
                ?>
                <tr>
                    <td><?php echo $cadastro['id']; ?></td>
                    <td><?php if ($cadastro['admin']) echo "Admin"; else echo "Normal"; ?></td>
                    <td><?php echo $cadastro['nome']; ?></td>
                    <td><?php echo $cadastro['email']; ?></td>
                    <td><?php echo $telefone; ?></td>
                    <td><?php echo $nascimento; ?></td>
                    <td><?php echo $data_cadastro; ?></td>
                    <td><?php echo $cadastro['item']; ?></td>
                    <?php if($_SESSION['admin']) { ?>
                    <td>
                        <a class="btn btn-secondary" href="editar_cadastro.php?id=<?php echo $cadastro['id']; ?>"><span class="glyphicon glyphicon-edit"><b>EDITAR</b></span></a>
                        <a class="btn btn-danger" href="deletar_cadastro.php?id=<?php echo $cadastro['id']; ?>"><span class="glyphicon glyphicon-remove"><b> DELETAR</b></span></a>
                    </td>
                    <?php } ?>
                </tr>
                <?php
                }
            } ?>
        </tbody>
    </table>
    <a  href="logout.php" class="btn btn-dark"><b>Sair do Sistema</b></a>
    </div>
    </div>
</body>
</html>