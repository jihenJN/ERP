<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lignereglement $lignereglement
 * @var \Cake\Collection\CollectionInterface|string[] $reglements
 * @var \Cake\Collection\CollectionInterface|string[] $factures
 * @var \Cake\Collection\CollectionInterface|string[] $piecereglements
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Lignereglements'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="lignereglements form content">
            <?= $this->Form->create($lignereglement) ?>
            <fieldset>
                <legend><?= __('Add Lignereglement') ?></legend>
                <?php
                    echo $this->Form->control('reglement_id', ['options' => $reglements, 'empty' => true]);
                    echo $this->Form->control('Montant');
                    echo $this->Form->control('facture_id', ['options' => $factures, 'empty' => true]);
                    echo $this->Form->control('tauxchange');
                    echo $this->Form->control('piecereglement_id', ['options' => $piecereglements, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
