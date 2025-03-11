<?php $this->layout = 'AdminLTE.print';

use Cake\Datasource\ConnectionManager;
?>
<br>
<style>
    body {
        font-size: 12px;
    }

    table {
        font-size: 12px;
    }

    .page {
        page-break-before: always;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>

<div>
    <?php
    $o = 0;
    foreach ($groupedResults as $res) :
      //  debug($res);
        $connection = \Cake\Datasource\ConnectionManager::get('default');
        $sql = "SELECT * FROM fournisseurs WHERE name LIKE :name";
        $params = ['name' => '%' . $four_id . '%'];
        $fournisseurs = $connection->execute($sql, $params)->fetchAll('assoc');
        if (!empty($fournisseurs)) {
            $adresse = $fournisseurs[0]['adresse'];
            $tel = $fournisseurs[0]['tel'];
            $fax = $fournisseurs[0]['fax'];
        }

    ?>
        <div style="display:flex">
            <div style="margin-left:4%">
                <?php
                echo $this->Html->image('logoSMBM.png', ['alt' => 'CakePHP', 'height' => '80px', 'width' => '100%']); ?>
            </div>

        </div>

        <br>
        <div class="container">
            <hr class="titre">
        </div>
        <br>
        <div>
            <table style="border:0.2px solid black;border-radius: 15px 15px 15px 15px;border-collapse: collapse;width: 100%;">
                <thead>

                </thead>
                <tbody>
                    <tr>
                        <td style="width:30%;padding: 6px;">Numéro : </td>
                        <td style="width:70%"><?php echo $demandeoffredeprix['numero']; ?></td>
                    </tr>
                    <tr>
                        <td style="width:30%;padding: 6px;">Date :</td>
                        <td style="width:70%"><?php echo $this->Time->format(
                                                    $demandeoffredeprix['date'],
                                                    'dd/MM/Y'
                                                ) ?></td>
                    </tr>
                    <tr>
                        <td style="width:30%;padding: 6px;"> Fournisseur : </td>
                        <td style="width:70%"><?php echo $four_id; ?></td>
                    </tr>
                    <tr>
                        <td style="width:30%;padding: 6px;"> Adresse : </td>
                        <td style="width:70%"><?php echo  $adresse;
                                                ?></td>
                    </tr>
                    <tr>
                        <td style="width:30%;padding: 6px;"> Tel : </td>
                        <td style="width:70%"><?php echo $tel;
                                                ?></td>
                    </tr>
                    <tr>
                        <td style="width:30%;padding: 6px;"> Fax : </td>
                        <td style="width:70%"><?php echo $fax;
                                                ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <div>
            <p>Remarque : Nous vous prions de nous communiquer une facture proforma pour les articles suivants : </p>
        </div>
        <br><br>
        <div>
            <p>Prière de nous envoyer votre meilleur offre de prix pour l'achat des produits suivants : </p>
        </div>
        <div>
            <div>
                <div>
                    <div>
                        <table style="border:0.2px solid black;border-radius: 15px 15px 15px 15px;border-collapse: collapse;width: 100%;">
                            <thead>
                                <tr>
                                    <td align="center" style="border:1px solid black;height:30px"><strong>Réf</strong></td>
                                    <td align="center" style="border:1px solid black;height:30px"><strong>Désignation</strong></td>
                                    <td align="center" style="border:1px solid black;height:30px"><strong>Réf.Fournisseur</strong></td>
                                    <td align="center" style="border:1px solid black;height:30px"><strong>Quantité</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($res as $article) :
                                    $connection = ConnectionManager::get('default');
                                    $articleId = $article->article_id;
                                    $fournisseurId = $article->fournisseur_id;

                                ?>
                                    <tr class="tr">
                                        <td style="vertical-align:top;border-right:1px solid black;height:30px" align="center">
                                            <?php if ($articleId) {
                                                $Code = $connection->execute("SELECT Code FROM articles WHERE id = " . $articleId)->fetch('assoc'); ?>
                                                <?= h($Code['Code']) ?>

                                            <?php   }  ?>

                                        </td>
                                        <?php if ($articleId) {
                                            $designation = $connection->execute("SELECT Dsignation  FROM articles WHERE id = " . $articleId)->fetch('assoc');

                                        ?>
                                            <td style=" vertical-align: top;border-right:1px solid black;height:30px">
                                                <?= h($designation['Dsignation']) ?>
                                            </td>
                                        <?php } else { ?>
                                            <td style=" vertical-align: top;border-right:1px solid black;height:30px">
                                                <?= h($article->designiationA) ?>
                                            </td>
                                        <?php } ?>


                                        <td style="vertical-align:top;border-right:1px solid black;height:30px" align="center">
                                        <?php if ($fournisseurId) {
                                                $Code = $connection->execute("SELECT code FROM fournisseurs WHERE id = " . $fournisseurId)->fetch('assoc'); ?>
                                                <?= h($Code['code']) ?>

                                            <?php   }  ?>
                                        </td>
                                        <td style="vertical-align:top;border-right:1px solid black;height:30px" align="center">
                                            <?= h($article->qte) ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div>
                <p><strong>Mode Livraison : </strong></p>
            </div>
            <div style="displey:flex">
                <div align="left">
                    <p><strong>Avec nos remerciements anticipés . </strong></p>
                </div>
                <div align="right">
                    <p><strong>La Direction ACHAT</strong></p>
                </div>
            </div>
        </div>
        <div class="footer">
            <hr>
            <br>
            <table style="border:0.2px solid black;border-radius: 15px 15px 15px 15px;border-collapse: collapse;width: 100%;">
                <thead>
                    <th style="text-align:center">
                    <td align="center" style="width: 100%;border:0;"><strong>
                            <?php echo $societes->nom ?>&nbsp;&nbsp;&nbsp; Capital : <?php echo $societes->capital ?> <br>
                            Adresse: <?php echo $societes->adresse ?> - Tél : <?php echo $societes->tel ?> - FAX: <?php echo $societes->fax ?> <br>
                            TVA :<?php echo $societes->codetva ?> - E-mail :<?php echo $societes->mail ?><br>
                    </td>
                    </th>
                </thead>
            </table>
        </div>
        <div class="page"></div>
        <br><br>
    <?php endforeach; ?>
</div>
<style>
    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        text-align: center;
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
        content: 'Demande  de Prix';
        padding: 0 4px;
        position: relative;
        top: -13px;
        font-size: x-large;

    }
</style>