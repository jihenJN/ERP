<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Livraison $livraison
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php //echo $this->Html->script('alert'); 
?>
<?php echo $this->Html->css('select2'); ?>

<?php //echo $this->Html->script('controle_frs'); 
?>

<section class="content-header">
  <h1>
    Facture Achat
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index', $typef, $typefac]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box">
        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($facture, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="row">


            <div class="col-md-6">
              <?php
              echo $this->Form->control('numero', ['label' => 'Numéro']);
              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->control('date', ['readonly' => 'readonly', 'empty' => true]);

              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->control('fournisseur_id', ['options' => $fournisseurs, 'class' => 'select2 form-control']);

              ?>
            </div>
            <div class="col-md-6">
              <?php
              // echo $this->Form->control('adresselivraisonfournisseur_id', ["label" => "adresse livraison fournisseur", 'class'=>'select2 form-control']);

              ?>
            </div>
            <div class="col-md-6">
              <?php
              // echo $this->Form->control('pointdevente_id', ["label" => "point de vente", 'options' => $pointdeventes, 'class'=>'select2 form-control']);

              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->control('depot_id', ['options' => $depots, 'class' => 'select2 form-control']);

              ?>
            </div>

            <div class="col-xs-6" hidden>
              <?php
              echo $this->Form->control('service_id', [
                'label' => 'Service',
                'required' => 'off',
                'empty' => 'Veuillez choisir!!!',
                'class' => 'form-control select2 ',
                'type' => 'select',
                'options' => $services

              ]);
              ?>
            </div>
            <div class="col-xs-6" hidden>
              <?php
              echo $this->Form->control('machine_id', [
                'label' => 'Machine',
                'required' => 'off',
                'empty' => 'Veuillez choisir!!!',
                'class' => 'form-control select2 ',
                'type' => 'select',
                'options' => $machines

              ]);
              ?>
            </div>

            <!-- <div class="col-md-6">
              <?php
              echo $this->Form->control('facturefournisseur', ["label" => "N° Facture fournisseur", 'class' => 'form-control']);

              ?>
            </div> -->

            <!-- <div class="col-md-6">
              <?php
              echo $this->Form->control('datefournisseur', ["label" => "Date Facture fournisseur", 'class' => 'form-control']);

              ?>
            </div> -->



            <!-- <div class="col-xs-6">
              <?php echo $this->Form->control('observation', ['label' => 'Commentaire', 'class' => 'form-control', 'type' => 'textarea']); ?>
            </div> -->






          </div>

        </div>
        <!-- /.box-body -->
        <section class="content-header">
          <h1 class="box-title"><?php echo __('Ligne Facture'); ?></h1>
        </section>
        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">
              <div class="box-header with-border">


              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                    <thead>
                      <tr>
                        <td align="center" style="width: 15%;"><strong>Code</strong> </td>
                        <td align="center" style="width: 25%;"><strong>Designation</strong> </td>
                        <td align="center" style="width: 6%;"><strong> Qté</strong></td>
                        <td align="center" style="width: 12%;"><strong>Prix HT </strong></td>
                        <td align="center" style="width: 12%;"><strong> PUNHT</strong></td>
                        <td align="center" style="width: 8%;"><strong> Remise </strong></td>

                        <th hidden scope="col">Fodec</th>

                        <td align="center" style="width: 6%;"><strong>TVA </strong></td>
                        <td align="center" style="width: 12%;"><strong> TTC </strong></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="tr" style="display: none !important;font-size: 18px;font-weight: bold;" align="center">
                        <td champ="tdcode"><input table="tabligne3" index="" class="getdesignation articleidbl1" champ="article_idcode" type="text">

                          <datalist table="tabligne3" index="" champ="codearticle_id">
                            <?php foreach ($articles as $id => $article) { ?>
                              <option value="<?php echo $article->Code; ?>">

                              </option>

                            <?php } ?>
                          </datalist>
                        </td>
                        <td champ="tddes">
                          <input table="tabligne3" index="" class="getcode articleidbl1des" champ="article_iddes" type="text">

                          <datalist table="tabligne3" index="" champ="desarticle_id">
                            <?php foreach ($articles as $id => $article) { ?>
                              <option value="<?php echo $article->Dsignation; ?>">

                              </option>

                            <?php } ?>
                          </datalist>
                        </td>

                        <!--                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" type='text' champ='codefrs' class='form-control httbc getprixarticle' class='input'>
                        </td>-->
                        <td style="width: 10%;" align="center">
                          <input type="hidden" champ="sup" table="tabligne3" index="" class="form-control">
                          <input type="hidden" table="tabligne3" name="" readonly champ="article_idd" class="  form-control" index>

                          <input table="tabligne3" type='text' champ='qte' class='form-control httbc ' class='input'>
                        </td>

                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" type='text' champ='prix' class='form-control httbc getprixarticle' class='input'>
                        </td>

                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" type='text' champ='remise' class='form-control httbc' class='input'>
                        </td>

                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" type='text' champ='ht' class='form-control httbc' class='input'>
                        </td>
                        <td style="width: 10%;" align="center" hidden>
                          <input table="tabligne3" type='text' champ='fodec' class='form-control httbc' class='input'>
                        </td>
                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" type='text' champ='tva' class='form-control httbc' class='input'>
                        </td>
                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" type='text' champ='ttc' class='form-control httbc' class='input'>
                        </td>

                      </tr>
                      <?php foreach ($lignes as $indice => $ligne) :
                       // debug($ligne);
                        ?>
                        <tr style="font-size: 18px;font-weight: bold;">
                          <td champ="tdcode">
                            <input table="tabligne3" index="<?= h($indice) ?>" class="getdesignation articleidbl1" id="article_idcode<?= h($indice) ?>" champ="article_idcode"
                              type="text" list="codearticle_id<?= h($indice) ?>"
                              value="<?php echo htmlspecialchars($ligne->article->Code, ENT_QUOTES, 'UTF-8'); ?>">
                            <datalist table="tabligne3" index="<?= h($indice) ?>"
                              id="codearticle_id<?= h($indice) ?>"
                              champ="codearticle_id">
                              <?php foreach ($articles as $article) { ?>
                                <option style="font-size: 10px;"
                                  value="<?php echo htmlspecialchars($article->Code, ENT_QUOTES, 'UTF-8'); ?>">
                                  <?php echo htmlspecialchars($article->Code, ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                              <?php } ?>
                            </datalist>
                          </td>
                          <td champ="tddes">
                            <input table="tabligne3" index="<?= h($indice) ?>" class="getcode articleidbl1des" id="article_iddes<?= h($indice) ?>"
                              champ="article_iddes" type="text" list="desarticle_id<?= h($indice) ?>"
                              value="<?php echo htmlspecialchars($ligne->article->Dsignation, ENT_QUOTES, 'UTF-8'); ?>">
                            <datalist table="tabligne3" index="<?= h($indice) ?>"
                              id="desarticle_id<?= h($indice) ?>"
                              champ="desarticle_id">
                              <?php foreach ($articles as $article) { ?>
                                <option style="font-size: 10px;"
                                  value="<?php echo htmlspecialchars($article->Dsignation, ENT_QUOTES, 'UTF-8'); ?>">
                                  <?php echo htmlspecialchars($article->Dsignation, ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                              <?php } ?>
                            </datalist>
                          </td>

                          <td>
                            <div style="display: none ">
                              <input type="" name="data[tabligne3][<?= h($indice) ?>][id]" id="id<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->id) ?>">
                            </div>

                            <input type="hidden" name="data[tabligne3][<?= h($indice) ?>][article_idd]" id="article_idd<?= h($indice) ?>" readonly index="<?= h($indice) ?>" class="form-control verifierlivr2 htbcc" value="<?= h($ligne->article_id) ?>">


                            <input type="hidden" name="data[tabligne3][<?= h($indice) ?>][sup]" id="sup<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control ">

                            <input type="text" readonly name="data[tabligne3][<?= h($indice) ?>][qte]" id="qte<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->qte) ?>">
                          </td>
                          <td>
                            <input type="text" name="data[tabligne3][<?= h($indice) ?>][prix]" id="prix<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->prix) ?>">
                          </td>
                          <td>
                            <input type="text" readonly name="data[tabligne3][<?= h($indice) ?>][punht]" id="punht<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->ht) ?>">

                          </td>
                          <td>
                            <input type="text" name="data[tabligne3][<?= h($indice) ?>][remise]" id="remise<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->remise) ?>">

                          </td>

                          <td hidden>
                            <input type="text" name="data[tabligne3][<?= h($indice) ?>][fodec]" id="fodec<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->fodec) ?>">

                          </td>
                          <td>
                            <input type="text" name="data[tabligne3][<?= h($indice) ?>][tva]" id="tva<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->tva) ?>">

                          </td>
                          <td>
                            <input type="text" readonly name="data[tabligne3][<?= h($indice) ?>][ttc]" id="ttc<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control httbc" value="<?= h($ligne->ttc) ?>">

                          </td>

                        </tr>
                      <?php endforeach; ?>

                    </tbody>
                    <input type="hidden" value="<?php echo $indice ?>" id="index0">
                  </table><br>
                </div>
              </div>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('remise', ['id' => 'totalremise', 'class' => 'form-control httbc ', 'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('ht', ['label' => 'Ht', 'id' => 'totalht', 'class' => 'form-control httbc ', 'readonly']); ?>
            </div>

            <div class="col-xs-6" hidden>
              <?php
              echo $this->Form->control('fodec', ['id' => 'totalfodec', 'class' => 'form-control httbc ', 'readonly']); ?>
            </div>

            <div class="col-xs-6">
              <?php
              echo $this->Form->control('tva', ['id' => 'totaltva', 'class' => 'form-control httbc ', 'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('timbre', ['readonly' => 'readonly', 'id' => 'timbre_id', 'value' => $timbre, 'class' => 'form-control httbc ']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('ttc', ['id' => 'totalttc', 'class' => 'form-control httbc ', 'readonly']); ?>
            </div>
            <button type="submit" class="pull-right btn btn-success " id="livraisonSubmit" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
            <?php echo $this->Form->end(); ?>
          </div>

        </section>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>
<script>
  $(document).ready(function() {

    $('.httbc').on('keyup', function() {

      calculeachatavctimbre();

    });

    function calculeachatavctimbre() {
    index = $('#index0').val();//alert(index)

    // alert(index);

    totalremise = 0; totalht = 0; totalfodec = 0;
    totaltva = 0; totalttc = 0;
    punht = 0;

    for (i = 0; i <= index; i++) {



        fodecl = 0; ht = 0; tval = 0; ttcl = 0;
        punht = 0;
        qte = $('#qte' + i).val() || 0;
        prix = $('#prix' + i).val() || 0;
        remise = $('#remise' + i).val() || 0;
        //alert(remise);
        // alert($('#fodec' + i).val())
        // if(CommandeExonfodec =='0') $('#fodec' + i).val(); else $('#fodec' + i).val(0);
        //if(CommandeExontva =='0') $('#tva' + i).val(); else $('#tva' + i).val(0);

        fodec = $('#fodec' + i).val() || 0;
        // alert(fodec);
        tva = $('#tva' + i).val() || 0;
        // alert(tva);
        punht = (Number(qte) * Number(prix));

        remisel = ((Number(qte) * Number(prix)) * Number(remise / 100));
        totalremise = Number(totalremise) + Number(remisel);
        $('#punht' + i).val(Number(punht).toFixed(3));

        ht = (Number(qte) * Number(prix)) - Number(remisel);
        $('#ht' + i).val(Number(ht).toFixed(3));
        // alert(ht); 

        totalht = Number(totalht) + Number(ht);
        fodecl = Number(ht) * Number(fodec / 100);
        totalfodec = Number(totalfodec) + Number(fodecl);
        htfodec = Number(ht) + Number(fodecl);
        tval = Number(htfodec) * Number(tva / 100);
        totaltva = Number(totaltva) + Number(tval);
        ttcl = Number(htfodec) + Number(tval);
        $('#ttc' + i).val(Number(ttcl).toFixed(3));
        totalttc = Number(totalttc) + Number(ttcl);
    }

    timbre = $('#timbre_id').val();
    //alert(timbre);
    totalttc = Number(totalttc) + Number(timbre);
    //  alert(totalttc);
    $('#punht').val(Number(punht).toFixed(3));
    $('#totalremise').val(Number(totalremise).toFixed(3));
    $('#totalht').val(Number(totalht).toFixed(3));
    $('#totalfodec').val(Number(totalfodec).toFixed(3));
    $('#totaltva').val(Number(totaltva).toFixed(3));
    $('#totalttc').val(Number(totalttc).toFixed(3));

}
    $('.getcode').on('change', function() {
      index = $(this).attr('index'); //alert(index);
      selectedcodename = $(this).val(); //alert(selectedcodename);
      if (selectedcodename !== "") {

        $.ajax({
          method: "GET",
          url: "<?= $this->Url->build(['controller' => 'Livraisons', 'action' => 'getcode']) ?>",
          dataType: "json",
          data: {
            client: selectedcodename,
            index: index,
          },
          headers: {
            "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
          },
          success: function(data) {
            if (data) {
              //alert(data.select)
              //alert(data.select)
              // Determine which dropdown to update based on the ID

              //  $("#tdcode"+index).html(data.select);
              $("#codearticle_id" + index).html(data.select);
              $('#article_idcode' + index).val(data.value);
              $('#article_idcode' + index).focus();

              //  $("#idclient1").html(data.select1);


              // Trigger change event on updated dropdown if necessary
              // $(this).trigger("change");
            }
          },
        });
      }
    });

    $('.getdesignation').on('change', function() {
      index = $(this).attr('index'); //alert(index);
      selectedcodename = $(this).val(); //alert(selectedcodename);
      if (selectedcodename !== "") {

        $.ajax({
          method: "GET",
          url: "<?= $this->Url->build(['controller' => 'Livraisons', 'action' => 'getdesignation']) ?>",
          dataType: "json",
          data: {
            client: selectedcodename,
            index: index,
          },
          headers: {
            "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
          },
          success: function(data) {
            if (data) {
              //alert(data.select)
              //alert(data.select)
              // Determine which dropdown to update based on the ID

              //$("#tddes"+index).html(data.select);
              $("#desarticle_id" + index).html(data.select);
              $('#article_iddes' + index).val(data.value);
              $('#article_iddes' + index).focus();


              //  $("#idclient1").html(data.select1);


              // Trigger change event on updated dropdown if necessary
              // $(this).trigger("change");
            }
          },
        });
      }
    });
    $(function() {

      function getdesignation(selectedcodename, index) {

        // selectedcodename = $(this).val();
        // alert(selectedcodename);
        // index = $(this).attr('index');//alert(index);
        // electedcodename = $(this).val();//alert(selectedcodename);

        if (selectedcodename !== "") {

          $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Livraisons', 'action' => 'getdesignation']) ?>",
            dataType: "json",
            data: {
              client: selectedcodename,
              index: index,
            },
            headers: {
              "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
            },
            success: function(data) {
              if (data) {
                //alert(data.select)
                //alert(data.select)
                // Determine which dropdown to update based on the ID

                $("#tddes" + index).html(data.select);

                //  $("#idclient1").html(data.select1);


                // Trigger change event on updated dropdown if necessary
                // $(this).trigger("change");
              }
            },
          });
        }
      }

      function getcode(selectedcodename, index) {

        // selectedcodename = $(this).val();alert(selectedcodename);
        // index = $(this).attr('index');//alert(index);
        // electedcodename = $(this).val();//alert(selectedcodename);


        if (selectedcodename !== "") {

          $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Livraisons', 'action' => 'getcode']) ?>",
            dataType: "json",
            data: {
              client: selectedcodename,
              index: index,
            },
            headers: {
              "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
            },
            success: function(data) {
              if (data) {
                //alert(data.select)
                //alert(data.select)
                // Determine which dropdown to update based on the ID

                $("#tdcode" + index).html(data.select);

                //  $("#idclient1").html(data.select1);


                // Trigger change event on updated dropdown if necessary
                // $(this).trigger("change");
              }
            },
          });
        }
      }


    });
  });
  $('.articleidbl1des').on('change', function() {
    // alert("hh");
    index = $(this).attr('index');
    //  alert(index);
    article_id = $('#article_iddes' + index).val(); //alert(article_id);
    //alert(article_id);
    // datecreation = $('#date').val();
    idClient = $('#fournisseur-id').val();
    // depot_id = $('#depot_id').val(); //alert(depot_id)
    //alert(depot_id);
    $.ajax({
      method: "GET",
      type: "GET",
      url: "<?= $this->Url->build(['controller' => 'Livraisons', 'action' => 'getquantitedes']) ?>",
      dataType: "JSON",
      data: {
        idarticle: article_id,
        // idadepot: depot_id,
        // idClient: idClient,
        // date: datecreation,
      },
      success: function(response) {
        //  alert(response);
        // qtestockx = response['inv'];

        // $('#qteStock' + index).val(qtestockx);
        $('#prix' + index).val(response['donnearticle']["Prix_LastInput"]);
        // val = (Number(response['donnearticle']["Prix_LastInput"]) * (1 - (response['donnearticle']["remise"] / 100)) * (1 + (Number(response['donnearticle']["tva"]["valeur"]) / 100))); //*(1+(Number(remise) / 100)) /*+ ((Number(puttc) - (puttc * (Number(tva) / 100))) * (Number(remise) / 100))*/;
        // $('#puttc' + index).val(val.toFixed(3));
        // $('#ml' + index).val(response['donnearticle']["ml"]);
        $('#tva' + index).val(response['donnearticle']["tva"]["valeur"]);
        // $('#fodec' + index).val(response['donnearticle']["fodec"]);
        // $('#remise' + index).val(response['donnearticle']["remise"]);
        $('#article_idd' + index).val(response['donnearticle']["id"]);
        $('#qte' + index).focus();


        // Calcul();
      }
    })
  });
  $('.articleidbl1').on('change', function() {
    // alert("hh");
    index = $(this).attr('index');
    //  alert(index);
    article_id = $('#article_idcode' + index).val(); //alert(article_id);
    //alert(article_id);
    datecreation = $('#date').val();
    idClient = $('#fournisseur-id').val();
    // depot_id = $('#depot_id').val(); //alert(depot_id)
    //alert(depot_id);
    $.ajax({
      method: "GET",
      type: "GET",
      url: "<?= $this->Url->build(['controller' => 'Livraisons', 'action' => 'getquantitecode']) ?>",
      dataType: "JSON",
      data: {
        idarticle: article_id,
        // idadepot: depot_id,
        // idClient: idClient,
        // date: datecreation,
      },
      success: function(response) {
        //  alert(response);
        // qtestockx = response['inv'];

        // $('#qteStock' + index).val(qtestockx);
        // //  response['donnearticle']["remise"]=20;
        // $('#prix' + index).val(response['donnearticle']["Prix_LastInput"]);
        // val = (Number(response['donnearticle']["Prix_LastInput"]) * (1 - (response['donnearticle']["remise"] / 100)) * (1 + (Number(response['donnearticle']["tva"]["valeur"]) / 100))); //*(1+(Number(remise) / 100)) /*+ ((Number(puttc) - (puttc * (Number(tva) / 100))) * (Number(remise) / 100))*/;
        // $('#puttc' + index).val(val.toFixed(3));
        // $('#ml' + index).val(response['donnearticle']["ml"]);
        $('#tva' + index).val(response['donnearticle']["tva"]["valeur"]);
        // $('#fodec' + index).val(response['donnearticle']["fodec"]);
        // $('#remise' + index).val(response['donnearticle']["remise"]);
        $('#article_idd' + index).val(response['donnearticle']["id"]);
        $('#qte' + index).focus();


      }
    })
  });
  $(document).ready(function() {
    calculeachatavctimbre();
  })
  $(function() {
    $('#fournisseur-id').on('change', function() {
      //alert('hello');
      id = $('#fournisseur-id').val();
      //alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Facture', 'action' => 'getadresselivraison']) ?>",

        dataType: "json",
        data: {
          idfam: id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {

          $('#adresselivraisonfournisseur').html(data.select);

        }
      })
    });
  });

  $('.ajouterligne_w').on('click', function() {
    table = $(this).attr('table');
    //alert(table);
    index = $(this).attr('index');
    ajouter_lignee(table, index);
  })
</script>

<script>
  function ajouter_lignee(table, index) {
    ind = Number($('#' + index).val()) + 1;
    // alert(table);
    $ttr = $('#' + table).find('.tr').clone(true);
    $ttr.attr('class', '');
    i = 0;
    tabb = [];
    $ttr.find('input,select,textarea,tr,td,div').each(function() {
      tab = $(this).attr('table'); //alert(tab)
      champ = $(this).attr('champ');
      $(this).attr('index', ind);
      $(this).attr('id', champ + ind);
      $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
      $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
      $type = $(this).attr('type');
      $(this).val('');
      if ($type == 'radio') {
        $(this).attr('name', 'data[' + champ + ']');
        $(this).val(ind);
      }
      if ((champ == 'datedebut') || (champ == 'datefin')) {
        $(this).attr('onblur', 'nbrjour(' + ind + ')')
      }
      $(this).removeClass('anc');
      if ($(this).is('select')) {
        tabb[i] = champ + ind;
        i = Number(i) + 1;
      }
    })
    $ttr.find('i').each(function() {
      // alert('hh');
      $(this).attr('index', ind);
    });
    $('#' + table).append($ttr);
    $('#' + index).val(ind);
    $('#' + table).find('tr:last').show();
    for (j = 0; j <= i; j++) {}
  }
</script>
<script>
  $(function() {
    $('#fournisseur-id').on('change', function() {
      //alert('hello');
      id = $('#fournisseur-id').val();
      // alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Livraisons', 'action' => 'getadresselivraison']) ?>",
        dataType: "json",
        data: {
          idfam: id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          // alert(data.ligne.Fodec);
          $('#adresselivraisonfournisseur-id').html(data.select);
          // uniform_select('adresse');
          $('#exofodec').val(data.ligne.Fodec);
          $('#exotva').val(data.ligne.R_TVA);
        }
      })
    });
  });
  $('.ajouterligne_w').on('click', function() {

    table = $(this).attr('table');
    //alert(table);
    index = $(this).attr('index');
    ajouter_ligne(table, index);
  })
  $('.btnajout').on('mouseover', function() {
    //alert('marwa')
    depot = $('#depot-id').val();
    //alert(namepv)
    if (depot == '') {
      alert('choisir depot SVP !!', function() {});
    }
  });
</script>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    })
  })
  $('.select2').select2();
  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('dd/mm/yyyy', {
    'placeholder': 'dd/mm/yyyy'
  })
  //Datemask2 mm/dd/yyyy
  $('#datemask2').inputmask('mm/dd/yyyy', {
    'placeholder': 'mm/dd/yyyy'
  })
  //Money Euro
  $('[data-mask]').inputmask()
  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    format: 'MM/DD/YYYY h:mm A'
  })
</script>

<?php $this->end(); ?>