<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->css('select2'); ?>


<?php echo $this->fetch('script'); ?>
<section class="content-header">
    <h1>
        Ajout base poste
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
               
                <?php echo $this->Form->create($basepostes, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box-body">

                    <div class="box-body">

                        <div class="row">
                        <div class="col-xs-6    ">
                            <?php echo $this->Form->control('codepostale', ['label' => 'Code postale', 'name', 'required' => 'On']); ?>
                        </div>


                        <div class="col-xs-6">
                        <?php echo $this->Form->control('id_gouv', ['label'=>'Gouvernorats' , 'empty' => 'Veuillez choisir SVP !!', 'options' => $gouvernorats, 'class' => 'form-control select2 control-label ', 'id' => 'gouv']); ?>
                        </div>

                        </div>

                      <div class="row">
                        <div class="col-xs-6" >
                        <?php echo $this->Form->control('id_deleg', ['name' => 'delegation_id', 'empty' => 'Veuillez choisir SVP !!', 'options' => $delegations, 'class' => 'form-control select2 control-label  ', 'label' => 'Delegations']); ?>
                        </div>


                        <div class="col-xs-6">
                            <?php echo $this->Form->control('id_loc', ['name' => 'localite_id', 'id' => 'loc',  'empty' => 'Veuillez choisir !!',  'options' => $localites,'label' => 'Localites', 'class' => 'form-control select2 control-label']); ?>
                        </div>
                     </div>






                    </div>





                </div>
                <div align="center">
                    <button type="submit" class="pull-right btn btn-success " id="btnbaseposte" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
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
                gv_id = $('#gouv').val();

               // alert(deleg_id)
                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Basepostes', 'action' => 'getloc']) ?>",
                    dataType: "json",
                    data: {
                        idDeleg: deleg_id,
                        idGouver: gv_id,

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

<script>
            $(function() {

  $('#btnbaseposte').on('mousemove', function () {

             gouvernorat = $('#gouv').val() ;  
             delegation =$('#id-deleg').val() ;
             localite = $('#loc').val() ; 
             
              
              
              if (gouvernorat == '') {
            alert('choisir une gouvernorat SVP', function () { });
                }
            
              else if (delegation =='') {
            alert('choisir une delegation SVP', function () { });

                }

                else if (localite =='') {
            alert('choisir une localite SVP', function () { });

                }
       

  


               
                
                
        });
        
  });
</script>



<?php $this->end(); ?>