 <div class="form-group">
          <p>
           <label class="radio-inline col-sm-4"><input type="radio" name="optradio" value="juridica" onclick="pessoa(this.value);">Pessoa Juridica</label>
            <label class="radio-inline col-sm-4"><input type="radio" name="optradio" value="fisica" onclick="pessoa(this.value);">Pessoa Fisica</label>
          </p>
          </div>

        <div id="juridica" style="display:none;">
          <div class="form-group">
            <label class="control-label col-sm-2" for="txtRazaosocial">Razão Social: *</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="txtRazaosocial" name="txtRazaosocial" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="txtNomefantasia">Nome Fantasia: *</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="txtNomefantasia" required name="txtNomefantasia">
            </div>
          </div>
          
           <div class="form-group">
            <label class="control-label col-sm-2" for="txtCnpj">CNPJ: *</label>
            <div class="col-sm-3">
              <input type="numbe" class="form-control cnpj" id="txtCnpj" name="txtCnpj" required>
            </div>

            <label class="control-label col-sm-2 " for="txtIe">I.E.: * </label>
            <div class="col-sm-3">
              <input type="text" class="form-control ie" id="txtIe" name="txtIe" required>
            </div>
          </div>
          </div>

          <div id="fisica" style="display:none;">
          <div class="form-group">
            <label class="control-label col-sm-2" for="txtNomePF">Nome: *</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="txtNomePF" required name="txtNomePF">
            </div>
          </div>
          
           <div class="form-group">
            <label class="control-label col-sm-2" for="txtCPF">CPF: *</label>
            <div class="col-sm-3">
              <input type="numbe" class="form-control cpf" id="txtCPF" name="txtCPF" required>
            </div>

            <label class="control-label col-sm-2 " for="txtRG">RG: * </label>
            <div class="col-sm-3">
              <input type="text" class="form-control rg" id="txtRG" name="txtRG" onkeypress="return SomenteNumero(event)" required>
            </div>
          </div>
          </div>`


<script>
    function pessoa(tipo){
      if(tipo=="fisica"){
      document.getElementById("fisica").style.display = "inline";
      document.getElementById("juridica").style.display = "none";
      }else if(tipo=="juridica"){
      document.getElementById("fisica").style.display = "none";
      document.getElementById("juridica").style.display = "inline";

      }

    }
  </script>