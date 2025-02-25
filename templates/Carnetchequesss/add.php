<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Carnetcheque $carnetcheque
 * @var \Cake\Collection\CollectionInterface|string[] $comptes
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Carnetcheques'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="carnetcheques form content">
            <?= $this->Form->create($carnetcheque) ?>
            <fieldset>
                <legend><?= __('Add Carnetcheque') ?></legend>
                <?php
                    echo $this->Form->control('numero');
                    echo $this->Form->control('compte_id', ['options' => $comptes, 'empty' => true]);
                    echo $this->Form->control('debut');
                    echo $this->Form->control('nombre');
                    echo $this->Form->control('taille');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
