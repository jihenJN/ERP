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
                    <h4 class="box-title"><strong><?php echo __('Civilité'); ?></strong></h4>
                    <br>
                </div>
            </div>
            <div class="row">
                <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
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
                        <?php echo h( $clients->Contact); ?>

                    </div>

                </div>
            </div>



        </div>
</section>