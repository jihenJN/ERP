<?php
$total = 0;
?>

<?php $this->layout = 'AdminLTE.print';
use Cake\Datasource\ConnectionManager; ?>
<br>
<style>
    body {
        font-size: 12px;
    }

    table {
        font-size: 12px;
        width: 100%; /* Définir la largeur de la table sur 100% de la largeur de la page */
    }

 
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<div style="display:flex">
    <div style="margin-left:4%">
        <?php echo $this->Html->image('mm.png', ['alt' => 'CakePHP', 'height' => '110px', 'width' => '200px']); ?>
    </div>
    <div style="width: 58%;margin-left:23%; border: 1px solid black;"  align="left">
        Customer No:  <br>
       <strong>Genius Global Business</strong>  <br>
        2035 CHARGUIA1 <br>
        TUNEZ  <br>
        71806790/54848590 <br>
        a.direction@geniusgb.net <br>
    </div>
</div>
<br>
<!-- <HR> ligne separateur  --> 
<br><br>
<div   align="center">
    <h1><strong>QUOTATION</strong></h1>
</div>

<table>
    <tr>
        <td align="left" style=" width: 16.67%;  border: 1px solid black; text-align: left;">
            <strong>Quotation No:</strong><br> 
            <?= h($commandefournisseur->numero) ?><br>
            <strong>Quotation Date:</strong><br> 
            <?= h($commandefournisseur->date) ?><br> 
            <br>
            <strong>Weight : KG</strong><br> 
          
        </td>
        
        <td align="left" style=" width: 16.67%;  border: 1px solid black; text-align: left;">
            <strong>Currency : EUR</strong><br>
            <strong>Incoterm-2010: CPT DOUALA </strong><br>
            <strong>Terms of payment :</strong><br>
        </td>
        
        <td align="left" style=" width: 16.67%;  border: 1px solid black; text-align: left;">
            <strong>Ref:</strong><br> 
            <?= h($commandefournisseur->reference) ?><br> 
        </td>
    </tr>
</table>


<div style="display:flex; margin-top:25px;">
    <table >
        <thead>
            <tr>
                <td style=" width: 16.67%;  border: 1px solid black; text-align: center;"><strong>Product</strong></td>
                <td style=" width: 16.67%;  border: 1px solid black; text-align: center;"><strong>Description</strong></td>
                <td style=" width: 16.67%;  border: 1px solid black; text-align: center;"><strong>Units</strong></td>
                <td style=" width: 16.67%;  border: 1px solid black; text-align: center;"><strong>S.U</strong></td>
                <td style=" width: 16.67%;  border: 1px solid black; text-align: center;"><strong>Unit Price</strong></td>
                <td style=" width: 16.67%;  border: 1px solid black; text-align: center;"><strong>Price</strong></td>
            </tr>
        </thead>
        
        <tbody>
            <!-- <?php debug($lignecommandefournisseurs->toArray());?> -->
        <?php foreach ($lignecommandefournisseurs as $article):
                                // debug($article);
                                $connection = ConnectionManager::get('default');
                                $articleId = $article->article_id;
                                // debug($articleId);
                                 ?>
         
                <tr>
                    <td style=" width: 16.67%;   text-align: center;"> <?php echo $article->article->Dsignation ?></td>
                    <td style=" width: 16.67%; text-align: center;"><?php echo $article->article->Description ?></td>
                    <td style=" width: 16.67%;  text-align: center;"><?php echo $article->qte; ?></td>
                    <td style="width: 16.67%; text-align: center;">UN</td>
                    <td style=" width: 16.67%;text-align: center;"><?php echo $article->prix; ?></td>
                    <td style=" width: 16.67%; text-align: center;"><?php echo $article->ttc ?></td>
                    
                    <?php
                        $total += $article->ttc;
                    ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <div style="height: 600px;"></div>
        <tbody>
    <tr>
        <td colspan="1"></td> 
        <td colspan="2"><strong>Gross Weight:</strong></td>
        <td colspan="2"><strong>Net Weight:</strong></td>
        <td colspan="2"><strong>Total: <?php echo $total; ?></strong></td>
    </tr>
</tbody>

    </table>
</div>
<div class="footer">
<div class="footer" style="padding: 0 5px;margin-top:20px">
    <div style="display:flex; justify-content: center;">
        <div>
            <?php echo $this->Html->image('SGS.jpeg', ['alt' => 'CakePHP', 'height' => '110px']); ?>
        </div>
    </div>
</div>

        </div>
    <div class="page"></div>
    <br><br>
    <?php //endforeach; ?>
</div>
<style>
 .footer {
    position: fixed;
    left: 0;
    bottom: 10px;
    width: 100%;
     /* couleur de fond */
     /* couleur du texte */
    /* espacement intérieur */
    text-align: center; /* centrage du texte */
}



    .titre {
  border: none;
  border-top: 2px solid #333;
  color: #333;
  overflow: visible;
  text-align: center;
  height: 5px;
}

.titre::after {
  background: #fff;
  content: 'Bon de Commande Fournisseur';
  padding: 0 4px;
  position: relative;
  top: -13px;
  font-size: x-large;

}

    /* .boxxx::before {
        content: "Demande Offre de Prix ";
        display: block;
        color: #0619e3;
        font-weight:bold;
        background-color: white;*/
        /* Fond pour couvrir la bordure */
        /* position: absolute; /* 
        /*  top: -4%; */
        /* Place le titre au-dessus de la bordure */
        /* right: 2%; */
        /* Cent transform: translateX(-50%); /* Centre le titre horizontalement */
        /* padding: 0 10px;
        font-size: 20px; */
        /* Espace autour du titre */
   /*   } */
</style>
