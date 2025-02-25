<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Opportunite $opportunite
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $opportunite->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $opportunite->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Opportunites'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="opportunites form content">
            <?= $this->Form->create($opportunite) ?>
            <fieldset>
                <legend><?= __('Edit Opportunite') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
