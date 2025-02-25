<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>


<?php echo $this->Html->script('mariem'); ?>

<?php echo $this->fetch('script'); ?>

<?php echo $this->Html->css('select2'); ?>


<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ajout Bon de chargement
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
        <?php echo $this->Form->create($bondechargement, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>


        <div class="box-body">
          <div class="row">
            <div class="row">
              <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                <div class="col-xs-6">
                  <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $mm, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                </div>
                <div class="col-xs-6">
                  <?php echo $this->Form->control('pointdevente_id', ['options' => $pointdeventes, 'value' => $this->request->getQuery('name'), 'empty' => 'Veuillez choisir !!', 'id' => 'site-id', 'required' => 'off', 'label' => 'Site', 'class' => 'form-control select2 control-label depot']); ?></div>
              </div>
            </div>


            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


              <div class="row">

                <div class="col-xs-6">

                  <?php echo $this->Form->control('depot_id', ['options' => $depots, 'empty' => 'Veuillez choisir !!', 'label' => 'Dépots', 'class' => 'form-control select2 control-label dep', 'id' => 'depot_id']); ?>
                </div>
                <div class="col-xs-6">
                  <?php echo $this->Form->control('date', ['empty' => true, "value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]);
                  ?> </div>
              </div>
            </div>

          </div>





          <section class="content-header">
            <h1 class="box-title"><?php echo __('Ligne bon de chargement'); ?></h1>
          </section>

          <section class="content" style="width: 99%">
            <div class="row">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <a class="btn btn-primary test " table="addtable" index="index" style="
                                       float: right;
                                       margin-bottom: 5px;
                                       " id='ajouter_ligne3'>
                    <i class="fa fa-plus-circle "></i> Ajouter ligne</a>

                </div>
                <div class="panel-body">
                  <div class="table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless" id="tabligne3">



                      <thead>
                        <tr style="width:20px">
                        <td align="center" style="width: 35%;"><strong>Article</strong></td>
                          <td align="center" style="width: 15%;"><strong>Quantite en stock</strong></td>
                          <td align="center" style="width: 15%;"><strong>Quantite</strong></td>
                          <td align="center" style="width: 5%;"><strong></strong></td>
                        </tr>
                      </thead>
                      <tbody>


                        <tr class="tr" style="display: none ">
                          <td align="center">



                            <select table="ligner" index champ="article_id" class="js-example-responsive  foc articleidbl1">
                              <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                              <?php


                              foreach ($articles as $id => $article) {

                              ?>
                                <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                              <?php } ?>
                            </select>


                          </td>
                          <td align="center" table="ligner">
                            <input table="ligner" name="" champ="qteStock" id="" type="text" class="form-control " readonly>
                          </td>
                          <td align="center" table="ligner">
                            <input table="ligner" name="" champ="qte" type="text" id="" class="form-control gettot focus focusss">
                          </td>
                         
                          <td>
                            <i index="" id="" class="fa fa-times supLigne" style="color: #c9302c;font-size: 22px;"></i>
                            <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control">
                          </td>
                        </tr>
                        <input type="hidden" value=-1 id="in">
                      </tbody>
                    </table><br>
                  </div>
                </div>
              </div>
            </div>


          </section>

        </div>

        <div align="center">
          <button type="submit" class="pull-right btn btn-success btn-sm " id="testbonchargement" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

        </div>
        <?php echo $this->Form->end(); ?>

      </div>

    </div>
  </div>
</section>





<script type="text/javascript">
  $(function() {


    $('.articleidbl1').on('change', function() {

      index = $(this).attr('index');
      article_id = $('#article_id' + index).val();
      date = $('#date').val();
      depot = $('#depot_id').val();

      $.ajax({
        method: "GET",
        type: "GET",
        url: "<?= $this->Url->build(['controller' => 'Bonsortiestocks', 'action' => 'getquantite']) ?>",
        dataType: "JSON",
        data: {
          idarticle: article_id,
          date: date,
          depot: depot,

        },
        success: function(data) {
          //  alert(data.qtes)

          $('#qteStock' + index).val(data.qtes);
          $('#prix' + index).val(data.prix);
          $('#qte' + index).focus();

        }

      })

    })

    $('.depot').on('change', function() {
      //  alert('hello');
      id = $('#site-id').val();
      //alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Bondechargements', 'action' => 'getdepot']) ?>",
        dataType: "json",
        data: {
          id: id,

        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {

          $('#depot_id').html(data.select);

        }

      })

    });

    $(".gettot").on("keyup", function() {
      //alert('hh');
      index = $("#in").val(); //alert(index);

      total = 0;
      for (i = 0; i <= index; i++) {
        qteStock = $("#qteStock" + i).val() * 1; //alert(qteStock);
        qte = $("#qte" + i).val() * 1; //alert(qte);
        prix = $("#prix" + i).val() || 0; //alert(prix);
     
        total = Number(qte) * Number(prix); //alert(total);
        

        $("#total" + i).val(Number(total));
      }
    });





  });
</script>
<script>
  
function ajouter(table, index) {
  // alert("hh");
     ////alert(index);
     ind = Number($('#in').val()) + 1;
   alert(ind)
  
  
  $ttr = $('#' + table).find('.tr').clone(true);
  $ttr.attr('class', '');
  i = 0;
  tabb = [];
  $ttr.find('input,select,textarea,tr,td,div,ul,li').each(function () {
      tab = $(this).attr('table');//alert(tab)
      champ = $(this).attr('champ');
      $(this).attr('index', ind);
      $(this).attr('id', champ + ind);//alert(champ);
      if (champ == 'marchandisetype_id') {
          //alert(champ)
          $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + '][]');
          $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
      } else {
          $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
          $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
      }
      $type = $(this).attr('type');
      $(this).val('');
      if ($type == 'radio') {
          $(this).attr('name', 'data[' + champ + ']');
          //$(this).attr('value',ind);
          $(this).val(ind);
      }
      if ((champ == 'datedebut') || (champ == 'datefin')) {
          $(this).attr('onblur', 'nbrjour(' + ind + ')')
      }
      $(this).removeClass('anc');
      if ($(this).is('select', 'multiple')) {
          //alert(champ);
          //alert(ind);
          tabb[i] = champ + ind;//alert(tabb[i]);
          i = Number(i) + 1;
      }
      // $(this).val('');
  })
  $ttr.find('i').each(function () {
      $(this).attr('index', ind);
  });
  $('#' + table).append($ttr);
  $('#' + index).val(ind);

  $('#' + table).find('tr:last').show();
  
  $("#quantite" +ind).val(1);

 // $("#fodec" +ind).val(1);
 // $("#tva" +ind).val(19);
  // $('#quantite' + ind).attr('readonly', "");
$("#article_id" + ind).select2({
           width: '100%' // need to override the changed default
       });
  $("#article" + ind).select2({
      width: '100%' // need to override the changed default
  });
  $("#article_id" + ind).select2({
      width: '100%' // need to override the changed default
  });
  $("#banque_id" + ind).select2({
      width: '100%' // need to override the changed default
  });
  $("#typeexon_id" + ind).select2({
      width: '100%' // need to override the changed default
  });

  $("#gouvernorat_id" + ind).select2({
      width: '75%' // need to override the changed default
  });
  $("#tva" + ind).select2({
    width: '75%' // need to override the changed default
});
$("#fodec" + ind).select2({
  width: '75%' // need to override the changed default
});
  $('#designation' + ind).focus();

  $('#article_id' + ind).select2("open");




  for (j = 0; j <= i; j++) {
      // alert(tabb[j]);
      //  $('marchandisetype_id1').attr('class','select2');
      //  uniform_select(tabb[j]); jareb
      //$('#'+tabb[j]).select2({ });
  }
}

      $(document).ready(function() {



// $(document).on('keyup', '.focus', function(e) {

//     e.preventDefault(); //
//     if (event.which == 13) {
//         //alert('dddd')
//         var $tableBody = $('#tabligne').find("tbody"), //idftable
//             $trLast = $tableBody.find("tr:last");
//         //  $trNew = $trLast.clone();

//         ajouter('tabligne3', 'index');

//       ///  document.getElementById("invBtnn").scrollIntoView(); //idfbouton

//         e.preventDefault();
//         return false;
//     }
//     if (event.which === 13) {
//         //alert('hechem')
//         //if($('input').not(':hidden')  )
//         {
//             var index = $('.focus').index(this) + 1;

//             //  class f les    select ili temchilhom 
//             $('.focus').eq(index).focus();
//             event.preventDefault();
//             return false;
//         }
//     }
//     e.preventDefault();
//     return false;
// });








});
</script>

<!-- <style>
  .select2-selection__rendered {
    line-height: 25px !important;
  }

  .select2-container .select2-selection--single {
    height: 35px !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    border-color: #d2d6de !important;

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
    width: auto !important;
  }
</style> -->



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

<script>
    const submitBtn = document.querySelector('button[type="submit"]');

    ///console.log(submitBtn)

    document.querySelector('form').addEventListener('submit', function() {

        submitBtn.disabled = true;
    });
</script>
<?php $this->end(); ?>