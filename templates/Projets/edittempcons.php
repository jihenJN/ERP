<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tacheassign $tacheassign
 */
?>
<?php echo $this->Html->script('js_vieww_projet'); ?>

<div class="row">
    <section class="content-header">
        <h1>
            Modification Taches
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->Url->build(['action' => 'vieww/', $project_id]); ?>"><i class="fa fa-reply"></i>
                    <?php echo __('Retour'); ?>
                </a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="column-responsive">
                        <div class="tacheassigns form content">
                            <?= $this->Form->create($tacheassign) ?>

                            <div class="form-group">
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('numero', ['class' => 'form-control', 'champ' => 'numero', 'label' => 'Numero']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('tache_id', ['options' => $taches, 'value' => $tacheassign->tache_id, 'class' => 'form-control', 'champ' => 'tache', 'label' => 'Tache']); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('personnel_id', ['options' => $personnels, 'value' => $tacheassign->personnel_id, 'class' => 'form-control', 'champ' => 'personnel', 'label' => 'Assigné par']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('datedebut', ['type' => 'datetime', 'value' => $tacheassign->datedebut, 'class' => 'form-control', 'champ' => 'personnel', 'label' => 'Datedebut']); ?>
                                </div>
                            </div>
                            <div class="form-inline">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->input('HH', array('type' => 'text', 'label' => '', 'index' => '', 'id' => 'HH', 'title' => 'HH', 'label' => 'Temps Consommé', 'champ' => 'HH', 'table' => 'tabletache', 'class' => 'form-control', 'style' => 'width: 40px;', 'after' => '</div><div class="form-group">'));
                                    echo (' : ');
                                    echo $this->Form->input('MM', array('type' => 'text', 'title' => 'MM', 'label' => '', 'index' => '', 'id' => 'MM', 'champ' => 'MM', 'class' => 'form-control mminput', 'style' => 'width: 40px;', 'after' => '</div>', 'empty' => 'MM')); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('note', ['type' => 'text', 'value' => $tacheassign->note, 'class' => 'form-control', 'champ' => 'note', 'label' => 'Note']); ?>
                                </div>
                            </div>

                            <div align="center" style="margin-top:50px;">
                                <?= $this->Form->button(__('Submit')) ?>
                            </div>

                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>