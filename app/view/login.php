<?php $this->include('header') ?>
<div class="container border-right border-left">
<form class="form-group" method="POST" action="check-login">
  <div class="row">

            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4"><br>
                <label>Senha</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4"></div>
            <div class="col-sm-2"><br>
                <button class="btn btn-primary btn-block text-white">Entrar</button>
            </div>
            <div class="col-sm-2"><br>
                <a class="btn btn-success btn-block text-white" href="cadastrar-login">Cadastrar</a>
            </div>
            <div class="col-sm-4"></div>
    </div>
    </form>
</div>


<?php $this->include('footer') ?>