<?php $this->layout = 'AdminLTE.print'; ?>
<br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<div style="display:flex">
    <div style="margin-left:4%">
        <?php
        echo $this->Html->image('m.png', ['alt' => 'CakePHP', 'height' => '96px', 'width' => '200px']); ?>
    </div>
    <div style="width: 38%;margin-left:23%" class="box">
        Isolmax <br>
        Sfax <br>
        Phone:20182836 <br>
        Mail :isolmax@gmail.com <br>
    </div>
</div>
<br>
<?php foreach ($commandeclients as $commandeclient) : ?>
    <div style="display:flex">
        <div class="box" style="width: 45%;height: 100px;margin-left:3%">
            Commande client N° : <?= h($commandeclient->code) ?> <br>
            Date : <?= h($commandeclient->date) ?> <br>
            BR N° :
        </div>
        <div class="box " style="width: 45%;height: 100px;margin-left:3%">
            Client : <?php
                        if (isset($commandeclient->client)) {
                            echo  h($commandeclient->client->name);
                        } ?><br>
            Adresse : <br>
            Matricule fiscale : <br>
            Mail : <br>
            Telephone : <br>
        </div>
    </div>
<?php endforeach; ?>
<div class="box">
    <div class="panel-body">
        <div class="table-responsive ls-table">
            <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                <thead>
                    <tr>
                        <td align="center" style="width: 15%;"><strong>Article</strong></td>
                        <td align="center" style="width: 10%;"><strong>quantite</strong></td>
                        <td align="center" style="width: 15%;"><strong>prixht</strong></td>
                        <td align="center" style="width: 10%;"><strong>Remise %</strong></td>
                        <td align="center" style="width: 15%;"><strong>PUNHT</strong></td>
                        <td align="center" style="width: 10%;"><strong>Tva %</strong></td>
                        <td align="center" style="width: 10%;"><strong>Fodec %</strong></td>
                        <td align="center" style="width: 15%;"><strong>Ttc</strong></td>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    foreach ($lignecommandeclients as $lignecommandeclient) :
                    ?>

                        <tr class="tr">
                            <td><?php
                                if (isset($lignecommandeclient->article)) {
                                    echo  h($lignecommandeclient->article->designiation);
                                }
                                ?></td>
                            <td style="width: 12%;height: 400px" align="center">
                                <?= $this->Number->format($lignecommandeclient->qte) ?>
                            </td>
                            <td style="width: 12%;height: 400px" align="center">
                                <?= $this->Number->format($lignecommandeclient->prixht) ?>
                            </td>
                            <td style="width: 12%;height: 400px" align="center">
                                <?= $this->Number->format($lignecommandeclient->remise) ?> %
                            </td>
                            <td style="width: 12%;height: 400px" align="center">
                                <?= $this->Number->format($lignecommandeclient->punht) ?>
                            </td>
                            <td style="width: 12%;height: 400px" align="center">
                                <?= $this->Number->format($lignecommandeclient->tva) ?> %
                            </td>
                            <td style="width: 12%;height: 400px" align="center">
                                <?= $this->Number->format($lignecommandeclient->fodec) ?> %
                            </td>
                            <td style="width: 12%;height: 400px" align="center">
                                <?= $this->Number->format($lignecommandeclient->ttc) ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <div style="display:flex ; margin-top:15px;">
                <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                    <thead>
                        <tr>
                            <td align="center" style="width: 15%;"><strong>taxe</strong></td>
                            <td align="center" style="width: 10%;"><strong>Taux %</strong></td>
                            <td align="center" style="width: 15%;"><strong>Assiette</strong></td>
                            <td align="center" style="width: 10%;"><strong>Montant</strong></td>
                        </tr>
                    </thead>
                    <tbody>



                        <tr class="tr">
                            <td style="width: 12%;height: 100px" align="center">
                                Fodec <br><br>
                                TVA
                            </td>
                            <?php

                            foreach ($lignecommandeclients as $lignecommandeclient) :
                            ?>
                                <td style="width: 12%;height: 100px" align="center">
                                    <?= $this->Number->format($lignecommandeclient->tva) ?> %<br><br>
                                    <?= $this->Number->format($lignecommandeclient->fodec) ?> %
                                </td>
                            <?php endforeach; ?>
                            <?php foreach ($commandeclients as $commandeclient) : ?>
                            <td style="width: 12%;height: 100px" align="center">
                                <?= $this->Number->format($commandeclient->totaltva) ?><br><br>
                                <?= $this->Number->format($commandeclient->totalfodec) ?>
                            </td>
                            <td style="width: 12%;height: 100px" align="center">
                            <?= $this->Number->format($commandeclient->totaltva) ?><br><br>
                                <?= $this->Number->format($commandeclient->totalfodec) ?>
                            </td>
                            <?php endforeach; ?>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>