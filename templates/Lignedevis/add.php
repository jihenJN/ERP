<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lignedevi $lignedevi
 * @var \Cake\Collection\CollectionInterface|string[] $articles
 * @var \Cake\Collection\CollectionInterface|string[] $devis
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Lignedevis'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="lignedevis form content">
            <?= $this->Form->create($lignedevi) ?>
            <fieldset>
                <legend><?= __('Add Lignedevi') ?></legend>
                <?php
                    echo $this->Form->control('prix');
                    echo $this->Form->control('remise');
                    echo $this->Form->control('ht');
                    echo $this->Form->control('article_id', ['options' => $articles]);
                    echo $this->Form->control('devis_id', ['options' => $devis]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
