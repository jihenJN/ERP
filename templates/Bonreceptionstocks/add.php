<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bonreceptionstock $bonreceptionstock
 */
?>
<?php echo $this->fetch('script'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('mahdi'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('salma'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ajout bon de reception stock

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
        <?php echo $this->Form->create($bonreceptionstock, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13",]); ?>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6"><?php
                                  echo $this->Form->control('numero', ['value' => $numero, "readonly" => true]);

                                  ?></div>
            <div class="col-md-6"><?php
                                  echo $this->Form->control('date', ['empty' => true, "value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]);

                                  ?></div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('pointdevente_id', ['label' => 'Site', 'empty' => false, 'id' => 'site-id', 'options' => $poindeventes, 'class' => 'form-control select2']); ?>

            </div>

            <div class="col-xs-6">
              <?php
              echo $this->Form->control('depot_id', ['label' => 'Dépot', 'id' => 'depot_id', 'class' => 'form-control select2', 'options' => $depots,]); ?>
            </div>

            <div class="col-xs-6">
              <?php
              echo $this->Form->control('typentree_id', ['label' => 'Type dentrée', 'empty' => 'Veuillez choisir !!', 'id' => 'typeentree_id', 'class' => 'form-control select2 typeEntr', 'options' => $typentrees,]); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('typereception_id', ['label' => 'Type de reception', 'empty' => 'Veuillez choisir !!', 'id' => 'typereception_id', 'class' => 'form-control select2 typereception', 'options' => $typereceptions,]); ?>
            </div>








          </div>

          <div class="row">

            <div class="col-xs-6" id="selectClient" style="display:none;">

              <div class="form-group input select required">

                <label>Clients</label>

                <select name="client_id" id="client_id" class="form-control select2 control-label clientrem">
                  <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                  <?php foreach ($clients as $i => $client) {
                  ?>
                    <option value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-xs-6" style="float: right;">
              <?php
              echo $this->Form->control('observation', ['label' => 'Observation', 'class' => 'form-control', 'type' => 'textarea']); ?>
            </div>
          </div>

          <div class="row">

          </div>
     

        </div>




        <section class="content-header">
          <h1 class="box-title"><?php echo __('Ligne bon de reception'); ?></h1>
        </section>
        <div id="block2">
          <section class="content" style="width: 99%">
            <div class="row">
              <div class="box">

                <div class="box-header with-border">
                  <a class="btn btn-primary al ajouter_ligne_reception" table='addtable' index='index' id='' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                    <i class="fa fa-plus-circle "></i> Ajouter article</a>

                </div>
                <div class="panel-body">
                  <div class="table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                      <thead>
                        <tr>
                          <td align="center" style="width: 35%;"><strong>Article</strong></td>
                          <td align="center" style="width: 15%;"><strong>Qte Stock</strong></td>
                          <td align="center" style="width: 15%;"><strong>Qte</strong></td>
                          <td align="center" style="width: 15%;"><strong>Prix</strong></td>
                          <td align="center" style="width: 15%;"><strong>Total</strong></td>
                          <td align="center" style="width: 5%;"></td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="tr" style="display: none !important">
                          <td align="center" table="ligner">
                            <label></label>
                            <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control">

                            <select table="ligner" index champ="article_id" class="js-example-responsive articleQtest  ">
                              <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                              <?php foreach ($articles as $id => $article) {
                              ?>
                                <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                              <?php } ?>
                            </select>

                            <?php
                            ?>
                          </td>



                          <td align="center" table="ligner">
                            <?php
                            echo $this->Form->input('qtestock', array('class' => ' form-control ', 'label' => '', 'index' => '', 'champ' => 'qtestock', 'table' => 'ligner', 'name' => '', 'id' => '', 'type' => 'number', 'readonly' => true));
                            ?>
                          </td>
                          <td align="center" table="ligner">
                            <?php
                            echo $this->Form->input('qte', array('class' => ' form-control focus tot', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'qte', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => ''));
                            ?>
                          </td>

                          <td align="center" table="ligner">
                            <?php
                            echo $this->Form->input('prix', array('class' => ' form-control', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'prix', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                            ?>
                          </td>
                          <td align="center" table="ligner">
                            <?php
                            echo $this->Form->input('total', array('class' => ' form-control', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'total', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                            ?>
                          </td>

                          <td align="center">
                            <i class="fa fa-times supLigne0" style="color: #c9302c;font-size: 22px;"></i>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <input type="hidden" value="-1" id="index">

                    <br>
                  </div>
                </div>
              </div>
            </div>

          </section>
        </div>


    
    




        <div align="center" id="">

          <button type="submit" id="" class="btn btn-primary alertMouv verifqte ">Enregistrer</button>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>

<script>
      $(document).ready(function() {



$(document).on('keyup', '.focus', function(e) {

    e.preventDefault(); //
    if (event.which == 13) {
        //alert('dddd')
        var $tableBody = $('#tabligne').find("tbody"), //idftable
            $trLast = $tableBody.find("tr:last");
        //  $trNew = $trLast.clone();

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








});
</script>
<script>
  $(function() {
    $('.articleQtest').on('change', function() {
      index = $(this).attr('index');
      article_id = $('#article_id' + index).val();
      date = $('#date').val();
      depot = $('#depot_id').val();
      client = $('#client_id').val();

      $.ajax({
        method: "GET",
        type: "GET",
        url: "<?= $this->Url->build(['controller' => 'Bonsortiestocks', 'action' => 'getquantite']) ?>",
        dataType: "JSON",
        data: {
          idarticle: article_id,
          date: date,
          depot: depot,
          client : client ,
        },
        success: function(data) {
          //  alert(data.qtes)
          $('#qtestock' + index).val(data.qtes);
          $('#prix' + index).val(data.prix);
          $('#qte' + index).focus();
        }
      })
    })

    $('.tot').on('keyup', function() {
      ind = Number($('#index').val());
      for (j = 0; j <= ind; j++) {
        qte = Number($('#qte' + j).val()) || 0;
        qtest = Number($('#qtestock' + j).val()) || 0;
        prix = Number($('#prix' + j).val()) || 0;
        tot = Number(qte) * Number(prix);
        $("#total"+j).val(Number(tot).toFixed(3));

      }
    })

    $('.typereception').on('change', function() {
      typereception_id = $('#typereception_id').val();
      if (typereception_id == 2) {
        // $('#block').show();
        // $('#Payement').show();
        // $('#blockResults').show();
        // $('#blockLignes').show();
        // $('#block2').hide();
        // $("button").attr("class", "btn btn-primary alertMouv verifqte");

        // $('#blocclient').show();

      } else {
        // $('#block').hide();
        // $('#block2').show();
        // $('#Payement').hide();
        // $('#blockResults').hide();
        // $('#blockLignes').hide();
        // $('#blocclient').hide();



      }
    });
    $('.typeEntr').on('change', function() {
      //////alert('hechem')
      typeentree_id = $('#typeentree_id').val();
      if (typeentree_id == 1) {
        $('#selectClient').show();
      } else {
        $('#selectClient').hide();
      }
    })


    $('.getstock').on('click', function() {
      index = $(this).attr('index'); //alert(index)
      article_id = $('#article_id' + index).val(); //alert(article_id)
      idClient = $('#client_id').val(); //alert(idClient);//alert(
      depot_id = $('#depot_id').val(); //alert(depot_id)
      ms = "";

      $.ajax({
        method: "GET",
        type: "GET",
        url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getquantite']) ?>",
        dataType: "JSON",
        data: {
          idarticle: article_id,
          idadepot: depot_id,
          idClient: idClient,
        },
        success: function(data, status, settings) {

          stock = data.inv;
          qtecommande = data.qtecommande;
          if (stock == qtecommande) {
            qte = qtecommande;
          } else {
            qte = qtecommande;
          }
          seuil = data.alert;
          ms = (ms) + 'la quantité en stock est ' + stock + "\n";
          ms = (ms) + 'la quantité commandé est ' + qte + "\n";
          ms = (ms) + 'la quantité seuil est ' + seuil;
          alert(ms)



        }
      })

    });




    var filterFloat = function(value) {
      if (/^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/
        .test(value))
        return Number(value);
      return NaN;
    }
  


 
  })


  
</script>

<script>
  
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
  $('.select2').select2({
    width: '100%' // need to override the changed default
  });

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
  $(document).ready(function() {


    $(document).on('keyup', '.focuss', function(e) {
      //alert('fff')
      e.preventDefault(); //
      if (event.which == 13) {
        // alert('dddd')
        var $tableBody = $('#addtable').find("tbody"), //idftable
          $trLast = $tableBody.find("tr:last");
        //  $trNew = $trLast.clone();



        // $trLast.after($trNew);
        ajouter('addtable', 'index');
        // alert('ccc')
        document.getElementById("boutonCommande").scrollIntoView(); //idfbouton

        e.preventDefault();
        return false;
      }
      //            if (e.which === 13) {
      // 			//if($('input').not(':hidden')  )
      //			{
      //                var index = $('.focus').index(this) + 1;     //  class f les    select ili temchilhom 
      //               // console.log('this index '+ index);
      //                $('.focus').eq(index).focus();
      //                event.preventDefault();
      //                return false;
      //				}
      //            }
      //            e.preventDefault();
      //            return false;
    });
    $(document).on('keyup', '.focus', function(e) {
      //alert('fff')
      index = $(this).attr('index');
      e.preventDefault(); //
      if (event.which == 13) {
        // alert('dddd')

        //  $trNew = $trLast.clone();

        $('#tpe' + index).focus();


        // $trLast.after($trNew);


        e.preventDefault();
        return false;
      }
      //            if (e.which === 13) {
      // 			//if($('input').not(':hidden')  )
      //			{
      //                var index = $('.focus').index(this) + 1;     //  class f les    select ili temchilhom 
      //               // console.log('this index '+ index);
      //                $('.focus').eq(index).focus();
      //                event.preventDefault();
      //                return false;
      //				}
      //            }
      //            e.preventDefault();
      //            return false;
    });
  });
</script>
<script>
  function ajouter(table, index) {
    //alert("hh");
    //  alert(index);
    ind = Number($("#" + index).val()) + 1;
    $ttr = $("#" + table)
      .find(".tr")
      .clone(true);
    $ttr.attr("class", "");
    i = 0;
    tabb = [];
    $ttr.find("input,select,textarea,tr,td,div,ul,li").each(function() {
      //alert()
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
    $("#" + index).val(ind);

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
    $('#article_id' + ind).select2("open");
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

  function openWindow(h, w, url) {
    //alert()
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
  }
</script>
<script>
    const submitBtn = document.querySelector('button[type="submit"]');

    ///console.log(submitBtn)

    document.querySelector('form').addEventListener('submit', function() {

        submitBtn.disabled = true;
    });
</script>
<?php $this->end(); ?>