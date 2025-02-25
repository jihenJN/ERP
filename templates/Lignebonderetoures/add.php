<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lignebonderetoure $lignebonderetoure
 * @var \Cake\Collection\CollectionInterface|string[] $bonderetoures
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Lignebonderetoures'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="lignebonderetoures form content">
            <?= $this->Form->create($lignebonderetoure) ?>
            <fieldset>
                <legend><?= __('Add Lignebonderetoure') ?></legend>
                <?php
                    echo $this->Form->control('article_id');
                    echo $this->Form->control('qte');
                    echo $this->Form->control('qtestock');
                    echo $this->Form->control('bonderetoure_id', ['options' => $bonderetoures]);
                    echo $this->Form->control('couleur_id');
                    echo $this->Form->control('dimension_id');
                    echo $this->Form->control('categorie_id');
                    echo $this->Form->control('famille_id');
                    echo $this->Form->control('sousfamille1_id');
                    echo $this->Form->control('sousfamille2_id');
                    echo $this->Form->control('unite_id');
                    echo $this->Form->control('tva_id');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
