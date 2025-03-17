<?php

// Configuration de la mise en page
$this->layout = 'AdminLTE.print';

?>

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

    /* .table-container {
        max-height: 500px; 
        overflow-y: auto; 
         }*/
}
</style>


<?php echo $this->Html->script('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'script']); ?>
<?= $this->Html->css('AdminLTE./bower_components/bootstrap/dist/css/bootstrap.min.css') ?>
<?php echo $this->Html->css('select2'); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="col-md-12">
                        <div class="col-xs-6">
                            <?php echo $this->Html->image('logoSMBM.png', array('width' => '250px', 'height' => '110px')); ?>
                        </div>
                        <div class="col-xs-6">
                            <h1 class="box-title" style="color:#3C386E!important;margin-top:5%;"><strong>Consulter
                                    Visite sur site N° <?php echo $visite->numero; ?></strong></h1>

                        </div>
                    </div>

                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($visite, ['role' => 'form', 'id' => 'testform', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box box-primary">
                    <br>
                    <div class="row">
                        <section class="content" style="width: 98%">
                            <div class="row">
                                <div
                                    style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                    <div class="col-xs-6">
                                        <label><strong>Date Contact:</strong></label>
                                        <?php echo h($visite->datecontact); ?>
                                    </div>
                                    <div class="col-xs-6">
                                        <label><strong>Date Planifiée:</strong></label>
                                        <?php echo h($visite->dateplanifie); ?>
                                    </div>
                                    <div class="col-xs-6">
                                        <label><strong>Raison_Sociale:</strong></label>
                                        <?php echo h($clients->Raison_Sociale); ?>
                                    </div>
                                    <div class="col-xs-6">
                                        <label><strong>Addresse:</strong></label>
                                        <?php echo h($clients->Adresse); ?>
                                    </div>
                                    <div class="col-xs-6">
                                        <label><strong>Responsable:</strong></label>
                                        <?php echo h($clients->responsable); ?>
                                    </div>
                                    <div class="col-xs-6">
                                        <label><strong>Télephone:</strong></label>
                                        <?php echo h($clients->Tel); ?>
                                    </div>
                                    <div class="col-xs-6">
                                        <label><strong>Type Contact:</strong></label>
                                        <?php echo h($typeContacts->libelle); ?>
                                    </div>
                                    <div class="col-xs-6">
                                        <label><strong>Visiteur:</strong></label>
                                        <?php echo h($commercials->name); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="box box-primary">
                                    <div class="panel-body">
                                        <div class="col-xs-6">
                                            <label>Travail demandé :</label>
                                            <?php echo h($visite->trdemande); ?>
                                        </div>
                                        <div class="col-xs-6">
                                            <label>Description :</label>
                                            <?php echo h($visite->description) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="box box-primary">
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table" style=" height: 100%;">
                                            <div class="col-xs-12" style="margin-bottom: 20px;">
                                                <label>Schéma décriptif :</label>
                                                <?php echo h($visite->descriptif); ?>
                                            </div>
                                            <br><br>
                                            <div class="col-xs-12">
                                                <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                                                    <?php foreach ($typebesoins as $id => $name): ?>
                                                    <label style="display: flex; align-items: center; gap: 5px;">
                                                        <input type="checkbox" class="typebesoin-checkbox"
                                                            name="typebesoins[]" value="<?= $id; ?>"
                                                            <?= in_array($id, $listetypeIds) ? 'checked' : ''; ?>>
                                                        <?= h($name); ?>
                                                    </label>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>


                                            <?php foreach ($listebesoins as $b): ?>
                                            <?php

                                                $display = ($b->typebesoin_id == 1) ? 'display: block;' : 'display: none;';
                                                ?>
                                            <?php endforeach; ?>

                                            <div class="col-xs-12" id="piece" style="<?php echo $display; ?>">
                                                <!-- <?php $url = $_SERVER['HTTP_HOST']; ?>
                                                <?php $this->Form->control('piece', ['name' => 'piece', 'id' => 'pie', 'type' => 'file', 'label' => false]); ?>
                                                <a href="https://<?php echo $url; ?>/ERP/webroot/img/imgpersonnels/<?php echo $visite->piece; ?>" target="_blank">
                                                    <i class="fa fa-file" style="color: green; font-size: 20px;"></i>
                                                </a> -->
                                                <?php echo $this->Html->link('/imgpersonnels/' . $visite->piece, ['style' => 'max-width:200px;height:200px;']); ?>

                                            </div>
                                            <br>

                                            <br><br>

                                            <div class="col-xs-12" style="margin-bottom: 20px;">
                                                <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                                                    <label>Compte rendu à qui ?:</label>
                                                    <br>

                                                    <?php foreach ($compterendus as $id => $name): ?>
                                                    <label style="display: flex; align-items: center; gap: 5px;">
                                                        <input type="checkbox" class="compterendu-checkbox"
                                                            name="compterendus[]" value="<?= $id; ?>"
                                                            <?= in_array($id, $listetypecomteIds) ? 'checked' : ''; ?>>
                                                        <?= h($name); ?>
                                                    </label>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="col-xs-6" style="margin-bottom: 20px;">
                                                <label>Date compte rendu :</label>
                                                <?php echo h($visite->datecptrendu); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section>
                    </div>

                </div>

                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>