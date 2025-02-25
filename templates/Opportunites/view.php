<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Opportunite $opportunite
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Opportunite'), ['action' => 'edit', $opportunite->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Opportunite'), ['action' => 'delete', $opportunite->id], ['confirm' => __('Are you sure you want to delete # {0}?', $opportunite->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Opportunites'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Opportunite'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="opportunites view content">
            <h3><?= h($opportunite->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($opportunite->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($opportunite->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
