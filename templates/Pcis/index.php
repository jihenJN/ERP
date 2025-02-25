<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Pci> $pcis
 */
?>
<div class="pcis index content">
    <?= $this->Html->link(__('New Pci'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Pcis') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('designation') ?></th>
                    <th><?= $this->Paginator->sort('qtedisp') ?></th>
                    <th><?= $this->Paginator->sort('qtenonliv') ?></th>
                    <th><?= $this->Paginator->sort('qtetheo') ?></th>
                    <th><?= $this->Paginator->sort('stockminart') ?></th>
                    <th><?= $this->Paginator->sort('qtevendu') ?></th>
                    <th><?= $this->Paginator->sort('qteliv') ?></th>
                    <th><?= $this->Paginator->sort('besoin') ?></th>
                    <th><?= $this->Paginator->sort('qtenoncloture') ?></th>
                    <th><?= $this->Paginator->sort('besoinprodtheoperiode') ?></th>
                    <th><?= $this->Paginator->sort('qtprodpratique') ?></th>
                    <th><?= $this->Paginator->sort('lancerpdp') ?></th>
                    <th><?= $this->Paginator->sort('rang') ?></th>
                    <th><?= $this->Paginator->sort('ventem1') ?></th>
                    <th><?= $this->Paginator->sort('qtem1') ?></th>
                    <th><?= $this->Paginator->sort('ventem2') ?></th>
                    <th><?= $this->Paginator->sort('qtem2') ?></th>
                    <th><?= $this->Paginator->sort('ventem3') ?></th>
                    <th><?= $this->Paginator->sort('qtem3') ?></th>
                    <th><?= $this->Paginator->sort('article_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pcis as $pci): ?>
                <tr>
                    <td><?= $this->Number->format($pci->id) ?></td>
                    <td><?= h($pci->designation) ?></td>
                    <td><?= $pci->qtedisp === null ? '' : $this->Number->format($pci->qtedisp) ?></td>
                    <td><?= $pci->qtenonliv === null ? '' : $this->Number->format($pci->qtenonliv) ?></td>
                    <td><?= $pci->qtetheo === null ? '' : $this->Number->format($pci->qtetheo) ?></td>
                    <td><?= $pci->stockminart === null ? '' : $this->Number->format($pci->stockminart) ?></td>
                    <td><?= $pci->qtevendu === null ? '' : $this->Number->format($pci->qtevendu) ?></td>
                    <td><?= $pci->qteliv === null ? '' : $this->Number->format($pci->qteliv) ?></td>
                    <td><?= $pci->besoin === null ? '' : $this->Number->format($pci->besoin) ?></td>
                    <td><?= $pci->qtenoncloture === null ? '' : $this->Number->format($pci->qtenoncloture) ?></td>
                    <td><?= $pci->besoinprodtheoperiode === null ? '' : $this->Number->format($pci->besoinprodtheoperiode) ?></td>
                    <td><?= $pci->qtprodpratique === null ? '' : $this->Number->format($pci->qtprodpratique) ?></td>
                    <td><?= h($pci->lancerpdp) ?></td>
                    <td><?= $pci->rang === null ? '' : $this->Number->format($pci->rang) ?></td>
                    <td><?= $pci->ventem1 === null ? '' : $this->Number->format($pci->ventem1) ?></td>
                    <td><?= $pci->qtem1 === null ? '' : $this->Number->format($pci->qtem1) ?></td>
                    <td><?= $pci->ventem2 === null ? '' : $this->Number->format($pci->ventem2) ?></td>
                    <td><?= $pci->qtem2 === null ? '' : $this->Number->format($pci->qtem2) ?></td>
                    <td><?= $pci->ventem3 === null ? '' : $this->Number->format($pci->ventem3) ?></td>
                    <td><?= $pci->qtem3 === null ? '' : $this->Number->format($pci->qtem3) ?></td>
                    <td><?= $pci->has('article') ? $this->Html->link($pci->article->id, ['controller' => 'Articles', 'action' => 'view', $pci->article->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $pci->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pci->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pci->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pci->id)]) ?>
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
