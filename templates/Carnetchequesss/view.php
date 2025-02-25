<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Carnetcheque $carnetcheque
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Carnetcheque'), ['action' => 'edit', $carnetcheque->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Carnetcheque'), ['action' => 'delete', $carnetcheque->id], ['confirm' => __('Are you sure you want to delete # {0}?', $carnetcheque->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Carnetcheques'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Carnetcheque'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="carnetcheques view content">
            <h3><?= h($carnetcheque->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Numero') ?></th>
                    <td><?= h($carnetcheque->numero) ?></td>
                </tr>
                <tr>
                    <th><?= __('Compte') ?></th>
                    <td><?= $carnetcheque->has('compte') ? $this->Html->link($carnetcheque->compte->id, ['controller' => 'Comptes', 'action' => 'view', $carnetcheque->compte->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Debut') ?></th>
                    <td><?= h($carnetcheque->debut) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($carnetcheque->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre') ?></th>
                    <td><?= $carnetcheque->nombre === null ? '' : $this->Number->format($carnetcheque->nombre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Taille') ?></th>
                    <td><?= $carnetcheque->taille === null ? '' : $this->Number->format($carnetcheque->taille) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Piecereglements') ?></h4>
                <?php if (!empty($carnetcheque->piecereglements)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Paiement Id') ?></th>
                            <th><?= __('Reglement Id') ?></th>
                            <th><?= __('Montant') ?></th>
                            <th><?= __('Intericecredit') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Carnetcheque Id') ?></th>
                            <th><?= __('Cheque Id') ?></th>
                            <th><?= __('Num') ?></th>
                            <th><?= __('Echance') ?></th>
                            <th><?= __('Compte Id') ?></th>
                            <th><?= __('Montant Brut') ?></th>
                            <th><?= __('Montant Net') ?></th>
                            <th><?= __('To Id') ?></th>
                            <th><?= __('Societe Id') ?></th>
                            <th><?= __('Situation') ?></th>
                            <th><?= __('Numeroachat') ?></th>
                            <th><?= __('Importation Id') ?></th>
                            <th><?= __('Montantdevise') ?></th>
                            <th><?= __('Nbrmoins') ?></th>
                            <th><?= __('Etatpiecereglement Id') ?></th>
                            <th><?= __('Traitecredit Id') ?></th>
                            <th><?= __('Reglefournisseur') ?></th>
                            <th><?= __('Credit') ?></th>
                            <th><?= __('Montantfrs') ?></th>
                            <th><?= __('Impaye Regler') ?></th>
                            <th><?= __('Numeropieceintegre') ?></th>
                            <th><?= __('Fournisseur Id') ?></th>
                            <th><?= __('RG Cours') ?></th>
                            <th><?= __('RG MontantDev') ?></th>
                            <th><?= __('Prop') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($carnetcheque->piecereglements as $piecereglements) : ?>
                        <tr>
                            <td><?= h($piecereglements->id) ?></td>
                            <td><?= h($piecereglements->paiement_id) ?></td>
                            <td><?= h($piecereglements->reglement_id) ?></td>
                            <td><?= h($piecereglements->montant) ?></td>
                            <td><?= h($piecereglements->intericecredit) ?></td>
                            <td><?= h($piecereglements->date) ?></td>
                            <td><?= h($piecereglements->carnetcheque_id) ?></td>
                            <td><?= h($piecereglements->cheque_id) ?></td>
                            <td><?= h($piecereglements->num) ?></td>
                            <td><?= h($piecereglements->echance) ?></td>
                            <td><?= h($piecereglements->compte_id) ?></td>
                            <td><?= h($piecereglements->montant_brut) ?></td>
                            <td><?= h($piecereglements->montant_net) ?></td>
                            <td><?= h($piecereglements->to_id) ?></td>
                            <td><?= h($piecereglements->societe_id) ?></td>
                            <td><?= h($piecereglements->situation) ?></td>
                            <td><?= h($piecereglements->numeroachat) ?></td>
                            <td><?= h($piecereglements->importation_id) ?></td>
                            <td><?= h($piecereglements->montantdevise) ?></td>
                            <td><?= h($piecereglements->nbrmoins) ?></td>
                            <td><?= h($piecereglements->etatpiecereglement_id) ?></td>
                            <td><?= h($piecereglements->traitecredit_id) ?></td>
                            <td><?= h($piecereglements->reglefournisseur) ?></td>
                            <td><?= h($piecereglements->credit) ?></td>
                            <td><?= h($piecereglements->montantfrs) ?></td>
                            <td><?= h($piecereglements->impaye_regler) ?></td>
                            <td><?= h($piecereglements->numeropieceintegre) ?></td>
                            <td><?= h($piecereglements->fournisseur_id) ?></td>
                            <td><?= h($piecereglements->RG_Cours) ?></td>
                            <td><?= h($piecereglements->RG_MontantDev) ?></td>
                            <td><?= h($piecereglements->prop) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Piecereglements', 'action' => 'view', $piecereglements->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Piecereglements', 'action' => 'edit', $piecereglements->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Piecereglements', 'action' => 'delete', $piecereglements->id], ['confirm' => __('Are you sure you want to delete # {0}?', $piecereglements->id)]) ?>
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
