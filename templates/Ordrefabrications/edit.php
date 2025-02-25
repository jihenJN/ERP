<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->fetch('script'); ?>
<?php echo $this->Html->script('safa'); ?>
<?php echo $this->Html->script('ajouterlignematrice'); ?>

<?php echo $this->Html->css('select2'); ?>



<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>


    Modification Ordre Fabrication
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
        <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box ">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($ordrefabrications, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <?php //dd($ordrefabrications); 
        ?>

        <div class="box-body">
          <div class="row">

            <div class="col-xs-6">

              <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $ordrefabrications->numero, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('date', ['empty' => true]); ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('pointdevente_id', ['required' => 'off', 'id' => 'pointdevente_id', 'label' => 'Site', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 depot']); ?>

            </div>
            <div class="col-xs-6">

              <?php echo $this->Form->control('depot_id', ['required' => 'off', 'id' => 'depot_id', 'label' => 'Depots', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ']); ?>
            </div>

          </div>

        </div>


        <section class="content-header">
          <h1 class="box-title"><?php echo __('Modifier ligne ordre fabrication'); ?></h1>
        </section>

        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box box-primary">
              <div class="box-header with-border">
                <a class="btn btn-primary ajouterligne_o" table="addtable" index="index" style="
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
                        <td align="center" style="width: 40%;"><strong>Article</strong></td>

                        <td align="center" style="width: 20%;"><strong>Quantite</strong></td>
                        <td align="center" style="width: 50%;"><strong></strong></td>

                    
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($lignes as $j => $lp) {
                      // debug ($lp);die;?>
                        <tr>
                          <td >
                            <?php echo $this->Form->control('article_id', ['value' => $lp['article_id'], 'label' => '', 'index' => $j, 'id' => 'article_id' . $j, 'name' => 'data[ligner][' . $j . '][article_id]', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2  art articleblock fiche']); ?>
                          </td>

                          <td>
                            <?php echo $this->Form->control('quantite', ['value' => $lp['quantite'], 'id' => 'qte' . $j, 'index' => $j, 'name' => 'data[ligner][' . $j . '][quantite]', 'label' => '', 'class' => 'form-control calculeqte']); ?>
                           
                            <input table="ligner" value="<?php echo $qtesaf ?>" name="data[ligner][0][quantite]" id="quantite<?php echo $j ?>" champ="quantite0" type="hidden" class="form-control " index="<?php echo $j ?>">
                            <input table="ligner" name="data[ligner][0][quantitee]" id="quantitee0" champ="quantitee0" type="hidden" class="form-control " index="0">
                            <input table="ligner" name="data[ligner][0][quantiteee]" id="quantiteee0" champ="quantiteee0" type="hidden" class="form-control " index="0">

                          </td>
                       
                          <td>





                            <?php foreach ($ligneligneordrefab as $k => $lg) { ?>
                              <table>
                                <thead>

                                </thead>
                                <tbody>
                                  <tr bgcolor='#EDEDED'>
                                    <td align='center' style='width: 25%;'><strong>Composant 1</strong></td>
                                    <td align='center' style='width: 80%;'><strong>Quantite </strong></td>

                                  </tr>
                                  <tr>
                                    <td align='left'><input readonly value="<?php echo $lg->article->Dsignation ?>" name='data[ligner][<?php echo $j ?>][Ofsfligne][<?php echo $k ?>][article_idm]' index="<?php echo $j ?>" indexx="<?php echo $k ?>" id='article_id' champ='article_idm' table='Ofsfligne' class='form-control'>

                                    </td>
                                   
                                    <td align='left'><input readonly value="<?php echo $lg->qte ?>" name='data[ligner][<?php echo $j ?>][Ofsfligne][<?php echo $k ?>]' index="<?php echo $j ?>" indexx="<?php echo $k ?>" id='qte1comp<?php echo $j ?>-<?php echo $k ?>' champ='article_idm' table='Ofsfligne' class='form-control calculeqte'>
                                     </td>   
                                  <tr index='".$i."' align='centre'>
                                    <td champ='afef' class='afef' width='30%'></td>
                                    <td id='".$i."' colspan='2' indexx='".$i."'>
                                      <table id='addtableaa".$i."' style='width:100%' align='center'>
                                        <thead>
                                          <tr bgcolor='#EDEDED'>
                                            <td align='center'>Composant2</td>
                                            <td align='center'>Quantite</td>


                                          </tr>
                                        </thead>
                                        <?php foreach ($ligneligneordrefab as $p => $ltttttt) { ?>
                                          <table>
                                            <thead>

                                            </thead>
                                            <tbody>

                                              <tr>
                                                <td align='left'><input readonly value="<?php echo $ltttttt->article->Dsignation ?>" name='data[ligner][<?php echo $j ?>][Ofsfligne][<?php echo $k ?>][Phaseofsf][<?php echo $p ?>][article_idt]' index=<?php echo $j ?> indexx=<?php echo $k ?> indexxx=<?php echo $p ?> id='article_id' champ='article_idm' table='Ofsfligne' class='form-control'>

                                                </td>
                                                <td align='left'><input readonly value="<?php echo $ltttttt->qte ?>" name='data[ligner][<?php echo $j ?>][Ofsfligne][<?php echo $k ?>][Phaseofsf][<?php echo $p ?>][qte]' index=<?php echo $j ?> indexx=<?php echo $k ?> indexxx=<?php echo $p ?> id='qte2comp<?php echo $j ?>-<?php echo $k ?>-<?php echo $p ?>' champ='article_idm' table='Ofsfligne' class='form-control calculeqte'>
                                              <tr id='traaligne".$i."-".$j."' champ='traaligne'>
                                                <td width='30%'></td>
                                                <td id='afefligne".$i."-".$j."' champ='afefligne' class='afefligne".$i."-".$j."' colspan='3' id='afefligne".$i."-".$j."' indexx='".$i."'>
                                                  <table indexx='".$i."' indexligneligne='".$j."' champ='addtableaaligne' id='addtableaaligne".$i."-".$j."' style='width:100%' align='center'>
                                                    <thead>
                                                      <tr bgcolor='#EDEDED'>
                                                        <td align='center'>Composant3</td>
                                                        <td align='center'>Qte</td>

                                                      </tr>
                                                    </thead>
                                                    <?php foreach ($ligneligneligneordrefabsafa as $tt => $ffff) { ?>
                                                      <table>
                                                        <thead>

                                                        </thead>
                                                        <tbody>

                                                          <tr>
                                                            <td align='left'><input readonly value="<?php echo $ffff->article_id ?>" name='data[ligner][<?php echo $j ?>][Ofsfligne][<?php echo $k ?>][Phaseofsf][<?php echo $p ?>][Phaseofsfligne][<?php echo $tt ?>][article_idd]' index=<?php echo $j ?> indexx=<?php echo $k ?> indexxx=<?php echo $p ?> indexxxx=<?php echo $tt ?> id='article_idm' champ='article_idm' table='Ofsfligne' class='form-control calculeqte'>

                                                            </td>
                                                            <td align='left'><input readonly value="<?php echo $ffff->qte ?>" name='data[ligner][<?php echo $j ?>][Ofsfligne][<?php echo $k ?>][Phaseofsf][<?php echo $p ?>][Phaseofsfligne][<?php echo $tt ?>][qte]' index=<?php echo $j ?> indexx=<?php echo $k ?> indexxx=<?php echo $p ?> indexxxx=<?php echo $tt ?> id='qte3comp<?php echo $j ?>-<?php echo $k ?>-<?php echo $p ?>-<?php echo $tt ?>' champ='article_idm' table='Ofsfligne' class='form-control calculeqte'>

                                                            </td>

                                                          </tr>





                                                        </tbody>
                                                      </table>
                                                    <?php } ?>

                                                </td>

                                              </tr>
                                            </tbody>
                                          </table>
                                        <?php } ?>
                                  </table>
                                    </td>

                                  </tr>


                                </tbody>
                              </table>
                            <?php } ?>
                          <?php } ?>
                </div>
                </td>
                <!-- <td id="deuxieme<?php echo $j ?>">-->
                 <!-- <div id="divmp<?php echo $j ?>" index="<?php echo $j ?>"> -->
                </td>


                <tr class="tr" style="display: none!important; ">
                  <td align="center">

                    <input type="hidden" id="" champ="supp" name="" table="ligner" index="" class="form-control">

                    <select table="ligner" index="" name="" champ="article_id" class="form-control  fiche">

                      <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                      <?php foreach ($articles as $id => $article) {
                      ?>
                        <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                      <?php } ?>
                    </select>

                  </td>

                  <td align="center" table="ligner">
                    <input table="ligner" name="" champ="qte" type="text" id="" class="form-control  calculeqte">

                    <input table="ligner" name="" champ="quantite" type="hidden" id="" class="form-control ">
                    <input table="ligner" name="" champ="quantitee" type="hidden" id="" class="form-control ">
                    <input table="ligner" name="" champ="quantiteee" type="hidden" id="" class="form-control ">



                  </td>

                  <td align="center" table="ligner" champ="divmp" index="" id=""></td>

                  <td align="center">
                    <i index="" id="" class="fa fa-times supLigne0ch" style="color: #c9302c;font-size: 22px;"></i>
                  </td>
                </tr>

                </tbody>



                </table>



                <button type="submit" class="pull-right btn btn-success " style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

              </div>
            </div>

        </section>




        <div align="center">
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
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
<script>
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
<script>
  $(document).ready(function() {

    // $('.fiche').on('change', function() {
    //   //  alert('hello');
    //   index = $(this).attr('index'); //alert(index)
    //   article_id = $('#article_id' + index).val() || 0;
    //   //alert(article_id);

    //   //    alert(id);
    //   $.ajax({
    //     method: "GET",
    //     url: "<?= $this->Url->build(['controller' => 'Ordrefabrications', 'action' => 'getFiche']) ?>",
    //     dataType: "json",
    //     data: {
    //       id: article_id,
    //       index: index,
    //     },
    //     headers: {
    //       'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
    //     },
    //     success: function(data, status, settings) {
    //       // alert(data.res);

    //       $('#divmp' + index).html(data.res);
    //     },
    //     error: function(data) {
    //       //alert(data.res);
    //       $('#divmp' + index).html(null);

    //     }
    //   })
    // });
    $('.fiche').on('change', function () {
           //  alert('hello');
            index = $(this).attr('index');//alert(index)
            article_id = $('#article_id' + index).val() || 0;
            //alert(article_id);

            //    alert(id);
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Ordrefabrications', 'action' => 'getFiche']) ?>",
                dataType: "json",
                data: {
                    id: article_id,
                    index: index,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data, status, settings) {
                    // alert(data.res);

                    $('#divmp' + index).html(data.res);
                },
                error:
                        function (data) {
                            alert(data.res);
                            $('#divmp' + index).html(null);

                        }
            })
        });
    $(".edit").on("change", function() {
      // alert('hhh')
      index = $(this).attr("index");
      article_id = $('#article_id' + index).val() || 0;
      $('#safa' + index).val(1);
      $(this).parent().parent().hide();
      //alert('ssss')
      safa = $('#safa' + index).val();
      if (safa = 1) {
        $('#deuxieme' + index).attr('style', "display:true;");
        $.ajax({
          method: "GET",
          url: "<?= $this->Url->build(['controller' => 'Ordrefabrications', 'action' => 'getFiche']) ?>",
          dataType: "json",
          data: {
            id: article_id,
            index: index,
          },
          headers: {
            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
          },
          success: function(data, status, settings) {
            // alert(data.res);

            $('#divmp' + index).html(data.res);
          },
          error: function(data) {
            //alert(data.res);
            $('#divmp' + index).html(null);
            $('#divmp' + index).attr('style', "display:true;");
          }
        })

        $('#qte' + index).val('');
        $('#ff' + index).attr('style', "display:true;");
        $('#edittable' + index).attr('style', "display:none;");
      } else {
        $('#ff' + index).show();
        $('#edittable' + index).attr('style', "display:true;")
        $('#divmp' + index).attr('style', "display:none;");
      }
    });
    $('.calculeqte').on('keyup', function() {
      //alert('hello');
      index = $(this).attr('index');
      //alert(index)
      article_id = $('#article_id' + index).val() || 0;
      indexx = $('#indexx' + index).val() || 0; //alert(indexx);
      indexligne = $('#indexligne' + index).val() || 0; //alert(indexligne);
      indexligneligne = $('#indexligneligne' + index + '-' + indexx + '-' + indexligne).val() || 0; //alert(indexligneligne);
      qte = Number($("#qte" + index).val());
      alert(qte)
      //alert(article_id);

      //    alert(id);
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Ordrefabrications', 'action' => 'getQteval']) ?>",
        dataType: "json",
        data: {
          id: article_id,

        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data, status, settings) {
          //alert(data.qte1);

          $('#quantite' + index).val(data.qte1); //alert(data.qte1)
          $('#quantitee' + index).val(data.qte2);
          $('#quantiteee' + index).val(data.qte3);
          qteee1 = Number($("#quantite" + index).val()); //alert(qteee1);
          qteee2 = Number($("#quantitee" + index).val());
          qteee3 = Number($("#quantiteee" + index).val());


          for (i = 0; i <= index; i++) {
            //indexx = $('#indexx' + i).val() || 0;
            qtecompcalu = qteee1 * qte;
            alert(qtecompcalu);
            qtecompcalula = qtecompcalu * qteee2; //alert(qtecompcalu);
            qtecompcalulable = qtecompcalula * qteee3;

          }
          Number($("#qte1comp" + index + '-' + indexx).val(qtecompcalu));
          Number($("#qte2comp" + index + '-' + indexx + '-' + indexx).val(qtecompcalula));
          Number($("#qte3comp" + index + '-' + indexx + '-' + indexligne + '-' + indexligneligne).val(qtecompcalulable));
        },

      })
    });

    $('.depot').on('change', function() {
      //  alert('hello');

      id = $("#pointdevente_id").val();
      //alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Ordrefabrications', 'action' => 'getDepot']) ?>",
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
    $('.artordfab').on('change', function() {
      //  alert('hello');
      index = $(this).attr('index'); //alert(index)
      article_id = $('#article_id' + index).val() || 0;
      id = $('#id').val() || 0;
      article_idm = $('#article_idm' + index).val() || 0;
      idl = $('#idl').val() || 0;
      article_idt = $('#article_idt' + index).val() || 0;
      idll = $('#idll').val() || 0;
      article_idd = $('#article_idd').val() || 0;
      idlll = ('#idlll').val() || 0;


      //alert(id);
      //alert(article_id);

      //    alert(id);
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Ordrefabrications', 'action' => 'getOrdfab']) ?>",
        dataType: "json",
        data: {
          article_id: article_id,
          id: id,
          article_idm: article_idm,
          idl: idl,
          article_idt: article_idt,
          idll: idll,
          article_idd: article_idd,
          idlll: idlll,

          // index: index,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data, status, settings) {
          // alert(data.res);


        },
        error: function(data) {
          //alert(data.res);


        }
      })
    });
  });
</script>



<?php $this->end(); ?>