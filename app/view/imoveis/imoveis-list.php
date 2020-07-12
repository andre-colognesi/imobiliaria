<h3>Todos os Imóveis</h3>

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