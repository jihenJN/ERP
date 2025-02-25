<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Piecereglement[]|\Cake\Collection\CollectionInterface $piecereglements
 */
?>
<div class="piecereglements index content">
    <?= $this->Html->link(__('New Piecereglement'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Piecereglements') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('paiement_id') ?></th>
                    <th><?= $this->Paginator->sort('reglement_id') ?></th>
                    <th><?= $this->Paginator->sort('montant') ?></th>
                    <th><?= $this->Paginator->sort('intericecredit') ?></th>
                    <th><?= $this->Paginator->sort('date') ?></th>
                    <th><?= $this->Paginator->sort('carnetcheque_id') ?></th>
                    <th><?= $this->Paginator->sort('cheque_id') ?></th>
                    <th><?= $this->Paginator->sort('num') ?></th>
                    <th><?= $this->Paginator->sort('echance') ?></th>
                    <th><?= $this->Paginator->sort('compte_id') ?></th>
                    <th><?= $this->Paginator->sort('montant_brut') ?></th>
                    <th><?= $this->Paginator->sort('montant_net') ?></th>
                    <th><?= $this->Paginator->sort('to_id') ?></th>
                    <th><?= $this->Paginator->sort('societe_id') ?></th>
                    <th><?= $this->Paginator->sort('situation') ?></th>
                    <th><?= $this->Paginator->sort('numeroachat') ?></th>
                    <th><?= $this->Paginator->sort('importation_id') ?></th>
                    <th><?= $this->Paginator->sort('montantdevise') ?></th>
                    <th><?= $this->Paginator->sort('nbrmoins') ?></th>
                    <th><?= $this->Paginator->sort('etatpiecereglement_id') ?></th>
                    <th><?= $this->Paginator->sort('traitecredit_id') ?></th>
                    <th><?= $this->Paginator->sort('reglefournisseur') ?></th>
                    <th><?= $this->Paginator->sort('credit') ?></th>
                    <th><?= $this->Paginator->sort('montantfrs') ?></th>
                    <th><?= $this->Paginator->sort('impaye_regler') ?></th>
                    <th><?= $this->Paginator->sort('numeropieceintegre') ?></th>
                    <th><?= $this->Paginator->sort('fournisseur_id') ?></th>
                    <th><?= $this->Paginator->sort('RG_Cours') ?></th>
                    <th><?= $this->Paginator->sort('RG_MontantDev') ?></th>
                    <th><?= $this->Paginator->sort('prop') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($piecereglements as $piecereglement): ?>
                <tr>
                    <td><?= $this->Number->format($piecereglement->id) ?></td>
                    <td><?= $piecereglement->has('paiement') ? $this->Html->link($piecereglement->paiement->name, ['controller' => 'Paiements', 'action' => 'view', $piecereglement->paiement->id]) : '' ?></td>
                    <td><?= $piecereglement->has('reglement') ? $this->Html->link($piecereglement->reglement->id, ['controller' => 'Reglements', 'action' => 'view', $piecereglement->reglement->id]) : '' ?></td>
                    <td><?= $piecereglement->montant === null ? '' : $this->Number->format($piecereglement->montant) ?></td>
                    <td><?= $piecereglement->intericecredit === null ? '' : $this->Number->format($piecereglement->intericecredit) ?></td>
                    <td><?= h($piecereglement->date) ?></td>
                    <td><?= $piecereglement->carnetcheque_id === null ? '' : $this->Number->format($piecereglement->carnetcheque_id) ?></td>
                    <td><?= $piecereglement->cheque_id === null ? '' : $this->Number->format($piecereglement->cheque_id) ?></td>
                    <td><?= h($piecereglement->num) ?></td>
                    <td><?= h($piecereglement->echance) ?></td>
                    <td><?= $piecereglement->compte_id === null ? '' : $this->Number->format($piecereglement->compte_id) ?></td>
                    <td><?= $piecereglement->montant_brut === null ? '' : $this->Number->format($piecereglement->montant_brut) ?></td>
                    <td><?= $piecereglement->montant_net === null ? '' : $this->Number->format($piecereglement->montant_net) ?></td>
                    <td><?= $piecereglement->to_id === null ? '' : $this->Number->format($piecereglement->to_id) ?></td>
                    <td><?= $piecereglement->has('societe') ? $this->Html->link($piecereglement->societe->id, ['controller' => 'Societes', 'action' => 'view', $piecereglement->societe->id]) : '' ?></td>
                    <td><?= h($piecereglement->situation) ?></td>
                    <td><?= h($piecereglement->numeroachat) ?></td>
                    <td><?= $this->Number->format($piecereglement->importation_id) ?></td>
                    <td><?= $piecereglement->montantdevise === null ? '' : $this->Number->format($piecereglement->montantdevise) ?></td>
                    <td><?= h($piecereglement->nbrmoins) ?></td>
                    <td><?= $piecereglement->etatpiecereglement_id === null ? '' : $this->Number->format($piecereglement->etatpiecereglement_id) ?></td>
                    <td><?= $piecereglement->traitecredit_id === null ? '' : $this->Number->format($piecereglement->traitecredit_id) ?></td>
                    <td><?= $piecereglement->reglefournisseur === null ? '' : $this->Number->format($piecereglement->reglefournisseur) ?></td>
                    <td><?= $piecereglement->credit === null ? '' : $this->Number->format($piecereglement->credit) ?></td>
                    <td><?= $piecereglement->montantfrs === null ? '' : $this->Number->format($piecereglement->montantfrs) ?></td>
                    <td><?= $piecereglement->impaye_regler === null ? '' : $this->Number->format($piecereglement->impaye_regler) ?></td>
                    <td><?= h($piecereglement->numeropieceintegre) ?></td>
                    <td><?= $piecereglement->has('fournisseur') ? $this->Html->link($piecereglement->fournisseur->name, ['controller' => 'Fournisseurs', 'action' => 'view', $piecereglement->fournisseur->id]) : '' ?></td>
                    <td><?= $piecereglement->RG_Cours === null ? '' : $this->Number->format($piecereglement->RG_Cours) ?></td>
                    <td><?= $piecereglement->RG_MontantDev === null ? '' : $this->Number->format($piecereglement->RG_MontantDev) ?></td>
                    <td><?= h($piecereglement->prop) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $piecereglement->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $piecereglement->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $piecereglement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $piecereglement->id)]) ?>
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
