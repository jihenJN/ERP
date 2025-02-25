<?php

use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager; ?>
<?php $this->layout = 'AdminLTE.printt'; ?>
<br>

<style>
    @media print {
        .content-header {
            page-break-before: always;
            display: none;

        }
    }

    #tabligne1 {
        border-collapse: collapse;
        width: 100%;
    }

    #tabligne1 th,
    #tabligne1 td {
        padding: 8px;
        text-align: center;
        border: 1px solid #ccc;
    }

    #tabligne1 th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
    }

    .header {
        display: flex;
        margin-bottom: 20px;
    }

    .logo {
        margin-left: 6%;
    }

    .company-info {
        width: 75%;
        margin-left: 23%;
        font-size: 14px;
        line-height: 1.5;
    }

    .box {
        border: 1px solid #ccc;
        padding: 10px;
    }

    h3 {
        color: red;
        font-family: monospace;
        text-align: center;
        margin-top: 40px;
    }

    .row {
        margin: 0 auto;
        margin-left: 20px;
        margin-right: 20px;
        position: static;
    }

    .col-xs-6 {
        width: 50%;
        float: left;
    }

    .field-container {
        border: 1px solid black;
        padding: 5px;
        margin-bottom: 10px;
    }

    .field-container .field-label {
        font-weight: bold;
    }

    .field-container .field-value {
        margin-top: 5px;
    }

    .field-value {
        border: 1px solid black;
        padding: 5px;
        min-height: 20px;
    }
</style>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>
<style>
    .boxgris {
        position: relative;
        background: #E6E6E6;
        width: 50%;
        color: #000040;
    }

    .boxblanc {
        position: relative;
        border: 1px solid #6F7175;
        background: #ffffff;
        width: 50%;
        color: #000000;
    }

    .boxbordergris {
        position: relative;
        border: 1px solid #E6E6E6;
        background: #ffffff;
        width: 99%;
        color: #000000;
    }
</style>
<!-- <?php debug($facture->numero); ?> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<div style="position: relative; top: -18px;">
    <!-- Bande noire continue -->
    <div style="background-color: black; height: 40px;"></div>

    <!-- Image au-dessus de la bande noire -->
    <div style="position: absolute; top: 10px; left: 15%; transform: translateX(-50%); z-index: 1;">
        <?php echo $this->Html->image('logoggb.png', ['alt' => 'CakePHP', 'height' => '130px', 'width' => '180px']); ?>
    </div>
</div>
<br>

<div style="width: 87%;height: 20px;margin-left:12%;margin-right:5%;">
    <div style=" display: flex; position: relative; justify-content: flex-end; color: #103458; font-size: 1.7em; ">
        <strong>Consultation Demande offre
            <!-- <?php echo $dmd->numero ?> -->
        </strong>
    </div>
    <div style="display: flex; position: relative; justify-content: flex-end; font-size: 1.2em; color: #103458;">
        Code fournisseur :
        <?= h($fournisseur->code) ?>
    </div>
</div>
<br><br>
<br><br>
<!-- <div style="display:flex">
    <div style="width: 30%; margin-left:3%">
        Adressé à:
    </div>
    <div style=" width: 60%; margin-left:27%">
        Émetteur:
    </div>
</div> -->
<div style="display:flex">
    <div class="boxblanc" style="width: 52%;height: 180px;margin-left:3%">
        <div style="margin-top:1%; margin-left:1%">
            <strong>
                <?= h($fournisseur->name) ?>
            </strong>
            <br>
            <?= h($fournisseur->adresse) ?>
            <br>
            <?= h($fournisseur->port) ?>
            <br>
            <?= h($fournisseur->Code_VilleL) ?>
            <br>
            <strong>Téléphone:</strong>
            <?= h($fournisseur->tel) ?>
            <br>
            <strong>Fax :</strong>
            <?= h($fournisseur->fax) ?>
            <br>
            <strong>Email :</strong>
            <?= h($fournisseur->mail) ?>
            <br>
            <strong>Site :</strong>
            <?= h($fournisseur->site) ?>
        </div>
    </div>
    <div class="boxblanc" style="width: 52%;height: 180px;margin-left:4%">
        <div style="margin-top:1%; margin-left:1%">
            Customer No: <br><br><br>
            <strong>Genius Global Business</strong> <br><br>
            2035 CHARGUIA1 <br><br>
            TUNEZ <br><br>
            71806790/54848590 <br><br>
            a.direction@geniusgb.net <br>
        </div>
    </div>

</div>
<br><br>

<div class="box" style="width: 94%; margin-left:3%;margin-right:5%;">
    <div class="panel-body">
        <div class="table-responsive ls-table">
            <table
                style="border:0.2px solid black;border-radius: 15px 15px 15px 15px;border-collapse: collapse;width: 100%;">
                <thead>
                    <tr>
                        <td align="center" style="width: 15%;"><strong>PRODUIT</strong></td>
                        <td align="center" style="width: 15%;"><strong>Prix</strong></td>
                        <td align="center" style="width: 15%;"><strong>DESCRIPTION</strong></td>
                        <td align="center" style="width: 10%;"><strong>UNITS</strong></td>
                        <td align="center" style="width: 10%;"><strong>S.U</strong></td>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    // debug($facture->lignefactures);
                    foreach ($ligneas as $article):
                        $connection = ConnectionManager::get('default');
                        if ($article->article_id != null) {
                            $art = $connection->execute('SELECT * FROM articles where articles.id =' . $article->article_id)->fetchAll('assoc');
                        } else {
                            $art[0]['Dsignation'] = $article->DsignationA;
                            $art[0]['Description'] = '';
                        } ?>

                        <tr class="tr">
                            <td>

                                <?php echo h($art[0]['Dsignation']); ?>
                            </td>
                            <td>

                                <?php echo h($article->prix); ?>
                            </td>
                            <td>
                                <?php echo h($art[0]['Description']); ?>
                            </td>
                            <td align="center">
                                <?=
                                    $article->qte;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                echo 'UN' ?>
                            </td>


                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
            <table>
                <tbody style=" height: 50px;">
                    <tr>
                        <!-- <td colspan="1"></td> -->
                        <td colspan="2" style="color:#F72424"><strong>Gross Weight:</strong></td>

                        <td colspan="2" style="color:#F72424"><strong>Net Weight:</strong></td>
                    </tr>
                </tbody>
            </table>



        </div>

    </div>

</div>

<style>
    p {
        font-size: 10px;
        /* Vous pouvez ajuster la taille selon vos besoins */
    }
</style>
<div class="footer" style="padding: 0 5px">
    <div style="display:flex; justify-content: center;">
        <!-- <div>

            <img src="data:image/png;base64,<?php echo $data2 ?>" height="110px" width="90%">

        </div> -->
    </div>
</div>
<style>
    .footer {
        position: fixed;
        left: 0;
        bottom: 10px;
        width: 100%;
        text-align: center;
    }
</style>