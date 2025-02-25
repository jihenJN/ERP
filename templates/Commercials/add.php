<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ville $ville
 */
?>
<!-- Content Header (Page header) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script> 
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->css('select2'); ?>



<section class="content-header">
    <h1>
   Ajouter commercial
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
        <?php echo $this->Form->create($commercial, ['role' => 'form']); ?>
            <div class="box-body">
            <div class="col-xs-6">
              <?php
                echo $this->Form->control('name' , ['label'=>'Nom']);
              ?>
            </div>
            <div class="col-xs-6">
              <?php
                echo $this->Form->control('login');
              ?>
            </div>
            <div class="col-xs-6">
              <?php
                echo $this->Form->control('mp');
              ?>
            </div>
            <div class="col-xs-6">
              <?php
                echo $this->Form->control('soldedepart',['name'=>'soldedepart' , 'label'=>'Solde depart']);
              ?>
            </div>
            <div class="col-xs-6">
              <?php
                echo $this->Form->control('gouvernorats_id', [  'id'=>'gouv-id' ,   'data-placeholder' => 'Veuillez choisir !!','class'=>'form-control select2' ,'multiple'=>'multiple' ]);
              ?>
            </div>
            <div class="col-xs-6">
              <?php
                echo $this->Form->control('categorie_id', ['empty' => 'Veuillez choisir !!','class'=>'form-control select2' ]);
              ?>
            </div>  
 

 <button type="submit" class="pull-right btn btn-success btn-sm" id="boutoncomm" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

 </div>
          <section class="content">

 
            <div class="box-header with-border">
                  <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_ligne22' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                    <i class="fa fa-plus-circle "></i> Ajouter</a>

                </div>

                <div class="panel-body">
                  <div class="table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless" id="tabligne66">
                      <thead>
                        <tr width:20px">
                          <td align="center" style="width: 4%;"></td>
                          <td align="center" style="width: 4%;"></td>
                          <td align="center" style="width: 17%;"><strong>Gouvernorat</strong></td>
                          <td align="center" style="width: 20%;"> <strong>Clients</strong> </td>
                          <td align="center" style="width: 5%;"> </td>
                       

                        </tr>
                      </thead>
                      <tbody>
                    
                        <tr >
                        <?php $i = -1;
                            foreach ($gouveee as $i => $gv) :
                            ?>
                        <td align="center"><i  index="<?php echo $i ?>"  id="" class="fa fa-eye-slash hideItem  text-blue" style="font-size: 22px;"></td>
                        <td align="center"><i  index="<?php echo $i ?>"  id="" class="fa fa-eye showItem text-blue " style="font-size: 22px;"></td>


                       
                          <td align="center">
                           
                            
                              <select table="Gouvernorat" name="<?php echo "data[Gouvernorat][" . $i . "][gouvernorat_id]" ?>" id="<?php echo 'gouvernorat_id' . $i ?>" index="<?php echo $i ?>" champ="gouvernorat_id" class="js-example-responsive form-control select2 client ">
                                <option value="" selected="selected">Veuillez choisir !!</option>

                                <?php foreach ($gouveee as $a => $gouvernorat) {
                                ?>
                                  <option value="<?php echo $gouvernorat->id; ?>"><?php echo $gouvernorat->name  ?></option>
                                <?php } ?>
                              </select>
                              <?php echo $this->Form->input('sup', array('name' => "data[Gouvernorat][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => '', 'class' => 'form-control', 'type' => 'hidden')); ?>
                          </td>
                          <td>
                            <div index="" id="clients<?php echo $i ?>">
                            </div>
                          </td>
                          <td align="center"><i index="<?php echo $i ?>" id="" class="fa fa-times supresponsable66" style="color: #C9302C;font-size: 22px;"></td>
                        </tr>
                        <tr class='tr' style="display: none ;">
                        <td align="center"><i index="" id="" class="fa fa-eye-slash hideItem text-blue" style="font-size: 22px;"></td>
                        <td align="center"><i index="" id="" class="fa fa-eye showItem text-blue" style="font-size: 22px;"></td>

                          <td align="center">
                          
                            <input type="hidden" id="" champ="sup" name="" table="Gouvernorat" index="" class="form-control">
                            <select table="Gouvernorat" id="<?php echo 'gouvernorat_id' . $i ?>" index="<?php echo $i ?>" champ="gouvernorat_id" class="js-example-responsive  client ">
                              <option value="" selected="selected">Veuillez choisir !!</option>
                              <?php foreach ($gouveee as $id => $gouvernorat) {
                              ?>
                                <option value="<?php echo $gouvernorat->id; ?>"><?php echo $gouvernorat->name  ?></option>
                              <?php } ?>
                            </select>
                          </td>
                          <td>
                            <div index="" champ="clients">
                            </div>
                          </td>
                          <td align="center"><i index="" id="" class="fa fa-times supresponsable66" style="color: #C9302C;font-size: 22px;"></td>
                        </tr>
                      </tbody>
                    </table>
                    <input type="" value="<?php echo $i ?>" id="indexgv" hidden>
                  <?php endforeach;
                            $i++  ?>
                  </div>
                </div>
            
                </section>   




            <table align="center" style="width: 70%;" class="table table-bordered table-striped table-bottomless" >
                            <tr>
                                <th width="50%"> </th>
                                <?php
                                foreach ($mois as $m) : ?>
                                    <th  > <?php echo $m->name  ?> </th>
                                <?php endforeach; ?>
                            </tr>
                            <?php $i = 1;
                            foreach ($articles as $s) : ?>
                                <tr style="height:20px">
                                    <td > <?php echo $s->Code . '  ' . $s->Dsignation ?>
                                    </td>
                                    <?php
                                     // $i = 1;
                                    foreach ($mois as $m) : //debug($m->id) ?>
                                        <td style="width: 25px;">
                                            <input value="<?php echo $m->id  ?>" id="<?php echo "mois" . $i ?>" index="<?php echo $i  ?>" name="<?php echo 'data[objectifrep][' . $i . '][mois]' ?>" style="height:30px;width:50px" type="hidden" class="form-control">
                                            <input value="<?php echo $s->id  ;?>" id="<?php echo "art" . $i ?>" index="<?php echo $i  ?>" name="<?php echo 'data[objectifrep][' . $i . '][article]' ?>" style="height:30px;width:50px" type="hidden" class="form-control">
                                            <input id="<?php echo "objectif" . $i ?>" index="<?php echo $i  ?>" name="<?php echo 'data[objectifrep][' . $i . '][objectif]' ?>" style="height:30px;width:50px" type="text" class="form-control">
                                        </td>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                </tr>
                                <?php $i + 1 ?>
                            <?php endforeach; ?>
                        </table>


          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
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

<script>
            $(function() {

  $('#boutoncomm').on('mousemove', function () {

             index = Number($('#indexgv').val()); 
          //   alert(index) ; 
             
             categorie = $('#categorie-id').val() ;
            
              gouv = $('#gouv-id').val() ;
              gouver = $('#gouvernorat_id' + index).val();
                sup = -1;
              
              
              if (gouv == '') {
            alert('choisir une gouvernorat SVP', function () { });
                }
            
              else if (categorie =='') {
            alert('choisir une categorie SVP', function () { });

                }

      //   else if (gouver == '') {
      //     alert("Veuillez choisir une gouvernorat SVP !!")
      // }

       else if (index == 0 && gouver == ''  ) {
        alert('Veuillez choisir une gouvernorat SVP !!')

    }

    else if (index >= 0) {
      //alert('indexx > 0')
      for (i = 0; i <= index; i++) {

       // g = $('#gouvernorat_id' + i).val();


          supp = $('#sup'+i).val();

          if (supp == 1) {
               //alert("sup");
              sup += 1;
            //  alert(sup);
          }

          if (sup == index  ) {
              alert('Veuillez ajouter une ligne SVP !!')
          }

         
        

      }

  }


               
                
                
        });
        
  });
</script>

<script>
  $(function() {
    $('.client').on('change', function() {
      //alert('onchange') ; 

      index = $(this).attr('index');
      ind = $('#indexgv').val();

      gouver_id = $('#gouvernorat_id' + index).val();

  
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Commercials', 'action' => 'getclients']) ?>",
        dataType: "html",
        data: {
          idGouver: gouver_id,
          Index: index,

        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {

          $('#clients'+ index).html(data);




        }

      })
    });


   

  });
</script>




<script>
    const submitBtn = document.querySelector('button[type="submit"]');

    ///console.log(submitBtn)

    document.querySelector('form').addEventListener('submit', function() {

        submitBtn.disabled = true;
    });
</script>



<?php $this->end(); ?>