<h3>Todos os Imóveis</h3>

<form method="GET" action="<?=getenv('URL')?>imoveis">
<div class="row">
    <div class="col-sm-1">
        <?=renderInputText("propertie_id",false,"ID.",array("class"=>"form-control form-control-sm"))?>
    </div>
    <div class="col-sm-2">
        <?=renderInputText('propertie_street',null,"Rua",array("class"=>"form-control form-control-sm"))?>
    </div>
</div>
<div class="row">
    <div class="col-sm-2"><br>
        <input type="submit" class="btn btn-sm btn-primary btn-block" value="Buscar" /><br>
    </div>
</div>
</form>
<table class="table table-sm">
    <tr>
        <th>
            Endereço
        </th>
        <th>

        </th>
    </tr>
    <?php
    foreach($list as $l){ ?>
    <tr>
        <td>
            <a href="<?=getenv('URL')?>imovel/<?=$l->propertie_id?>"><?=$l->propertie_street?> - Nº <?=$l->propertie_number?> - <?=$l->propertie_neighborhood?> - <?=$l->propertie_city?>/<?=$l->propertie_state?></a>
        </td>
        <td>
            <a></a>
        </td>
    </tr>
        <?php } ?>
</table>

<?=$this->pages() ?>