<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lignedemandeclient $lignedemandeclient
 * @var string[]|\Cake\Collection\CollectionInterface $demandeclients
 * @var string[]|\Cake\Collection\CollectionInterface $familles
 * @var string[]|\Cake\Collection\CollectionInterface $sousfamille1s
 * @var string[]|\Cake\Collection\CollectionInterface $articles
 * @var string[]|\Cake\Collection\CollectionInterface $unites
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $lignedemandeclient->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $lignedemandeclient->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Lignedemandeclients'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="lignedemandeclients form content">
            <?= $this->Form->create($lignedemandeclient) ?>
            <fieldset>
                <legend><?= __('Edit Lignedemandeclient') ?></legend>
                <?php
                    echo $this->Form->control('demandeclient_id', ['options' => $demandeclients, 'empty' => true]);
                    echo $this->Form->control('numboite');
                    echo $this->Form->control('famille_id', ['options' => $familles, 'empty' => true]);
                    echo $this->Form->control('sousfamille1_id', ['options' => $sousfamille1s, 'empty' => true]);
                    echo $this->Form->control('article_id', ['options' => $articles, 'empty' => true]);
                    echo $this->Form->control('qte');
                    echo $this->Form->control('unite_id', ['options' => $unites, 'empty' => true]);
                    echo $this->Form->control('exigence');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
