<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Gouvernoratcommercial $gouvernoratcommercial
 * @var \Cake\Collection\CollectionInterface|string[] $commercials
 * @var \Cake\Collection\CollectionInterface|string[] $gouvernorats
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Gouvernoratcommercials'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="gouvernoratcommercials form content">
            <?= $this->Form->create($gouvernoratcommercial) ?>
            <fieldset>
                <legend><?= __('Add Gouvernoratcommercial') ?></legend>
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
