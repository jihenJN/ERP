<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Typecontact $typecontact
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $typecontact->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $typecontact->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Typecontacts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="typecontacts form content">
            <?= $this->Form->create($typecontact) ?>
            <fieldset>
                <legend><?= __('Edit Typecontact') ?></legend>
                <?php
                    echo $this->Form->control('libelle');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
