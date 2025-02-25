<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lignebonderetoure $lignebonderetoure
 * @var string[]|\Cake\Collection\CollectionInterface $bonderetoures
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $lignebonderetoure->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $lignebonderetoure->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Lignebonderetoures'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="lignebonderetoures form content">
            <?= $this->Form->create($lignebonderetoure) ?>
            <fieldset>
                <legend><?= __('Edit Lignebonderetoure') ?></legend>
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
