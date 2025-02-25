<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Gouvernoratcommercial $gouvernoratcommercial
 * @var string[]|\Cake\Collection\CollectionInterface $commercials
 * @var string[]|\Cake\Collection\CollectionInterface $gouvernorats
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $gouvernoratcommercial->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $gouvernoratcommercial->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Gouvernoratcommercials'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="gouvernoratcommercials form content">
            <?= $this->Form->create($gouvernoratcommercial) ?>
            <fieldset>
                <legend><?= __('Edit Gouvernoratcommercial') ?></legend>
                <?php
                    echo $this->Form->control('commercial_id', ['options' => $commercials, 'empty' => true]);
                    echo $this->Form->control('gouvernorat_id', ['options' => $gouvernorats, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
