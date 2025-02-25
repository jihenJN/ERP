<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Carnetcheque $carnetcheque
 */
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
    <h1>
        Carnet Chéque
        <small><?php echo __('Consultation'); ?></small>
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
                <?php echo $this->Form->create($carnetcheque, ['role' => 'form']); ?>
                <div class="box-body">


                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('numero', ['label' => 'Numero', 'id' => 'numero', 'readonly' => 'readonly']);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('debut', ['label' => 'Debut', 'id' => 'debut', 'readonly' => 'readonly']);
                        ?>
                    </div>
                    <!-- <div class="col-md-6">
                        <?php

                        echo $this->Form->input('banque_id', array(
                            'empty' => 'Veuillez choisir !!', 'readonly', 'options' => $banques, 'class' => ' form-control ', 'name' => 'banque_id', 'label' => 'Banque', 'id' => 'banque_id', 'type' => '', 'class' => 'form-control select2'
                        ));
                        ?>
                    </div> -->
                
                    <div class="col-xs-6">
                        <?php

                        echo $this->Form->control('compte_id', array('label' => 'Compte','class' => ' form-control ', 'options' => $comptes, 'disabled' => 'disabled', 'index' => '', 'name' => '', 'id' => 'compte_id', 'champ' => 'compte_id', 'table' => 'ligner', 'empty' => 'Veuillez choisir !!', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'empty' => 'Veuillez Choisir !!')); ?>


                    </div>
                   
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('nombre', ['label' => 'Nombre', 'id' => 'nombre', 'readonly' => 'readonly']);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('taille', ['label' => 'Taille', 'readonly' => 'readonly', 'id' => 'taille']);
                        ?>
                    </div>


                </div>




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