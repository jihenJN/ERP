<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Typecredit $typecredit
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
    <h1>
        Type Crédit
        <small><?php echo __('Ajouter'); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">

                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($typecredit, ['role' => 'form']); ?>
                <div class="box-body">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('name', ['label' => 'Nom']);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('montant', ['label' => 'Montant','class' => 'form-control number']);
                            ?>
                        </div>
                        <!-- <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('mesuel', ['label' => 'Mensuel']);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('annuel', ['label' => 'Annuel']);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('sertype', ['label' => 'Sertype']);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('tuestrie', ['label' => 'Tuestrie']);
                            ?>
                        </div> -->
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('frequence_id', array(
                                'empty' => 'Veuillez choisir !!',
                                'options' => $frequences,
                                'class' => ' form-control ',
                                'name' => 'frequence_id',
                                'label' => 'Fréquence',
                                'id' => 'frequence_id',
                                'type' => '',
                                'class' => 'form-control select2  fournisseurreglement2'
                            ));
                            ?>
                        </div>

                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('montantcredit', ['label' => 'Montant Crédit','class' => 'form-control number']);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('taux', ['label' => 'Taux d\'intérêt','class' => 'form-control number']);

                            //  echo $this->Form->control('taux', ['label' => 'Taux d intérét']);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('montantremb', ['label' => 'Montant Remboursement','class' => 'form-control number']);

                            //  echo $this->Form->control('taux', ['label' => 'Taux d intérét']);
                            ?>
                        </div>
                    </div>
                    <button type="submit" class="pull-right btn btn-success testchamp" id="controlecredit" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                    <?php echo $this->Form->end(); ?>
                </div>

                <!-- /.box-body -->


            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
<?php echo $this->Html->script('alert'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.testchamp').on('click', function() {

            num = $('#name').val();
            date = $('#date').val();
            frequence_id = $('#frequence_id').val();
            montantcredit = $('#montantcredit').val();
            solde = $('#montant').val();
            taux = $('#taux').val();
            montantremb = $('#montantremb').val();
            if (num == '') {
                alert("Ajouter le nom  SVP");
                return false;
            }
           
            if (frequence_id == '') {
                alert("Choisir le fréquence SVP");
                return false;
            }
           
            if (solde == '') {
                alert("Ajouter le montant SVP");
                return false;
            }
            if (montantcredit == '') {
                alert("Ajouter le montant credit SVP");
                return false;
            }
            if (taux == '') {
                alert("Ajouter le taux d`intérêt SVP");
                return false;
            }
            if (montantremb == '') {
                alert("Ajouter le Montant Remboursement SVP");
                return false;
            }

        });
    });
</script>