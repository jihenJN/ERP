<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compterendus $compterendus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Compterendus'), ['action' => 'edit', $compterendus->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Compterendus'), ['action' => 'delete', $compterendus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $compterendus->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Compterendus'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Compterendus'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="compterendus view content">
            <h3><?= h($compterendus->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($compterendus->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($compterendus->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
