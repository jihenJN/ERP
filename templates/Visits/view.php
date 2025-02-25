<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visit $visit
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Visit'), ['action' => 'edit', $visit->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Visit'), ['action' => 'delete', $visit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $visit->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Visits'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Visit'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="visits view content">
            <h3><?= h($visit->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Type Contact') ?></th>
                    <td><?= $visit->has('type_contact') ? $this->Html->link($visit->type_contact->id, ['controller' => 'Typecontacts', 'action' => 'view', $visit->type_contact->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Client') ?></th>
                    <td><?= $visit->has('client') ? $this->Html->link($visit->client->name, ['controller' => 'Clients', 'action' => 'view', $visit->client->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Lieu') ?></th>
                    <td><?= h($visit->lieu) ?></td>
                </tr>
                <tr>
                    <th><?= __('Localisation') ?></th>
                    <td><?= h($visit->localisation) ?></td>
                </tr>
                <tr>
                    <th><?= __('Visiteur') ?></th>
                    <td><?= $visit->has('visiteur') ? $this->Html->link($visit->visiteur->id, ['controller' => 'Visiteurs', 'action' => 'view', $visit->visiteur->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Commentaire') ?></th>
                    <td><?= h($visit->commentaire) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($visit->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Numero') ?></th>
                    <td><?= $this->Number->format($visit->numero) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Demande') ?></th>
                    <td><?= h($visit->date_demande) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Prevu') ?></th>
                    <td><?= h($visit->date_prevu) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Visite') ?></th>
                    <td><?= h($visit->date_visite) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
