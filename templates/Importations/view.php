<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Importation $importation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Importation'), ['action' => 'edit', $importation->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Importation'), ['action' => 'delete', $importation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $importation->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Importations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Importation'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="importations view content">
            <h3><?= h($importation->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($importation->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Numero') ?></th>
                    <td><?= h($importation->numero) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fournisseur') ?></th>
                    <td><?= $importation->has('fournisseur') ? $this->Html->link($importation->fournisseur->name, ['controller' => 'Fournisseurs', 'action' => 'view', $importation->fournisseur->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Devise') ?></th>
                    <td><?= $importation->has('devise') ? $this->Html->link($importation->devise->name, ['controller' => 'Devises', 'action' => 'view', $importation->devise->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($importation->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Montantachat') ?></th>
                    <td><?= $importation->montantachat === null ? '' : $this->Number->format($importation->montantachat) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tauxderechenge') ?></th>
                    <td><?= $importation->tauxderechenge === null ? '' : $this->Number->format($importation->tauxderechenge) ?></td>
                </tr>
                <tr>
                    <th><?= __('Prixachat') ?></th>
                    <td><?= $importation->prixachat === null ? '' : $this->Number->format($importation->prixachat) ?></td>
                </tr>
                <tr>
                    <th><?= __('Avis') ?></th>
                    <td><?= $importation->avis === null ? '' : $this->Number->format($importation->avis) ?></td>
                </tr>
                <tr>
                    <th><?= __('Transitaire') ?></th>
                    <td><?= $importation->transitaire === null ? '' : $this->Number->format($importation->transitaire) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ddttva') ?></th>
                    <td><?= $importation->ddttva === null ? '' : $this->Number->format($importation->ddttva) ?></td>
                </tr>
                <tr>
                    <th><?= __('Assurence') ?></th>
                    <td><?= $importation->assurence === null ? '' : $this->Number->format($importation->assurence) ?></td>
                </tr>
                <tr>
                    <th><?= __('Divers') ?></th>
                    <td><?= $importation->divers === null ? '' : $this->Number->format($importation->divers) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fraisfinancie') ?></th>
                    <td><?= $importation->fraisfinancie === null ? '' : $this->Number->format($importation->fraisfinancie) ?></td>
                </tr>
                <tr>
                    <th><?= __('Magasinage') ?></th>
                    <td><?= $importation->magasinage === null ? '' : $this->Number->format($importation->magasinage) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fournisseuravis') ?></th>
                    <td><?= $importation->fournisseuravis === null ? '' : $this->Number->format($importation->fournisseuravis) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fournisseurtransitaire') ?></th>
                    <td><?= $importation->fournisseurtransitaire === null ? '' : $this->Number->format($importation->fournisseurtransitaire) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fournisseurddttva') ?></th>
                    <td><?= $importation->fournisseurddttva === null ? '' : $this->Number->format($importation->fournisseurddttva) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fournisseurassurence') ?></th>
                    <td><?= $importation->fournisseurassurence === null ? '' : $this->Number->format($importation->fournisseurassurence) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fournisseurdivers') ?></th>
                    <td><?= $importation->fournisseurdivers === null ? '' : $this->Number->format($importation->fournisseurdivers) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fournisseurfraisfinancie') ?></th>
                    <td><?= $importation->fournisseurfraisfinancie === null ? '' : $this->Number->format($importation->fournisseurfraisfinancie) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fournisseurmagasinage') ?></th>
                    <td><?= $importation->fournisseurmagasinage === null ? '' : $this->Number->format($importation->fournisseurmagasinage) ?></td>
                </tr>
                <tr>
                    <th><?= __('Totale') ?></th>
                    <td><?= $importation->totale === null ? '' : $this->Number->format($importation->totale) ?></td>
                </tr>
                <tr>
                    <th><?= __('Coefficien') ?></th>
                    <td><?= $importation->coefficien === null ? '' : $this->Number->format($importation->coefficien) ?></td>
                </tr>
                <tr>
                    <th><?= __('Coeff') ?></th>
                    <td><?= $importation->coeff === null ? '' : $this->Number->format($importation->coeff) ?></td>
                </tr>
                <tr>
                    <th><?= __('Etat') ?></th>
                    <td><?= $this->Number->format($importation->etat) ?></td>
                </tr>
                <tr>
                    <th><?= __('Situation Id') ?></th>
                    <td><?= $importation->situation_id === null ? '' : $this->Number->format($importation->situation_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Coefficientchoisi') ?></th>
                    <td><?= $importation->Coefficientchoisi === null ? '' : $this->Number->format($importation->Coefficientchoisi) ?></td>
                </tr>
                <tr>
                    <th><?= __('Regler') ?></th>
                    <td><?= $importation->regler === null ? '' : $this->Number->format($importation->regler) ?></td>
                </tr>
                <tr>
                    <th><?= __('Facturer') ?></th>
                    <td><?= $importation->facturer === null ? '' : $this->Number->format($importation->facturer) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($importation->date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dateliv') ?></th>
                    <td><?= h($importation->dateliv) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Piecereglements') ?></h4>
                <?php if (!empty($importation->piecereglements)) : ?>
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
                        <?php foreach ($importation->piecereglements as $piecereglements) : ?>
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
            <div class="related">
                <h4><?= __('Related Reglements') ?></h4>
                <?php if (!empty($importation->reglements)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Numeroconca') ?></th>
                            <th><?= __('Fournisseur Id') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Montant') ?></th>
                            <th><?= __('Importation Id') ?></th>
                            <th><?= __('Montantdevise') ?></th>
                            <th><?= __('Libre') ?></th>
                            <th><?= __('Utilisateur Id') ?></th>
                            <th><?= __('Exercice Id') ?></th>
                            <th><?= __('Designation') ?></th>
                            <th><?= __('Impaye') ?></th>
                            <th><?= __('Differance') ?></th>
                            <th><?= __('Numeropieceintegre') ?></th>
                            <th><?= __('RG NO') ?></th>
                            <th><?= __('Devise Id') ?></th>
                            <th><?= __('Taux') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($importation->reglements as $reglements) : ?>
                        <tr>
                            <td><?= h($reglements->id) ?></td>
                            <td><?= h($reglements->numeroconca) ?></td>
                            <td><?= h($reglements->fournisseur_id) ?></td>
                            <td><?= h($reglements->Date) ?></td>
                            <td><?= h($reglements->Montant) ?></td>
                            <td><?= h($reglements->importation_id) ?></td>
                            <td><?= h($reglements->montantdevise) ?></td>
                            <td><?= h($reglements->libre) ?></td>
                            <td><?= h($reglements->utilisateur_id) ?></td>
                            <td><?= h($reglements->exercice_id) ?></td>
                            <td><?= h($reglements->designation) ?></td>
                            <td><?= h($reglements->impaye) ?></td>
                            <td><?= h($reglements->differance) ?></td>
                            <td><?= h($reglements->numeropieceintegre) ?></td>
                            <td><?= h($reglements->RG_NO) ?></td>
                            <td><?= h($reglements->devise_id) ?></td>
                            <td><?= h($reglements->taux) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Reglements', 'action' => 'view', $reglements->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Reglements', 'action' => 'edit', $reglements->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reglements', 'action' => 'delete', $reglements->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reglements->id)]) ?>
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
