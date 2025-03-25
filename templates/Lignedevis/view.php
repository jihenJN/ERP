<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lignedevi $lignedevi
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Lignedevi'), ['action' => 'edit', $lignedevi->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Lignedevi'), ['action' => 'delete', $lignedevi->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignedevi->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Lignedevis'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Lignedevi'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="lignedevis view content">
            <h3><?= h($lignedevi->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Article') ?></th>
                    <td><?= $lignedevi->has('article') ? $this->Html->link($lignedevi->article->id, ['controller' => 'Articles', 'action' => 'view', $lignedevi->article->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Devi') ?></th>
                    <td><?= $lignedevi->has('devi') ? $this->Html->link($lignedevi->devi->id, ['controller' => 'Devis', 'action' => 'view', $lignedevi->devi->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($lignedevi->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Prix') ?></th>
                    <td><?= $this->Number->format($lignedevi->prix) ?></td>
                </tr>
                <tr>
                    <th><?= __('Remise') ?></th>
                    <td><?= $this->Number->format($lignedevi->remise) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ht') ?></th>
                    <td><?= $this->Number->format($lignedevi->ht) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
