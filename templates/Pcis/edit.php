<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pci $pci
 * @var string[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $pci->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $pci->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Pcis'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="pcis form content">
            <?= $this->Form->create($pci) ?>
            <fieldset>
                <legend><?= __('Edit Pci') ?></legend>
                <?php
                    echo $this->Form->control('designation');
                    echo $this->Form->control('qtedisp');
                    echo $this->Form->control('qtenonliv');
                    echo $this->Form->control('qtetheo');
                    echo $this->Form->control('stockminart');
                    echo $this->Form->control('qtevendu');
                    echo $this->Form->control('qteliv');
                    echo $this->Form->control('besoin');
                    echo $this->Form->control('qtenoncloture');
                    echo $this->Form->control('besoinprodtheoperiode');
                    echo $this->Form->control('qtprodpratique');
                    echo $this->Form->control('lancerpdp');
                    echo $this->Form->control('rang');
                    echo $this->Form->control('ventem1');
                    echo $this->Form->control('qtem1');
                    echo $this->Form->control('ventem2');
                    echo $this->Form->control('qtem2');
                    echo $this->Form->control('ventem3');
                    echo $this->Form->control('qtem3');
                    echo $this->Form->control('article_id', ['options' => $articles, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
