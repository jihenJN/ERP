<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('salma'); ?>

<?php echo $this->fetch('script'); ?>



<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ajout facture
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($factureclient, ['role' => 'form']); ?>


        <div class="box-body">
          <div class="row">
            <div class="row">
              <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                <div class="col-xs-6">
                  <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $mm, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                </div>
                <div class="col-xs-6">
                  <?php echo $this->Form->control('date'); ?> </div>

              </div>
            </div>


            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


              <div class="row">

                <div class="col-xs-6">

                  <?php echo $this->Form->control('client_id', ['id' => 'client', 'options' => $clients, 'empty' => 'Veuillez choisir !!', 'label' => 'Clients', 'class' => 'form-control select2 control-label']); ?>
                </div>
                <div class="col-xs-6">
                  <?php echo $this->Form->control('materieltransport_id', ['options' => $materieltransports, 'empty' => 'Veuillez choisir !!',  'required' => 'off', 'label' => 'Materiel de transport', 'class' => 'form-control select2 control-label']); ?></div>
              </div>
            </div>


            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


              <div class="row">

                <div class="col-xs-6">

                  <?php echo $this->Form->control('adresselivraison_id', ['empty' => 'Veuillez choisir !!',  'required' => 'off', 'label' => 'Adresse livraison', 'class' => 'form-control select2 control-label', 'name' => 'adresselivraisonclient_id']); ?>
                </div>




                <div class="col-xs-6">
                  <div class="form-group input text required">
                    <label class="control-label" for="name">Chauffeurs</label>
                    <select class="form-control select2" name="chauffeur_id" id="chauffeur_id">
                      <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                      <?php foreach ($chauffeurs as $id => $chauffeur) { ?>
                        <option value="<?php echo $chauffeur->id; ?>"><?php echo $chauffeur->code . ' ' . $chauffeur->nom . ' ' . $chauffeur->prenom ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>




              </div>
            </div>




            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


              <div class="row">

                <div class="col-xs-6">
                  <?php echo $this->Form->control('pointdevente_id', ['options' => $pointdeventes, 'empty' => 'Veuillez choisir !!',  'required' => 'off', 'label' => 'Point de vente', 'class' => 'form-control select2 control-label']); ?>
                </div>



                <div class="col-xs-6">

                  <div class="form-group input text required">
                    <label class="control-label" for="name">Conffaieur</label>
                    <select class="form-control select2" name="convoyeur_id" id="convoyeur_id">
                      <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                      <?php foreach ($conffaieurs as $id => $conffaieur) {
                      ?>

                        <option value="<?php echo $conffaieur->id; ?>"><?php echo $conffaieur->code . ' ' . $conffaieur->nom . ' ' . $conffaieur->prenom ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>




            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


              <div class="row">

                <div class="col-xs-6">
                  <?php echo $this->Form->control('depot_id', ['options' => $depots, 'empty' => 'Veuillez choisir !!',  'required' => 'off', 'label' => 'Dépot', 'class' => 'form-control select2 control-label']); ?>
                </div>



                <div class="col-xs-6">
                  <?php echo $this->Form->control('cartecarburant_id', ['options' => $cartecarburants, 'empty' => 'Veuillez choisir !!',  'required' => 'off', 'label' => 'Carte carburant', 'class' => 'form-control select2 control-label']); ?>


                </div>
              </div>
            </div>

            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


              <div class="row">

                <div class="col-xs-6">
                  <?php echo $this->Form->control('kilm_depart', ['label' => 'kilometrage depart']); ?>
                </div>


                <?php echo $this->Form->control('exotva', ['type' => 'hidden', 'value' => '']); ?>
                <?php echo $this->Form->control('exofodec', ['type' => 'hidden', 'value' => '']); ?>




                <div class="col-xs-6">
                  <?php echo $this->Form->control('kilm_arrive', ['label' => 'kilometrage arrive']); ?>


                </div>
              </div>
            </div>



            <div class="col-xs-6" style="margin-top:20px ;">

              <label style="margin-right: 10px"> Payement comptant: </label>

              <input type="checkbox" id="check" name="checkpayement" champ="checkclient" value="oui" class="ch">



            </div>








          </div>





          <section class="content-header">
            <h1 class="box-title"><?php echo __('Ligne facture'); ?></h1>
          </section>

          <section class="content" style="width: 99%">
            <div class="row">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <a class="btn btn-primary ajouterligne_w btn  btnajout" table="addtable" index="index" style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                    <i class="fa fa-plus-circle "></i> Ajouter ligne</a>

                </div>
                <div class="panel-body">
                  <div class="table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless" id="addtable">



                      <thead>
                        <tr width:20px>
                          <td align="center" style="width: 20%; font: size 20px;"><strong>Article</strong></td>
                          <td align="center" style="width:8%;font:size 20px;"><strong>Quantite Stock</strong></td>
                          <td align="center" style="width: 8%;"><strong>Quantite </strong></td>
                          <td align="center" style="width: 8%;"><strong>Prix HT </strong></td>


                          <td align="center" style="width: 8%;"><strong>Remise</strong></td>
                          <td align="center" style="width: 8%;"><strong>PUNHT </strong></td>
                          <td align="center" style="width: 8%;"><strong>Fodec </strong></td>
                          <td align="center" style="width: 8%;"><strong>Tva </strong></td>
                          <td align="center" style="width: 8%;"><strong>Ttc </strong></td>

                          <td align="center" style="width: 25%;"></td>
                        </tr>
                      </thead>
                      <tbody>







                        <tr class="tr" style="display: none ">
                          <td align="center">

                            <input type="hidden" id="" champ="supp" name="" table="ligner" index="" class="form-control">

                            <select table="ligner" index champ="article_id" class="form-control articleidbl1
                             select selectized">
                              <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                              <?php foreach ($articles as $id => $article) {


                              ?>
                                <option value="<?php echo $id; ?>"><?php echo  $article ?></option>
                              <?php } ?>
                            </select>

                          </td>
                          <td align="center" table="ligner">
                            <input table="ligner" champ="qteStock" type="text" class="form-control getprixht" index readonly>
                          </td>
                          <td align="center" table="ligner">


                            <input type="number" table="ligner" name="" id="" champ="qte" type="text" class="form-control Testqtestock " index>


                          </td>


                          <td align="center" table="ligner">
                            <input table="ligner" type="text" champ="prix" class="form-control getprixht" index name=''>
                          </td>



                          <td align="center" table="ligner">
                            <input table="ligner" type="text" name='' champ="remise" id='' class="form-control getprixht " index>
                          </td>

                          <td align="center" table="ligner">
                            <input table="ligner" type="text" name="" champ="punht" id='' index class="form-control getprixht getprixarticle">
                          </td>
                          <td align="center" table="ligner">
                            <input table="ligner" type="text" name="" champ="fodec" id='' index class="form-control getprixht getprixarticle">
                          </td>
                          <td align="center" table="ligner">
                            <input table="ligner" type="text" name="" champ="tva" id='' class="form-control getprixht" index>
                          </td>
                          <td align="center" table="ligner">
                            <input table="ligner" type="text" name="" champ="ttc" id='ttc' class="form-control getprixht" index>
                          </td>

                          <td align="center">
                            <i index id="" class="fa fa-times supLigne0ch" style="color: #c9302c;font-size: 22px;"></i>
                          </td>
                        </tr>
                        <input type="" value="-1" id="index" hidden>
                      </tbody>
                    </table><br>
                  </div>
                </div>
              </div>
            </div>


          </section>







        </div>







        <section class="content" style="width: 99%">
          <div class="row">
            <div class="row">
              <div style=" margin-left: 150px; position: static;">
                <div class="col-xs-5">
                  <?php echo $this->Form->control('Totalremise', ['id' => 'CommandeclientTotalremise', 'readonly' => 'readonly', 'value' => '', 'label' => 'Total remise', 'name', 'required' => 'off']); ?>
                </div>
                <div class="col-xs-5">
                  <?php echo $this->Form->control('Totalttc', ['id' => 'CommandeclientTotalttc', 'readonly' => 'readonly', 'value' => '', 'label' => 'Total ttc', 'name', 'required' => 'off']); ?>
                </div>

              </div>
            </div>


            <div class="row">
              <div style=" margin-left: 150px; position: static;">
                <div class="col-xs-5">
                  <?php echo $this->Form->control('Totalfodec', ['id' => 'CommandeclientTotalfodec', 'readonly' => 'readonly', 'value' => '', 'label' => 'Total fodec', 'name', 'required' => 'off']); ?>
                </div>
                <div class="col-xs-5">

                  <?php echo $this->Form->control('totalht', ['id' => 'CommandeclientTotalht', 'readonly' => 'readonly', 'value' => '', 'label' => 'Total ht', 'name', 'required' => 'off']); ?>


                </div>

              </div>
            </div>
            <div class="row">
              <div style=" margin-left: 150px; position: static;">
                <div class="col-xs-5">

                  <?php echo $this->Form->control('totaltva', ['id' => 'CommandeclientTotaltva', 'readonly' => 'readonly', 'value' => '', 'label' => 'Total tva', 'name', 'required' => 'off']); ?>

                </div>


              </div>
            </div>








          </div>
        </section>







        <div align="center">
          <button type="submit" class="pull-right btn btn-success btn-sm Testqtestock chauff" id="boutonlivraison" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

        </div>
        <?php echo $this->Form->end(); ?>

      </div>



    </div>
  </div>
</section>




<!-- Ajout ajax recupération select -->
<script type="text/javascript">
  $(function() {
    $('#client').on('change', function() {
      //alert('hello');
      id = $('#client').val();
      // alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getadresselivraison']) ?>",
        dataType: "json",
        data: {
          idfam: id,

        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          // alert(data.ligne.Fodec);
          $('#adresselivraison-id').html(data.select);
          // uniform_select('adresse');
          $('#exofodec').val(data.ligne.Fodec);
          $('#exotva').val(data.ligne.R_TVA);




        }

      })
    });
  });

  $(function() {
    $('.articleidbl1').on('change', function() {
      index = $(this).attr('index');
      // alert(inde);
      article_id = $('#article_id' + index).val();
      // alert(article_id);
      datecreation = $('#date').val();
      depot_id = $('#depot-id').val();
      //alert(depot_id);
      $.ajax({
        method: "GET",
        type: "GET",
        url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getquantite']) ?>",
        dataType: "JSON",
        data: {
          idarticle: article_id,
          idadepot: depot_id,
        },
        success: function(response) {
          //  alert(response['ligne']["Prix_LastInput"]);
          qtestockx = response['qtestockx'];
          // alert(qtestockx);

          $('#qteStock' + index).val(qtestockx);
          $('#prix' + index).val(response['ligne']["Prix_LastInput"]);
          $('#ttc' + index).val(response['ligne']["PTTC"]);
          //$('#exofodec').val(response['ligne']["FODEC"]);
          $('#prixht' + index).val(response['ligne']["PHT"]);

          $('#tva' + index).val(response['ligne']["tva"]["Taux"]);

        }
      })
    });
  });
</script>
















<!--    -->



<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
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
  $('.select2').select2()

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