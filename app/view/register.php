<?php $this->include('header') ?>
<div class="container border-right border-left">
<form class="form-group" method="POST" action="criar-usuario">
    <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <label>Nome</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="col-sm-4"></div>

            <div class="col-sm-4"></div>
            <div class="col-sm-4">
            <br>
                <label>E-mail</label>
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
                <button class="btn btn-success btn-block text-white" href="#!">Cadastrar</button>
            </div>
            <div class="col-sm-4"></div>
    </div>
    </form>
</div>


<?php $this->include('footer') ?>

