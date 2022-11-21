<?php

if(isset($_POST['email']) && isset($_POST['senha'])) {

  include ('conexao.php');

  $email = $mysqli->escape_string($_POST['email']);
  $senha = $_POST['senha'];

  $sql_code = "SELECT * FROM cadastro_pessoas WHERE email = '$email'";
  $sql_querry = $mysqli->query($sql_code) or die($mysqli->error);
  


  $erro = false;

  if($sql_querry->num_rows == 0){
      echo  "<script>alert('O e-mail informado é incorreto');</script>";
    } else {
        $usuario = $sql_querry->fetch_assoc();
          if ($senha != password_verify($senha, $usuario['senha'])){
            echo  "<script>alert('A senha informada é incorreta');</script>";
          }else{
            if(!isset($_SESSION)){
                session_start();
              $_SESSION['usuario'] = $usuario["id"];
              $_SESSION['admin'] = $usuario["admin"];
              header("Location: tabela_cadastro.php");
            }  
        }
      }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Logim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<body>
<form method="POST" action="">
  <section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <h3 class="alert alert-light">Tela de Login</h3>

              <div class="form-outline mb-4">
                <input name="email" type="email" id="typeEmailX-2" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX-2">Email</label>
              </div>

              <div class="form-outline mb-4">
                <input name="senha" type="password" id="typePasswordX-2" class="form-control form-control-lg" />
                <label class="form-label" for="typePasswordX-2">Password</label>
              </div>

              <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>

            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>
</body>
</html>