<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visiteur $visiteur
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Visiteur'), ['action' => 'edit', $visiteur->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Visiteur'), ['action' => 'delete', $visiteur->id], ['confirm' => __('Are you sure you want to delete # {0}?', $visiteur->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Visiteurs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Visiteur'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="visiteurs view content">
            <h3><?= h($visiteur->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($visiteur->nom) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telephone') ?></th>
                    <td><?= h($visiteur->telephone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($visiteur->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
