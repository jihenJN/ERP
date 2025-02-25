<?php echo $this->Html->css('select2'); ?>

<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>

        Consultation famille
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($famille, ['role' => 'form']); ?>


                <div class="box-body">
                    <div class="row">

                        <div class="col-xs-6">

                            <?php
                            echo $this->Form->control('Nom', ['label' => 'Nom', 'readonly']); ?>

                            <!-- <div class="col-xs-6" style="margin-top: 25px ; margin-right : 25px;"> -->
                            <!-- <label class="control-label" for="unite-id" style="margin-right: 20px"> Etat</label>

                                Activé <input type="radio" name="etat" value="1" id="active" class="choixcollisage" style="margin-right: 20px" <?php if ($famille->etat == 1) { ?> checked="checked" <?php } ?>>
                                Désactivé <input type="radio" name="etat" value="0" id="desactive" class="choixcollisage" <?php if ($famille->etat == 0) { ?> checked="checked" <?php } ?>>
                                <br><br><br> -->
                            <!--
                                <label class="control-label" for="unite-id" style="margin-right: 20px"> destinée à la vente</label>
                                oui <input type="radio" name="vente" value="1" id="true" class="choixcollisage" style="margin-right: 20px" <?php if ($famille->vente == 1) { ?> checked="checked" <?php } ?>>
                                non <input type="radio" name="vente" value="0" id="false" class="choixcollisage" <?php if ($famille->vente == 0) { ?> checked="checked" <?php } ?>>
-->


                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('marque_id', ['label' => 'Marque','readonly', 'options' => $marques, 'required' => 'off', 'id' => 'marque_id', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control']); ?>
                        </div>
                    </div>


                </div>



                <?php echo $this->Form->end(); ?>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
