<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Previsionachat $previsionachat
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script> 
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->css('select2'); ?>

<section class="content-header">
  <h1>
    Ajouter prevision vente 
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
        <div class="box box-primary">
       
          <!-- /.box-header -->
          <?php echo $this->Form->create($previsionachat, ['role' => 'form' , 'onkeypress' => "return event.keyCode!=13"]); ?>
            <div class="box-body">
            <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $mmm, 'label' => 'Numero', 'type'=>'hidden' ]); ?>

         
            <?php
            echo $this->Form->control('date',['label'=>'Date'  , 'class'=>'form-control', 'required' => 'off', 'value' => date('Y-m-d') , 'type'=>'hidden' ]);
            ?>
        
          
            </div>
<section class="content">
<div class="box-header with-border">
      <a class="btn btn-primary  " table='achat'  index='index' id='ajouter_ligne_achat' style="
                           float: right;
                           margin-bottom: 5px;
                           ">
    <i class="fa fa-plus-circle "></i> Ajouter ligne</a>

</div>

    <div class="panel-body">
      <div class="table-responsive ls-table">
        <table class="table table-bordered table-striped table-bottomless" table="achat" id="achat">
          <thead>
            <tr >
            <th  style="width: 20%;" class="actions text-center"> Article </th>
            <?php
                 foreach ($mois as $m) : ?>
             <th align="center"> 
                      <?php echo $m->name  ?> </th>
                       <?php endforeach; ?>

                       <th  style="width: 2%;"></th>

            </tr>
          </thead>
          <tbody>

    
      <?php $i = -1 ?>
            <tr  class='tr' style="display: none ;" >
              <td style="width: 20%;">

              <input type="hidden" id="" champ="suppv" name="" table="achat" index="" class="form-control">

              <select  name="" style="width: 80px;" table="achat"  index champ="article_id" class="js-example-responsive mois  ">
                   <option value="" selected="selected">Veuillez choisir !!</option>
               <?php foreach ($articles as $j => $art) {
                    ?>
                   <option value="<?php echo $art->id; ?>"><?php echo $art->Code . ' ' . $art->Dsignation ?></option>
                              <?php } ?>
                   
                            </select>
              </td>
              <?php
            foreach ($mois as $m => $moi) :  ?>
                <td >
                    <input  name=""    indexa="<?php echo $m ?>"   table="achat" value="<?php echo $moi->id ?>" champ="moi_id<?php echo $m ?>"  style="height:30px;width:50px" type="hidden" class="form-control">
                    <input id="" index="" table="achat"  champ="qte<?php echo $m ?>"   style="height:30px;width:90%" type="text" class="form-control">
                </td>
                <?php  ?>
            <?php endforeach; $m++ ?>
            <td align="center"    ><i index="" id="" class="fa fa-times supreprev" style="width: 20%; color: #C9302C;font-size: 22px;"></td>

            </tr>
          


        

          </tbody>
        </table>
        <input type="" value="<?php echo $i ?>" id="indexpv" hidden  >
        <input type="" value="<?php echo $m ?>" id="indexa" hidden  >

      </div>
      <div class="box-header with-border">
      <a class="btn btn-primary  " table='achat'  index='index' id='ajouter_ligne_achat' style="
                           float: right;
                           margin-bottom: 5px;
                           ">
    <i class="fa fa-plus-circle "></i> Ajouter ligne</a>

</div>
      <button type="submit" class="pull-right btn btn-success " id="previsionachat" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

    </div>


    </section>   






          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
  </div>
  <!-- /.row -->
</section>

<!-- daterange picker -->
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
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
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
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
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