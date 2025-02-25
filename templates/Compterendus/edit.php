<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compterendus $compterendus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $compterendus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $compterendus->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Compterendus'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="compterendus form content">
            <?= $this->Form->create($compterendus) ?>
            <fieldset>
                <legend><?= __('Edit Compterendus') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
