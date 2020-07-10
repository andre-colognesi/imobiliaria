<?php include_once "includes/header.php"; ?>
<form action="<?=getenv('INDEX')?>templates/signin.php" method="POST" class="rounded border-top border-bottom mt-5 px-5 py-5">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <label>E-mail</label>
            <input type="email" class="form-control form-control-sm" name="email" />    
            <br>
            <label>Senha</label>
            <input type="password" class="form-control form-control-sm" name="password" />
        </div>
        <div class="col-sm-4"></div>
        <div class="col-sm-5"></div>
        <div class="col-sm-2">
            <br>
            <input type="submit" class="btn btn-success btn-sm btn-block" value="Entrar" />
        </div>
    </div>
</form>


<?php include_once "includes/footer.php"; ?>