
<script language="JavaScript" type="text/JavaScript">
function flvFPW1(){
var v1=arguments,v2=v1[2].split(","),v3=(v1.length>3)?v1[3]:false,v4=(v1.length>4)?parseInt(v1[4]):0,v5=(v1.length>5)?parseInt(v1[5]):0,v6,v7=0,v8,v9,v10,v11,v12,v13,v14,v15,v16;v11=new Array("width,left,"+v4,"height,top,"+v5);for (i=0;i<v11.length;i++){v12=v11[i].split(",");l_iTarget=parseInt(v12[2]);if (l_iTarget>1||v1[2].indexOf("%")>-1){v13=eval("screen."+v12[0]);for (v6=0;v6<v2.length;v6++){v10=v2[v6].split("=");if (v10[0]==v12[0]){v14=parseInt(v10[1]);if (v10[1].indexOf("%")>-1){v14=(v14/100)*v13;v2[v6]=v12[0]+"="+v14;}}if (v10[0]==v12[1]){v16=parseInt(v10[1]);v15=v6;}}if (l_iTarget==2){v7=(v13-v14)/2;v15=v2.length;}else if (l_iTarget==3){v7=v13-v14-v16;}v2[v15]=v12[1]+"="+v7;}}v8=v2.join(",");v9=window.open(v1[0],v1[1],v8);if (v3){v9.focus();}document.MM_returnValue=false;return v9;
}
</script>

<br><input type="hidden" id="page" value="soldeclient"/>
<div class="row">
<div class="col-md-12" >
                            <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo __('Recherche'); ?></h3>
                                    <ul class="panel-control" style="top: 83px">
                    <li><a class="minus" href="javascript:void(0)"><i class="fa fa-square-o"></i></a></li>
<!--                    <li><a class="refresh" href="javascript:void(0)"><i class="fa fa-refresh"></i></a></li>
                    <li><a class="close-panel" href="javascript:void(0)"><i class="fa fa-times"></i></a></li>-->
                </ul>
                                </div>
                                <div class="panel-body">
        <?php echo $this->Form->create('Recherche',array('autocomplete' => 'off','class'=>'form-horizontal ls_form','id'=>'defaultForm','data-bv-message'=>'This value is not valid','data-bv-feedbackicons-valid'=>'fa fa-check','data-bv-feedbackicons-invalid'=>'fa fa-bug','data-bv-feedbackicons-validating'=>'fa fa-refresh')); ?>

            <div class="col-md-6">                  
              	<?php 
		
		echo $this->Form->input('date1',array('label'=>'Date d&eacute;but','div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control datePickerOnly','required data-bv-notempty-message'=>'Champ Obligatoire','type'=>'text') );
                echo $this->Form->input('client_id',array('id'=>'client_id','div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control','required data-bv-notempty-message'=>'Champ Obligatoire','empty'=>'Veuillez choisir..') );			
	?></div>
  <div class="col-md-6"> 
       	<?php 

        echo $this->Form->input('date2',array('label'=>'Date fin','div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control datePickerOnly','required data-bv-notempty-message'=>'Champ Obligatoire','type'=>'text') );
        echo $this->Form->input('detail_id',array('id'=>'type_id','div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control','required data-bv-notempty-message'=>'Champ Obligatoire','empty'=>'Veuillez choisir..') );			

        // echo $this->Form->input('personnel_id',array('id'=>'personnel_id','label'=>'Personnel','div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control','required data-bv-notempty-message'=>'Champ Obligatoire','empty'=>'Veuillez choisir..') );
        //echo $this->Form->input('exercice_id',array('value'=>@$exerciceid,'empty'=>'veuillez choisir','div'=>'form-group','label'=>'ann�e','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
?>
  </div>   

                <div class="form-group">
                                            <div class="col-lg-9 col-lg-offset-3" >
                                                <button  id="breleve" type="submit" class="btn btn-primary testhistoriquearticle" >Afficher</button> 
       <a  onClick="flvFPW1(wr+'Releves/imprimerrecherche?date1=<?php echo @$date1;?>&date2=<?php echo @$date2;?>&name=<?php echo @$name;?>&soldeint=<?php echo @$soldeint;?>','UPLOAD','width=800,height=1150,scrollbars=yes',0,2,2);return document.MM_returnValue" href="javascript:;" ><button class="btn btn-primary">Imprimer</button> </a>
                                            </div>
                                        </div>
 
<?php echo $this->Form->end();?>

</div>
                            </div>
                        </div>

<?php 

?>
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo __('Etat de solde client'); ?></h3>
                                </div>
                                <div class="panel-body">
                                    <div >
                                     <table border="1" style="border:2px solid black;width:100%">
                      <thead>

<tr><td colspan="5" style="height: 10px;" ></td></tr>                          
<?php if(!empty($date1)||!empty($date2)){  ?>                     
<tr>
    <td style="background-color: #F2D7D5;" align="center"><strong> P&eacute;riode </strong></td>    <td colspan="2" bgcolor="#F2D7D5" align="center"><strong><?php  echo date("d/m/Y", strtotime(str_replace('-', '/',@$date1))); ?></strong></td><td align="center" colspan="2" bgcolor="#F2D7D5" ><strong><?php  echo date("d/m/Y", strtotime(str_replace('-', '/',@$date2))); ?></strong></td>
</tr>
<tr><td colspan="5" style="height: 10px;" ></td></tr>
<!--**************************************************************************************************************-->    
<?php } ?>
<?php if(!empty($name)){  ?>                     
<tr>
    <td style="background-color: #F2D7D5;" align="center"><strong> Agent </strong></td>    <td colspan="4" bgcolor="#F2D7D5" ><strong><?php  echo @$name; ?></strong></td>
</tr><strong>
<tr><td colspan="5" style="height: 10px;" ></td></tr>
<!--**************************************************************************************************************-->    
<?php } ?>
                <tr style="border:1px solid black;" class="tdreleveclient">
	         
                <th style="border:1px solid black;width: 97px;" bgcolor="#F2D7D5" ><strong><center>Date</center></strong></th>
<!--                <th style="border:1px solid black;width: 138px;" bgcolor="#F2D7D5"><strong><center>N� Piece</center></strong></th>-->
                <th style="border:1px solid black;width: 642px;" bgcolor="#F2D7D5" ><strong><center>Libell&eacute; Piece</center></strong></th>
                <th style="border:1px solid black;width: 118px;" bgcolor="#F2D7D5" ><strong><center>D&eacute;dit</center></strong></th>
                <th style="border:1px solid black;width: 106px;" bgcolor="#F2D7D5" ><strong><center>Cr&eacute;dit</center></strong></th>
<!--            <th style="border:1px solid black;width: 105px;" bgcolor="#F2D7D5" ><strong><center>Impay�</center></strong></th>
                <th style="border:1px solid black;width: 105px;" bgcolor="#F2D7D5" ><strong><center>R�glement</center></strong></th>
                <th style="border:1px solid black;width: 96px;" bgcolor="#F2D7D5" ><strong><center>Avoir</center></strong></th>-->
                <th style="border:1px solid black;width: 117px;" bgcolor="#F2D7D5" ><strong><center>Solde</center></strong></th>
                </tr><tr><td colspan="9" style="height: 10px;" ></td></tr> </thead><tbody>

    



	<?php //debug($lignecommandes);
        
        $totdebit=0;
        $totcredit=0;
        $totimpayer=0;
        $totreg=0; 
        $totavoir=0;
        $totsolde=0;
        $totdebitt=0;
        $totcreditt=0;
        $totimpayert=0;
        $totregt=0; 
        $totavoirt=0;
        $totsoldet=0;
        $clt_id=0;
        if(!empty($soldeint)){
            $sld=$soldeint;

        }else{
            $sld="";
        }
        foreach ($relefes as $i=>$relefe){ 
        $totdebitt=$totdebitt+@$relefe['Relefe']['debit'];
        $totcreditt=$totcreditt+@$relefe['Relefe']['credit'];
        $totimpayert=$totimpayert+@$relefe['Relefe']['impaye'];
        $totregt=$totregt+@$relefe['Relefe']['reglement'];
        $totavoirt=$totavoirt+@$relefe['Relefe']['avoir'];
        $totsoldet=$totsoldet+@$relefe['Relefe']['solde'];
        
        
        if($relefe['Relefe']['debit']!=null) {
           // debug("debit");die;
         $sld=$sld+$relefe['Relefe']['debit'];
        }   else{
            // debug("credit");die;
             $sld=$sld-$relefe['Relefe']['credit'];
        } 
        ?>




<?php if ($relefe['Client']['id']!=$clt_id){ ?>
<?php if($i!=0){ 
         ?>
<tr><td colspan="5" style="height: 10px;" ></td></tr>
<tr>
    <td colspan="2" style="background-color: #F2D7D5;" align="center"><strong> Total  </strong></td>    
    <td  align="right"><strong><?php  echo number_format(@$totdebit,3, '.', ' '); ?></strong></td>
    <td  align="right"><strong><?php  echo number_format(@$totcredit,3, '.', ' '); ?></strong></td>
<!--    <td  align="right"><strong><?php  echo number_format(@$totimpayer,3, '.', ' '); ?></strong></td>
    <td  align="right"><strong><?php  echo number_format(@$totreg,3, '.', ' '); ?></strong></td>
    <td  align="right"><strong><?php  echo number_format(@$totavoir,3, '.', ' '); ?></strong></td>-->
    <td  align="right"><strong><?php  echo number_format(@$totsolde,3, '.', ' '); ?></strong></td>
</tr>
<tr><td colspan="5" style="height: 10px;" ></td></tr>
<?php   $totdebit=0;
        $totcredit=0;
        $totimpayer=0;
        $totreg=0; 
        $totavoir=0;
        $totsolde=0;
}?> 
<tr>
    <td style="background-color: #F2D7D5;" align="center"><strong> Client </strong></td>    <td colspan="4"  ><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo @$relefe['Client']['code']."  ".@$relefe['Client']['name']; ?></strong></td>
</tr>
<tr>
    <td style="background-color: #F2D7D5;" align="center" colspan="2"><strong> Solde d&eacute;part </strong></td>
    <td   align="right"><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php if(!empty($soldeint)) {if($soldeint>=0) {echo number_format(@$soldeint,3, '.', ' ');} else {echo " ";} }?></strong></td>
     <td   align="right"><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php if(!empty($soldeint)) { if($soldeint<0) {echo number_format(@$soldeint*(-1),3, '.', ' ');} else {echo " ";}} ?></strong></td>
<!--     <td colspan="2"></td>-->
      <td   align="right"><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php if(!empty($soldeint)) { if($soldeint<0) {echo number_format(@$soldeint*(-1),3, '.', ' ');} else {echo number_format(@$soldeint,3, '.', ' ');} }?></strong></td>
</tr>
<?php } 
$clt_id=$relefe['Client']['id'];
?>


	<tr>
		<td align="center" style="width: 97px;"><?php echo date("d/m/Y",strtotime(str_replace('/','-',@$relefe['Relefe']['date'])))  ;?></td>
<!--		<td align="center" style="width: 138px;"><?php echo @$relefe['Relefe']['numero'] ;?></td>-->
                <td align="left" style="width: 642px;"><?php echo  @$relefe['Relefe']['type'] ;?></td>
                <td align="right" style="width: 118px;"><?php echo number_format(@$relefe['Relefe']['debit'],3, '.', ' ') ;?></td>
                <td align="right" style="width: 106px;"><?php echo number_format(@$relefe['Relefe']['credit'],3, '.', ' ') ;?></td>
<!--                <td align="right" style="width: 105px;"><?php echo number_format(@$relefe['Relefe']['impaye'],3, '.', ' ') ;?></td>
                <td align="right" style="width: 105px;"><?php echo number_format(@$relefe['Relefe']['reglement'],3, '.', ' ');?></td>
                <td align="right" style="width: 96px;"><?php echo number_format(@$relefe['Relefe']['avoir'],3, '.', ' ') ;?></td>-->
                <td align="right" style="width: 117px;"><?php echo number_format(@$sld,3, '.', ' ') ;?></td>
	</tr>
        <?php 
        $totdebit=$totdebit+@$relefe['Relefe']['debit'];
        $totcredit=$totcredit+@$relefe['Relefe']['credit'];
        $totimpayer=$totimpayer+@$relefe['Relefe']['impaye'];
        $totreg=$totreg+@$relefe['Relefe']['reglement'];
        $totavoir=$totavoir+@$relefe['Relefe']['avoir'];
        $totsolde=$totsolde+@$relefe['Relefe']['solde'];
        ?>
<?php } ?>
<tr><td colspan="5" style="height: 10px;" ></td></tr>
<tr>
    <td colspan="2" style="background-color: #F2D7D5;" align="center"><strong> Total  </strong></td>    
    <td  align="right"><strong><?php  echo number_format(@$totdebit,3, '.', ' '); ?></strong></td>
    <td  align="right"><strong><?php  echo number_format(@$totcredit,3, '.', ' '); ?></strong></td>
<!--    <td  align="right"><strong><?php  echo number_format(@$totimpayer,3, '.', ' '); ?></strong></td>
    <td  align="right"><strong><?php  echo number_format(@$totreg,3, '.', ' '); ?></strong></td>
    <td  align="right"><strong><?php  echo number_format(@$totavoir,3, '.', ' '); ?></strong></td>-->
    <td  align="right"><strong><?php  //echo number_format(@$sld,3, '.', ' '); ?></strong></td>
</tr>
<tr><td colspan="5" style="height: 10px;" ></td></tr>
<?php  if(!empty($soldeint)){if($soldeint>=0) { $totdebitt=@$totdebitt+@$soldeint;} else {  @$totcreditt=@$totcreditt+(@$soldeint*(-1));}} ?>
<tr>
    <td colspan="2" style="background-color: #F2D7D5;" align="center"><strong> Total G&eacute;n&eacute;ral </strong></td>    
    <td  align="right"><strong><?php  echo number_format(@$totdebitt,3, '.', ' '); ?></strong></td>
    <td  align="right"><strong><?php  echo number_format(@$totcreditt,3, '.', ' '); ?></strong></td>
<!--    <td  align="right"><strong><?php  echo number_format(@$totimpayert,3, '.', ' '); ?></strong></td>
    <td  align="right"><strong><?php  echo number_format(@$totregt,3, '.', ' '); ?></strong></td>
    <td  align="right"><strong><?php  echo number_format(@$totavoirt,3, '.', ' '); ?></strong></td>-->
    <td  align="right"><strong><?php  echo number_format(@$sld,3, '.', ' '); ?></strong></td>
</tr>
                          </tbody>
	</table>
                                        
                                        
	
                                </div></div></div></div></div>	


<script type="text/javascript">
//    $(document).on("scroll",function(){
//        if($(document).scrollTop()>300){ 
//            $(".tdreleveclient").addClass("displays");
//   //$(".contact-client").addClass("display");
//   
//            }
//        else{
//            $(".tdreleveclient").removeClass("displays");
//            //$(".contact-client").removeClass("display");
//            }
//        });
    
</script>

