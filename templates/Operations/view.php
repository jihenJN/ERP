<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Operation $operation
 */
?>
<section class="content-header">
  <h1>
  Opération
    <small><?php echo __('Vue'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <!-- <i class="fa fa-info"></i> -->
          <!-- <h3 class="box-title"><?php echo __('Information'); ?></h3> -->
        </div>
        <?php echo $this->Form->create($operation, ['role' => 'form']); ?>
                <div class="box-body">
                    <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('name', ['label' => 'Nom','disabled'=>'disabled']);
                            ?>
                        </div>
                    
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('datevaleur', ['empty' => true,'disabled'=>'disabled','label' => 'Date Valeur']);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('datedebut', ['empty' => true,'disabled'=>'disabled','label' => 'Date Debut']);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php

                            echo $this->Form->control('typeoperation_id', array(
                                'empty' => 'Veuillez choisir !!', 'options' => $typeoperations,'disabled'=>'disabled', 'class' => ' form-control ', 'name' => 'typeoperation_id', 'label' => 'Type Opération', 'id' => 'typeoperation_id', 'type' => '', 'class' => 'form-control select2'
                            ));
                            ?>
                        </div>
                    </div>
 
    </div>
    </div>

</section>

