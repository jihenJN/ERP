<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->fetch('script'); ?>
<section class="content-header">
    <h1>


        Consultation Type exonerations
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?></a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>


            <?= $this->Form->create($typeexon) ?>
                <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">

                               <?php     echo $this->Form->control('name',['readonly'=>'readonly','label'=>'Nom']); ?>
                                </div>
                            </div>
                     </div>
                
                 
                  <?php echo $this->Form->end(); ?>
           
            
        </div>
    </div>
</div>
</section>































<!--
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $typeexon->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $typeexon->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Typeexons'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="typeexons form content">
            <?= $this->Form->create($typeexon) ?>
            <fieldset>
                <legend><?= __('Edit Typeexon') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>-->
