<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Visiteur> $visiteurs
 */
?>
<div class="visiteurs index content">
    <?= $this->Html->link(__('New Visiteur'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Visiteurs') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('nom') ?></th>
                    <th><?= $this->Paginator->sort('telephone') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($visiteurs as $visiteur): ?>
                <tr>
                    <td><?= $this->Number->format($visiteur->id) ?></td>
                    <td><?= h($visiteur->nom) ?></td>
                    <td><?= h($visiteur->telephone) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $visiteur->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $visiteur->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $visiteur->id], ['confirm' => __('Are you sure you want to delete # {0}?', $visiteur->id)]) ?>
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
