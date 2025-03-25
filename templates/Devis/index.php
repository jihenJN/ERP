<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Devi> $devis
 */
?>
<div class="devis index content">
    <?= $this->Html->link(__('New Devi'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Devis') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('numero') ?></th>
                    <th><?= $this->Paginator->sort('date') ?></th>
                    <th><?= $this->Paginator->sort('client_id') ?></th>
                    <th><?= $this->Paginator->sort('total_remise') ?></th>
                    <th><?= $this->Paginator->sort('total_ht') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($devis as $devi): ?>
                <tr>
                    <td><?= $this->Number->format($devi->id) ?></td>
                    <td><?= h($devi->numero) ?></td>
                    <td><?= h($devi->date) ?></td>
                    <td><?= $devi->has('client') ? $this->Html->link($devi->client->name, ['controller' => 'Clients', 'action' => 'view', $devi->client->id]) : '' ?></td>
                    <td><?= $this->Number->format($devi->total_remise) ?></td>
                    <td><?= $this->Number->format($devi->total_ht) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $devi->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $devi->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $devi->id], ['confirm' => __('Are you sure you want to delete # {0}?', $devi->id)]) ?>
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
