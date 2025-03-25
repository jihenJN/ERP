<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Lignedevi> $lignedevis
 */
?>
<div class="lignedevis index content">
    <?= $this->Html->link(__('New Lignedevi'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Lignedevis') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('prix') ?></th>
                    <th><?= $this->Paginator->sort('remise') ?></th>
                    <th><?= $this->Paginator->sort('ht') ?></th>
                    <th><?= $this->Paginator->sort('article_id') ?></th>
                    <th><?= $this->Paginator->sort('devis_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lignedevis as $lignedevi): ?>
                <tr>
                    <td><?= $this->Number->format($lignedevi->id) ?></td>
                    <td><?= $this->Number->format($lignedevi->prix) ?></td>
                    <td><?= $this->Number->format($lignedevi->remise) ?></td>
                    <td><?= $this->Number->format($lignedevi->ht) ?></td>
                    <td><?= $lignedevi->has('article') ? $this->Html->link($lignedevi->article->id, ['controller' => 'Articles', 'action' => 'view', $lignedevi->article->id]) : '' ?></td>
                    <td><?= $lignedevi->has('devi') ? $this->Html->link($lignedevi->devi->id, ['controller' => 'Devis', 'action' => 'view', $lignedevi->devi->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $lignedevi->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lignedevi->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lignedevi->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignedevi->id)]) ?>
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
