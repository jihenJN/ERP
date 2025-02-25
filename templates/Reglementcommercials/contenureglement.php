<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php
echo $this->Html->script('salma');
?>
<section class="content-header">
    <h1 class="box-title"><?php echo __(''); ?></h1>
</section>

<!--<div align="end">
    <table style="position:relative;left:70%"><tr>
            <td style="width:110px"> 
        Tout selectionner  
                </td>
                <td style="width:110px">    
                    <input id ="ts"type="checkbox" style= "position:relative;left:-10%"  class="calculereglementclient afficheinputmontantreglementclient calculereglementkeyup testmontantreglementclientb  testmontantreglementclientl  afficheinputmontantreglementclient2 select-all   ">
                </td>
        
        </tr></table>
        </div>-->
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
                        <td>
                        <b><?php echo ('Tous cocher/decocher'); ?></b>
                        <input type="checkbox" champ="lignelivraison"  table ="reglement" name="" id="reg" index="<?php echo $i; ?>" class="reglement"  >
                        </td>
                        <td  style="width: 5%;" ><strong><?php echo (''); ?></strong></td>

                    </tr>
                </thead>
                <tbody>


                    <?php
                    $i = 0;
                    foreach ($dat as $i => $dat) :
                       
                       
                        ?>


                        <tr>
                            <td>  <?php echo "BL"; ?></td>
                    <input  type="hidden" value="<?php echo "BL" ?>" index="<?php echo $i ?>" table="reglement" name="data[reglement][<?php echo $i ?>][paiement_id]" champ="paiement_id" id="paiement_id<?php echo $i ?>" >
                    <td > <input value="<?php echo $dat['numero'] ?>" type="hidden"   id="num"  > <?php echo $dat['numero'] ?> </td>                                
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
                        <?php echo  sprintf("%.3f",$dat['montantregle']) ?>
                    </td>
                    <td>    <input value="<?php echo $dat['reste'] ?>" type="hidden" index="<?php echo $i ?>" table ="reglement" champ="reste" name="data[reglement][<?php echo $i ?>][reste]" table="reglement" id="reste<?php echo $i ?>" >
                        <?php echo sprintf("%.3f", $dat['reste']) ?>

                    </td>




                    <!--                            <td align="center"> 
                                                    <table> 
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" index="<?php echo $i ?>" id="checkreglement<?php echo $i ?>" name="data[reglement][<?php echo $i ?>][lignebonlivraison_id]" table ="reglement" champ="checkreglement" value="2" class="affichermontantbl">
                                                            </td>
                                                            <td id="s<?php echo $i ?>" style="display:none">
                                                                <input type="" class="form-control calculmontantbl" index="<?php echo $i ?>" id="montantentre<?php echo $i ?>" champ="montantentre" name="data[reglement][<?php echo $i ?>][montantentre]" table="reglement" id="montantentre<?php echo $i ?>" >
                                                            </td>

                                                        </tr>
                                                    </table>     </td>  -->

                    <td style="width:15%;">
                    <div>
                    <table >
                            <tr>
                                <td style="width:1%;">
                                    <input   type="checkbox" champ="lignelivraison"  table ="reglement" name="data[reglement][<?php echo $i; ?>][lignelivraison_id]" id="lignelivraison_id<?php echo $i; ?>" index="<?php echo $i; ?>" class="calculereglementclient  afficheinputmontantreglementclient  testcheckbox " value="<?php echo $dat['id'] ?>" mnt="<?php echo sprintf("%.3f", $dat['reste']); ?>" >
                                </td>
                                <td style="width:99%;" align="left">
                                    <?php
                                    echo $this->Form->input('montantentre', array('style' => 'display:none', 'index' => $i, 'champ' => 'montantentre', 'table' => 'reglement', 'name' => 'data[reglement][' . $i . '][montantentre]', 'id' => 'montantentre' . $i, 'label' => '', 'div' => '', 'between' => '<div class="col-sm-12">', 'after' => '', 'type' => 'text', 'value' =>sprintf("%.3f", $dat['reste']) , 'class' => 'form-control calculereglementkeyup testmontantreglementclientl number'));
                                    ?>
                                    
                                    <input  type="hidden" id="mont<?php echo $i ?>" value="<?php echo $dat['reste'] ?>"    >

                                </td>



                            </tr>
                        </table>
                    </div>
                      
                    </td>

                    </tr>
                    

                    <?php endforeach; ?>
                    </tbody>
               
            <input type="hidden" value="<?php echo $i ?>" id="indexlivraison" >
  
                <tbody>


                    <?php
                    $j = 0;
                    foreach ($data as $j => $data) :
                        //debug($t);
                        ?>


                        <tr>
                            <td><?php echo "Bonus"; ?></td>
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
                                    <input type="checkbox" checked champ="lignebonus" checked table="bonusreglement"name="data[bonusreglement][<?php echo $j; ?>][lignebonus_id]" id="lignebonus_id<?php echo $j; ?>" index="<?php echo $j; ?>" class="calculereglementclient select-all afficheinputmontantreglementclient2" value="<?php echo $data['id'] ?>" mnt="<?php echo sprintf("%.3f", $data['reste']); ?>" >
                                </td>
                                <td style="width:99%;" align="left">
                                    <?php
                                    echo $this->Form->input('montantentrebonus', array('style' => 'display:', 'index' => $j, 'value' => $data['reste'], 'table' => 'bonusreglement', 'champ' => 'montantentrebonus', 'name' => 'data[bonusreglement][' . $j . '][montantentrebonus]', 'id' => 'montantentrebonus' . $j, 'label' => '', 'div' => '', 'between' => '<div class="col-sm-12">', 'after' => '', 'type' => 'text', 'class' => 'form-control calculereglementkeyup testmontantreglementclientb number'));
                                    ?>
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

<script>
     $(function () {
      
        
        
       

        $('.reglement').on('click', function() {
           

            ind = $('#indexlivraison').val();
            sommePayer = 0 ; 
            sommeCommiss = 0 ; 
           
            for (i = 0; i <= ind; i++) {
           
         if  ($('#reg').is(':checked'))     {
            //alert('check')

          $('#lignelivraison_id'+ i).prop('checked', true);

          $('#montantentre' + i).show();

          montantEntree = $('#montantentre' + i ).val(); 
          montantCommiss = $('#mont' + i).val() ;
         // alert(montCommiss) ; 
          sommePayer += Number(montantEntree);
          sommeCommiss += Number(montantCommiss) ; 
          //alert(sommeCommiss) ; 
      

    }

            $('#total').val(Number(sommePayer).toFixed(2));
            $('#ttpayer').val(Number(sommeCommiss).toFixed(2));

    
}

                //// Decocher ////

        if  (!$('#reg').is(':checked'))    {
            for (i = 0; i <= ind; i++) {
          $('#lignelivraison_id'+ i).prop('checked', false);

          $('#montantentre' + i).hide();
    }
                $('#total').val('');
                $('#ttpayer').val('');

}
    
    })


    ////        test checkbox         ///
    $('.testcheckbox').on('click', function() {
       // alert('test') ;
        index = $(this).attr('index');
        ind = $('#indexlivraison').val();
       

        for (i = 0; i <= ind; i++) {

      
    
        }
        if (!$('#lignelivraison_id' + index).is(':checked')) {
            $('#reg').prop('checked', false);
    
            }
    })

  

    });
</script>