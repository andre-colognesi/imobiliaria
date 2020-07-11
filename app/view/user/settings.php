<?php $this->include('header') ?>

   <div class="row">
    <div class="col-sm-12">
    <h1>Configurações</h1>
    <hr>
    <br><br>
  
    </div>
   </div>
    <form action="atualizar-usuario" method="POST" enctype="multipart/form-data">
    <?= $this->getToken()?>
        <div class="row">
            <div class="col-sm-3">
                <label>Nome</label>
                <input type="text" class="form-control" name="name" value="<?= $user["name"]?>">
            </div>

            <div class="col-sm-3">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="<?= $user["email"]?>">
            </div>
            <div class="col-sm-2">
                <Label>Foto</Label>
                <input type="file" class="" name="avatar">
            </div>

        </div>
        <div class="row">
            <div class="col-sm-2">
            <br>
            <input type="submit" value="Salvar" class="btn btn-success btn-block">
            </div>
        </div>
    </form>

    <?php  $this->include('footer'); ?>
