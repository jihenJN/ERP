<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Devi $devi
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Devi'), ['action' => 'edit', $devi->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Devi'), ['action' => 'delete', $devi->id], ['confirm' => __('Are you sure you want to delete # {0}?', $devi->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Devis'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Devi'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="devis view content">
            <h3><?= h($devi->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Numero') ?></th>
                    <td><?= h($devi->numero) ?></td>
                </tr>
                <tr>
                    <th><?= __('Client') ?></th>
                    <td><?= $devi->has('client') ? $this->Html->link($devi->client->name, ['controller' => 'Clients', 'action' => 'view', $devi->client->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($devi->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Remise') ?></th>
                    <td><?= $this->Number->format($devi->total_remise) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Ht') ?></th>
                    <td><?= $this->Number->format($devi->total_ht) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($devi->date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
