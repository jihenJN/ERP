<?php

// Configuration de la mise en page
$this->layout = 'AdminLTE.print';

?>


<?php echo $this->Html->script('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'script']); ?>
<?= $this->Html->css('AdminLTE./bower_components/bootstrap/dist/css/bootstrap.min.css') ?>
<?php echo $this->Html->css('select2'); ?>


<style>
body {
    font-size: 10px;
}

table {
    font-size: 13px;
}

.page-break {
    page-break-before: always;
}

@media print {

    /* Masquer l'en-tête et le pied de page sur chaque page */
    .content {
        display: block !important;
        /* Afficher normalement */
        page-break-inside: avoid;
        /* Éviter les sauts de page à l'intérieur du contenu */
    }

    .page-break {
        page-break-before: always;
        /* Forcer un saut de page avant chaque section */
    }

    .table-container {
        max-height: 500px;
        overflow-y: auto;
    }
}
</style>

<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="col-xs-6">
                                <?php echo $this->Html->image('logoSMBM.png', array('width' => '250px', 'height' => '110px')); ?>
                            </div>
                            <div class="col-xs-6">
                                <h1 class="box-title" style="color:#3C386E!important;margin-top:5%;">
                                    <strong>Consultation Formulaire Consultation Client</strong>
                                </h1>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="box box-primary">
                <div>
                    <h3 class="box-title"><strong><?php echo __('Civilité'); ?></strong></h3>
                </div>
            </div>
            <div class="row">
                <div style=" margin: 0 auto;   position: static; ">
                    <div class="col-xs-4">
                        <label><strong>Code:</strong></label>
                        <?php echo h($clients->Code); ?>
                    </div>

                    <div class="col-xs-4">
                        <label><strong>Responsable:</strong></label>
                        <?php echo h($clients->responsable); ?>
                    </div>

                    <div class="col-xs-4">
                        <label><strong>Adresse:</strong></label>
                        <?php echo h($clients->Adresse); ?>
                    </div>

                    <div class="col-xs-4">
                        <label><strong>Fax:</strong></label>
                        <?php echo h($clients->Fax); ?>
                    </div>

                    <div class="col-xs-4">
                        <label><strong>Client:</strong></label>
                        <?php echo h($clients->Raison_Sociale); ?>
                    </div>

                    <div class="col-xs-4">
                        <label><strong>Mail:</strong></label>
                        <?php echo h($clients->Email); ?>
                    </div>

                    <div class="col-xs-4">
                        <label><strong>Tél:</strong></label>
                        <?php echo h($clients->Tel); ?>
                    </div>

                    <div class="col-xs-4">
                        <label><strong>Portable:</strong></label>
                        <?php echo h($clients->Contact); ?>

                    </div>

                </div>
            </div>

            <div class="box box-primary">
                <div>
                    <h3 class="box-title"><strong><?php echo __('Demande Client'); ?></strong></h3>
                </div>
            </div>
            <div class="row">
                <div style=" margin: 0 auto;   position: static; ">

                    <div class="col-xs-6">
                        <label><strong>Date Consultation:</strong></label>
                        <p><?php echo h($demandeclient->dateconsulation); ?></p>
                    </div>

                    <div class="col-xs-6">
                        <label><strong>Délai Conception:</strong></label>
                        <p><?php echo h($demandeclient->delaivoulu); ?></p>
                    </div>

                    <div class="col-xs-6">
                        <label><strong>Délai de Réponse:</strong></label>
                        <p><?php echo h($demandeclient->delaireponse); ?></p>
                    </div>

                    <div class="col-xs-6">
                        <label><strong>Délai d`approvisionnement:</strong></label>
                        <p> <?php echo h($demandeclient->delaiapprov); ?></p>
                    </div>
                    <br>
                    <div class="col-xs-12">
                        <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                            <?php foreach ($typedemandes as $id => $name): ?>
                            <label style="display: flex; align-items: center; gap: 7px;">
                                <input type="checkbox" class="typedemande-checkbox" name="typedemandes[]"
                                    value="<?= $id; ?>" <?= in_array($id, $listetypedemandeIds) ? 'checked' : ''; ?>>
                                <?= h($name); ?>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div>
                    <h3 class="box-title"><strong></strong></h3>
                </div>
            </div>
            <!------------------------Table starts here ------------------>
            <table border="1px" class="table table-bordered table-striped table-bottomless">
                <thead>
                    <tr>
                        <th align="center" style="width: 12%; font-size: 16px;">N° boite</th>
                        <th align="center" style="width: 14%; font-size: 16px;">Famille</th>
                        <th align="center" style="width: 14%; font-size: 16px;">Sous-Famille</th>
                        <th align="center" style="width: 15%; font-size: 16px;">Réf produit</th>
                        <th align="center" style="width: 8%; font-size: 16px;">Qte</th>
                        <th align="center" style="width: 10%; font-size: 16px;">Unité</th>
                        <th align="center" style="width: 20%; font-size: 16px;">Exigence</th>
                    </tr>
                </thead>

                <?php foreach ($lignedemandeclients as $i => $res) : ?>
                <td><?= h($res->numboite ?? 'N/A'); ?></td>
                <td><?= h($res->famille_id ?? 'N/A'); ?></td>
                <td><?= h($res->sousfamille1_id ?? 'N/A'); ?></td>
                <td><?= h($res->article_id ?? 'N/A'); ?></td>
                <td><?= h($res->qte ?? 'N/A'); ?></td>
                <td><?= h($res->unite_id ?? 'N/A'); ?></td>
                <td><?= h($res->exigence ?? 'N/A'); ?></td>
            </tr>
                <?php endforeach; ?>

            </table>





</section>