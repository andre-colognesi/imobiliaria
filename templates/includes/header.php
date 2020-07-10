<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" 
integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" 
crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" 
crossorigin="anonymous">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titulo</title>
</head>
<?php   
        require(realpath(__DIR__)."/../../config/Bootstrap.php");
        require(realpath(__DIR__)."/../../config/Session.php");
        $session = new Session();
?>

<?php include_once "includes/header.php"; ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Imobiliaria</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#"> <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">
            <?php
                if($session->checkSession()){
                    ?>
                    Bem vindo <?= $_SESSION['USERNAME'] ?>
                <?php
                }else{
                    echo "<a href='".getenv('INDEX')."templates/register.php'>Cadastrar</a>";
                }
                ?>
        </a>
      </li>
      
    </ul>
  </div>
</nav>

<?= Session::showMsg()?>

<body>
<main class="container-fluid">
    
