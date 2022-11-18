<?php
if(isset($_POST['confirmar'])) {

    include("conexao.php");
    $id = intval($_GET['id']);
    $sql_code = "DELETE FROM cadastro_pessoas WHERE id = '$id'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

    if($sql_query) {
        echo  "<script>alert('Usuário deletado com sucesso!!');location.href=\"tabela_cadastro.php\"</script>";
        unset($_POST);
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <h1 class="text-center alert alert-danger">Tem certeza que deseja deletar este cadastro?</h1>
    <div class="text-center">
        <form action="" method="post">
            <a class='btn btn-info btn-xs' style="padding: 15px 30px; color: #333333" href="tabela_cadastro.php"><b>Não</b></a>
            <button name="confirmar" value="1" type="submit" class="btn btn-danger btn-xs" style="padding: 15px 30px; color: #333333;"><b>Sim</b></button>
        </form>
    </div>
    </div>
</body>
</html>