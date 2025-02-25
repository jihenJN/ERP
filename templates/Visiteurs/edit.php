<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visiteur $visiteur
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $visiteur->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $visiteur->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Visiteurs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="visiteurs form content">
            <?= $this->Form->create($visiteur) ?>
            <fieldset>
                <legend><?= __('Edit Visiteur') ?></legend>
                <?php
                    echo $this->Form->control('nom');
                    echo $this->Form->control('telephone');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
