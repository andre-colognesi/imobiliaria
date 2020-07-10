<?php include_once "includes/header.php"; ?>
<form method="POST" action="<?=getenv('INDEX')?>templates/signup.php" class="rounded border-top border-bottom mt-5 px-5 py-5">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <label>Nome completo</label>
            <input type="text" class="form-control form-control-sm" name="name" />
            <br>
            <label>E-mail</label>
            <input type="email" class="form-control form-control-sm" name="email" />
            <br>
            <label>Senha</label>
            <input type="password" class="form-control form-control-sm" name="password" />
            <br>
        </div>
        <div class="col-sm-4"></div>
        <div class="col-sm-5"></div>
        <div class="col-sm-2">
            <br>
            <input type="submit" class="btn btn-success btn-sm btn-block" value="Cadastrar" />
        </div>
    </div>
</form>


<?php include_once "includes/footer.php"; ?>