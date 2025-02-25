<?php $this->layout = 'AdminLTE.print'; ?>
<br>
<style>
    body {
        font-size: 11px;

    }

    table {
        font-size: 12px;

    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<div>
    <div>
        <?php
        echo $this->Html->image('mm.png', ['alt' => 'CakePHP', 'height' => '110px', 'width' => '200px']); ?>
    </div>
    <div align="left">
        Société CODIFA <br>
        Rte Fouchana 1.8 km 1135 naassen <br>
        Phone : (+216) 71 398 404 / (+216) 71 398 158 <br>
        Mail : codifa@gnet.tn <br>
    </div>
</div>
<br>
<br>
<br>
<?php

foreach ($data as $i  => $pre) {
?>
<?php } ?>
<h1 style="text-align: center;"> BON DE SORTIE N° <?php echo $pre['numero']  ?> </h1>



<p style="font-size: 15px ;"> Doit <?php echo $nomsoc  ?> A <?php echo $adresse  ?> , Naasane </p>
<br><br>

<div>



    <b align="right"> Edité Le : </b> <b> <?php echo $pre['date']  ?> </b> <br> <br>


    <br>
    <br>


    <table style="width: 100%;border-collapse: collapse;border-radius: 15px;">
        <thead>

            <th width="10%"> Reference </th>
            <th width="40%"> Désignation </th>
            <th width="10%"> Quantité </th>
            <th width="10%"> Nb Cartons </th>
            <th width="10%"> Nb Vrac </th>

        </thead>

        <tbody>
            <?php
            $totqte = 0;
            $sommeCartons  = 0;
            foreach ($data as $i  => $pre)
            //debug($data) ; die ; 

            {
            ?>
                <?php


                foreach ($data[$i]['Ligne'] as $k => $ligne) {

                    $npiece = $ligne['nombrepiece'];
                    //debug($npiece) ; die ;
                    $qteliv = $ligne['quantiteliv'];

                    $nbcartons = $npiece / $qteliv;

                    $totqte = $totqte + $qteliv;
                    $sommeCartons += $nbcartons;



                ?>



                    <tr>


                        <td width="10%" align="center"> <?php echo $ligne['Code']  ?> </td>
                        <td width="40%" align="center"> <?php echo $ligne['Dsignation']  ?> </td>
                        <td width="10%" align="center"> <?php echo $ligne['quantiteliv']  ?> </td>
                        <td width="10%" align="center"> <?php echo $nbcartons ?> </td>
                        <td width="10%" align="center"> 0 </td>



                    </tr>

                <?php }  ?>
            <?php } ?>



        </tbody>

        <tfoot>

            <tr>
                <th style=" padding-left: 15%;" width="10%" colspan="2"> Total </th>
                <td width="10%" align="center">
                    <?php echo $totqte ?>
                </td>
                <td width="10%" align="center">
                    <?php echo $sommeCartons ?>
                </td>
                <td width="10%" align="center">
                    0
                </td>
            </tr>
        </tfoot>



    </table>

    <br><br><br>

    <table style="width: 100%;border-collapse: collapse;border-radius: 15px;">
        <thead>
            <th width="10%">Magasanier</th>
            <th width="10%">Chauffeur</th>
            <th width="10%">Convoyeur</th>
            <th width="10%">Camion transporteur</th>
        </thead>


        <tbody>

            <tr>
                <td width="10%" align="center"> Date : </td>
                <td width="10%" align="center"> Date :<?php echo $date ?> </td>
                <td width="10%" align="center"> Date : <?php echo $datec ?> </td>
                <td width="10%" align="center"> Marque : <?php echo $pre['designation']  ?> </td>
            </tr>
            <tr>
                <td width="10%" align="center"> Nom :</td>
                <td width="10%" align="center"> Nom : <?php echo $chauff ?> </td>
                </td>
                <td width="10%" align="center"> Nom : <?php echo $conv ?> </td>
                <td width="10%" align="center"> Matricule : <?php echo $pre['matricule']  ?> </td>
            </tr>
            <tr>
                <td width="10%" align="center">Visa :</td>
                <td width="10%" align="center">Visa :</td>
                <td width="10%" align="center">Visa :</td>
            </tr>


        </tbody>
    </table>