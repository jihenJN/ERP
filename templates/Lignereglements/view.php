<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lignereglement $lignereglement
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Lignereglement'), ['action' => 'edit', $lignereglement->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Lignereglement'), ['action' => 'delete', $lignereglement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignereglement->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Lignereglements'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Lignereglement'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="lignereglements view content">
            <h3><?= h($lignereglement->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Reglement') ?></th>
                    <td><?= $lignereglement->has('reglement') ? $this->Html->link($lignereglement->reglement->id, ['controller' => 'Reglements', 'action' => 'view', $lignereglement->reglement->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Facture') ?></th>
                    <td><?= $lignereglement->has('facture') ? $this->Html->link($lignereglement->facture->id, ['controller' => 'Factures', 'action' => 'view', $lignereglement->facture->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Piecereglement') ?></th>
                    <td><?= $lignereglement->has('piecereglement') ? $this->Html->link($lignereglement->piecereglement->id, ['controller' => 'Piecereglements', 'action' => 'view', $lignereglement->piecereglement->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($lignereglement->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Montant') ?></th>
                    <td><?= $lignereglement->Montant === null ? '' : $this->Number->format($lignereglement->Montant) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tauxchange') ?></th>
                    <td><?= $lignereglement->tauxchange === null ? '' : $this->Number->format($lignereglement->tauxchange) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
