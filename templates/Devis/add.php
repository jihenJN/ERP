<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Devi $devi
 * @var \Cake\Collection\CollectionInterface|string[] $clients
 */
?>
<!--div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Devis'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="devis form content">
            <?= $this->Form->create($devi) ?>
            <fieldset>
                <legend><?= __('Add Devi') ?></legend>
                <?php
                echo $this->Form->control('numero');
                echo $this->Form->control('date');
                echo $this->Form->control('client_id', ['options' => $clients]);
                echo $this->Form->control('total_remise');
                echo $this->Form->control('total_ht');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
    <h1>
        Ajout Type Contact
        <small><?php echo __(''); ?></small>
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
                <?php echo $this->Form->create($devi, ['role' => 'form']); ?>
                <div class="box-body">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('numero', ['label' => 'Numéro','readOnly' => true]); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('date', ['label' => 'Date']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?= $this->Form->control('client_id', [
                                'label' => 'Client',
                                'options' => $clients,
                                
                               
                                'empty' => 'Veuillez choisir!!!',
                                'class' => 'form-control select2 ',
                                'type' => 'select',
                            ]); ?>


                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('total_remise', ['label' => 'Total Remise']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('total_ht', ['label' => 'Total HT']); ?>
                        </div>
                    </div>
                    <button type="submit" class="pull-right btn btn-success" id="testde" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
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