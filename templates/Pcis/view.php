<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pci $pci
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Pci'), ['action' => 'edit', $pci->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Pci'), ['action' => 'delete', $pci->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pci->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Pcis'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Pci'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="pcis view content">
            <h3><?= h($pci->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Designation') ?></th>
                    <td><?= h($pci->designation) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lancerpdp') ?></th>
                    <td><?= h($pci->lancerpdp) ?></td>
                </tr>
                <tr>
                    <th><?= __('Article') ?></th>
                    <td><?= $pci->has('article') ? $this->Html->link($pci->article->id, ['controller' => 'Articles', 'action' => 'view', $pci->article->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($pci->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qtedisp') ?></th>
                    <td><?= $pci->qtedisp === null ? '' : $this->Number->format($pci->qtedisp) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qtenonliv') ?></th>
                    <td><?= $pci->qtenonliv === null ? '' : $this->Number->format($pci->qtenonliv) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qtetheo') ?></th>
                    <td><?= $pci->qtetheo === null ? '' : $this->Number->format($pci->qtetheo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Stockminart') ?></th>
                    <td><?= $pci->stockminart === null ? '' : $this->Number->format($pci->stockminart) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qtevendu') ?></th>
                    <td><?= $pci->qtevendu === null ? '' : $this->Number->format($pci->qtevendu) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qteliv') ?></th>
                    <td><?= $pci->qteliv === null ? '' : $this->Number->format($pci->qteliv) ?></td>
                </tr>
                <tr>
                    <th><?= __('Besoin') ?></th>
                    <td><?= $pci->besoin === null ? '' : $this->Number->format($pci->besoin) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qtenoncloture') ?></th>
                    <td><?= $pci->qtenoncloture === null ? '' : $this->Number->format($pci->qtenoncloture) ?></td>
                </tr>
                <tr>
                    <th><?= __('Besoinprodtheoperiode') ?></th>
                    <td><?= $pci->besoinprodtheoperiode === null ? '' : $this->Number->format($pci->besoinprodtheoperiode) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qtprodpratique') ?></th>
                    <td><?= $pci->qtprodpratique === null ? '' : $this->Number->format($pci->qtprodpratique) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rang') ?></th>
                    <td><?= $pci->rang === null ? '' : $this->Number->format($pci->rang) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ventem1') ?></th>
                    <td><?= $pci->ventem1 === null ? '' : $this->Number->format($pci->ventem1) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qtem1') ?></th>
                    <td><?= $pci->qtem1 === null ? '' : $this->Number->format($pci->qtem1) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ventem2') ?></th>
                    <td><?= $pci->ventem2 === null ? '' : $this->Number->format($pci->ventem2) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qtem2') ?></th>
                    <td><?= $pci->qtem2 === null ? '' : $this->Number->format($pci->qtem2) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ventem3') ?></th>
                    <td><?= $pci->ventem3 === null ? '' : $this->Number->format($pci->ventem3) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qtem3') ?></th>
                    <td><?= $pci->qtem3 === null ? '' : $this->Number->format($pci->qtem3) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
