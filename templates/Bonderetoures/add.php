<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bonderetoure $bonderetoure
 */
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>


<section class="content-header">
    <h1>
        bon de retour
    </h1>
    <ol class="breadcrumb">

        <a href="<?php echo $this->Url->build(['action' => 'index/']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a>

    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box ">


                <?php echo $this->Form->create($bonderetoure, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box-body">

                    <div class="row">

                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('numero', ["value" => $code, 'readonly' => 'readonly']);


                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('date', ['empty' => true, 'value' => date("d/m/Y"), 'class' => 'form-control']);

                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $this->Form->control('fournisseur_id', ['options' => $fournisseurs, 'required' => 'on', 'label' => 'Fournisseurs', 'class' => 'form-control  select2 control-label', 'empty' => 'Veuillez choisir !!']); ?>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group input select required">

                                <?php echo $this->Form->control('depot_id', ['options' => $depots, 'required' => 'on', 'label' => 'Depots', 'class' => 'form-control select2 control-label', 'empty' => 'Veuillez choisir !!']); ?>

                            </div>
                        </div>




                    </div>
                    
                    <section class="content-header">
          <h1 class="box-title"><?php echo __('Ligne bon de retour'); ?></h1>
        </section>
        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">
              <div class="box-header with-border">
                <a class="btn btn-primary  " table='addtable' index='' id='ajouter_ligne' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                  <i class="fa fa-plus-circle "></i> Ajouter ligne</a>

              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="tabligne">

                    <thead>
                      <tr style="width:20px">
                       
                        
                        <td align="center" style="width: 25%;"><strong>Articles</strong></td>
                        
                        <td align="center" style="width: 25%;"><strong>TVA</strong></td>
                        
                        <td align="center" style="width: 25%;"><strong>Quantite en stock     </strong></td>
                        <td align="center" style="width: 25%;"><strong>Quantite     </strong></td>
                        <td align="center" style="width: 25%;"></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="tr" style="display: none !important">

                       
                        <td align="center">
                            <?php echo $this->Form->control('article_id', array('options' => $articles, 'table' => 'tabligne','class' => ' form-control ', 'label' => '', 'index' => '', 'champ' => '', 'empty' => 'Veuillez choisir !!')); ?>
                        </td>
                       
                        <td align="center">
                            <?php echo $this->Form->input('tva', array( 'class' => ' form-control ', 'label' => '', 'index' => '', 'champ' => '','table' => 'tabligne')); ?>
                        </td>
                        <td align="center">
                            <?php echo $this->Form->input('qtestock', array('class' => ' form-control ', 'label' => '', 'index' => '', 'champ' => '','table' => 'tabligne')); ?>
                        </td>
                        <td align="center">
                            <?php echo $this->Form->input('qte', array( 'class' => ' form-control ', 'label' => '', 'index' => '', 'champ' => '','table' => 'tabligne')); ?>
                        </td>

                       
                        <td align="center">
                          <i index="0" id="" name="" class="fa fa-times supLigne2" style="color: #c9302c;font-size: 22px;"></i>
                          <input type="hidden" name="" id="" champ="sup2" table="tabligne" index="" class="form-control">
                        </td>

                      </tr>


                      <input type="hidden" value="-1" id="index">
                    </tbody>
                  </table><br>
                </div>
              </div>
            </div>
          </div>

        </section>

                    


                    <button type="submit" class="pull-right btn btn-success btn-sm alertFac" id="" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
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
/****************************************************ajout ligne *******************************************************/
        $('#ajouter_ligne').on('click', function () {

        ajouter('tabligne', 'index');
 });
/****************************************************sup ligne **********************************************************/
$('.supLigne2').on('click', function () {
        //alert('hh');
        index = $(this).attr('index');

        $('.supLigne2').each(function () {
            ind = $(this).attr('index');
            if (ind == index) {
                $('#sup2' + index).val(1);//alert('sup'+sup);
                $(this).parent().parent().hide();
            }
        })


    });
/******************************************************* *****************************************************************/
      
    })


    
    function ajouter(table, index) {
        //  alert("hh");
        //  alert(index);
        ind = Number($('#' + index).val()) + 1;
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
        $("#article_id" + ind).select2({
          width: '100%' // need to override the changed default
        });
       
    }
</script>

<?php $this->end(); ?>]