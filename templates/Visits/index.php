<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Visit> $visits
 */
?>
<div class="visits index content">
    <?= $this->Html->link(__('New Visit'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Visits') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('numero') ?></th>
                    <th><?= $this->Paginator->sort('date_demande') ?></th>
                    <th><?= $this->Paginator->sort('type_contact_id') ?></th>
                    <th><?= $this->Paginator->sort('client_id') ?></th>
                    <th><?= $this->Paginator->sort('lieu') ?></th>
                    <th><?= $this->Paginator->sort('localisation') ?></th>
                    <th><?= $this->Paginator->sort('date_prevu') ?></th>
                    <th><?= $this->Paginator->sort('visiteur_id') ?></th>
                    <th><?= $this->Paginator->sort('date_visite') ?></th>
                    <th><?= $this->Paginator->sort('commentaire') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($visits as $visit): ?>
                <tr>
                    <td><?= $this->Number->format($visit->id) ?></td>
                    <td><?= $this->Number->format($visit->numero) ?></td>
                    <td><?= h($visit->date_demande) ?></td>
                    <td><?= $visit->has('type_contact') ? $this->Html->link($visit->type_contact->id, ['controller' => 'Typecontacts', 'action' => 'view', $visit->type_contact->id]) : '' ?></td>
                    <td><?= $visit->has('client') ? $this->Html->link($visit->client->name, ['controller' => 'Clients', 'action' => 'view', $visit->client->id]) : '' ?></td>
                    <td><?= h($visit->lieu) ?></td>
                    <td><?= h($visit->localisation) ?></td>
                    <td><?= h($visit->date_prevu) ?></td>
                    <td><?= $visit->has('visiteur') ? $this->Html->link($visit->visiteur->id, ['controller' => 'Visiteurs', 'action' => 'view', $visit->visiteur->id]) : '' ?></td>
                    <td><?= h($visit->date_visite) ?></td>
                    <td><?= h($visit->commentaire) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $visit->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $visit->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $visit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $visit->id)]) ?>
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
