<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Livraison $livraison
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->css('select2'); ?>


<section class="content-header">
  <h1>
    Livraison Achat
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index/' . $typebl]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box ">

        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($livraison, ['role' => 'form']); ?>
        <div class="box-body">

          <div class="row">

            <div class="col-md-6">
              <?php
              // echo $this->Form->control('numero', ["value" => "BL" . sprintf('%04d', $numero + 1), 'readonly' => 'readonly']);
              echo $this->Form->control('numero', ['label' => 'Numéro','value'=>$b,'readonly']);


              ?>
            </div>
            <div class="col-xs-6">
              <?php
              date_default_timezone_set('Africa/Tunis');
              $now = date('Y-m-d H:i:s');
              echo $this->Form->control('date', ['value' => $now]);
              ?>
            </div>
            <!-- <div class="col-md-6">
              <?php
              // echo $this->Form->control('date', ['empty' => true, 'value' => date("d/m/Y"), 'class' => 'form-control', 'id' => 'date']);

              ?>
            </div> -->
            <div class="col-md-6">
              <?php
              echo $this->Form->control('fournisseur_id', ['options' => $fournisseurs, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control ajoutttt select2']);

              ?>
            </div>


            <div class="col-md-6">
              <?php
              echo $this->Form->control('depot_id', ['options' => $depots, 'value' => 2,  'class' => 'form-control select2']);

              ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('blfournisseur', ['label' => 'N° BL Fournisseur', 'class' => 'form-control  control-label', 'id' => 'blfournisseur']);
              ?> </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('observation', ['label' => 'Commentaire', 'class' => 'form-control', 'type' => 'textarea']); ?>
            </div>

            <div class="col-md-6" hidden>
              <?php
              echo $this->Form->control('cartecarburant_id', ["label" => "carte carburant", 'options' => $cartecarburants, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2']);

              ?>
            </div>
            <div class="col-md-6" hidden>
              <?php
              echo $this->Form->control('materieltransport_id', ["label" => "materiel du transport", 'options' => $materieltransports, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2']);

              ?>
            </div>
            <div class="col-md-6" hidden>
              <?php
              echo $this->Form->control('kilometragedepart', ['label' => "kilometrage de depart"]);

              ?>
            </div>
            <div class="col-md-6" hidden>
              <?php
              echo $this->Form->control('kilometragearrive', ["label" => "kilometrage d'arrive"]);

              ?>
            </div>
            <div class="col-md-6" hidden>
              <?php
              echo $this->Form->control('conffaieur_id', ['options' => $conffaieurs, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2']);
              ?>
            </div>
            <div class="col-md-6" hidden>
              <?php
              echo $this->Form->control('chauffeur_id', ['options' => $chauffeurs, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2']);
              ?>

            </div>

          </div>
        </div>
        <!-- /.box-body -->

        <section class="content-header">
          <h1 class="box-title"><?php echo __('Ligne Livraison'); ?></h1>
        </section>
        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">
              <div class="box-header with-border">
                <a class="btn btn-primary  btnajout" table='addtable' index='index3' id='ajouter_ligne33' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                  <i class="fa fa-plus-circle "></i> Ajouter Ligne Livraison</a>

              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                    <thead>
                      <tr>

                        <td align="center" style="width: 15%;"><strong>Code</strong> </td>
                        <td align="center" style="width: 25%;"><strong>Designation</strong> </td>
                        <td align="center" style="width: 6%;"><strong> Quantité</strong></td>
                        <td align="center" style="width: 12%;"><strong>Prix HT </strong></td>
                        <td align="center" style="width: 8%;"><strong> Remise </strong></td>
                        <td align="center" style="width: 12%;"><strong> PUNHT</strong></td>
                        <th hidden scope="col">Fodec</th>

                        <td align="center" style="width: 6%;"><strong>TVA </strong></td>
                        <td align="center" style="width: 12%;"><strong> TTC </strong></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="tr" style="display: none;font-size: 18px;font-weight: bold;">


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
                          <input table="tabligne3" type='text' champ='codefrs' class='form-control htbcdalandadalanda getprixarticle' class='input'>
                        </td>-->
                        <td style="width: 10%;" align="center">
                          <input type="hidden" table="tabligne3" name="" readonly champ="article_idd" class="  form-control" index>

                          <input type="hidden" champ="sup" table="tabligne3" index="" class="form-control ">

                          <input table="tabligne3" type='text' champ='qte' class='form-control htbcdalanda ' class='input'>
                        </td>
    
                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" type='text' champ='prix' class='form-control htbcdalanda ' class='input'>
                        </td>

                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" type='text' champ='remise' class='form-control htbcdalanda' class='input'>
                        </td>

                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" type='text' champ='punht' class='form-control htbcdalanda' class='input'>
                        </td>
                        <td style="width: 10%;" align="center" hidden>
                          <input table="tabligne3" type='text' champ='fodec' class='form-control htbcdalanda' class='input'>
                        </td>
                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" type='text' champ='tva' class='form-control ajoutligneeetva htbcdalanda' class='input'>
                        </td>
                        <td style="width: 10%;" align="center">
                          <input table="tabligne3" readonly type='text' champ='ttc' class='form-control  htbcdalanda' class='input'>
                        </td>
                        <td style="width: 5%;" align="center"><i class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;"></td>

                      </tr>
                    </tbody>
                  </table><br>
                  <input type="hidden" value=-1 id="index3">
                </div>

              </div>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('remise', ['id' => 'remise', 'class' => 'form-control htbcdalanda ', 'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('ht', ['id' => 'ht', 'class' => 'form-control htbcdalanda ', 'readonly']); ?>
            </div>

            <div class="col-xs-6" hidden>
              <?php
              echo $this->Form->control('fodec', ['id' => 'fodec', 'class' => 'form-control htbcdalanda ', 'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('ttc', ['id' => 'ttc', 'class' => 'form-control htbcdalanda  ajoutligneeettc ', 'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('tva', ['id' => 'tva', 'class' => 'form-control htbcdalanda ', 'readonly']); ?>
            </div>

            <button type="submit" class="pull-right btn btn-success btn-sm" id="livraisonSubmit" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
            <?php echo $this->Form->end(); ?>
          </div>
        </section>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<!-- <script>
  function ajouter_ligne(table, index) {
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
</script> -->


<?php $this->start('scriptBottom'); ?>

<script>

$('.htbcdalanda').on('keyup', function () {
    // alert('aaaaaaaaa');
    calculeachatdal();

  });
  function calculeachatdal() {
    index = $('#index3').val();  //alert(index)



    totalremise = 0; totalht = 0; totalfodec = 0;
    totaltva = 0; totalttc = 0;
    for (i = 0; i <= index; i++) {
        sup = $('#sup' + i).val() || 0;
        if (Number(sup) != 1) {


            fodecl = 0; ht = 0; tval = 0; ttcl = 0;
            punht = 0;
            qte = $('#qte' + i).val() || 0;
            prix = $('#prix' + i).val() || 0;
            remise = $('#remise' + i).val() || 0;


            fodec = $('#fodec' + i).val() || 0;
            // alert(fodec);
            tva = $('#tva' + i).val() || 0;
            // alert(tva);
            punht = punht + (Number(qte) * Number(prix));
            //alert(punht);
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
    }
    //timbre=$('#timbre').val()||0;
    //totalttc=Number(totalttc)+Number(timbre);
    $('#punht').val(Number(punht).toFixed(3));
    $('#remise').val(Number(totalremise).toFixed(3));
    $('#ht').val(Number(totalht).toFixed(3));
    $('#fodec').val(Number(totalfodec).toFixed(3));
    $('#tva').val(Number(totaltva).toFixed(3));
    $('#ttc').val(Number(totalttc).toFixed(3));

}
  $('.ajoutttt').on('change', function() {

    $('html, body').animate({
      scrollTop: $("#tabligne3").offset().top
    }, 1000);
    // ajoutermk("tabligne", "index");
    ajouter_lignefares("tabligne3", "index3");
  })
  $('.ajoutligneeettc').on('keyup', function(event) {
    if (event.key === "Enter") {
      // alert('dddddddddddddddd');
      $('html, body').animate({
        scrollTop: $("#tabligne3").offset().top
      }, 1000);
      ajouter_lignefares("tabligne3", "in");
    }
  });



  $('.htbcdalandadalanda').on('keyup', function() {
    //alert('aaaaaaaaa');
    calculeachat();

  });

  function calculeachat() {
    index = $('#index3').val(); //alert(index)



    totalremise = 0;
    totalht = 0;
    totalfodec = 0;
    totaltva = 0;
    totalttc = 0;
    for (i = 0; i <= index; i++) {
      sup = $('#sup' + i).val() || 0;
      if (Number(sup) != 1) {


        fodecl = 0;
        ht = 0;
        tval = 0;
        ttcl = 0;
        punht = 0;
        qte = $('#qte' + i).val() || 0;
        prix = $('#prix' + i).val() || 0;
        remise = $('#remise' + i).val() || 0;


        fodec = $('#fodec' + i).val() || 0;
        // alert(fodec);
        tva = $('#tva' + i).val() || 0;
        // alert(tva);
        punht = punht + (Number(qte) * Number(prix));
        //alert(punht);
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
    }
    //timbre=$('#timbre').val()||0;
    //totalttc=Number(totalttc)+Number(timbre);
    $('#punht').val(Number(punht).toFixed(3));
    $('#remise').val(Number(totalremise).toFixed(3));
    $('#ht').val(Number(totalht).toFixed(3));
    $('#fodec').val(Number(totalfodec).toFixed(3));
    $('#tva').val(Number(totaltva).toFixed(3));
    $('#ttc').val(Number(totalttc).toFixed(3));

  }


  $('.select2').select2();
</script>
<script>
  $(document).ready(function() {
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
  // });
  $(function() {
    $('#fournisseur-id').on('change', function() {
      //alert('hello');
      id = $('#fournisseur-id').val();
      //alert(id)
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
          $('#adresselivraisonfournisseur').html(data.select);
          // uniform_select('adresse');
          //          $('#exofodec').val(data.ligne.Fodec);
          //          $('#exotva').val(data.ligne.R_TVA);
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
</script>

<script>
  function ajouter_ligne(table, index) {
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
    //alert('dalanda')
    numero = $('#numero').val();
    depot = $('#depot-id').val();
    fournisseur = $('#fournisseur-id').val();
    if (numero == '') {
      alert('choisir numéro SVP !!', function() {});
    }
    if (fournisseur == '') {
      alert('choisir fournisseur SVP !!', function() {});
    }
    //alert(namepv)
    if (depot == '') {
      alert('choisir depot SVP !!', function() {});
    }

  });
</script>
<script>
  function ajouterlignepress() {

    if (event.keyCode == 120 || event.keyCode == 107 || event.keyCode == 9) {
      table = $(this).attr("table");
      //alert(table)
      //alert(table);

      //  alert("hh");
      //  alert(index);
      ind = Number($('#index').val()) + 1;

      //ind = Number($("#" + index).val()) + 1;
      //alert(ind)
      $ttr = $("#" + table)
        .find(".tr")
        .clone(true);
      $ttr.attr("class", "");
      i = 0;
      tabb = [];
      $ttr.find("input,select,textarea,tr,td,div,ul,li").each(function() {

        tab = $(this).attr("table"); //alert(tab)
        champ = $(this).attr("champ");
        $(this).attr("index", ind);
        $(this).attr("id", champ + ind); //alert(champ);
        if (champ == "marchandisetype_id") {
          //alert(champ)
          $(this).attr("name", "data[" + tab + "][" + ind + "][" + champ + "][]");
          $(this).attr(
            "data-bv-field",
            "data[" + tab + "][" + ind + "][" + champ + "]"
          );
        } else {
          $(this).attr("name", "data[" + tab + "][" + ind + "][" + champ + "]");
          $(this).attr(
            "data-bv-field",
            "data[" + tab + "][" + ind + "][" + champ + "]"
          );
        }
        $type = $(this).attr("type");
        $(this).val("");
        if ($type == "radio") {
          $(this).attr("name", "data[" + champ + "]");
          //$(this).attr('value',ind);
          $(this).val(ind);
        }
        if (champ == "datedebut" || champ == "datefin") {
          $(this).attr("onblur", "nbrjour(" + ind + ")");
        }
        $(this).removeClass("anc");
        if ($(this).is("select", "multiple")) {
          //alert(champ);
          //alert(ind);
          tabb[i] = champ + ind; //alert(tabb[i]);
          i = Number(i) + 1;
        }
        // $(this).val('');
      });

      $ttr.find("i").each(function() {

        $(this).attr("index", ind);
      });
      $("#" + table).append($ttr);
      //alert(ind+"ind")
      $("#index").val(ind);

      $("#" + table)
        .find("tr:last")
        .show();
      $("#article_id" + ind).select2({
        width: "100%", // need to override the changed default
      });
      $("#charge_id" + ind).select2({
        width: "100%", // need to override the changed default
      });
      $("#article" + ind).select2({
        width: "100%", // need to override the changed default
      });
      $("#article" + ind).select2({
        width: "100%", // need to override the changed default
      });
      $("#client_id" + ind).select2({
        width: "100%", // need to override the changed default
      });
      $("#fr_id" + ind).select2({
        width: "100%", // need to override the changed default
      });
      $("#banque_id" + ind).select2({
        width: "100%", // need to override the changed default
      });
      $("#typeexon_id" + ind).select2({
        width: "100%", // need to override the changed default
      });

      $("#gouvernorat_id" + ind).select2({
        width: "75%", // need to override the changed default
      });
      //indd = Number($("#" + index).val()) ;
      //alert(indd);
      $("#inserted" + ind).val(1);

      for (j = 0; j <= i; j++) {
        // alert(tabb[j]);
        //  $('marchandisetype_id1').attr('class','select2');
        //  uniform_select(tabb[j]); jareb
        //$('#'+tabb[j]).select2({ });
      }
    }
  }
</script>





<?php $this->end(); ?>