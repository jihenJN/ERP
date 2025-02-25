<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lignedemandeclient $lignedemandeclient
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Lignedemandeclient'), ['action' => 'edit', $lignedemandeclient->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Lignedemandeclient'), ['action' => 'delete', $lignedemandeclient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignedemandeclient->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Lignedemandeclients'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Lignedemandeclient'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="lignedemandeclients view content">
            <h3><?= h($lignedemandeclient->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Demandeclient') ?></th>
                    <td><?= $lignedemandeclient->has('demandeclient') ? $this->Html->link($lignedemandeclient->demandeclient->id, ['controller' => 'Demandeclients', 'action' => 'view', $lignedemandeclient->demandeclient->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Numboite') ?></th>
                    <td><?= h($lignedemandeclient->numboite) ?></td>
                </tr>
                <tr>
                    <th><?= __('Famille') ?></th>
                    <td><?= $lignedemandeclient->has('famille') ? $this->Html->link($lignedemandeclient->famille->id, ['controller' => 'Familles', 'action' => 'view', $lignedemandeclient->famille->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Sousfamille1') ?></th>
                    <td><?= $lignedemandeclient->has('sousfamille1') ? $this->Html->link($lignedemandeclient->sousfamille1->name, ['controller' => 'Sousfamille1s', 'action' => 'view', $lignedemandeclient->sousfamille1->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Article') ?></th>
                    <td><?= $lignedemandeclient->has('article') ? $this->Html->link($lignedemandeclient->article->codeabarre, ['controller' => 'Articles', 'action' => 'view', $lignedemandeclient->article->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Unite') ?></th>
                    <td><?= $lignedemandeclient->has('unite') ? $this->Html->link($lignedemandeclient->unite->name, ['controller' => 'Unites', 'action' => 'view', $lignedemandeclient->unite->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Exigence') ?></th>
                    <td><?= h($lignedemandeclient->exigence) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($lignedemandeclient->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qte') ?></th>
                    <td><?= $lignedemandeclient->qte === null ? '' : $this->Number->format($lignedemandeclient->qte) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
