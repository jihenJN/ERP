<div id="offreggb" style="display:none;margin-top: 18px;">
  <section class="content-header">
    <h1>
      Demande Client (offre GGB)
      <small>
        <?php echo __(''); ?>
      </small>
    </h1>
  </section>
  <script>
    function desactiverSelection() {
      var selectElement = document.getElementById("ch81");
      selectElement.disabled = true;
    }
  </script>
  <section class="content" style="width: 98%">
    <div class="row">
      <div class="box ">
        <div class="panel-body">
          <div class="table-responsive ls-table">

            <?php echo $this->Form->create($commandeclient, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>

            <div class="row">

              <div class="col-xs-2">
                <?php echo $this->Form->control('code', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][code]', 'value' => $code, 'label' => 'Code', 'required' => 'off', 'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'readonly' => 'readonly']); ?>
              </div>
              <div class="col-xs-2">
                <?php echo $this->Form->control('projet_id', ['options' => $projets, 'value' => $project_id, 'id' => 'projet_id', 'name' => 'projet_idggb', 'disabled', 'empty' => 'Veuillez choisir !!', 'class' => "form-control"]); ?>
              </div>
              <div class="col-xs-6" hidden>
                <?php echo $this->Form->control('depot_id', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][depot_id]', 'class' => "form-control", 'value' => '9', 'empty' => 'Veuillez choisir !!']); ?>
              </div>
              <?php echo $this->Form->input('datedecreation', array('table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][datedecreation]', 'label' => false, 'type' => 'hidden', 'placeholder' => '', 'maxlength' => '30', 'class' => 'datepicker', 'required', 'default' => date('Y-m-d H:i:s'))); ?>
              <div class="col-xs-2">
                <?php echo $this->Form->input('date', array('name' => 'data[tablecommandeclient][0][date]', 'type' => 'datetime', 'readonly' => 'readonly', 'value' => $this->Time->format('now', 'd/MM/y'), 'label' => 'Date', 'id' => 'date', 'div' => 'form-group ', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control')); ?>
              </div>
              <div class="col-xs-2">
                <?php echo $this->Form->control('commentaire', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][commentaire]']); ?>
              </div>
              <div class="col-xs-2">
                <?php echo $this->Form->input('client_id', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][client_id]', 'value' => $client['client_id'], 'class' => 'form-control select2', 'id' => 'client_id', 'label' => 'Tiers', 'empty' => 'Veuillez choisir !!']); ?>
              </div>
              <div class="col-xs-2" style="    width: 15%;">
                <label class="control-label" for="unipxte-id" style="margin-top: 25px;">TVA:</label>
                OUI <input type="radio" name="data[tablecommandeclient][0][tvaOnOff]" index="0" champ="tvaOnOff"
                  table="tablecommandeclient" value="1" id="OUI" class="toggleOffreGGB " style="margin-right: 17px">
                NON <input type="radio" name="data[tablecommandeclient][0][tvaOnOff]" index="0" champ="tvaOnOff"
                  table="tablecommandeclient" value="0" id="NON" class="toggleOffreGGB " checked>
              </div>

            </div>
            <div class="row">
              <div class="col-xs-2">
                <label> Produit | Service </label>
                <select name="data[tablecommandeclient][0][typearticle]" class="form-control" id="ch81">
                  <option> Veuillez choisir !!</option>
                  <option value="1"> Produit</option>
                  <option value="2"> Service</option>
                </select>
              </div>
              <div class="col-xs-2">
                <?php echo $this->Form->input('duree_validite', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][duree_validite]', 'type' => 'number', 'value' => '15', 'class' => 'form-control', 'id' => 'duree_validite', 'label' => 'Duree de validite en Jours']); ?>
              </div>
              <div class="col-xs-2">
                <?php echo $this->Form->input('incoterm_id', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][incoterm_id]', 'value' => '', 'class' => 'form-control select2', 'id' => 'incoterm_id', 'label' => 'Incoterm en Total', 'empty' => 'Veuillez choisir !!']); ?>
              </div>
              <div class="col-xs-2">
                <?php echo $this->Form->input('pay', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][pay]', 'type' => 'text', 'class' => 'form-control ', 'id' => 'pay_id', 'label' => 'Pay', 'empty' => 'Veuillez choisir !!']); ?>
              </div>
              <div class="col-xs-2">
                <?php echo $this->Form->input('incotermpdf_id', ['name' => 'data[tablecommandeclient][0][incotermpdf_id]', 'class' => 'form-control select2', 'id' => 'incotermpdf_id', 'label' => 'Incoterm Pdf', 'empty' => 'Veuillez choisir !!']); ?>
              </div>


            </div>


            <div class="row">
              <div class="col-xs-2">
                <?php echo $this->Form->input('paiement_id', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][paiement_id]', 'value' => '', 'class' => 'form-control select2 ', 'multiple' => 'multiple', 'id' => 'paiement_id', 'label' => 'Mode de reglèment', 'options' => $paiements, 'empty' => false]); ?>
              </div>
              
            
              <div class="col-xs-2" id="deviseSelect">
                <?php echo $this->Form->input('devis_id', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][devis_id]', 'value' => '', 'class' => 'form-control', 'id' => 'devis_id', 'label' => 'Devises ', 'options' => $devises, 'empty' => 'Veuillez choisir !!']); ?>
              </div>
              <div class="col-xs-2">
                <?php echo $this->Form->control('tauxdechange', ['label' => 'Taux de change de devise ', 'name' => 'data[tablecommandeclient][0][tauxdechange]', 'id' => 'tauxChange', 'class' => 'form-control', 'readonly']); ?>
                <div id="message"></div>
              </div>
              <div class="col-xs-2" id="deviseSelect2">
                <?php echo $this->Form->input('devis2_id', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][devis2_id]', 'value' => '', 'class' => 'form-control', 'id' => 'devis_id2', 'label' => 'Devises en dinar', 'options' => $devises, 'empty' => 'Veuillez choisir !!']); ?>
              </div>
              <div class="col-xs-3">
                <?php echo $this->Form->control('tauxdechange2', ['label' => 'Taux de change de devise en dinar', 'name' => 'data[tablecommandeclient][0][tauxdechange2]', 'id' => 'tauxChange2', 'class' => 'form-control', 'readonly']); ?>
                <div id="message2"></div>
              </div>
            </div>
            <div class="row">


              <div class="col-xs-4">
                <?php echo $this->Form->input('modetransport_id', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][modetransport_id]', 'value' => '', 'class' => 'form-control select2', 'id' => 'modetransport_id', 'label' => 'Mode transports', 'empty' => 'Veuillez choisir !!']); ?>
              </div>
              <div class="col-xs-4">
                <?php echo $this->Form->input('remarque', ['name' => 'data[tablecommandeclient][0][remarque]', 'type' => 'text', 'class' => 'form-control', 'id' => 'remarque', 'label' => 'Description de transport', 'step' => 'any']); ?>
              </div>
              <div class="col-xs-4">
                <?php echo $this->Form->input('total_transport', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][total_transport]', 'type' => 'number', 'class' => 'form-control', 'id' => 'total_transport', 'label' => 'Total de transport', 'step' => 'any']); ?>
              </div>


            </div>
            <div class="">
              <section class="content-header">
                <h1 class="box-title">
                  <?php echo __('Ligne demande client'); ?>
                </h1>
              </section>
              <section class="content" style="width: 99%">
                <div class="row">
                  <div class="box">
                    <div class="box-header with-border">
                      <a class="btn btn-primary categorieggb disabled" table='addtable' index='index'
                        id='ajouter_ligne_offreggb' style="float: right; margin-bottom: 5px;">
                        <i class="fa fa-plus-circle"></i> Ajouter ligne demande client
                      </a>
                    </div>
                    <div class="panel-body">
                      <div class="table-responsive ls-table">
                        <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                          <thead>
                            <tr width:20px>
                              <td align="center" nowrap="nowrap"><strong>Produit</strong></td>
                              <td align="center" nowrap="nowrap"><strong>Description</strong></td>
                              <td align="center" nowrap="nowrap"><strong>Unité</strong></td>
                              <td align="center" nowrap="nowrap"><strong>Quantite</strong></td>
                              <td align="center" nowrap="nowrap"><strong>Prix de<br>
                                  revient</strong></td>
                              <td align="center" nowrap="nowrap"><strong>Taux
                                  de<br>marge</strong></td>
                              <td align="center" nowrap="nowrap"><strong>Taux
                                  de<br>marque</strong></td>
                              <td align="center" nowrap="nowrap"><strong>Prixht</strong></td>
                              <td align="center" nowrap="nowrap"><strong>Remise</strong></td>
                              <td align="center" nowrap="nowrap"><strong>PUNHT</strong></td>
                              <td hidden align="center" nowrap="nowrap"><strong>Fodec</strong></td>
                              <td id='tftva' align="center" style="width: 10%; display:none"><strong>Tva</strong></td>
                              <td align="center" nowrap="nowrap"><strong>Ttc</strong></td>
                              <td align="center" nowrap="nowrap"></td>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="tr" style="display: none !important">
                              <?php echo $this->Form->input('sup', array('name' => 'sup', 'id' => '', 'champ' => 'sup', 'table' => 'tabligne3', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden')); ?>
                              <td champ="tdarticle">
                              </td>
                              <td>
                                <input table="tabligne3" type='text' champ='description' class='form-control  '
                                  index="">
                              </td>
                              <td  style="width: 5%;">
                              <select champ="unite_id" table="tabligne3" class="form-control " id="">
                                <option value=""></option>
                                <?php foreach ($unites as $key => $unit) {
                                 
                                ?>
                                <option value="<?php echo $unit['id'] ?>"><?php echo $unit['name'] ?></option>
                                <?php  } ?>
                              </select>
                               
                              </td>

                              <td align="center">

                                <input table="tabligne3" type='number' champ='qte'
                                  class='form-control calculprix getprixhtson ' class='input' index="">
                              </td>
                              <td align="center">
                                <input table="tabligne3" type='number' champ='coutrevient'
                                  class='form-control calculprix  getprixhtson' class='input' index="">
                              </td>
                              <td style="width: 8%;" align="center">
                                <input table="tabligne3" type='number' champ='tauxdemarge'
                                  class='form-control  calculprix getprixhtson' class='input' index="">
                              </td>
                              <td style="width: 8%;" align="center">
                                <input table="tabligne3" type='number' champ='tauxdemarque'
                                  class='form-control  calculprix getprixhtson' class='input' index="">
                              </td>
                              <td align="center">

                                <input table="tabligne3" type='number' champ='prixht'
                                  class='form-control  getprixarticle getprixhtson' step="any" class='input' index="">
                              </td>
                              <td align="center">

                                <input table="tabligne3" type='number' champ='remise' class='form-control getprixhtson'
                                  class='input' index="">
                              </td>
                              <td align="center">

                                <input readonly table="tabligne3" type='number' champ='punht'
                                  class='form-control getprixht' class='input' index="">
                              </td>
                              <td hidden style="width: 12%;" align="center">

                                <input table="tabligne3" type='number' champ='fodec' class='form-control getprixht'
                                  class='input' index="">
                              </td>
                              <td champ="tdtva" table="tablelignetva" id="" name="" index="" style="display:none;"
                                align="center">

                                <input table="tabligne3" champ="tva" id="" name="" index=""
                                  class='form-control getprixht' class='input' type='number'>
                              </td>
                              <td style="width: 12%;" align="center">

                                <input readonly table="tabligne3" type='number' champ='ttc'
                                  class='form-control getprixht' class='input' index="">
                              </td>
                              <td style="width: 2%;" align="center"><i class="fa fa-times supLigne"
                                  style="color: #C9302C;font-size: 22px;"></td>
                            </tr>
                          </tbody>
                        </table><br>
                        <input type="hidden" value="-1" id="indexoffreggb">
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
            <div class="col-xs-2">
              <?php echo $this->Form->control('totalfodec', ['label' => 'Total Taux de Marque', 'id' => 'totalmarque', 'readonly' => true]); ?>
            </div>
            <div class="col-xs-2">
              <?php echo $this->Form->control('totalmarge', ['label' => 'Total Taux de Marge', 'id' => 'totalmarge', 'readonly' => true]); ?>
            </div>
            <div class="col-xs-2">
              <?php
              echo $this->Form->control('totalremise', ['value' => '0.000', 'table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][totalremise]', 'label' => 'Total Remise', 'readonly' => true]); ?>
            </div>
            <div class="col-xs-2">
              <?php
              echo $this->Form->control('totalht', ['value' => '0.000', 'table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][totalht]', 'label' => 'Total HT', 'readonly' => true]); ?>
            </div>
            <div class="col-xs-6" hidden>
              <?php echo $this->Form->control('totalfodec', ['value' => '0.000', 'table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][totalfodec]', 'label' => 'Total Fodec', 'readonly' => true]); ?>
            </div>
            <div id="divtva_id" class="col-xs-2" style="display:none;">
              <?php
              echo $this->Form->control('totaltva', ['value' => '0.000', 'table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][totaltva]', 'label' => 'Total Tva', 'readonly' => true]); ?>
            </div>
            <div class="col-xs-2">
              <?php
              echo $this->Form->control('totalttc', ['id' => 'totalttc', 'value' => '0.000', 'table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][totalttc]', 'label' => 'Total TTC', 'readonly' => true]); ?>

              <?php
              echo $this->Form->control('totalttcdl', ['id' => 'totalttcdl', 'type' => 'hidden', 'value' => '0.000', 'table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][totalttcdl]', 'label' => 'Total TTC', 'readonly' => true]); ?>

            </div>
          </div>
        </div>
      </div>
      <div align="center" class="addoffreggb" id="e1">
        <button type="submit" class="pull-right btn btn-success btn-sm" id="poi1ntv"
          style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
      </div>
      <?php echo $this->Form->end(); ?>

    </div>
  </section>
</div>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>

<script>
  $(document).ready(function () {
    var selectPS = document.getElementById('ch81');
    var ajouterligneGGB = document.getElementById('ajouter_ligne_offreggb');
    $("#ch81").on("change", function () {
      val = $(this).val();//alert(val)
      if (Number(val)) {
        ajouterligneGGB.classList.remove("disabled");
      } else {
        ajouterligneGGB.classList.add("disabled");
      }
    });
  });
</script>
<script>
  function getTauxChange(devise) {
    const apiKey = 'fba6e8ad2ac7e46125bc58df';
    const url = `https://v6.exchangerate-api.com/v6/${apiKey}/latest/${devise}`;
    fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error('Erreur lors de la récupération des données');
        }
        return response.json();
      })
      .then(data => {
        const tauxTND = data.conversion_rates.TND;
        document.getElementById('tauxChange').value = tauxTND;
        document.getElementById('message').textContent = '';
      })
      .catch(error => {
        document.getElementById('message').textContent = 'Erreur: Impossible de récupérer le taux de change.';
        document.getElementById('tauxChange').value = '';

      });
  }
  function getTauxChange2(devise) {
    const apiKey = 'fba6e8ad2ac7e46125bc58df';
    const url = `https://v6.exchangerate-api.com/v6/${apiKey}/latest/${devise}`;
    fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error('Erreur lors de la récupération des données');
        }
        return response.json();
      })
      .then(data => {
        const tauxTND = data.conversion_rates.TND;
        document.getElementById('tauxChange2').value = tauxTND;
        document.getElementById('message2').textContent = '';
      })
      .catch(error => {
        document.getElementById('message2').textContent = 'Erreur: Impossible de récupérer le taux de change.';
        document.getElementById('tauxChange2').value = '';

      });
  }
  $(document).ready(function () {
    $('#deviseSelect').on('change', function () {
      // var devise_id = $(this).val();
      devise_id = $('#devis_id').val();
      // var devise = mapDevise(devise_id);

      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'getdevise']) ?>",
        dataType: "json",
        data: {
          devise_id: devise_id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function (data) {
          console.log(data)
          var devis = data.code;
          getTauxChange(devis);
        }

      })
    });
    $('#deviseSelect2').on('change', function () {
      // var devise_id = $(this).val();
      devise_id = $('#devis_id2').val();
      // var devise = mapDevise(devise_id);

      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'getdevise']) ?>",
        dataType: "json",
        data: {
          devise_id: devise_id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function (data) {
          console.log(data)
          var devis = data.code;
          getTauxChange2(devis);
        }

      })
    });
  });

</script>
<script>
  function openWindow(h, w, url) {
    //alert()
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
  }

  $('.select2').select2({
    width: '100%' // need to override the changed default
  });

</script>
<script>

  $(document).ready(function () {
    $(".calcull").on("keyup", function () {
      index = $("#index").val(); //nombre de ligne total
      index1 = $("#indexa").val();
      index = $("#index").val();
      indexl = $("#indexoffreggb").val();
      tt = 0;
      total = 0;
      for (i = 0; i <= Number(indexl); i++) {
        sup = $("#sup" + i).val() || 0;
        if (Number(sup) != 1) {
          qte = $("#qte" + j + "-" + i).val();
          prix = $("#prix" + j + "-" + i).val();
          tot = Number(qte) * Number(prix);
          total = Number(total) + Number(tot);
          $("#total" + j + "-" + i).val(Number(tot).toFixed(3)); ///('afef')
        }

        tt = Number(tt) + Number(total);
        $("#t" + j).val(Number(tt).toFixed(3));
      }
    });
    $(".calculprix").on("keyup", function () {
      // index = $("#index").val();
      // index1 = $("#indexa").val();
      index = $("#indexoffreggb").val();
      // indexl = $("#indexa" + index).val();

      prixMG = 0;
      prixMQ = 0;
      total = 0;
      totalmarge = 0;
      totalmarque = 0;
      for (i = 0; i <= Number(index); i++) {
        sup = $("#sup0" + i).val() || 0;
        if (Number(sup) != 1) {
          prixrevient = $("#coutrevient" + i).val(); //alert(prixrevient)
          MG = $("#tauxdemarge" + i).val() || 0; //alert(MG)
          MQ = $("#tauxdemarque" + i).val() || 0; //alert(MQ)
          console.log('mg ' + MG);
          if (MG && MQ) {
            alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
            $("#tauxdemarge" + i).val('');
            $("#tauxdemarque" + i).val('');
            $("#prixht" + i).val('');
            // $("#punht" + i).val('');
          } else if (MG) {
            prixMG = Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100)
            prixMG = Math.floor(prixMG); // Conversion en entier
            $("#prixht" + i).val(prixMG);
            //$("#punht" + i).val(prixMG);
            margel = Number(prixMG) * Number(MG / 100);
            totalmarge = (Number(totalmarge) + Number(margel)).toFixed(3);
          } else if (MQ) {
            prixMQ = Number(prixrevient) + (Number(MQ) * Number(prixrevient) / 100); //alert(prixMQ)
            $("#prixht" + i).val(Number(prixMQ).toFixed(3));
            marquel = Number(prixMQ) * Number(MQ / 100);
            totalmarque = (Number(totalfodec) + Number(marquel)).toFixed(3);
            // $("#punht" + i).val(prixMG);
          } else {
            $("#prixht" + i).val(Number(prixrevient).toFixed(3));
          }
        }
      }
      $("#totalmarge").val(Number(totalmarge).toFixed(3));
      $("#totalmarque").val(Number(totalmarque).toFixed(3));

    });
  });
</script>
<!-- <script>
    $(document).ready(function () {
      $(".calculprix").on("keyup", function () {
        // index = $("#index").val();
        index1 = $("#indexa").val();
        index = $("#indexoffreggb").val();
        indexl = $("#indexa" + index).val();
          prixMG = 0;
          prixMQ = 0;
          total = 0;
          for (i = 0; i <= Number(index); i++) {
            sup = $("#sup" + i).val() || 0;
            if (Number(sup) != 1) {
              prix = $("#prix" + j + "-" + i).val(); //alert(prix)
              MG = $("#tauxdemarge" + j + "-" + i).val(); //alert(MG)
              MQ = $("#tauxdemarque" + j + "-" + i).val(); //alert(MQ)
              if (MG && MQ) {
                alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
                $("#tauxdemarge" + j + "-" + i).val('');
                $("#tauxdemarque" + j + "-" + i).val('');
                $("#coutrevient" + j + "-" + i).val('');
              } else if (MG) {
                prixMG = Number(prix) + (Number(MG) * Number(prix) / 100);
                prixMG = Math.floor(prixMG); // Conversion en entier
                $("#coutrevient" + j + "-" + i).val(prixMG);
              } else if (MQ) {
                prixMQ = Number(prix) + (Number(MQ) * Number(prix) / 100);
                $("#coutrevient" + j + "-" + i).val(Number(prixMQ).toFixed(3));
              }
            
          }
        }
      });
    });
  </script> -->
<script>
  $("#ajouter_ligne_offreggb").on("click", function () {
    id = $("#ch81").val();
    if (id == "Veuillez choisir !!") {
      alert("Vous devez choisir Produit ou Service");
    } else {
      ajouter_lignefares("tabligne3", "indexoffreggb");
    }
  });
  $('.categorieggb').on('click', function () {
    id = $("#ch81").val();
    if (id == "Veuillez choisir !!") {
      event.preventDefault();
    };
    index = Number($("#indexoffreggb").val());
    $.ajax({
      method: "GET",
      url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'getcategorieoffrggb']) ?>",
      dataType: "json",
      data: {
        id: id,
        index: index,
      },
      headers: {
        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
      },
      success: function (data) {
        $('#tdarticle' + index).html(data.select);
        setTimeout(function () {
          $('#tdarticle' + index + ' select').select2();
        }, 100);
        // $('#ch81').prop('disabled', true);

      }
    })
  });
</script>
<style>
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  ;

  input[type="number"] {
    -moz-appearance: textfield;
  }
</style>