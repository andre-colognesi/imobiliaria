<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Imobiliária</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=getenv("URL")?>app/forniture/css/css.css">
    <link rel="stylesheet" href="<?=getenv("URL")?>app/forniture/css/toast/toastify.css">
    <!--<link rel="stylesheet" id="teste" href="<?=getenv("URL")?>app/forniture/css/app.css"> -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="<?=getenv('URL')?>app/forniture/js/toast/toastify.js"></script>
        <script src="<?=getenv('URL')?>app/forniture/js/app.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <a class="navbar-brand" href="#">Imobiliária</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <?php if($this->auth()){ ?>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="<?=getenv("URL")?>home">Home </a>
      </li>

    </ul>
    <form class="form-inline my-2 my-lg-0 nav-item dropdown">
        <?php if(isset($_SESSION['AVATAR'])){?>
        <a class="nav-item" ><img class="img rounded img-fluid"  src="<?= getenv("URL") . 'app/upload/images/avatar/'.$_SESSION["USER_ID"]."/".$_SESSION["AVATAR"]?>" width="50px" style="max-height: 50px;"></a>
        <?php }?>
        <a class="btn btn-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= $_SESSION['USERNAME']?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?= getenv("URL")?>configuracao">Alterar Dados</a>
          <a class="dropdown-item" href="<?= getenv("URL")?>logout">Logout</a>
        </div>
    </form>
  </div>
    </nav>
    <nav aria-label="breadcrumb" class="mb-1  mx-3">
    <ol class="breadcrumb">
  
      <?php 
      $i = 1;
        foreach($this->breadcrumbs as $bc){
            if($i == count($this->breadcrumbs)){
                ?>
                  <li class="breadcrumb-item active"><?=$bc["title"]?></li>
                <?php
            }else{
          ?>
              <li class="breadcrumb-item"><a href="<?=$bc["url"]?>"><?=$bc["title"]?></a></li>
          <?php
            }
            $i++;
        }
      ?>
    </ol>
  </nav>
  
    <?php }else{ ?>
</nav>
<nav aria-label="breadcrumb" class="mb-1 mx-3">
    <ol class="breadcrumb">
    <li class="breadcrumb-item active" ><a href="login">Login</a></li>
    <li class="breadcrumb-item active" ><a href="cadastrar-login">Cadastrar</a></li>

    </ol>
  </nav>

    <?php } ?>

<?php 
if(!isset($_SESSION)){
  session_start();
}
if(isset($_SESSION['MESSAGE'])){
    echo '<div class="container">';
    echo "<div onclick='this.remove()' class='col-sm-12 alert alert-".$_SESSION["MESSAGE"]["TYPE"]." btn border-rounded' role='alert'>".$_SESSION['MESSAGE']["MESSAGE"]." <a data-dismiss='alert' role='button' class='close'>&times;</a></div> ";
    echo '</div>';  
    unset($_SESSION['MESSAGE']);
  }

?>    

<main class="mx-3 rounded py-3 px-3 main">