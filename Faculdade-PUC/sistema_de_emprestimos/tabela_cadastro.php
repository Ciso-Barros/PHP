<?php 
include('conexao.php');

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
    <link rel="stylesheet" href="assets/css/tabela.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <h1>Lista de Cadastros</h1>
    <h2>Estes são os cadastrados do sistema:</h2>
    <div class="container">
    <table class="table table-striped custab">
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Nascimento</th>
            <th>Data de Cadastro</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php if($num_clientes == 0) { ?>
                <tr>
                    <td colspan="7">Nenhum cliente foi cadastrado</td>
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
                    <td><?php echo $cadastro['nome']; ?></td>
                    <td><?php echo $cadastro['email']; ?></td>
                    <td><?php echo $telefone; ?></td>
                    <td><?php echo $nascimento; ?></td>
                    <td><?php echo $data_cadastro; ?></td>
                    <td>
                        <a class='btn btn-info btn-xs' href="editar_cadastro.php?id=<?php echo $cadastro['id']; ?>"><span class="glyphicon glyphicon-edit"><b> EDITAR</b></span></a>
                        <a class="btn btn-danger btn-xs" href="deletar_cadastro.php?id=<?php echo $cadastro['id']; ?>"><span class="glyphicon glyphicon-remove"><b> DELETAR</b></span></a>
                    </td>
                </tr>
                <?php
                }
            } ?>
        </tbody>
    </table>
    </div>
</body>
</html>