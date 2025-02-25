<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->fetch('script'); ?>
<section class="content-header">
  <h1>
    Modifier zone delegation
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
        Retour </a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box ">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <?php echo $this->Form->create($zonedelegation, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">

        <div class="box-body">
        <div class="col-xs-6">
        <?php echo $this->Form->control('numero', [ 'readonly'=>'readonly' , 'value' => $zonedelegation->numero, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
          </div>
          <div class="col-xs-6">
          <?php echo $this->Form->control('zone_id', [ 'class'=>'form-control select2' , 'value' => $zonedelegation->zone_id, 'empty' => 'Veuillez choisir !!','label' => 'Zone', 'required' => 'off']); ?>

          </div>
              
            </div>
          
        <section class="content-header">
                        <h1 class="box-title"> Modifier ligne zone delegation  </h1>
          </section>
                    <section class="content" style="width: 99%">
                        <div class="row">
                            <div class="box">
                                <div class="box-header with-border">
                                    <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_ligne66' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                        <i class="fa fa-plus-circle "></i> Ajouter ligne zone delegation </a>

                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless" id="tabligne6">

                                            <thead>
                                                <tr>
                                                    <td align="center" style="width: 15%;"><strong>Gouvernorat</strong></td>
                                                    <td align="center" style="width :35%;">    <strong>Delegations</strong>   </td>
                                                    <td align="center" style="width: 4%;"> </td>

                                                </tr>
                                            </thead>
                                            <tbody>
                            <?php  $i = 0;
                             foreach ($gouv as $i => $gv) : 
                              ?>
                               
                                            <tr>
                
                <td align="center" >
                
                <?php echo $this->Form->input('sup', array('name' => "data[Gouvernorat][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => '', 'class' => 'form-control', 'type' => 'hidden')); ?>

                <select table="Gouvernorat" name="<?php echo "data[Gouvernorat][" . $i . "][gouvernorat_id]" ?>"   id="<?php echo 'gouvernorat_id' . $i ?>"  index="<?php echo $i ?>" champ="gouvernorat_id"  class="js-example-responsive form-control select2 gouvernorat ">
                                <option value="" selected="selected" >Veuillez choisir !!</option>

                                <?php foreach ($gouvernorats as $id=> $gouvernorat) {
                                    ?>
                  <option <?php if ($gv->gouvernorat->id == $gouvernorat->id) { ?> selected="selected" <?php } ?> value="<?php echo $gouvernorat->id; ?>"><?php echo $gouvernorat->name ?></option>
                                <?php } ?>
                            </select>
                  </td>


                <td>
                  
                
                  <div class="table-responsive ls-table" index="" id="delegation<?php echo $i ?>"  >
                    
                    <table style="width:70%" align="center" class="table table-bordered table-striped table-bottomless">
                    
                      <tbody>
                        <?php
                        foreach ($tab2[$gv->gouvernorat_id]as $j  => $b ) 
                         { 
                        
                        ?> 
                        
                          <tr>
                            <td>

                              <input readonly value="<?php echo $b['deleg']?>" index="<?php echo $j ?>"   id="deleg<?php echo $j ?>"   name="data[Gouvernorat][<?php echo $i ?>][Delegation][<?php echo $j ?>][delegname]" class="form-control">
                              <input type="hidden" value="<?php echo $b['deleg_id']?>" index="<?php echo $j ?>" table="Delegation" champ="" name="data[Gouvernorat][<?php echo $i ?>][Delegation][<?php echo $j ?>][deleg_id]"  id="deleg<?php echo $j ?>" class="form-control">
                            </td>
                      
                            <td align="center">
                        
                        
                                 <input    
                                 
                                 <?php 
                                  foreach ($tab[$gv->gouvernorat_id] as $g  => $bb ) {
                                 if (   in_array($b['deleg'], $tab[$gv->gouvernorat_id][$g])     ) { 
                                  ?> checked  <?php } 

                                  }

                                 ?> 
                                 value="1"
                                type="checkbox" index="<?php echo $j ?>" id="checkdelegation<?php echo $j ?>" name="data[Gouvernorat][<?php echo $i ?>][Delegation][<?php echo $j ?>][checkdelegation]" champ="checkdelegation"
                                 >

                                <input   
   
                                 <?php 
                                      
                                      foreach ($tab[$gv->gouvernorat_id] as $g  => $bb ) {
                                 if (   in_array($b['deleg'], $tab[$gv->gouvernorat_id][$g])     ) { ?>    value="<?php echo $bb['ligne']?>"       name="data[Gouvernorat][<?php echo $i ?>][Delegation][<?php echo $j ?>][ligne]"     <?php 
                                } 
                              } 
                              
                                 ?> 

                                type="hidden" index="<?php echo $j ?>" id="ligne<?php echo $j ?>"  champ="ligne"  >
                                
                                </td>


                        
                          </tr>
                      </tbody>

                      <?php } ?>

                    </table>



                  </div>
                </td>
                <td align="center"><i index="<?php echo $i ?>" id="" class="fa fa-times supresponsable66" style="color: #C9302C;font-size: 22px;"></td>
                <?php  ?>

                <?php endforeach; $i++  ?>
            </tr>
              <tr class='tr' style="display:none ;" >
            
                              <td align="center">

                              <input type="hidden" id="sup" champ="sup" name="" table="Gouvernorat" index="" class="form-control">

                            <select table="Gouvernorat"     id="<?php echo 'gouvernorat_id' . $i ?>"  index="<?php echo $i ?>"  champ="gouvernorat_id" class="js-example-responsive  gouvernorat ">
                                <option value="" selected="selected" >Veuillez choisir !!</option>

                                <?php foreach ($gouvernorats as $id => $gouvernorat) {
                                    ?>

                                    <option value="<?php echo $gouvernorat->id; ?>"><?php echo $gouvernorat->name  ?></option>
                                <?php } ?>
                            </select>
                            </td>
                            <td >
                            <div  index="" champ="delegation">
                             </div>
                            </td>
                            <td align="center"><i index="" id="" class="fa fa-times supresponsable66" style="color: #C9302C;font-size: 22px;"></td>
                             

                            </tr>
                           
                           </tbody>
                                        </table>
                                       
                                        <input type="" value="<?php echo $i ?>" id="indexgv" hidden>

                                    </div>
                                </div>
                            </div>
                            
                           
                        </div>
                        
                    </section>

             
            
          </div>
          <div align="center">     
            <button type="submit" class="pull-right btn btn-success "  style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
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

<script>

$(function () {

    $('.gouvernorat').on('change', function () {
       // alert('onchange')
         
         index = $(this).attr('index');
         ind= $('#indexgv').val();
         gouver_id = $('#gouvernorat_id'+ index ).val();
       
   
           $.ajax({
               method: "GET",
               url: "<?= $this->Url->build(['controller' => 'Zonedelegations', 'action' => 'getdeleg']) ?>",
               dataType: "html",
               data: {
                 idGouver: gouver_id,
                 Index : index ,
                 
               
               },
               headers: {
                   'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
               },
               success: function (data) {
               
                 $('#delegation'+index).html(data);
                 
               

             
               }

           })
       });

  
       

    });





</script>




<?php $this->end(); ?>
