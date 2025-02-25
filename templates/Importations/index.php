<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Importation[]|\Cake\Collection\CollectionInterface $importations
 */
?>
<div class="importations index content">
    <?= $this->Html->link(__('New Importation'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Importations') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('numero') ?></th>
                    <th><?= $this->Paginator->sort('date') ?></th>
                    <th><?= $this->Paginator->sort('dateliv') ?></th>
                    <th><?= $this->Paginator->sort('fournisseur_id') ?></th>
                    <th><?= $this->Paginator->sort('devise_id') ?></th>
                    <th><?= $this->Paginator->sort('montantachat') ?></th>
                    <th><?= $this->Paginator->sort('tauxderechenge') ?></th>
                    <th><?= $this->Paginator->sort('prixachat') ?></th>
                    <th><?= $this->Paginator->sort('avis') ?></th>
                    <th><?= $this->Paginator->sort('transitaire') ?></th>
                    <th><?= $this->Paginator->sort('ddttva') ?></th>
                    <th><?= $this->Paginator->sort('assurence') ?></th>
                    <th><?= $this->Paginator->sort('divers') ?></th>
                    <th><?= $this->Paginator->sort('fraisfinancie') ?></th>
                    <th><?= $this->Paginator->sort('magasinage') ?></th>
                    <th><?= $this->Paginator->sort('fournisseuravis') ?></th>
                    <th><?= $this->Paginator->sort('fournisseurtransitaire') ?></th>
                    <th><?= $this->Paginator->sort('fournisseurddttva') ?></th>
                    <th><?= $this->Paginator->sort('fournisseurassurence') ?></th>
                    <th><?= $this->Paginator->sort('fournisseurdivers') ?></th>
                    <th><?= $this->Paginator->sort('fournisseurfraisfinancie') ?></th>
                    <th><?= $this->Paginator->sort('fournisseurmagasinage') ?></th>
                    <th><?= $this->Paginator->sort('totale') ?></th>
                    <th><?= $this->Paginator->sort('coefficien') ?></th>
                    <th><?= $this->Paginator->sort('coeff') ?></th>
                    <th><?= $this->Paginator->sort('etat') ?></th>
                    <th><?= $this->Paginator->sort('situation_id') ?></th>
                    <th><?= $this->Paginator->sort('Coefficientchoisi') ?></th>
                    <th><?= $this->Paginator->sort('regler') ?></th>
                    <th><?= $this->Paginator->sort('facturer') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($importations as $importation): ?>
                <tr>
                    <td><?= $this->Number->format($importation->id) ?></td>
                    <td><?= h($importation->name) ?></td>
                    <td><?= h($importation->numero) ?></td>
                    <td><?= h($importation->date) ?></td>
                    <td><?= h($importation->dateliv) ?></td>
                    <td><?= $importation->has('fournisseur') ? $this->Html->link($importation->fournisseur->name, ['controller' => 'Fournisseurs', 'action' => 'view', $importation->fournisseur->id]) : '' ?></td>
                    <td><?= $importation->has('devise') ? $this->Html->link($importation->devise->name, ['controller' => 'Devises', 'action' => 'view', $importation->devise->id]) : '' ?></td>
                    <td><?= $importation->montantachat === null ? '' : $this->Number->format($importation->montantachat) ?></td>
                    <td><?= $importation->tauxderechenge === null ? '' : $this->Number->format($importation->tauxderechenge) ?></td>
                    <td><?= $importation->prixachat === null ? '' : $this->Number->format($importation->prixachat) ?></td>
                    <td><?= $importation->avis === null ? '' : $this->Number->format($importation->avis) ?></td>
                    <td><?= $importation->transitaire === null ? '' : $this->Number->format($importation->transitaire) ?></td>
                    <td><?= $importation->ddttva === null ? '' : $this->Number->format($importation->ddttva) ?></td>
                    <td><?= $importation->assurence === null ? '' : $this->Number->format($importation->assurence) ?></td>
                    <td><?= $importation->divers === null ? '' : $this->Number->format($importation->divers) ?></td>
                    <td><?= $importation->fraisfinancie === null ? '' : $this->Number->format($importation->fraisfinancie) ?></td>
                    <td><?= $importation->magasinage === null ? '' : $this->Number->format($importation->magasinage) ?></td>
                    <td><?= $importation->fournisseuravis === null ? '' : $this->Number->format($importation->fournisseuravis) ?></td>
                    <td><?= $importation->fournisseurtransitaire === null ? '' : $this->Number->format($importation->fournisseurtransitaire) ?></td>
                    <td><?= $importation->fournisseurddttva === null ? '' : $this->Number->format($importation->fournisseurddttva) ?></td>
                    <td><?= $importation->fournisseurassurence === null ? '' : $this->Number->format($importation->fournisseurassurence) ?></td>
                    <td><?= $importation->fournisseurdivers === null ? '' : $this->Number->format($importation->fournisseurdivers) ?></td>
                    <td><?= $importation->fournisseurfraisfinancie === null ? '' : $this->Number->format($importation->fournisseurfraisfinancie) ?></td>
                    <td><?= $importation->fournisseurmagasinage === null ? '' : $this->Number->format($importation->fournisseurmagasinage) ?></td>
                    <td><?= $importation->totale === null ? '' : $this->Number->format($importation->totale) ?></td>
                    <td><?= $importation->coefficien === null ? '' : $this->Number->format($importation->coefficien) ?></td>
                    <td><?= $importation->coeff === null ? '' : $this->Number->format($importation->coeff) ?></td>
                    <td><?= $this->Number->format($importation->etat) ?></td>
                    <td><?= $importation->situation_id === null ? '' : $this->Number->format($importation->situation_id) ?></td>
                    <td><?= $importation->Coefficientchoisi === null ? '' : $this->Number->format($importation->Coefficientchoisi) ?></td>
                    <td><?= $importation->regler === null ? '' : $this->Number->format($importation->regler) ?></td>
                    <td><?= $importation->facturer === null ? '' : $this->Number->format($importation->facturer) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $importation->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $importation->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $importation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $importation->id)]) ?>
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
