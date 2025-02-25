<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('hechem'); ?>
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<section class="content-header">
    <h1>
        Ajout facture avoir financière
    </h1>
    <ol class="breadcrumb">

        <a href="<?php echo $this->Url->build(['action' => 'index/1']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a>

    </ol>
</section>
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
                <?php echo $this->Form->create($factureavoir, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13",]); ?>
                <div class="box-body">
                   
            <div class="row">

              <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                <div class="col-xs-6">
                  <?php
                  echo $this->Form->control('numero', ['readonly' => 'readonly','value'=>$numspecial]);
                  ?>
                </div>

                <div class="col-md-6"><?php
                                                echo $this->Form->control('date', ['empty' => true, "value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]);

                                                ?></div>

              </div>
            </div>

            <div class="row">

              <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                <div class="col-xs-6">
                  <div class="form-group input select required">

                    <label class="control-label" for="depot-id">Clients</label>

                    <select name="client_id" id="client" class="form-control select2 control-label ">
                      <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                      <?php foreach ($clients as $id => $client) {

                      ?>
                        <option <?php if ($factureavoir->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                      <?php } ?>
                    </select>


                  </div>

                </div>
                <div class="col-xs-6">
                  <div class="form-group input select required">

                    <label>Depot</label>

                    <select name="depot_id" id="depot-id" class="form-control select2 control-label ">
                      <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                      <?php foreach ($depots as $dep) {
                      ?>
                        <option <?php if ($factureavoir->depot_id == $dep->id) { ?> selected="selected" <?php } ?> value="<?php echo $dep->id; ?>"><?php echo $dep->name ?></option>
                      <?php } ?>
                    </select>


                  </div>




                </div>
              </div>
            </div>

            <div class="row">
              <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                <!-- <div class="col-xs-6">
                  <div class="form-group input select required">

                    <label>Commercial</label>

                    <select name="commercial_id" id="commercial-id" class="form-control select2 ">
                      <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                      <?php foreach ($commercials as $com) {
                      ?>
                        <option <?php if ($commercial->id == $com->id) { ?> selected="selected" <?php } ?> value="<?php echo $com->id; ?>"><?php echo $com->name ?></option>
                      <?php } ?>
                    </select>


                  </div>
                </div> -->

                <div class="col-xs-6" style="float: right;">
                  <?php
                  echo $this->Form->control('observation', ['label' => 'Observation', 'class' => 'form-control', 'type' => 'textarea', 'value' => $bonreception->observation]); ?>
                </div>
                <!-- <div class="col-xs-6" style="margin-top: 20px ;">
                  <label class="control-label" for="unipxte-id" style="margin-right: 20px">Payement comptant:</label>

                  OUI <input type="radio" name="checkpayement" value="1" id="OUI" class="oui calcheck" style="margin-right: 20px">
                  NON <input type="radio" name="checkpayement" value="0" id="NON" class="oui calcheck " checked>


                </div> -->
              </div>
            </div>

                </div>

                <section class="content-header">
                    <h1 class="box-title"><?php echo __('Ligne facture avoir financière'); ?></h1>
                </section>
                <section class="content" style="width: 99%">
                    <div class="row">
                        <div class="box">

                            <div class="box-header with-border">
                                <a class="btn btn-primary al ajouter_ligne_facavoir btnajoutFac" table='addtable' index='index' id='' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                    <i class="fa fa-plus-circle "></i> Ajouter ligne</a>

                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                                        <thead>
                                        <tr>
                              <td align="center" style="width: 37%; font-size: 13px;"><strong>Article</strong></td>
                              <td align="center" style="width: 9%;font-size: 13px;"><strong>Qte stock </strong></td>
                              <td align="center" style="width: 9%;font-size: 13px;"><strong>Qte récept </strong></td>
                              <td align="center" style="width: 10%;font-size: 13px;"><strong>Prix</strong></td>
                              <td align="center" style="width:8%; font-size: 13px;"><strong>P.U.TTC</strong></td>
                              <!-- <td align="center" style="width:8%;font-size: 13px;"><strong>R/Pro </strong></td> -->
                              <td align="center" style="width:7%;font-size: 13px;"><strong> TVA </strong></td>
                              <td align="center" style="width:7%;font-size: 13px;"><strong> Fodec </strong></td>
                              <td align="center" style="width: 5%;font-size: 13px;"><strong>ToTAL TTC </strong></td>

                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="tr" style="display: none ">
                              <td align="center">
                                <input type="hidden" id="" champ="sup" name="" table="Lignefacture" index="" class="form-control ">
                                <select table="Lignefacture" index champ="article_id" class="js-example-responsive  articleidbl1 ">
                                  <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                  <?php foreach ($articles as $id => $article) {
                                  ?>
                                    <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                  <?php } ?>
                                </select>
                              </td>



                              <td align="center" table="Lignefacture">
                                <input table="Lignefacture" champ="qtestock" type="text" class="form-control getprixht getstock" index readonly>
                              </td>

                              <td align="center" table="Lignefacture">


                                <input table="Lignefacture" name="" id="" champ="qte" type="text" class=" form-control focus htb" index>

                              </td>

                              <td align="center" table="Lignefacture">
                                <input readonly table="Lignefacture" type="text" champ="prix" class="form-control" index name=''>
                              </td>

                              <td align="center" table="Lignefacture">
                                <input readonly table="Lignefacture" type="text" champ="ht" class="form-control " index name=''>
                              </td>
                              <!-- <td align="center" table="Lignefacture">
                                <input readonly table="Lignefacture" type="text" champ="remiseclient" class="form-control" index name=''>
                              </td> -->
                              <td align="center" table="Lignefacture">
                                <input  table="Lignefacture" type="text" champ="tva" class="form-control htb" index name=''>
                              </td>
                              <td align="center" table="Lignefacture">
                                <input  table="Lignefacture" type="text" champ="fodec" class="form-control htb" index name=''>
                              </td>
                              <td align="center" table="Lignefacture">
                                <input  table="Lignefacture" type="text" champ="ttc" class="form-control htb" index name=''>
                              </td>



                              <td align="center" table="Lignefacture">
                                <i id="" class="fa fa-times supp" style="color: #c9302c;font-size: 22px;" table="Lignefacture" name=""></i>
                                <input type='hidden' table="Lignefacture" champ="" class="form-control" index name='' id="">
                              </td>
                            </tr>

                                        </tbody>
                                    </table>
                                    <input type="hidden" value="-1" id="index">

                                    <br>
                                </div>
                            </div>
                        </div>

                     
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('remise', ['id' => 'remise', 'class' => 'form-control  ', 'readonly']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('totalht', ['id' => 'ht', 'class' => 'form-control  ', 'readonly']); ?>
                        </div>

                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('fodec', ['id' => 'fodec', 'class' => 'form-control', 'readonly']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('totalttc', ['readonly','id' => 'ttc', 'class' => 'form-control  ', 'readonly']); ?>
                        </div>
                
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('tva', ['id' => 'tva', 'class' => 'form-control  ', 'readonly']); ?>
                        </div>
                    </div>

                </section>
                <div align="center" id="">

                    <button type="submit" id="invBtnn" class="btn btn-primary  desactive">Enregistrer</button>
                </div>
                <?php echo $this->Form->end(); ?>
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
<?php $this->start('scriptBottom'); ?>
<script>
    $(document).ready(function() {
        
    $('.articleQtest').on('change', function() {

index = $(this).attr('index');
article_id = $('#article_id' + index).val();
date = $('#date').val();
depot = $('#depot-id').val();
client = $('#client').val();


$.ajax({
  method: "GET",
  type: "GET",
  url: "<?= $this->Url->build(['controller' => 'Bonsortiestocks', 'action' => 'getquantite']) ?>",
  dataType: "JSON",
  data: {
    idarticle: article_id,
    date: date,
    depot: depot,
    client: client,

  },
  success: function(data) {
    //  alert(data.qtes)

    $('#qtestock' + index).val(data.qtes);
    $('#prix' + index).val(data.prix);
    $('#remiseclient' + index).val(data.remise);
    $('#tva' + index).val(data.tva);
    $('#fodec' + index).val(data.fodec);
    $('#remisearticle' + index).val(data.remiseart);
    $('#quantite' + index).focus();
    $('#qte' + index).val('');


  }

})

})

        // $('#client_id').on('change', function() {

        //     $('html, body').animate({
        //         scrollTop: $("#tabligne").offset().top
        //     }, 1000);
        //     ajouter("tabligne", "index");


        // })


        $(document).on('keyup', '.focus', function(e) {

            e.preventDefault(); //
            if (event.which == 13) {
                //alert('dddd')
                var $tableBody = $('#tabligne').find("tbody"), //idftable
                    $trLast = $tableBody.find("tr:last");
                //  $trNew = $trLast.clone();



                // $trLast.after($trNew);
                ajouter('tabligne', 'index');

                document.getElementById("invBtnn").scrollIntoView(); //idfbouton

                e.preventDefault();
                return false;
            }
            if (event.which === 13) {
                //alert('hechem')
                //if($('input').not(':hidden')  )
                {
                    var index = $('.focus').index(this) + 1;

                    //  class f les    select ili temchilhom 
                    $('.focus').eq(index).focus();
                    event.preventDefault();
                    return false;
                }
            }
            e.preventDefault();
            return false;
        });

        $(document).on('keyup', '.foc', function(e) {

            e.preventDefault(); //

            if (e.which === 13) {
                // alert('hechem')
                //if($('input').not(':hidden')  )
                {
                    var index = $('.focus').index(this) + 1;


                    $('#prix' + index).focus();


                    // console.log('this index '+ index);
                    $('.focus').eq(index).focus();
                    event.preventDefault();
                    return false;
                }
            }
            e.preventDefault();
            return false;
        });

        $(document).on('keyup', '.foc', function(e) {

e.preventDefault(); //

if (e.which === 13) {
  // alert('hechem')
  //if($('input').not(':hidden')  )
  {
    var index = $('.focus').index(this) + 1;


    $('#prix' + index).focus();


    // console.log('this index '+ index);
    $('.focus').eq(index).focus();
    event.preventDefault();
    return false;
  }
}
e.preventDefault();
return false;
});

$(document).on('keyup', '.focuss', function(e) {

e.preventDefault(); //

if (e.which === 13) {
  // alert('hechem')
  //if($('input').not(':hidden')  )
  {
    var index = $('.focus').index(this) + 1;


    $('#remise' + index).focus();


    // console.log('this index '+ index);
    $('.focus').eq(index).focus();
    event.preventDefault();
    return false;
  }
}
e.preventDefault();
return false;
});

$(document).on('keyup', '.focusss', function(e) {

e.preventDefault(); //

if (e.which === 13) {
  // alert('hechem')
  //if($('input').not(':hidden')  )
  {
    var index = $('.focus').index(this) + 1;


    $('#fodec' + index).focus();


    // console.log('this index '+ index);
    $('.focus').eq(index).focus();
    event.preventDefault();
    return false;
  }
}
e.preventDefault();
return false;
});

$(document).on('keyup', '.focussss', function(e) {

e.preventDefault(); //

if (e.which === 13) {
  // alert('hechem')
  //if($('input').not(':hidden')  )
  {
    var index = $('.focus').index(this) + 1;


    $('#tva' + index).focus();


    // console.log('this index '+ index);
    $('.focus').eq(index).focus();
    event.preventDefault();
    return false;
  }
}
e.preventDefault();
return false;
});
    });
    //     function ajouter(table, index) {
    //   // alert("hh");
    //   //  alert(index);
    //   ind = Number($('#' + index).val()) + 1;
    //  /// alert(ind)

    //   $ttr = $('#' + table).find('.tr').clone(true);
    //   $ttr.attr('class', '');
    //   i = 0;
    //   tabb = [];
    //   $ttr.find('input,select,textarea,tr,td,div,ul,li').each(function () {
    //       tab = $(this).attr('table');//alert(tab)
    //       champ = $(this).attr('champ');
    //       $(this).attr('index', ind);
    //       $(this).attr('id', champ + ind);//alert(champ);
    //       if (champ == 'marchandisetype_id') {
    //           //alert(champ)
    //           $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + '][]');
    //           $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
    //       } else {
    //           $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
    //           $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
    //       }
    //       $type = $(this).attr('type');
    //       $(this).val('');
    //       if ($type == 'radio') {
    //           $(this).attr('name', 'data[' + champ + ']');
    //           //$(this).attr('value',ind);
    //           $(this).val(ind);
    //       }
    //       if ((champ == 'datedebut') || (champ == 'datefin')) {
    //           $(this).attr('onblur', 'nbrjour(' + ind + ')')
    //       }
    //       $(this).removeClass('anc');
    //       if ($(this).is('select', 'multiple')) {
    //           //alert(champ);
    //           //alert(ind);
    //           tabb[i] = champ + ind;//alert(tabb[i]);
    //           i = Number(i) + 1;
    //       }
    //       // $(this).val('');
    //   })
    //   $ttr.find('i').each(function () {
    //       $(this).attr('index', ind);
    //   });
    //   $('#' + table).append($ttr);
    //   $('#' + index).val(ind);

    //   $('#' + table).find('tr:last').show();

    //   $("#quantite" +ind).val(1);
    //   $('#quantite' + ind).attr('readonly', "");
    //        $("#article_id" + ind).select2({
    //            width: '100%' // need to override the changed default
    //        });
    //   $("#article" + ind).select2({
    //       width: '100%' // need to override the changed default
    //   });
    //   $("#article_id" + ind).select2({
    //       width: '100%' // need to override the changed default
    //   });
    //   $("#banque_id" + ind).select2({
    //       width: '100%' // need to override the changed default
    //   });
    //   $("#typeexon_id" + ind).select2({
    //       width: '100%' // need to override the changed default
    //   });

    //   $("#gouvernorat_id" + ind).select2({
    //       width: '75%' // need to override the changed default
    //   });
    //   $('#designation' + ind).focus();




    //   for (j = 0; j <= i; j++) {
    //       // alert(tabb[j]);
    //       //  $('marchandisetype_id1').attr('class','select2');
    //       //  uniform_select(tabb[j]); jareb
    //       //$('#'+tabb[j]).select2({ });
    //   }
    // }
</script>
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
<?php echo $this->Html->css('select2'); ?>
<script>
    $(function() {

        $('.desactive').on('click', function() {
            /// alert('hechem')
            $(this).find("button[type='submit']").hide();
            //$(this).attr("type", "submit");
        });



        $('.calcul').on('keyup', function() {

        })



    })
    $('.articleidbl1').on('change', function() {
      index = $(this).attr('index');
      // alert(inde);
      client = $('#client').val();
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
          date:datecreation,
          idClient: client,
        },
        success: function(response) {
          //  alert(response['ligne']["Prix_LastInput"]);
          qtestockx = response['qtestockx'];
          // alert(qtestockx);

          $('#qtestock' + index).val(qtestockx);
          $('#prix' + index).val(response['ligne']);
          $('#ttc' + index).val(response['ligne']["PTTC"]);
          //$('#exofodec').val(response['ligne']["FODEC"]);
          $('#prixht' + index).val(response['ligne']["PHT"]);

          $('#tva' + index).val(response['ligne']["tva"]["Taux"]);

        }
      })
    });
</script>


<script>



    const submitBtn = document.querySelector('button[type="submit"]');

    ///console.log(submitBtn)

    document.querySelector('form').addEventListener('submit', function() {

        submitBtn.disabled = true;
    });
</script>

<?php $this->end(); ?>]