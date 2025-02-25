<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Lignedemandeclient> $lignedemandeclients
 */
?>
<div class="lignedemandeclients index content">
    <?= $this->Html->link(__('New Lignedemandeclient'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Lignedemandeclients') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('demandeclient_id') ?></th>
                    <th><?= $this->Paginator->sort('numboite') ?></th>
                    <th><?= $this->Paginator->sort('famille_id') ?></th>
                    <th><?= $this->Paginator->sort('sousfamille1_id') ?></th>
                    <th><?= $this->Paginator->sort('article_id') ?></th>
                    <th><?= $this->Paginator->sort('qte') ?></th>
                    <th><?= $this->Paginator->sort('unite_id') ?></th>
                    <th><?= $this->Paginator->sort('exigence') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lignedemandeclients as $lignedemandeclient): ?>
                <tr>
                    <td><?= $this->Number->format($lignedemandeclient->id) ?></td>
                    <td><?= $lignedemandeclient->has('demandeclient') ? $this->Html->link($lignedemandeclient->demandeclient->id, ['controller' => 'Demandeclients', 'action' => 'view', $lignedemandeclient->demandeclient->id]) : '' ?></td>
                    <td><?= h($lignedemandeclient->numboite) ?></td>
                    <td><?= $lignedemandeclient->has('famille') ? $this->Html->link($lignedemandeclient->famille->id, ['controller' => 'Familles', 'action' => 'view', $lignedemandeclient->famille->id]) : '' ?></td>
                    <td><?= $lignedemandeclient->has('sousfamille1') ? $this->Html->link($lignedemandeclient->sousfamille1->name, ['controller' => 'Sousfamille1s', 'action' => 'view', $lignedemandeclient->sousfamille1->id]) : '' ?></td>
                    <td><?= $lignedemandeclient->has('article') ? $this->Html->link($lignedemandeclient->article->codeabarre, ['controller' => 'Articles', 'action' => 'view', $lignedemandeclient->article->id]) : '' ?></td>
                    <td><?= $lignedemandeclient->qte === null ? '' : $this->Number->format($lignedemandeclient->qte) ?></td>
                    <td><?= $lignedemandeclient->has('unite') ? $this->Html->link($lignedemandeclient->unite->name, ['controller' => 'Unites', 'action' => 'view', $lignedemandeclient->unite->id]) : '' ?></td>
                    <td><?= h($lignedemandeclient->exigence) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $lignedemandeclient->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lignedemandeclient->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lignedemandeclient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignedemandeclient->id)]) ?>
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
