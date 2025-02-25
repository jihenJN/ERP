<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
  <h1>
  Modification base poste 
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
      <div class="box ">
        <?php echo $this->Form->create($baseposte, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">

        <div class="row">
        <div class="col-xs-6">
            
            <?php
            echo $this->Form->control('codepostale');
            ?>
          </div>
          <div class="col-xs-6">
          <?php echo $this->Form->control('id_gouv', ['label'=>'Gouvernorat' , 'empty' => 'Veuillez choisir SVP !!', 'options' => $gouvernorats, 'class' => 'form-control select2 control-label   ', 'id' => 'gouv']); ?>
             </div>
        </div>
         
        <div class="row">
          <div class="col-xs-6">
          <?php echo $this->Form->control('id_deleg', ['label'=>'Delegation' , 'empty' => 'Veuillez choisir SVP !!', 'options' => $delegations, 'class' => 'form-control select2 control-label  ']); ?>
          </div>

          <div class="col-xs-6">
          <?php echo $this->Form->control('id_loc', ['label'=>'Localite' , 'empty' => 'Veuillez choisir SVP !!', 'options' => $localites, 'class' => 'form-control select2 control-label Gouvernorat ']); ?>
          </div>
          </div>

          

          <button type="submit" class="pull-right btn btn-success btn-sm " style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
</section>

<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function () {
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
        $(function () {

            $('.Gouvernorat').on('change', function () {
                //alert('onchange')

                gv_id = $('#gouv').val();
                //alert(id) ; 

                $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Basepostes', 'action' => 'getdelegation']) ?>",
                dataType: "json",
                data: {
                    idGouver: gv_id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {

                    $('#deleg-id').html(data.select);
                    $('#localite-id').html(data.select1);



                }

            })


            });






        });

        
        function getlocalites(param) {

                //alert('hecheeeeeeeeeeem');
                deleg_id = $('#deleg').val();
               // alert(deleg_id)
                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Basepostes', 'action' => 'getloc']) ?>",
                    dataType: "json",
                    data: {
                        idDeleg: deleg_id,

                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function (data) {
                        //alert(data.select);
                        $('#localite-id').html(data.select);



                        

                    }

                });



                }



</script>


<?php $this->end(); ?>