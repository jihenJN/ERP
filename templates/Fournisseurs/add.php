<script>
  function flvFPW1() {
    var v1 = arguments,
      v2 = v1[2].split(","),
      v3 = (v1.length > 3) ? v1[3] : false,
      v4 = (v1.length > 4) ? parseInt(v1[4]) : 0,
      v5 = (v1.length > 5) ? parseInt(v1[5]) : 0,
      v6, v7 = 0,
      v8, v9, v10, v11, v12, v13, v14, v15, v16;
    v11 = new Array("width,left," + v4, "height,top," + v5);
    for (i = 0; i < v11.length; i++) {
      v12 = v11[i].split(",");
      l_iTarget = parseInt(v12[2]);
      if (l_iTarget > 1 || v1[2].indexOf("%") > -1) {
        v13 = eval("screen." + v12[0]);
        for (v6 = 0; v6 < v2.length; v6++) {
          v10 = v2[v6].split("=");
          if (v10[0] == v12[0]) {
            v14 = parseInt(v10[1]);
            if (v10[1].indexOf("%") > -1) {
              v14 = (v14 / 100) * v13;
              v2[v6] = v12[0] + "=" + v14;
            }
          }
          if (v10[0] == v12[1]) {
            v16 = parseInt(v10[1]);
            v15 = v6;
          }
        }
        if (l_iTarget == 2) {
          v7 = (v13 - v14) / 2;
          v15 = v2.length;
        } else if (l_iTarget == 3) {
          v7 = v13 - v14 - v16;
        }
        v2[v15] = v12[1] + "=" + v7;
      }
    }
    v8 = v2.join(",");
    v9 = window.open(v1[0], v1[1], v8);
    if (v3) {
      v9.focus();
    }
    document.MM_returnValue = false;
    return v9;
  }
</script>
<script>
  function openWindow(h, w, url) {
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
  }
</script>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->css('select2'); ?>



<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ajout Fournisseur
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content" style="width: 99%">
  <div class="box">
    <div class="box-header">
    </div>

    <div class="box-body">
      <div class="row">

        <?php echo $this->Form->create($fournisseur, ['role' => 'form', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">

          <div class="row">
            <div class="col-xs-6">
              <?php echo $this->Form->control('code', ['label' => 'Code', 'required' => 'off']); ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('name', ['label' => 'Nom', 'required' => 'off']); ?>
            </div>

            <div class="col-xs-6">
              <?php echo $this->Form->control('adresse', ['label' => 'Adresse', 'required' => 'off']); ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('codepostal', ['label' => 'Code postal']); ?>
            </div>
          </div>


          <div class="row">

            <div class="col-xs-6">
              <div class="form-group input text required">
                <?php echo $this->Form->control('typelocalisation_id', ['label' => 'Type localisation', 'empty' => 'Veuillez choisir !!', 'options' => $typelocalisations, 'class' => 'form-control select2 control-label', 'id' => 'typelocalisation_id', 'required' => 'off']); ?>
              </div>
            </div>

            <div class="col-xs-6">
              <div class="form-group input text required">
                <?php echo $this->Form->control('devise_id', ['options' => $devises, 'value' => 4, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label', 'id' => 'devise_id', 'required' => 'off']); ?>
              </div>
            </div>

          </div>

          <div class="row">

            <div class="col-xs-6">
              <?php echo $this->Form->control('secteur'); ?>
            </div>
            <div class="col-xs-6">
              <div class="form-group input text required">
                <?php echo $this->Form->control('typeutilisateur_id', ['empty' => 'Veuillez choisir !!', 'label' => 'Type utilisateur', 'class' => 'form-control select2 control-label', 'id' => 'typeutilisateur_id', 'required' => 'off']); ?>
              </div>
            </div>
            <div class="col-xs-6" id="divgouv" hidden>
              <?php echo $this->Form->control('gouvernorat_id', ['id' => 'gouvernorat', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ajouter_ligneadresse gouv']); ?>


            </div>

          </div>

          <div class="row">






            <div class="col-xs-6">
              <div class="form-group input text " id="delegation" hidden>
                <?php echo $this->Form->control('delegation_id', ['id' => 'deleg', 'name' => 'delegation_id', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label deleg']); ?>

              </div>

            </div>

          </div>






          <div class="row">




            <div class="col-xs-6">
              <div class="form-group input text " id="localite" hidden>
                <?php echo $this->Form->control('localite_id', ['name' => 'localite_id', 'id' => 'loc', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label loc']); ?>

              </div>

            </div>

          </div>


          <div class="row">




          </div>




          <div class="row">
            <div class="col-xs-3"><?php echo $this->Form->control('tel', ['label' => 'Télèphone 1']); ?></div>
            <div class="col-xs-3"><?php echo $this->Form->control('tel', ['label' => 'Télèphone 2']); ?></div>

            <div class="col-xs-6">
              <?php echo $this->Form->control('fax'); ?>
            </div>





          </div>




          <div class="row">


            <div class="col-xs-6">

              <?php echo $this->Form->control('compte_comptable', ['class' => 'form-control control-label']); ?></div>

            <div class="col-xs-6">
              <?php echo $this->Form->control('site'); ?></div>

          </div>




          <div class="row">

            <div class="col-xs-6">
              <?php echo $this->Form->control('mail'); ?>
            </div>
            <div class="col-xs-6"><?php echo $this->Form->control('activite'); ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('paiement_id', ['label' => 'Mode paiement', 'empty' => 'Veuillez choisir !!', 'options' => $paiements, 'class' => 'form-control select2 control-label', 'id' => 'paiement_id', 'required' => 'off']); ?>
            </div>

            <div class="col-xs-6">
              <div class="form-group input text required">
                <?php echo $this->Form->control('exo', ['name' => 'exo', 'empty' => 'Veuillez choisir !!', 'value' => 1, 'label' => 'Exonerations', 'empty' => 'Veuillez choisir !!', 'options' => $exonerations, 'class' => 'form-control select2 control-label typeexoneration', 'id' => 'exonerations', 'required' => 'off']); ?>
              </div>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('soldedebut', ['label' => 'Solde Debut']); ?>
            </div>

          </div>

          <!--                        <div class="col-xs-6">

                            <?php //echo $this->Form->control('pay_id', ['options' => $pays, 'empty' => 'Veuillez choisir !!', 'label' => 'Pays']); 
                            ?></div>-->



          <!--    <div class="col-xs-6">
              <div class="form-group input text required">
                <?php //echo $this->Form->control('pay_id', ['empty'=>'Veuillez choisir !!','label'=>'Pays','empty'=>'Veuillez choisir !!','options' => $pays, 'class' => 'form-control select2 control-label','id'=>'pay_id', 'required' => 'off']); 
                ?>
              </div>
            </div>  
                       -->






          <!--                        <div class="col-xs-6">
                               <div class=" form-group input text required col-xs-10" style="width:440px;margin-left:-15px">
                            <?php //echo $this->Form->control('paiement_id', ['options' => $paiements, 'empty' => 'Veuillez choisir !!']); 
                            ?> 
                               
                                  <label class="control-label" for="name">Mode paiement</label>
                <select class="form-control select2" name="paiement_id">
                  <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                  <?php foreach ($paiements as $id => $point) { ?>
                    <option value="<?php echo $id; ?>"><?php echo  $point ?></option>
                  <?php } ?>
                </select>
                               
                               
                               </div>-->


          <div class="row">


            <div class="col-xs-4">
              <span title="ajout paiement">
                <!--                                <a onclick="openWindow(1000, 1000, 'http://localhost:8765/paiements/add');"champ="orderr" value="0" class="btn btn-primary"><i class="fa fa fa-plus"></i></a> -->
              </span>
            </div>



          </div>







          <!--                          <div class="col-xs-6">
                            <?php //echo $this->Form->control('tt', ['id'=>'exoneration','label'=>'Exoneration','options' => $exonerations,'empty' => 'Veuillez choisir !!','class'=>' typeexoneration']); 
                            ?></div>-->
















        </div>












        <!--
#d2d6de-->

        <!--
                <div1 id="al"  style="display:none;">
                 <div id="message">
    <div style="padding-left:25%;">
        <div id="inner-message" class="alert " style="height:120px; width: 500px; background-color:#d2d6de">
            
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p > Veuillez remplir la premier ligne<p>
            <button type="button" class="close" style="margin-top:40px;">OK</button>
           
        </div>
    </div>
</div>
</div1>-->







        <!-- <div1 id="alert"  style="display:'';">
                 <div id="message">
    <div style="padding-left:25%;">
        <div id="inner-message" class="alert " style="height:120px; width: 500px; background-color:#d2d6de">
            
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p > Veuillez remplir la premier ligne<p>
           
        </div>
    </div>
</div>
</div1>   
                -->
        <section class="content-header" hidden>
          <h1 class="box-title"><?php echo __('Adresse de livraison'); ?></h1>
        </section>



        <section class="content" style="width: 99%" hidden>

          <div class="box box">
            <div class="box-header with-border">
              <a class="btn btn-primary al " data-toggle="modal" data-target="#modal-default" table='addtable' index='index' id='ajouter_ligne' style="
                                            float: right;
                                            margin-bottom: 5px;
                                            ">
                <i class="fa fa-plus-circle "></i> Ajouter adresse de livraison</a>
              <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                <tbody>
                  <tr class="tr" style="display: none !important">


                    <td style="width: 8%;" align="center">
                      <?php echo $this->Form->input('sup', array('name' => '', 'id' => '', 'champ' => 'sup', 'table' => 'lignead', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                      ?> <strong>Adresse</strong>
                    </td>




                    <td align="center">

                      <input table="lignead" type="text" class="form-control" table="lignead" name="" id="" champ="adresse">
                    </td>

                    <td align="center">
                      <i index="0" id="" class="fa fa-times supLigne" style="color: #c9302c;font-size: 22px;"></i>
                    </td>
                  </tr>




                </tbody>
              </table>
              <input type="hidden" value=-1 id="index">
            </div>
          </div>
        </section>

        <section class="content-header">
          <h1 class="box-title"><?php echo __('Les responsables'); ?></h1>
        </section>
        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">
              <div class="box-header with-border">
                <a class="btn btn-primary  " table='addtable' index='' id='ajouter_ligne0' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                  <i class="fa fa-plus-circle "></i> Ajouter responsable</a>

              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="tabligne0">

                    <thead>
                      <tr width:20px">
                        <td align="center" style="width: 25%;"><strong>Nom du responsable</strong></td>
                        <td align="center" style="width: 25%;"><strong>Email</strong></td>
                        <td align="center" style="width: 25%;"><strong>Téléphone</strong></td>
                        <td align="center" style="width: 25%;"><strong>Poste</strong></td>
                        <td align="center" style="width: 25%;"></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="tr" style="display: none !important">



                        <td align="center">
                          <input type="hidden" name="" id="" champ="sup1" table="ligne" index="" class="form-control">
                          <input table="ligne" id="" name="" type="text" champ="name" index="" class="form-control">
                        </td>
                        <td align="center">
                          <input table="ligne" id="" name="" type="text" champ="mail" class="form-control ">
                        </td>
                        <td align="center">
                          <input table="ligne" name="" id="tel" type="text" table="ligne" champ="tel" class="form-control">
                        </td>
                        <td align="center">
                          <input table="ligne" name="" type="text" id="" table="ligne" champ="poste" class="form-control four1 ">
                        </td>
                        <td align="center">
                          <i index="0" id="" name="" class="fa fa-times supLigne1" style="color: #c9302c;font-size: 22px;"></i>
                        </td>

                      </tr>


                      <input type="hidden" value="-1" id="index0">
                    </tbody>
                  </table><br>
                </div>
              </div>
            </div>
          </div>

        </section>






        <section class="content-header">
          <h1 class="box-title"><?php echo __('Les comptes bancaires'); ?></h1>
        </section>

        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">
              <div class="box-header with-border">
                <a class="btn btn-primary al" table='addtable' index='' id='ajouter_ligne1' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                  <i class="fa fa-plus-circle "></i> Ajouter compte bancaire</a>
              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="tabligne1">
                    <thead>
                      <tr width:20px>
                        <td align="center" style="width: 20%;"><strong>Banque</strong></td>
                        <td align="center" style="width: 10%;"><strong>Code agence</strong></td>
                        <td align="center" style="width: 10%;"><strong>Code banque</strong></td>
                        <td align="center" style="width: 10%;"><strong>Code SWIFT</strong></td>
                        <td align="center" style="width:10%;"><strong>Compte</strong></td>
                        <td align="center" style="width: 10%;"><strong>RIB</strong></td>
                        <td align="center" style="width: 10%;"><strong>Document</strong></td>
                        <td align="center" style="width: 2%;"><strong></strong></td>

                      </tr>
                    </thead>
                    <tbody>
                      <tr class="tr" style="display: none ;">

                        <td align="center" table="ligner">
                          <input type="hidden" name="" id="" champ="sup4" table="ligner" index="" class="form-control">

                          <div>
                            <?php
                            echo $this->Form->control('banque_id', array('class' => ' form-control js-example-responsive ', 'label' => false, 'div' => 'form-group ', 'between' => '<div class="col-sm-12">', 'after' => '</div>',  'index' => 0, 'champ' => 'banque_id', 'table' => 'ligner', 'name' => 'data[ligner][0][banque_id]', 'empty' => 'choix', 'id' => 'banque0'));

                            //echo $this->Form->control('banque_id', array('label' => '','champ'=>'banque_id','name'=>'','id'=>'banque0', 'table' => 'ligner',  'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); 
                            ?>
                          </div>
                          <!--                                                      <input table="ligner" options=$ban champ="name" class="form-control " id="banque">-->


                        </td>


                        <td align="center" table="ligner">
                          <input table="ligner" name="" champ="agence" id="agence" type="text" class="form-control ">
                        </td>
                        <td align="center" table="ligner">
                          <input table="ligner" name="" champ="code_banque" id="code_banque" type="text" class="form-control">
                        </td>
                        <td align="center" table="ligner">
                          <input table="ligner" type="text" champ="swift" id="swift" class="form-control">
                        </td>
                        <td align="center" table="ligner">
                          <input table="ligner" type="text" name="" champ="compte" id="compte" class="form-control">
                        </td>
                        <td align="center" table="ligner">
                          <input table="ligner" type="text" id="rib" name="" champ="rib" class="form-control">
                        </td>

                        <td align="center" table="ligner">
                          <!-- 
                                                        <input type="file" name=""  champ="document"  id="exampleInputFile" table="ligner"> -->
                          <input type="file" table="ligner" champ="documenttt" name="documenttt" class="form-control" id="">

                        </td>

                        <td align="center">

                          <i index="0" id="" class="fa fa-times supLigne0" style="color: #c9302c;font-size: 22px;"></i>
                        </td>
                      </tr>
                      <input type="hidden" value="-1" id="index1">
                    </tbody>
                  </table><br>
                </div>
              </div>
            </div>
          </div>


        </section>








        <div align="center">
          <button type="submit" class="pull-right btn btn-success btn-sm " id="" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

          <!-- <?php echo $this->Form->submit(__('Enregistrer')) ?> -->
        </div>
        <?php echo $this->Form->end(); ?>

      </div>



    </div>
  </div>
</section>


<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'css']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min', ['block' => 'css']); ?>
<!-- iCheck for checkboxes and radio inputs -->
<?php echo $this->Html->css('AdminLTE./plugins/iCheck/all', ['block' => 'css']); ?>
<!-- Bootstrap Color Picker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min', ['block' => 'css']); ?>
<!-- Bootstrap time Picker -->
<?php echo $this->Html->css('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<!-- InputMask -->
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.extensions', ['block' => 'script']); ?>
<!-- date-range-picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/moment/min/moment.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'script']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min', ['block' => 'script']); ?>
<!-- bootstrap color picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
<!-- bootstrap time picker -->
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {
    //Initialize Select2 Elements
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
    //Date range as a button
    $('#daterange-btn').daterangepicker({
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
      },
      function(start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    })
    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<?php $this->end(); ?>


<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'css']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min', ['block' => 'css']); ?>
<!-- iCheck for checkboxes and radio inputs -->
<?php echo $this->Html->css('AdminLTE./plugins/iCheck/all', ['block' => 'css']); ?>
<!-- Bootstrap Color Picker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min', ['block' => 'css']); ?>
<!-- Bootstrap time Picker -->
<?php echo $this->Html->css('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<!-- InputMask -->
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.extensions', ['block' => 'script']); ?>
<!-- date-range-picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/moment/min/moment.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'script']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min', ['block' => 'script']); ?>
<!-- bootstrap color picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
<!-- bootstrap time picker -->
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {
    //Initialize Select2 Elements
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
    //Date range as a button
    $('#daterange-btn').daterangepicker({
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
      },
      function(start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    })
    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<script>
  $(function() {

    $('#typelocalisation_id').on('change', function() {
      // alert('hello');
      id = $('#typelocalisation_id').val();
      /// alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Fournisseurs', 'action' => 'getdevise']) ?>",
        dataType: "json",
        data: {
          id: id,

        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          //alert(data.select);
          $('#devise_id').html(data.select);
          // $('#gouvernorat').select2();
          // uniform_select('sousfamille1_id');


        }

      })

    });
  });
</script>
<script>
  $(function() {

    $('.pays').on('change', function() {
      // alert('hello');
      id = $('#pay_id').val();
      // alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'getgouv']) ?>",
        dataType: "json",
        data: {
          id: id,

        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          //alert(data.select);
          $('#divgouv').html(data.select);
          $('#gouvernorat').select2();
          // uniform_select('sousfamille1_id');


        }

      })

    });
  });





  function gouv(id) {
    // $(function () {
    //     $('.gouv').on('change', function () {
    //         id = $('#gouvernorat').val();
    //         $('#gouv').val((id));

    $.ajax({
      method: "GET",
      url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'getbureaupostegouvs']) ?>",
      dataType: "json",
      data: {
        idgouv: id,
      },
      headers: {
        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
      },
      success: function(response, status, settings) {
        //alert(response.query);
        //  alert(response.name);
        bureauposte = $('#bureauposte').val();
        $('#bureauposte').val(response.query);
        $('#gouvadresse').val(response.name);
        $('#adresses').val(response.name + ' ' + response.query);
        $('#adresse0').val(response.name + ' ' + response.query);


        $('#adress').val(response.name + ' ' + response.query);




        $('#code').val(response.queryyy);
        $('#delegation').html(response.select);
        $('#deleg').select2();
        // uniform_select('delegation');



        //$('#adresses').val((id));

      }
    })
  }

  function localite(id) {
    //alert(id)
    idgouv = $('#gouvernorat').val();
    iddeleg = $('#deleg').val();

    $.ajax({
      method: "GET",
      // url: wr + "Clients/getbureaupostedelegs/",
      url: "<?= $this->Url->build(['controller' => 'Clients/getbureaupostelocs']) ?>",
      dataType: "json",
      data: {
        idloc: id,
        idgouv: idgouv,
        iddeleg: iddeleg,


      },
      headers: {
        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
      },
      success: function(response, status, settings) {
        // alert(response.query);
        $('#bureauposte').val(response.query);
        valeur = $('#adresses').val();

        $('#localiteadrresse').val(response.name);

        $('#adresses').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());
        $('#adress').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());

        $('#adresse0').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());
      }
    })

  }







  function delegation(id) {
    //alert("yyy");

    //alert(id)
    //id = $('#deleg').val();
    // alert(id);
    idgouv = $('#gouvernorat').val();
    $.ajax({
      method: "GET",
      // url: wr + "Clients/getbureaupostedelegs/",
      url: "<?= $this->Url->build(['controller' => 'Clients/getbureaupostedelegs']) ?>",
      dataType: "json",
      data: {
        iddeleg: id,
        idgouv: idgouv
      },
      headers: {
        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
      },
      success: function(response, status, settings) {
        // alert(response.query);
        // alert(response.name);
        bureauposte = $('#bureauposte').val();

        $('#bureauposte').val(response.query);
        $('#localite').html(response.select);
        $('#loc').select2();
        valeur = $('#adresses').val();
        //let v = valeur.substr(-4);
        //   let v = valeur.substr(valeur.length - 4);
        //alert(v);
        //  valeur.replace(v, bureauposte);
        //  alert(valeur);
        $('#delegationadr').val(response.name);

        $('#adresses').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());
        $('#adresse0').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());

        $('#adress').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());


        // uniform_select('localite');
      }
    })

  }
</script>
<?php $this->end(); ?>