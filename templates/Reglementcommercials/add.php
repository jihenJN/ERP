
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->css('select2'); ?>

<section class="content-header">
    <h1>
        Ajout Reglement commercial
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?></a></li>
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
                <?php
                echo $this->Form->create($reglementcommercial, ['role' => 'form', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"]);
                //debug($reglementcommercial);
                ?>
                <div class="box-body">
                    <div class="row">

                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">
                                
                         <?php echo $this->Form->control('numero', ['id' => 'numero', 'readonly','value'=>$b,'class' => ' form-control ']); ?>

                                </div>
                                
                           
                               <div class="col-xs-6">
                                    <?php /*echo $this->Form->control('date', ['id' => 'date','name'=>'date',
                                        'value' =>date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s')))),
                                        'label' => 'Date reglement','type'=>'datetime', 'class' => 'form-control ']) */?> 
                                     <?php echo $this->Form->control('date', ['id' => 'dateimp', 'class' => 'form-control ','name' => 'date','type'=>'datetime-local' ,'label' => 'Date']); ?>


                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">
                                           <?php echo $this->Form->control('commercial_id', ['id' => 'commercial', 'empty' => 'Veuillez choisir !!', 'class' => 'select2 form-control commercial ']); ?>

                                </div>
                              
                        </div>



                    </div> 
                    
                    
                    <div class="row ligne">
                                <div class="col-md-12 m" id="m">
                                </div>
                        
                            </div>
                        
                       <table class="col-xs-12" >
                           <tr>
                <td class="col-xs-4">
                    <?php echo $this->Form->control('paiement_id', ['label' => 'Mode paiement', 'name' => 'paiement_id', 'id' => 'paiement_id', 'empty' => 'Veuillez choisir !!', 'class' => 'select2 form-control jour ']); ?>
               

                    
                    
 <section  id="nbjours" style="display: none " class="content" style="width: 99%">
                        <div class="row">
                           
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless" id="addtable">
                                  <tr>  
                                        <td colspan="8" style="vertical-align: top;">
                                        <table >
                                            <tr class="col-xs-6">
                                               
                                        
                                            <?php
                                            echo $this->Form->input('numero_cheque', array('name' => 'numero_cheque', 'required'=>'off','label' => 'Numero ', 'id' => 'numero_cheque', 'div' => 'form-group',  'after' => '</div>', 'class' => 'form-control ', 'type' => 'number'));
                                            ?>
                                       
                                            </tr>
                           
                       
                              <tr class="col-xs-6">
                                            <?php
                                            echo $this->Form->input('banque_id', array('options'=>$banque,'name' => 'banque_id', 'empty' => 'Veuillez choisir !!', 'label' => 'Banque', 'id' => 'banque', 'div' => 'form-group',   'required'=>'off','class' => 'form-control select2'));
                                            ?>
                             </tr>
                              
                             <tr class="col-xs-6">
                                            <?php
                                            echo $this->Form->input('date_echeance', array('name' => 'date_echeance', 'label' => 'Date echeance', 'id' => 'date_echeance', 'div' => 'form-group','required'=>'off', 'class' => 'form-control ', 'type' =>'date'));
                                            ?>
                                        </tr>
                                                
                                            
                                              
                                           
                                           
                                            </table>
                                            
                                        </td>

                                      
                                        </tr>
                  
                                            </tbody>
                                        </table><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>                    
                 <td class="col-xs-4"> 
                    <?php echo $this->Form->input('montant', array('readonly', 'label' => 'Total comission', 'id' => 'ttpayer', 'champ' => 'montant', 'div' => 'form-group', 'between' => '<div class="col-sm-4" >', 'after' => '</div>', 'class' => 'form-control calculereglementkeyup  calculereglementclient2')); ?>
                </td>
                <td class="col-xs-4"> 
                    <?php echo $this->Form->input('montantpaye', array('readonly', 'name'=>'montantpaye','label' => 'Total a payer ', 'id' => 'total', 'champ' => 'montantpaye', 'div' => 'form-group', 'between' => '<div class="col-sm-4" >', 'after' => '</div>', 'class' => 'form-control ')); ?>
                </td>
                       </tr>
            </table>
                     
                    
                    
                    
                    
                    
                    <div align="center">
                        <button type="submit"    id="alertreglement"   class="pull-right btn btn-success  verifierjour "  style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                    </div>
                    
                     
                    
                    
                    
                    
                </div>   

                <?= $this->Form->end() ?>
            </div> 
        </div> 
    </div> 

    
    
    
    <script type="text/javascript">
        $(function () {
            $('.commercial').on('change', function () {
                id = $('#commercial').val();
               $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Reglementcommercials', 'action' => 'contenureglement']) ?>",
                    dataType: "html",
                    data: {
                        idcomm: id,
                       
                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function (data) {
                        
                       // alert(data);
                             $('#m').html(data);





                    }
                })
            });
        });
    </script>









    <!--    <div class="row">
            <aside class="column">
                <div class="side-nav">
                    <h4 class="heading"><?= __('Actions') ?></h4>
    <?= $this->Html->link(__('List Reglementcommercials'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
                </div>
            </aside>
            <div class="column-responsive column-80">
                <div class="reglementcommercials form content">
    <?= $this->Form->create($reglementcommercial) ?>
                    <fieldset>
                        <legend><?= __('Add Reglementcommercial') ?></legend>
    <?php
    echo $this->Form->control('commercial_id');
    echo $this->Form->control('paiement_id', ['options' => $paiements]);
    echo $this->Form->control('date');
    ?>
                    </fieldset>
    
    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>-->





    <script>
        $(function () {
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
    <?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-d    a        t              epicker.min', ['block' => 'script']); ?>
    <!-- bootstrap color picker -->
    <?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
    <!-- bootstrap time picker -->
    <?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
    <!-- iCheck 1.0.1 -->
    <?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>
    <?php $this->start('scriptBottom'); ?>
    <?php $this->end(); ?>


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
  $(function() {
    $('#alertreglement').on('mouseover', function () {
        commercial = $('#commercial').val();
        paiement = $('#paiement_id').val();
        total = $('#total').val();
        dateimp = $('#dateimp').val();

        if (commercial == '')
        {
            alert("Choisir un commercial SVP");
        }
         else if (dateimp == '')
        {
            alert("Entrer la date SVP");
        } else if (paiement == '')
        {
            alert("Choisir un mode de paiement SVP");
        } else if (total == '')
        {
            alert("Passer au moins un seul reglement SVP");
        }
    });



 })
</script>


<?php $this->end(); ?>






                  