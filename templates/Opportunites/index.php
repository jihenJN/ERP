<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Opportunite> $opportunites
 */
?>
<div class="opportunites index content">
    <?= $this->Html->link(__('New Opportunite'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Opportunites') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($opportunites as $opportunite): ?>
                <tr>
                    <td><?= $this->Number->format($opportunite->id) ?></td>
                    <td><?= h($opportunite->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $opportunite->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $opportunite->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $opportunite->id], ['confirm' => __('Are you sure you want to delete # {0}?', $opportunite->id)]) ?>
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
