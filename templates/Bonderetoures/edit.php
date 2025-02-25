<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bonderetoure $bonderetoure
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $bonderetoure->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $bonderetoure->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Bonderetoures'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bonderetoures form content">
            <?= $this->Form->create($bonderetoure) ?>
            <fieldset>
                <legend><?= __('Edit Bonderetoure') ?></legend>
                <?php
                    echo $this->Form->control('date', ['empty' => true]);
                    echo $this->Form->control('pointdevente_id');
                    echo $this->Form->control('depot_id');
                    echo $this->Form->control('numero');
                    echo $this->Form->control('materieltransport_id');
                    echo $this->Form->control('cartecarburant_id');
                    echo $this->Form->control('conffaieur_id');
                    echo $this->Form->control('chauffeur_id');
                    echo $this->Form->control('kilometragedepart');
                    echo $this->Form->control('kilometragearrive');
                    echo $this->Form->control('poste');
                    echo $this->Form->control('marque');
                    echo $this->Form->control('serie');
                    echo $this->Form->control('cin');
                    echo $this->Form->control('chauffeur');
                    echo $this->Form->control('fournisseur_id');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
