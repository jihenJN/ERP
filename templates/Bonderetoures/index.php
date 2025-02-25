<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Bonderetoure> $bonderetoures
 */
?>
<div class="bonderetoures index content">
    <?= $this->Html->link(__('New Bonderetoure'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Bonderetoures') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('date') ?></th>
                    <th><?= $this->Paginator->sort('pointdevente_id') ?></th>
                    <th><?= $this->Paginator->sort('depot_id') ?></th>
                    <th><?= $this->Paginator->sort('numero') ?></th>
                    <th><?= $this->Paginator->sort('materieltransport_id') ?></th>
                    <th><?= $this->Paginator->sort('cartecarburant_id') ?></th>
                    <th><?= $this->Paginator->sort('conffaieur_id') ?></th>
                    <th><?= $this->Paginator->sort('chauffeur_id') ?></th>
                    <th><?= $this->Paginator->sort('kilometragedepart') ?></th>
                    <th><?= $this->Paginator->sort('kilometragearrive') ?></th>
                    <th><?= $this->Paginator->sort('poste') ?></th>
                    <th><?= $this->Paginator->sort('marque') ?></th>
                    <th><?= $this->Paginator->sort('serie') ?></th>
                    <th><?= $this->Paginator->sort('cin') ?></th>
                    <th><?= $this->Paginator->sort('chauffeur') ?></th>
                    <th><?= $this->Paginator->sort('fournisseur_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bonderetoures as $bonderetoure): ?>
                <tr>
                    <td><?= $this->Number->format($bonderetoure->id) ?></td>
                    <td><?= h($bonderetoure->date) ?></td>
                    <td><?= $bonderetoure->pointdevente_id === null ? '' : $this->Number->format($bonderetoure->pointdevente_id) ?></td>
                    <td><?= $bonderetoure->depot_id === null ? '' : $this->Number->format($bonderetoure->depot_id) ?></td>
                    <td><?= h($bonderetoure->numero) ?></td>
                    <td><?= $bonderetoure->materieltransport_id === null ? '' : $this->Number->format($bonderetoure->materieltransport_id) ?></td>
                    <td><?= $bonderetoure->cartecarburant_id === null ? '' : $this->Number->format($bonderetoure->cartecarburant_id) ?></td>
                    <td><?= $bonderetoure->conffaieur_id === null ? '' : $this->Number->format($bonderetoure->conffaieur_id) ?></td>
                    <td><?= $bonderetoure->chauffeur_id === null ? '' : $this->Number->format($bonderetoure->chauffeur_id) ?></td>
                    <td><?= $bonderetoure->kilometragedepart === null ? '' : $this->Number->format($bonderetoure->kilometragedepart) ?></td>
                    <td><?= $bonderetoure->kilometragearrive === null ? '' : $this->Number->format($bonderetoure->kilometragearrive) ?></td>
                    <td><?= $bonderetoure->poste === null ? '' : $this->Number->format($bonderetoure->poste) ?></td>
                    <td><?= h($bonderetoure->marque) ?></td>
                    <td><?= h($bonderetoure->serie) ?></td>
                    <td><?= h($bonderetoure->cin) ?></td>
                    <td><?= h($bonderetoure->chauffeur) ?></td>
                    <td><?= $bonderetoure->fournisseur_id === null ? '' : $this->Number->format($bonderetoure->fournisseur_id) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $bonderetoure->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bonderetoure->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bonderetoure->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bonderetoure->id)]) ?>
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
