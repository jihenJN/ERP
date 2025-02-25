<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Lignebonderetoure> $lignebonderetoures
 */
?>
<div class="lignebonderetoures index content">
    <?= $this->Html->link(__('New Lignebonderetoure'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Lignebonderetoures') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('article_id') ?></th>
                    <th><?= $this->Paginator->sort('qte') ?></th>
                    <th><?= $this->Paginator->sort('qtestock') ?></th>
                    <th><?= $this->Paginator->sort('bonderetoure_id') ?></th>
                    <th><?= $this->Paginator->sort('couleur_id') ?></th>
                    <th><?= $this->Paginator->sort('dimension_id') ?></th>
                    <th><?= $this->Paginator->sort('categorie_id') ?></th>
                    <th><?= $this->Paginator->sort('famille_id') ?></th>
                    <th><?= $this->Paginator->sort('sousfamille1_id') ?></th>
                    <th><?= $this->Paginator->sort('sousfamille2_id') ?></th>
                    <th><?= $this->Paginator->sort('unite_id') ?></th>
                    <th><?= $this->Paginator->sort('tva_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lignebonderetoures as $lignebonderetoure): ?>
                <tr>
                    <td><?= $this->Number->format($lignebonderetoure->id) ?></td>
                    <td><?= $this->Number->format($lignebonderetoure->article_id) ?></td>
                    <td><?= $this->Number->format($lignebonderetoure->qte) ?></td>
                    <td><?= $this->Number->format($lignebonderetoure->qtestock) ?></td>
                    <td><?= $lignebonderetoure->has('bonderetoure') ? $this->Html->link($lignebonderetoure->bonderetoure->id, ['controller' => 'Bonderetoures', 'action' => 'view', $lignebonderetoure->bonderetoure->id]) : '' ?></td>
                    <td><?= $lignebonderetoure->couleur_id === null ? '' : $this->Number->format($lignebonderetoure->couleur_id) ?></td>
                    <td><?= $lignebonderetoure->dimension_id === null ? '' : $this->Number->format($lignebonderetoure->dimension_id) ?></td>
                    <td><?= $lignebonderetoure->categorie_id === null ? '' : $this->Number->format($lignebonderetoure->categorie_id) ?></td>
                    <td><?= $lignebonderetoure->famille_id === null ? '' : $this->Number->format($lignebonderetoure->famille_id) ?></td>
                    <td><?= $lignebonderetoure->sousfamille1_id === null ? '' : $this->Number->format($lignebonderetoure->sousfamille1_id) ?></td>
                    <td><?= $lignebonderetoure->sousfamille2_id === null ? '' : $this->Number->format($lignebonderetoure->sousfamille2_id) ?></td>
                    <td><?= $lignebonderetoure->unite_id === null ? '' : $this->Number->format($lignebonderetoure->unite_id) ?></td>
                    <td><?= $lignebonderetoure->tva_id === null ? '' : $this->Number->format($lignebonderetoure->tva_id) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $lignebonderetoure->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lignebonderetoure->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lignebonderetoure->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignebonderetoure->id)]) ?>
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
