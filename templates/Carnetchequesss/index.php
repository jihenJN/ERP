<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Carnetcheque[]|\Cake\Collection\CollectionInterface $carnetcheques
 */
?>
<div class="carnetcheques index content">
    <?= $this->Html->link(__('New Carnetcheque'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Carnetcheques') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('numero') ?></th>
                    <th><?= $this->Paginator->sort('compte_id') ?></th>
                    <th><?= $this->Paginator->sort('debut') ?></th>
                    <th><?= $this->Paginator->sort('nombre') ?></th>
                    <th><?= $this->Paginator->sort('taille') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carnetcheques as $carnetcheque): ?>
                <tr>
                    <td><?= $this->Number->format($carnetcheque->id) ?></td>
                    <td><?= h($carnetcheque->numero) ?></td>
                    <td><?= $carnetcheque->has('compte') ? $this->Html->link($carnetcheque->compte->id, ['controller' => 'Comptes', 'action' => 'view', $carnetcheque->compte->id]) : '' ?></td>
                    <td><?= h($carnetcheque->debut) ?></td>
                    <td><?= $carnetcheque->nombre === null ? '' : $this->Number->format($carnetcheque->nombre) ?></td>
                    <td><?= $carnetcheque->taille === null ? '' : $this->Number->format($carnetcheque->taille) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $carnetcheque->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $carnetcheque->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $carnetcheque->id], ['confirm' => __('Are you sure you want to delete # {0}?', $carnetcheque->id)]) ?>
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
