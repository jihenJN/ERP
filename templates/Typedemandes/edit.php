<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Typedemande $typedemande
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $typedemande->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $typedemande->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Typedemandes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="typedemandes form content">
            <?= $this->Form->create($typedemande) ?>
            <fieldset>
                <legend><?= __('Edit Typedemande') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
