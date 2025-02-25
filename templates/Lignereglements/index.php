<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lignereglement[]|\Cake\Collection\CollectionInterface $lignereglements
 */
?>
<div class="lignereglements index content">
    <?= $this->Html->link(__('New Lignereglement'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Lignereglements') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('reglement_id') ?></th>
                    <th><?= $this->Paginator->sort('Montant') ?></th>
                    <th><?= $this->Paginator->sort('facture_id') ?></th>
                    <th><?= $this->Paginator->sort('tauxchange') ?></th>
                    <th><?= $this->Paginator->sort('piecereglement_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lignereglements as $lignereglement): ?>
                <tr>
                    <td><?= $this->Number->format($lignereglement->id) ?></td>
                    <td><?= $lignereglement->has('reglement') ? $this->Html->link($lignereglement->reglement->id, ['controller' => 'Reglements', 'action' => 'view', $lignereglement->reglement->id]) : '' ?></td>
                    <td><?= $lignereglement->Montant === null ? '' : $this->Number->format($lignereglement->Montant) ?></td>
                    <td><?= $lignereglement->has('facture') ? $this->Html->link($lignereglement->facture->id, ['controller' => 'Factures', 'action' => 'view', $lignereglement->facture->id]) : '' ?></td>
                    <td><?= $lignereglement->tauxchange === null ? '' : $this->Number->format($lignereglement->tauxchange) ?></td>
                    <td><?= $lignereglement->has('piecereglement') ? $this->Html->link($lignereglement->piecereglement->id, ['controller' => 'Piecereglements', 'action' => 'view', $lignereglement->piecereglement->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $lignereglement->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lignereglement->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lignereglement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignereglement->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
