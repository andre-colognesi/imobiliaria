
  <div class="container">
   <div class="row">
    <div class="col-sm-12">
    <h3>Adicionar Imóvel</h3>
    <hr>
    </div>
    <form method="POST" action="<?=getenv('URL')?>imovel/criar">
        <div class="row">
            <div class="col-sm-3">
                <label>Rua</label>
                <input type="text" class="form-control form-control-sm" id="rua" name="propertie_street" />
            </div>
            <div class="col-sm-3">
                <label>Bairro</label>
                <input type="text" class="form-control form-control-sm" id="bairro" name="propertie_neighborhood" />
            </div>
            <div class="col-sm-3">
                <label>Numero</label>
                <input type="text" class="form-control form-control-sm" id="num" name="propertie_number" />
            </div>
            <div class="col-sm-3">
                <label>Cidade</label>
                <input type="text" class="form-control form-control-sm" id="cidade" name="propertie_city" />
            </div>
            <div class="col-sm-3">
                <label>Estado</label>
                <input type="text" class="form-control form-control-sm" id="estado" name="propertie_state" />
            </div>
            <div class="col-sm-3">
                <label>CEP</label>
                <input type="text" class="form-control form-control-sm" id="cep" name="propertie_zip_code" />
            </div>
            <div>
                <br>
                <a class="btn btn-primary btn-sm text-light" onclick="cepSearch()">Busca CEP</a>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-3">
            <br>
                <input type="submit" class="btn btn-sm btn-success" value="Salvar" />
            </div>
        </div>

    </form>
   </div>

   <script>
       function cepSearch(){
           let cep = $('#cep').val();
           if(!cep){
               return false;
           }
           cep = cep.replace("-","");
           $.ajax({
               url:"https://viacep.com.br/ws/"+cep+"/json/",
               type: "GET",
               success(cep){
                    $("#rua").val(cep.logradouro);
                    $("#bairro").val(cep.bairro);
                    $("#cidade").val(cep.localidade);
                    $("#estado").val(cep.uf);
               },

           })
       }
</script>

