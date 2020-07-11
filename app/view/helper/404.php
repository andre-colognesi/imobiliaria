<?= $this->include('header') ?>

  <div class="container">
   <form class="form-group" action="teste" method="post">
   <div class="row mt-5 mb-5">
    <div class="col-sm-12 text-center">
    <h1>404 - Página não encontrada</h1>
    </div>
    <div class="col-sm-4 pt-5">
        <a class="btn btn-link" href="<?=getenv('URL')?>home">Retornar para página inicial</a>
    </div>
   </div>
    <?= $this->include('footer'); ?>
