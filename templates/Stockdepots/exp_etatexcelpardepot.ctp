<script language="JavaScript" type="text/JavaScript">

    function flvFPW1(){

        var v1=arguments,v2=v1[2].split(","),v3=(v1.length>3)?v1[3]:false,v4=(v1.length>4)?parseInt(v1[4]):0,v5=(v1.length>5)?parseInt(v1[5]):0,v6,v7=0,v8,v9,v10,v11,v12,v13,v14,v15,v16;v11=new Array("width,left,"+v4,"height,top,"+v5);for (i=0;i<v11.length;i++){v12=v11[i].split(",");l_iTarget=parseInt(v12[2]);if (l_iTarget>1||v1[2].indexOf("%")>-1){v13=eval("screen."+v12[0]);for (v6=0;v6<v2.length;v6++){v10=v2[v6].split("=");if (v10[0]==v12[0]){v14=parseInt(v10[1]);if (v10[1].indexOf("%")>-1){v14=(v14/100)*v13;v2[v6]=v12[0]+"="+v14;}}if (v10[0]==v12[1]){v16=parseInt(v10[1]);v15=v6;}}if (l_iTarget==2){v7=(v13-v14)/2;v15=v2.length;}else if (l_iTarget==3){v7=v13-v14-v16;}v2[v15]=v12[1]+"="+v7;}}v8=v2.join(",");v9=window.open(v1[0],v1[1],v8);if (v3){v9.focus();}document.MM_returnValue=false;return v9;

    } 
</script>



<?php 


$ModelSociete = ClassRegistry::init('Societe');
$soc = $ModelSociete->find('first');


$ModelSocietedep = ClassRegistry::init('Depot');
$dep = $ModelSocietedep->find('first',array('conditions'=>array('Depot.id'=>$depotid)));
?>

<head>

</head>



<table align="center" border="1" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" width="100%" >

    <tr bgcolor="#BB010C"  style="color:#FFFFFF; font-family:Arial; font-size:12px;" >
        <th>Article</th>
        <?php foreach ($depotalls as $depot){ ?>
        <th><?php echo $depot['Depot']['name'] ; ?></th>
        <?php }?>
        <th>Qte ToT</th>

    </tr>
    <?php
    $total=0;
        foreach ($articless as $stockdepot){
            $articleanss=ClassRegistry::init('Article')->find('first', array('recursive'=>-1,'conditions' => array('Article.id' =>$stockdepot['Article']['id'])));

        $total=0;
            ?>
	<tr>

		<td >
			<?php echo $stockdepot['Article']['codeabarre']." ".$stockdepot['Article']['designiation']; ?>
		</td>
                <?php foreach ($depotalls as $d=>$depot){
					$datef=date('Y-m-d H:i:s');
					$st=ClassRegistry::init('Stockdepot')->query("select stockbassem(".$stockdepot['Article']['id'].",'".$datef."','0',".$depot['Depot']['id'].") as v"); //debug($st[0][0]['v']);die;*/*/*/*/*/
					//	debug($st[0][0]); die;
					if(!empty($st)){
						$qtestock= $st[0][0]['v'];//$this->qtestock($depotid,$articleid);
						//	echo $st[0][0]['v'];
						$total=$total+$st[0][0]['v'];
					}else{
						$qtestock=0;
					}
					?>
					<td align="center"><?php
						echo $qtestock;
						?></td>
				<?php }?>
		<td align="center">
			<?php
			echo $total;
			?></td>

	</tr>
<?php } ?>
                          </tbody>

	</table>


	<?php
App::import('Vendor', 'PHPExcel', array('file' => 'PHPExcel.php'));
header("Content-type: application/vnd.ms-excel");
 
header("Content-Disposition: attachment; filename=etatstock.xls");
?>
