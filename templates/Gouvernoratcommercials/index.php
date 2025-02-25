<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Gouvernoratcommercial[]|\Cake\Collection\CollectionInterface $gouvernoratcommercials
 */
?>
<div class="gouvernoratcommercials index content">
    <?= $this->Html->link(__('New Gouvernoratcommercial'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Gouvernoratcommercials') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('commercial_id') ?></th>
                    <th><?= $this->Paginator->sort('gouvernorat_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gouvernoratcommercials as $gouvernoratcommercial): ?>
                <tr>
                    <td><?= $this->Number->format($gouvernoratcommercial->id) ?></td>
                    <td><?= $gouvernoratcommercial->has('commercial') ? $this->Html->link($gouvernoratcommercial->commercial->name, ['controller' => 'Commercials', 'action' => 'view', $gouvernoratcommercial->commercial->id]) : '' ?></td>
                    <td><?= $gouvernoratcommercial->has('gouvernorat') ? $this->Html->link($gouvernoratcommercial->gouvernorat->id, ['controller' => 'Gouvernorats', 'action' => 'view', $gouvernoratcommercial->gouvernorat->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $gouvernoratcommercial->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $gouvernoratcommercial->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $gouvernoratcommercial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $gouvernoratcommercial->id)]) ?>
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
