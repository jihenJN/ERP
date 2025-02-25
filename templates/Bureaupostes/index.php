<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bureauposte[]|\Cake\Collection\CollectionInterface $bureaupostes
 */
?>
<div class="bureaupostes index content">
    <?= $this->Html->link(__('New Bureauposte'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Bureaupostes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('gouvernorat_id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('codepostal') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bureaupostes as $bureauposte): ?>
                <tr>
                    <td><?= $this->Number->format($bureauposte->id) ?></td>
                    <td><?= $bureauposte->has('gouvernorat') ? $this->Html->link($bureauposte->gouvernorat->id, ['controller' => 'Gouvernorats', 'action' => 'view', $bureauposte->gouvernorat->id]) : '' ?></td>
                    <td><?= h($bureauposte->name) ?></td>
                    <td><?= h($bureauposte->codepostal) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $bureauposte->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bureauposte->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bureauposte->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bureauposte->id)]) ?>
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
