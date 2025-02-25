<?php echo $this->fetch('script'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->css('select2'); ?>

                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->fetch('script'); ?>
<?php
echo $this->Html->script('salma');
?>
<section class="content-header">
    <h1>
        Modification Reglement commercial
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
                         <?php echo $this->Form->control('numero', ['id' => 'numero', 'readonly','class' => ' form-control ']); ?>
                                </div>
                                
                                

                               <div class="col-xs-6">
                                    <?php echo $this->Form->control('date', ['id' => 'date','name'=>'date',
                                       
                                        'label' => 'Date reglement','type'=>'datetime', 'class' => 'form-control ']) ?> 
                                    
                                    
                                    

                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">
                                                                    <?php echo $this->Form->control('commercial_id', ['id' => 'commercial', 'empty' => 'Veuillez choisir !!', 'class' => 'select2 form-control commercial']); ?>

                                </div>
                              
                        </div>



                    </div> 
                     
                    <div class="row ligne">
                                <div class="col-md-12 m" id="m">
                                </div>
                            </div>
                    
                        <div id ="contenu" style="display:true">
<section class="content-header">
    <h1 class="box-title"><?php echo __(''); ?></h1>
</section>


<section class="content" style="width: 100%">


    <div class="panel-body">
        <div class="table-responsive ls-table">
            <table class="table table-bordered table-striped table-bottomless" id="addtable">



                <thead>
                    <tr width:20px>

                        <td  style="width: 9%;"><strong>Type Reglement </strong></td>
                        <td  style="width: 5%;"><strong><?php echo ('Numero'); ?></strong></td>
                        <td  style="width: 10%;" ><strong><?php echo ('Date '); ?></strong></td>
                        <td  style="width: 5%;" ><strong><?php echo ('Montant'); ?></strong></td>
                        <td  style="width: 8%;" ><strong><?php echo ('Montant regle'); ?></strong></td>
                        <td  style="width: 5%;" ><strong><?php echo ('Reste'); ?></strong></td>
                        <td  style="width: 5%;" ><strong><?php echo (''); ?></strong></td>

                    </tr>
                </thead>
                <tbody>


                    <?php
                    $i = 0;
                    foreach ($dat as $i => $dat) : //debug($dat);
                        ?>
                        <tr>
                            <td><?php echo "BL"; ?>
                   
                                 <input value="<?php echo $dat['id'] ?>" type="hidden" index="<?php echo $i ?>" table ="reglement" champ="id" name="data[reglement][<?php echo $i ?>][id]" table="reglement" id="id<?php echo $i ?>" >
                            </td>
                    <input type="hidden" value="<?php echo "BL" ?>" index="<?php echo $i ?>" table="reglement" name="data[reglement][<?php echo $i ?>][paiement_id]" champ="paiement_id" id="paiement_id<?php echo $i ?>" >
                    <td> <?php echo $dat['numero'] ?> </td>                                
                    <td> <?php echo $this->Time->format($dat['date'], 'd/MM/y') ?></td>
                    <td>  
                        <input type="hidden" value ="<?php echo 
                        
                        $dat['montat'] ?>" index="<?php echo $i ?>" champ="montat" table="reglement" name="data[reglement][<?php echo $i ?>][montat]" id="montat<?php echo $i ?>" >
                        <?php
                       echo sprintf("%.3f", $dat['montat'])
                        
                        
                         ?>

                    </td>
                    <td>  
                        <input value ="<?php echo sprintf("%.3f", $dat['montantregle'] )?>" type="hidden" index="<?php echo $i ?>" champ="montantregle" name="data[reglement][<?php echo $i ?>][montantregle]" table="reglement" id="montantregle<?php echo $i ?>" >
                        <?php  echo sprintf("%.3f", $dat['montantregle'] ) ?>
                    </td>
                    
                    
                    
                    
                    
                    <td>    <input value="<?php echo $dat['reste'] ?>" type="hidden" index="<?php echo $i ?>" table ="reglement" champ="reste" name="data[reglement][<?php echo $i ?>][reste]" table="reglement" id="reste<?php echo $i ?>" >
                        <?php echo sprintf("%.3f", $dat['reste']) ?>

                    </td>




                    <td style="width:15%;">
                        <table >
                            <tr>
                                <td style="width:1%;">
                                    <input type="checkbox" champ="lignelivraison" table ="reglement" name="data[reglement][<?php echo $i; ?>][lignelivraison_id]" id="lignelivraison_id<?php echo $i; ?>" index="<?php echo $i; ?>" class="calculereglementkeyup calculereglementclient afficheinputmontantreglementclient" value="<?php echo $dat['id'] ?>" mnt="<?php echo sprintf("%.3f", $dat['reste']); ?>"      <?php if ($dat['montantentre'] !=0) { ?> checked="checked" <?php } ?>>
                                </td>
                                

                                
                                
                                
                                
                                
                                <?php   //debug($dat['montantentre']); 
                                if (
                                        isset($dat['montantentre'] ) && (!empty($dat['montantentre']))
                                       ) 
                                
                                    ?>                                  
                                <td style="width:99%;" align="left">
                                    <input
                                  
                                            <?php if ($dat['montantentre'] !=0) { ?> style='display:true' <?php } ?>
                                            <?php  if ($dat['montantentre'] ==0) { ?> style='display:none' <?php } ?>
                                            class ="form-control calculereglementkeyup calculereglementclient testmontantreglementclientl  number"
                                       table ="reglement" name ="data[reglement][<?php echo $i; ?>][montantentre]" id="montantentre<?php echo $i;?>"  type ="text" value ="<?php echo $dat['montantentre'] ;?>"       index = "<?php echo $i ;?>"  >
                                  
                                </td>
                              
                                 
                            </tr>
                            
                            
                            
                            
                             
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                        </table>
                    </td>

                    </tr>

                    <?php endforeach; ?>
                    </tbody>
               
            <input type="hidden" value="<?php echo $i ?>" id="indexlivraison" >
  
                <tbody>
<?php// debug($data); ?>

                    <?php
                    $j = 0;
                    foreach ($data as $j => $data) ://debug($data);die;
                        ?>


                        <tr>
                            <td>
                                 <input value="<?php echo $data['id'] ?>" type="hidden" index="<?php echo $i ?>" table ="bonusreglement" champ="id" name="data[bonusreglement][<?php echo $i ?>][id]" table="bonusreglement" id="id<?php echo $i ?>" >
                      <?php echo "Bonus"; ?></td>
                    <input type="hidden" value ="<?php echo "Bonus" ?>" index="<?php echo $j ?>" champ="bonus" name="data[bonusreglement][<?php echo $j ?>][bonus]" table="bonusreglement" id="bonus<?php echo $j ?>" >
                    <td> <?php  echo $data['numero']  ?> </td>                        
                    <td><?php echo $this->Time->format($data['dateoperation'], 'd/MM/y') ?></td>
    <!--                            <td><?php echo "" ?></td>-->
                    <td><?php echo sprintf("%.3f", $data['montat']) ?>
                        <input type="hidden" value ="<?php echo $data['montat'] ?>" index="<?php echo $j ?>" champ="montant" name="data[bonusreglement][<?php echo $j ?>][montant]" table="bonusreglement" id="montant<?php echo $j ?>" >

                    </td>
                    <td><?php echo sprintf("%.3f",$data['montantregle']) ?>
                        <input value ="<?php echo $data['montantregle'] ?>" type="hidden" index="<?php echo $j ?>" champ="montantregleb" name="data[bonusreglement][<?php echo $j ?>][montantregleb]" table="bonusreglement" id="montantregleb<?php echo $j ?>" >
                    </td>
                    <td><?php echo sprintf("%.3f", $data['reste']) ?>
                        <input value="<?php echo $data['reste'] ?>" type="hidden" index="<?php echo $j ?>" champ="resteb" name="data[bonusreglement][<?php echo $j ?>][resteb]" table="bonusreglement" id="resteb<?php echo $j ?>" >

                    </td>





                    <td style="width:15%;">
                        <table >
                                          <tr>
                                <td style="width:1%;">
                                    <input type="checkbox" champ="lignebonus" table ="bonusreglement" name="data[bonusreglement][<?php echo $j; ?>][lignebonus_id]" id="lignebonus_id<?php echo $j; ?>" index="<?php echo $j; ?>" class="calculereglementkeyup calculereglementclient afficheinputmontantreglementclient2"    value="<?php echo $data['id'] ?>" mnt="<?php echo sprintf("%.3f", $data['reste']); ?>"     <?php if ($data['montantentrebonus'] !=0) { ?> checked="checked" <?php } ?>>
                                </td>
                                

                                
                                
                                
                                
                                
                                <?php //debug($dat['montantentre']); 
                                if (
                                        isset($data['montantentrebonus'] ) && (!empty($data['montantentrebonus']))
                                       ) 
                                    ?>                                  
                                <td style="width:99%;" align="left">
                                    <input
                                  
                                            <?php if ($data['montantentrebonus'] !=0) { ?> style='display:true' <?php } ?>
                                            <?php  if ($data['montantentrebonus'] ==0) { ?> style='display:none' <?php } ?>
                                            class ="form-control calculereglementkeyup calculereglementclient testmontantreglementclientl  number"
                                       table ="bonusreglement" name ="data[bonusreglement][<?php echo $j;?>][montantentrebonus]" id="montantentrebonus<?php echo $j;?>"  type ="text" value ="<?php echo $data['montantentrebonus'] ;?>"       index ="<?php echo $j ;?>"  >
                                  
                                </td>
                              
                                 
                         
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                           
                               
                                                       
                                
                                
                            </tr>
                        </table>
                    </td>


                    <!--                            <td align="center"> 
                                                    <table> 
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" index="<?php echo $j ?>" id="check<?php echo $j ?>" name="data[reglement][<?php echo $j ?>][check]" table ="reglement" champ="check" value="2" class="affichermontantbonus">
                                                            </td>
                                                            <td id="a<?php echo $j ?>" style="display:none">
                                                                <input class="form-control" type="" index="<?php echo $j ?>" id="monentreb<?php echo $j ?>" champ="monentre" name="data[reglement][<?php echo $j ?>][monentre]" table="reglement" id="monentre<?php echo $j ?>" >

                                                            </td>

                                                        </tr>
                                                    </table>   </td>   -->
                    </tr>
<?php endforeach; ?>
                    </tbody>
                
 <input type="hidden" value="<?php echo $j ?>" id="indexbonus" >
            </table>



    
        </div>
    </div>



</section>



                        </div>

<!--<section class="content" style="width: 100%">


    <div class="panel-body">
        <div class="table-responsive ls-table">
            <table class="table table-bordered table-striped table-bottomless" id="addtable">



           
            </table> 
           
           






            <br>
        </div>
    </div>




</section>-->














<!--
<div class="panel-body">
    <table class="table table-bordered table-striped table-bottomless" style="width:90%" align="center">

        <thead>
            <tr>
                <td width="10%" >Date livraison</td>
                <td width="10%" align="center">Numero livraison</td>
                <td width="20%" align="center">Client</td>
                <td width="10%" align="center">Total livraison</td>
               <td width="10%" align="center">Montant a reglé</td>
               <td width="10%" align="center">Reste</td>
            </tr>
        </thead>
        <tbody>

<?php
//debug($clients);die;

foreach ($liv as $i => $liv) :
    ?>
                                                                                                        <tr>
                                                                                                            <td> <?php echo $liv->date ?> </td>
                                                                                                             <td> <?php echo $liv->numero ?> </td>
                                                                                                                <td> <?php echo $liv->client_id ?> </td>
                                                                                                                   <td> <?php echo $liv->totalttc ?> </td>
                                                                                                                   <td> <?php ?> </td>
                                                                                                                   
                                                                                                        </tr>
<?php endforeach; ?>
        
                </tbody>


      
    </table>
    <input type="hidden" id="index" value="<?php ?>" />


</div>-->

                       <table class="col-xs-12" >
                           <tr>
                <td class="col-xs-4">
                    <?php echo $this->Form->control('paiement_id', ['label' => 'Mode paiement', 'name' => 'paiement_id', 'id' => 'paiement_id', 'empty' => 'Veuillez choisir !!', 'class' => 'select2 jour form-control ']); ?>
              
                   <?php {
                      if ($reglementcommercial->paiement_id == 3) {?>
                 <section  id="nbjours" style="display:  " class="content" style="width: 99%">
                        <div class="row">
                           
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless" id="addtable">
                                            
                                            
             <tr  >  
                 
                                        <td colspan="8" style="vertical-align: top;">
                                     
                                            <table >
                                            <tr class="col-xs-6">
                                               
                                        
                                            <?php
                                            echo $this->Form->input('numero_cheque', array('name' => 'numero_cheque', 'label' => 'Numero chéque', 'id' => 'numero_cheque', 'div' => 'form-group',  'after' => '</div>', 'class' => 'form-control ', 'type' => 'number'));
                                            ?>
                                       
                                            </tr>
                           
                       
                              <tr class="col-xs-6">
                                            <?php
                                            echo $this->Form->input('banque_id', array('options'=>$banque,'name' => 'banque_id',  'empty' => 'Veuillez choisir !!','label' => 'Banque', 'id' => 'banque', 'div' => 'form-group',   'class' => 'form-control select2'));
                                            ?>
                             </tr>
                              
                             <tr class="col-xs-6">
                                            <?php
                                            echo $this->Form->input('date_echeance', array('name' => 'date_echeance', 'label' => 'Date echeance', 'id' => 'date_echeance', 'div' => 'form-group', 'class' => 'form-control ', 'type' =>'date'));
                                            ?>
                                        </tr>
                                                
                                            
                                              
                                           
                                           
                                            </table>
                                            
                                        </td>

                                      
                                        </tr>
                  
                                            </tbody>
                                        </table>
                                        
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </section>
                    
                      <?php }
                   }
                      ?>
                    
                    
                       <?php {
                      if ($reglementcommercial->paiement_id == 2) {?>
                 <section  id="nbjours" style="display:  " class="content" style="width: 99%">
                        <div class="row">
                           
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless" id="addtable">
                                            
                                            
             <tr  >  
                 
                                        <td colspan="8" style="vertical-align: top;">
                                     
                                            <table >
                                            <tr class="col-xs-6">
                                               
                                        
                                            <?php
                                            echo $this->Form->input('numero_cheque', array('name' => 'numero_cheque', 'label' => 'Numero chéque', 'id' => 'numero_cheque', 'div' => 'form-group',  'after' => '</div>', 'class' => 'form-control ', 'type' => 'number'));
                                            ?>
                                       
                                            </tr>
                           
                       
                              <tr class="col-xs-6">
                                            <?php
                                            echo $this->Form->input('banque_id', array('options'=>$banque,'name' => 'banque_id',  'empty' => 'Veuillez choisir !!','label' => 'Banque', 'id' => 'banque', 'div' => 'form-group',   'class' => 'form-control select2'));
                                            ?>
                             </tr>
                              
                             <tr class="col-xs-6">
                                            <?php
                                            echo $this->Form->input('date_echeance', array('name' => 'date_echeance', 'label' => 'Date echeance', 'id' => 'date_echeance', 'div' => 'form-group', 'class' => 'form-control ', 'type' =>'date'));
                                            ?>
                                        </tr>
                                                
                                            
                                              
                                           
                                           
                                            </table>
                                            
                                        </td>

                                      
                                        </tr>
                  
                                            </tbody>
                                        </table>
                                        
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </section>
                    
                      <?php }
                   }
                      ?>
                    
                    
                    
                    
                    
                </td>
                
                 <td class="col-xs-4"> 
                    <?php echo $this->Form->input('montant', array('readonly', 'label' => 'Total reglement', 'id' => 'ttpayer', 'champ' => 'montant', 'div' => 'form-group', 'between' => '<div class="col-sm-4" >', 'after' => '</div>', 'class' => 'form-control calculereglementkeyup')); ?>
                </td>
                <td class="col-xs-4"> 
                    <?php echo $this->Form->input('montantpaye', array('readonly', 'name'=>'montantpaye','label' => 'Total a payer ', 'id' => 'total', 'champ' => 'montantpaye', 'div' => 'form-group', 'between' => '<div class="col-sm-4" >', 'after' => '</div>', 'class' => 'form-control ')); ?>
                </td>
                       </tr>
            </table>
                     
                    
                    
                    
                    
                    
                    <div align="center">
                        <button type="submit" class="pull-right btn btn-success  addreglementcom"  style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
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
                        //alert(data);
                             $('#m').html(data);
                             $('#contenu').attr('style', "display:none;");
                             $('#ttpayer').val('');
                             $('#total').val('');  
                             $('#paiement_id').val(''); //alert($('#paiement_id').val());
        


    //                    $('#adresses').val(response.name + ' ' + response.query);
    //                     $('#adress').val(response.name + ' ' + response.query);
    //                    
    //                    
    //                    
    //                    
    //                    $('#code').val(response.queryyy);
    //                    $('#delegation').html(response.select);


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