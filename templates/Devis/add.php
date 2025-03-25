<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Devi $devi
 * @var \Cake\Collection\CollectionInterface|string[] $clients
 */
?>
<div class="row">
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
</div>
