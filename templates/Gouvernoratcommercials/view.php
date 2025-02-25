<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Gouvernoratcommercial $gouvernoratcommercial
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Gouvernoratcommercial'), ['action' => 'edit', $gouvernoratcommercial->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Gouvernoratcommercial'), ['action' => 'delete', $gouvernoratcommercial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $gouvernoratcommercial->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Gouvernoratcommercials'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Gouvernoratcommercial'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="gouvernoratcommercials view content">
            <h3><?= h($gouvernoratcommercial->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Commercial') ?></th>
                    <td><?= $gouvernoratcommercial->has('commercial') ? $this->Html->link($gouvernoratcommercial->commercial->name, ['controller' => 'Commercials', 'action' => 'view', $gouvernoratcommercial->commercial->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Gouvernorat') ?></th>
                    <td><?= $gouvernoratcommercial->has('gouvernorat') ? $this->Html->link($gouvernoratcommercial->gouvernorat->id, ['controller' => 'Gouvernorats', 'action' => 'view', $gouvernoratcommercial->gouvernorat->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($gouvernoratcommercial->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
