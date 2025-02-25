<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bonusmaluscommercial $bonusmaluscommercial
 * @var \Cake\Collection\CollectionInterface|string[] $commercials
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Bonusmaluscommercials'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bonusmaluscommercials form content">
            <?= $this->Form->create($bonusmaluscommercial) ?>
            <fieldset>
                <legend><?= __('Add Bonusmaluscommercial') ?></legend>
                <?php
                    echo $this->Form->control('datedebut');
                    echo $this->Form->control('datefin');
                    echo $this->Form->control('commercial_id', ['options' => $commercials]);
                    echo $this->Form->control('total');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
