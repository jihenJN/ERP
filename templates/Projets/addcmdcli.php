<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Commandeclient $commandeclient
 * @var string[]|\Cake\Collection\CollectionInterface $clients
 * @var string[]|\Cake\Collection\CollectionInterface $pointdeventes
 * @var string[]|\Cake\Collection\CollectionInterface $depots
 * @var string[]|\Cake\Collection\CollectionInterface $cartecarburants
 * @var string[]|\Cake\Collection\CollectionInterface $materieltransports
 * @var string[]|\Cake\Collection\CollectionInterface $bonlivraisons
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->script('js_vieww_projet'); 

date_default_timezone_set('Africa/Tunis');?>

<section class="content-header">
  <h1>
    Offre GGB
    <small>
      <?php echo __(''); ?>
    </small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'vieww/', $project_id]); ?>"><i class="fa fa-reply"></i>
        <?php echo __('Retour'); ?>
      </a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box ">
        <?php echo $this->Form->create($commandeclient, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="row">

            <div class="col-md-6">

              <?php echo $this->Form->control('code', ['value' => $code, 'label' => 'Code', 'required' => 'off', 'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'readonly' => 'readonly']); ?>
            </div>
            <div class="col-md-6">
              <?php echo $this->Form->control('projet_id', ['value' => $project_id, 'id' => 'projet_id', 'disabled', 'empty' => 'Veuillez choisir !!', 'class' => "form-control"]); ?>
            </div>
            <div class="col-xs-6" hidden>
              <?php echo $this->Form->control('depot_id', ['class' => "form-control", 'value' => '9', 'empty' => 'Veuillez choisir !!']); ?>
            </div>
            <div class="col-md-6">
              <?php echo $this->Form->input('datedecreation', array('value' => date('Y-m-d'), 'label' => 'Date de creation', 'type' => 'date', 'placeholder' => '',  'class' => 'form-control', 'required')); ?>

            </div>
            <div class="col-md-6">
              <?php echo $this->Form->input('date', array('type' => 'datetime-local', 'readonly' => 'readonly', 'value' => date('Y-m-d H:i:s'), 'label' => 'Date', 'id' => 'date', 'div' => 'form-group ', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control')); ?>
            </div>
            <div class="col-md-6">
              <?php echo $this->Form->control('commentaire', ['rows' => 1]); ?>
            </div>
            <div class="col-md-6">
              <?php //echo $client['client_id'];die;
              echo $this->Form->input('client_id', ['value' => $projet['client_id'], 'class' => 'form-control select2', 'id' => 'client_id', 'label' => 'Tiers', 'empty' => 'Veuillez choisir !!']); ?>
            </div>
            <div class="col-md-6">
              <div height="60px">

                <label class="control-label" for="unipxte-id" style="margin-top: 25px;">TVA:</label>
                OUI <input type="radio" name="tvaOnOff" value="1" id="OUI" class="toggleOffreGGB " style="margin-right: 17px">
                NON <input type="radio" name="tvaOnOff" value="0" id="NON" class="toggleOffreGGB " checked>
              </div>
            </div>
            <div class="col-md-6">
              <?php echo $this->Form->input('paiement_id', ['value' => '', 'class' => 'form-control select2 ', 'multiple' => 'multiple', 'id' => 'paiement_id', 'label' => 'Mode de reglèment', 'options' => $paiements, 'empty' => false]); ?>
            </div>

            <div class="col-md-6">
              <?php echo $this->Form->input('duree_validite', ['type' => 'number', 'value' => '15', 'class' => 'form-control', 'id' => 'duree_validite', 'label' => 'Duree de validite en Jours']); ?>
            </div>

            <div class="col-md-6">
              <?php echo $this->Form->input('incotermpdf_id', ['class' => 'form-control select2', 'id' => 'incotermpdf_id', 'label' => 'Total Incoterm ', 'empty' => 'Veuillez choisir !!']); ?>
            </div>
            <div class="col-md-6">
              <?php echo $this->Form->input('pay', ['type' => 'text', 'class' => 'form-control ', 'id' => 'pay_id', 'label' => 'Destination', 'empty' => 'Veuillez choisir !!']); ?>
            </div>
            <div class="col-md-6">
              <?php echo $this->Form->input('incoterm_id', ['value' => '', 'class' => 'form-control select2', 'id' => 'incoterm_id', 'label' => 'Incoterm ', 'empty' => 'Veuillez choisir !!']); ?>
            </div>

            <div class="col-md-6 deviseSelect" >
              <?php echo $this->Form->input('devisachat_id', ['value' => '', 'class' => 'form-control', 'id' => 'devisachat_id', 'label' => 'Devises Achat', 'options' => $devises, 'empty' => 'Veuillez choisir !!']); ?>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-10" id="selecttransp">
                  <?php echo $this->Form->input('modetransport_id', ['table' => 'tablecommandeclient',  'value' => '', 'class' => 'form-control select2', 'id' => 'modetransport_id', 'label' => 'Mode transports', 'empty' => 'Veuillez choisir !!']); ?>
                </div>
                <div class="col-md-1" style="margin-top: 31px;">

                  <a><i class="fa fa fa-plus urltransport" style="color:success;font-size: 25px;"></i></a>
                </div>
              </div>
            </div>
            <div class="col-md-6 deviseSelect" >
              <?php echo $this->Form->input('devis_id', ['value' => '', 'class' => 'form-control', 'id' => 'devis_id', 'label' => 'Devises Vente', 'options' => $devises, 'empty' => 'Veuillez choisir !!']); ?>
            </div>
            <div class="col-md-6">
              <?php echo $this->Form->control('tauxdechange', ['label' => 'Taux de change de devise ', 'id' => 'tauxChange', 'class' => 'form-control', 'readonly']); ?>
              <div id="message"></div>
            </div>
            <div class="col-md-6" id="deviseSelect2">
              <?php echo $this->Form->input('devis2_id', ['value' => '', 'class' => 'form-control', 'id' => 'devis_id2', 'label' => 'Devises par rapport au dinar', 'options' => $devises, 'empty' => 'Veuillez choisir !!']); ?>
            </div>
            <div class="col-md-6">
              <?php echo $this->Form->control('tauxdechange2', ['label' => 'Taux de change de devise en dinar', 'id' => 'tauxChange2', 'class' => 'form-control', 'readonly']); ?>
              <div id="message2"></div>
            </div>


            <div class="col-md-6">
              <?php echo $this->Form->input('conditionreglement_id', ['class' => 'form-control select2', 'id' => 'conditionreglement_id', 'label' => 'Condition de reglement', 'empty' => 'Veuillez choisir !!']); ?>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-10" id="selectdelai">
                  <?php echo $this->Form->input('delailivraison_id', ['class' => 'form-control select2', 'id' => 'delailivraison_id', 'label' => 'Délai de livraison', 'empty' => 'Veuillez choisir !!']); ?>
                </div>
                <div class="col-md-1" style="margin-top: 31px;">

                  <a><i class="fa fa-plus ajoutdelai" style="color:success;font-size: 25px;"></i></a>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <?php echo $this->Form->input('methodeexpedition_id', ['class' => 'form-control select2', 'id' => 'methodeexpedition_id', 'label' => 'Méthode d`expédition', 'empty' => 'Veuillez choisir !!']); ?>
            </div>

            <div class="col-md-6">
              <?php echo $this->Form->input('datelivraison', array('type' => 'date',  'value' => date('Y-m-d H:i:s'), 'label' => 'Date de livraison', 'id' => 'datelivraison', 'class' => 'form-control')); ?>
            </div>
            <div class="col-md-6">
                            <?php //echo $this->Form->control('banque_id', ['required' => 'off', 'empty' => 'Veuillez choisir !!!! ', 'id' => 'banque_id', 'class' => 'form-control select2', 'label' => 'Banque']); 
                            ?>
                        </div>
            <!-- <div class="col-md-6">
              <?php echo $this->Form->control('remisetotal', ['id' => 'remisetotal',  'label' => 'Remise relative sur le total', 'id' => 'remisetotal', 'type' => 'text', 'min' => 0, 'max' => 100, 'class' => 'form-control number']); ?>
            </div> -->
            <div class="col-md-6">
              <?php echo $this->Form->control('nbfergule', ['value'=>3,'label' => 'Nombre de chiffre aprés le firgule', 'id' => 'nbfergule', 'min' => 0, 'max' => 5, 'type' => 'number', 'class' => 'form-control number']); ?>
            </div>
           
            
            
            <div class="col-md-6">
              <div>
                <label class="control-label" style="margin-top: 25px;">Détait des montant de transport en pdf:</label>
                OUI <input type="radio" name="detailtransport" value="1" id="OUItransport" class="toggleOffreGGBtransport " style="margin-right: 17px">
                NON <input type="radio" name="detailtransport" value="0" id="NONtransport" class="toggleOffreGGBtransport " checked>
              </div>
            </div>
            <div class="col-md-6">
              <?php echo $this->Form->control('banque_id', ['required' => 'off', 'empty' => 'Veuillez choisir !!!! ', 'id' => 'banque_id', 'class' => 'form-control select2', 'label' => 'Banque']); ?>
            </div>
            <div class="col-md-6">
             </div>
            <div class="col-xs-6">
              <div id="Compteee_id">
                <label for="">Comptes bancaires</label>
                <select name="comptesBank_id" id="comptesBank_id" class="form-control select2">
                  <option value="">Veuillez choisir !!!!</option>
                  <?php foreach ($comptesBanks as $key => $comptesBan) {
                    $connection = ConnectionManager::get('default');
                    $dev = $connection->execute('SELECT * FROM devises where id=' . $comptesBan['devise_id'] . ';')->fetchAll('assoc');

                  ?>
                    <option value=""> <?php echo $comptesBan['compte'] . ' ' . $dev[0]['symbole'] ?> <?php ?> </option>
                  <?php } ?>
                </select>
                <?php // $this->Form->control('comptesBank_id', ['required' => 'off', 'empty' => 'Veuillez choisir !!!!', 'id' => 'comptesBank_id', 'class' => 'form-control select2', 'label' => 'Comptes bancaires', 'options' => $comptesBanks]); 
                ?>
              </div>


            </div>

          </div>
          <div align="center" class="btnEditCmdClient" id="e1">
            <button type="submit" class="pull-right btn btn-success btn-sm" id="poi1ntv" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
          </div>
          <?php echo $this->Form->end(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
</section>
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

<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<!-- DataTables -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(document).ready(function() {
    $('#banque_id').on('change', function() {

      id = $('#banque_id').val();
      //  alert(id);
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Banques', 'action' => 'getcomptebanks']) ?>",
        dataType: "json",
        data: {
          id: id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {

          $('#Compteee_id').html(data.select);


        }
      });
    });
    $('.ajoutdelai').on('click', function() {
      var index = $(this).attr('index');
      // alert(index)
      var currentUrl = window.location.href;
      var parentUrl = currentUrl.split('/').slice(0, 4).join('/');
      var link = parentUrl + "/delailivraisons/adddelai/";
      // alert(link);
      window.open(link, "_blank", "width=1000,height=1000");
      // openWindow(1000, 1000, link);
    });
    $(".calculprix").on("keyup", function () {
            // index = $("#index").val();
            // index1 = $("#indexa").val();
            devise_id = $('#devis_id').val();
            index = $("#indexoffreggb").val();
            nbfergule = $("#nbfergule").val();
            deviseprojet = $("#deviseprojet").val();
            taux = 1;
            tauxChange2 = $("#tauxChange").val();
            if (tauxChange2 != '' && Number(tauxChange2) != 0) {
                taux = $("#tauxChange").val();
            }
            i = $(this).attr('index');
        

            // indexl = $("#indexa" + index).val();
            ferg = 3;
            if (nbfergule != '' && Number(nbfergule) != 0) {
                ferg = $("#nbfergule").val();

            }
            champ = $(this).attr('champ');
           
         
            MG = $("#tauxdemarge" + i).val() || 0; //alert(MG)
            MQ = $("#tauxdemarque" + i).val() || 0; //alert(MQ)
            if (champ != "coutrevientdev") {
                coutrevient = $("#coutrevient" + i).val(); //alert(prixrevient)


                prixrevient = Number(coutrevient) * Number(taux);
                $("#coutrevientdev" + i).val(Number(prixrevient).toFixed(3));

            } else {
                prixrevient = $("#coutrevientdev" + i).val();
                coutrevient=  Number(prixrevient) / Number(taux);
                $("#coutrevient" + i).val(Number(coutrevient).toFixed(3));
            }
            if (MG && MQ) {
                    alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
                    $("#tauxdemarge" + i).val('');
                    $("#tauxdemarque" + i).val('');
                    $("#prixht" + i).val('');
                    // $("#punht" + i).val('');
                } else if (MQ && Number(prixrevient) != 0) {

                    marque = 100 - Number(MQ);
                    prixMG = ((Number(prixrevient) * 100) / Number(marque)); //*Number(taux);
                    $("#prixht" + i).val(Number(prixMG).toFixed(ferg));
                } else if (MG && Number(prixrevient) != 0) {
                    prixMQ = (Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100)); //*Number(taux); //alert(prixMQ)
                    $("#prixht" + i).val(Number(prixMQ).toFixed(ferg));
                } else {
                    if (Number(prixrevient) != 0) {
                        $("#prixht" + i).val(Number(Number(prixrevient) /* /Number(taux) */).toFixed(ferg));
                    }

                }
            getprixhtsonia();

        });

      


    $(".calculprix13092024").on("keyup", function() {
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
          } else if (MG && Number(prixrevient) != 0) {
            prixMG = Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100)
            prixMG = Math.floor(prixMG); // Conversion en entier
            $("#prixht" + i).val(Number(prixMG).toFixed(3));
            //$("#punht" + i).val(prixMG);
            margel = Number(prixMG) * Number(MG / 100);
            totalmarge = (Number(totalmarge) + Number(margel)).toFixed(3);
          } else if (MQ && Number(prixrevient) != 0) {
            prixMQ = Number(prixrevient) + (Number(MQ) * Number(prixrevient) / 100); //alert(prixMQ)
            $("#prixht" + i).val(Number(prixMQ).toFixed(3));
            marquel = Number(prixMQ) * Number(MQ / 100);
            totalmarque = (Number(totalfodec) + Number(marquel)).toFixed(3);
            // $("#punht" + i).val(prixMG);
          } else {
            if (Number(prixrevient) != 0) {
              $("#prixht" + i).val(Number(prixrevient).toFixed(3));
            }

          }
        }
      }
      // $("#totalmarge").val(Number(totalmarge).toFixed(3));
      // $("#totalmarque").val(Number(totalmarque).toFixed(3));
      getprixhtsonia();
    });
    // $(".calculprix").on("keyup", function () {
    //   // index = $("#index").val();
    //   // index1 = $("#indexa").val();
    //   index = $("#indexoffreggb").val();
    //   // indexl = $("#indexa" + index).val();

    //   prixMG = 0;
    //   prixMQ = 0;
    //   total = 0;
    //   for (i = 0; i <= Number(index); i++) {
    //     sup = $("#sup0" + i).val() || 0;
    //     if (Number(sup) != 1) {
    //       prixrevient = $("#coutrevient" + i).val(); //alert(prixrevient)
    //       MG = $("#tauxdemarge" + i).val(); //alert(MG)
    //       MQ = $("#tauxdemarque" + i).val(); //alert(MQ)
    //       if (MG && MQ) {
    //         alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
    //         $("#tauxdemarge" + i).val('');
    //         $("#tauxdemarque" + i).val('');
    //         $("#prixht" + i).val('');
    //         // $("#punht" + i).val('');
    //       } else if (MG) {
    //         prixMG = Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100)
    //         prixMG = Math.floor(prixMG); // Conversion en entier
    //         $("#prixht" + i).val(prixMG);
    //         // $("#punht" + i).val(prixMG);
    //       } else if (MQ) {
    //         prixMQ = Number(prixrevient) + (Number(MQ) * Number(prixrevient) / 100); //alert(prixMQ)
    //         $("#prixht" + i).val(Number(prixMQ).toFixed(3));
    //         // $("#punht" + i).val(prixMG);
    //       }
    //     }
    //   }

    // });
  });
</script>
<script type="text/javascript">
  $(function() {
    $('.gettvas').on('change', function() {
      // alert('hello');
      index = $(this).attr("index");
      id = $('#tva_id').val();
      // alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Commandeclients', 'action' => 'gettvas']) ?>",
        dataType: "json",
        data: {
          id: id,

        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          $('#tva' + index).val(data.val);


        }

      })

    });
  });
  // nouveau_client
</script>
<script>
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()
    // $("#verifenr").on("mouseover", function () {
    //   client_id = $("#client_id").val();//alert(client_id)
    //   opportunite_id = $("#opportunite_id").val();
    //   datedebut = $("#datedebut").val();
    //   datefin = $("#datefin").val();
    //   if (client_id == "") {
    //     alert("Veuillez choisir un tier !!", function () { });
    //     return false;
    //   } if (datedebut == "") {
    //     alert("Veuillez entrer la date de debut !!", function () { });
    //     return false;
    //   }if (datefin == "") {
    //     alert("Veuillez entrer la date fin !!", function () { });
    //     return false;
    //   }if (opportunite_id == "") {
    //     alert("Veuillez choisir une Statut opportunit� !!", function () { });
    //     return false;
    //   }
    // });
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
<style>
  .select2-selection__rendered {
    line-height: 25px !important;
  }

  .select2-container .select2-selection--single {
    height: 35px !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    border-color: #D2D6DE !important;
  }

  .select2-selection__arrow {
    height: 34px !important;
  }

  .select2-selection__choice {
    height: 24px !important;
    color: black !important;
    background-color: white !important;
    font-size: 18px !important;
  }

  .select2-container {
    display: block;
    /* width: auto !important; */
  }
</style>
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
  $(document).ready(function() {
    $('#deviseSelect2').on('change', function() {
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
        success: function(data) {
          console.log(data)
          var devis = data.code;
          getTauxChange2(devis);
        }

      })
    });
    $('.deviseSelect').on('change', function() {
      // var devise_id = $(this).val();
      devise_id = $('#devis_id').val();
      projet_id = $('#projet_id').val();
      // var devise = mapDevise(devise_id);
      devisachat_id = $('#devisachat_id').val();
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'getdevise']) ?>",
        dataType: "json",
        data: {
          devise_id: devise_id,
          projet_id: projet_id,
          devisachat_id: devisachat_id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          console.log(data)
          var devis = data.code;
          document.getElementById('tauxChange').value = data.taux;

          // if (data.taux != 0) {
          //   document.getElementById('tauxChange').value = data.taux;

          // } else {
          //   getTauxChange(devis);
          // }
        }

      })
    });
  });
</script>
<script>
  function openWindow(h, w, url) {
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
  }
</script>
<?php $this->end(); ?>