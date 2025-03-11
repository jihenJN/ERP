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

                            <div class="col-xs-6">
                                <?php echo $this->Form->control('code', ['readonly', 'label' => 'Code', 'required' => 'off', 'id' => 'code', 'class' => 'form-control']); ?>
                            </div>
                            <?php
                            echo $this->Form->control('Nom', ['label' => 'Nom', 'readonly']); ?>



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