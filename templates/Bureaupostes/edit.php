<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bureauposte $bureauposte
 * @var string[]|\Cake\Collection\CollectionInterface $gouvernorats
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $bureauposte->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $bureauposte->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Bureaupostes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bureaupostes form content">
            <?= $this->Form->create($bureauposte) ?>
            <fieldset>
                <legend><?= __('Edit Bureauposte') ?></legend>
                <?php
                    echo $this->Form->control('gouvernorat_id', ['options' => $gouvernorats]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('codepostal');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
