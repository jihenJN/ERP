<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Piecereglement $piecereglement
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Piecereglement'), ['action' => 'edit', $piecereglement->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Piecereglement'), ['action' => 'delete', $piecereglement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $piecereglement->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Piecereglements'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Piecereglement'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="piecereglements view content">
            <h3><?= h($piecereglement->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Paiement') ?></th>
                    <td><?= $piecereglement->has('paiement') ? $this->Html->link($piecereglement->paiement->name, ['controller' => 'Paiements', 'action' => 'view', $piecereglement->paiement->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Reglement') ?></th>
                    <td><?= $piecereglement->has('reglement') ? $this->Html->link($piecereglement->reglement->id, ['controller' => 'Reglements', 'action' => 'view', $piecereglement->reglement->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Num') ?></th>
                    <td><?= h($piecereglement->num) ?></td>
                </tr>
                <tr>
                    <th><?= __('Societe') ?></th>
                    <td><?= $piecereglement->has('societe') ? $this->Html->link($piecereglement->societe->id, ['controller' => 'Societes', 'action' => 'view', $piecereglement->societe->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Situation') ?></th>
                    <td><?= h($piecereglement->situation) ?></td>
                </tr>
                <tr>
                    <th><?= __('Numeroachat') ?></th>
                    <td><?= h($piecereglement->numeroachat) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nbrmoins') ?></th>
                    <td><?= h($piecereglement->nbrmoins) ?></td>
                </tr>
                <tr>
                    <th><?= __('Numeropieceintegre') ?></th>
                    <td><?= h($piecereglement->numeropieceintegre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fournisseur') ?></th>
                    <td><?= $piecereglement->has('fournisseur') ? $this->Html->link($piecereglement->fournisseur->name, ['controller' => 'Fournisseurs', 'action' => 'view', $piecereglement->fournisseur->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Prop') ?></th>
                    <td><?= h($piecereglement->prop) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($piecereglement->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Montant') ?></th>
                    <td><?= $piecereglement->montant === null ? '' : $this->Number->format($piecereglement->montant) ?></td>
                </tr>
                <tr>
                    <th><?= __('Intericecredit') ?></th>
                    <td><?= $piecereglement->intericecredit === null ? '' : $this->Number->format($piecereglement->intericecredit) ?></td>
                </tr>
                <tr>
                    <th><?= __('Carnetcheque Id') ?></th>
                    <td><?= $piecereglement->carnetcheque_id === null ? '' : $this->Number->format($piecereglement->carnetcheque_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cheque Id') ?></th>
                    <td><?= $piecereglement->cheque_id === null ? '' : $this->Number->format($piecereglement->cheque_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Compte Id') ?></th>
                    <td><?= $piecereglement->compte_id === null ? '' : $this->Number->format($piecereglement->compte_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Montant Brut') ?></th>
                    <td><?= $piecereglement->montant_brut === null ? '' : $this->Number->format($piecereglement->montant_brut) ?></td>
                </tr>
                <tr>
                    <th><?= __('Montant Net') ?></th>
                    <td><?= $piecereglement->montant_net === null ? '' : $this->Number->format($piecereglement->montant_net) ?></td>
                </tr>
                <tr>
                    <th><?= __('To Id') ?></th>
                    <td><?= $piecereglement->to_id === null ? '' : $this->Number->format($piecereglement->to_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Importation Id') ?></th>
                    <td><?= $this->Number->format($piecereglement->importation_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Montantdevise') ?></th>
                    <td><?= $piecereglement->montantdevise === null ? '' : $this->Number->format($piecereglement->montantdevise) ?></td>
                </tr>
                <tr>
                    <th><?= __('Etatpiecereglement Id') ?></th>
                    <td><?= $piecereglement->etatpiecereglement_id === null ? '' : $this->Number->format($piecereglement->etatpiecereglement_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Traitecredit Id') ?></th>
                    <td><?= $piecereglement->traitecredit_id === null ? '' : $this->Number->format($piecereglement->traitecredit_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Reglefournisseur') ?></th>
                    <td><?= $piecereglement->reglefournisseur === null ? '' : $this->Number->format($piecereglement->reglefournisseur) ?></td>
                </tr>
                <tr>
                    <th><?= __('Credit') ?></th>
                    <td><?= $piecereglement->credit === null ? '' : $this->Number->format($piecereglement->credit) ?></td>
                </tr>
                <tr>
                    <th><?= __('Montantfrs') ?></th>
                    <td><?= $piecereglement->montantfrs === null ? '' : $this->Number->format($piecereglement->montantfrs) ?></td>
                </tr>
                <tr>
                    <th><?= __('Impaye Regler') ?></th>
                    <td><?= $piecereglement->impaye_regler === null ? '' : $this->Number->format($piecereglement->impaye_regler) ?></td>
                </tr>
                <tr>
                    <th><?= __('RG Cours') ?></th>
                    <td><?= $piecereglement->RG_Cours === null ? '' : $this->Number->format($piecereglement->RG_Cours) ?></td>
                </tr>
                <tr>
                    <th><?= __('RG MontantDev') ?></th>
                    <td><?= $piecereglement->RG_MontantDev === null ? '' : $this->Number->format($piecereglement->RG_MontantDev) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($piecereglement->date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Echance') ?></th>
                    <td><?= h($piecereglement->echance) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Lignereglements') ?></h4>
                <?php if (!empty($piecereglement->lignereglements)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Reglement Id') ?></th>
                            <th><?= __('Montant') ?></th>
                            <th><?= __('Facture Id') ?></th>
                            <th><?= __('Tauxchange') ?></th>
                            <th><?= __('Piecereglement Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($piecereglement->lignereglements as $lignereglements) : ?>
                        <tr>
                            <td><?= h($lignereglements->id) ?></td>
                            <td><?= h($lignereglements->reglement_id) ?></td>
                            <td><?= h($lignereglements->Montant) ?></td>
                            <td><?= h($lignereglements->facture_id) ?></td>
                            <td><?= h($lignereglements->tauxchange) ?></td>
                            <td><?= h($lignereglements->piecereglement_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Lignereglements', 'action' => 'view', $lignereglements->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Lignereglements', 'action' => 'edit', $lignereglements->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Lignereglements', 'action' => 'delete', $lignereglements->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignereglements->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
