<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lignebonderetoure $lignebonderetoure
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Lignebonderetoure'), ['action' => 'edit', $lignebonderetoure->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Lignebonderetoure'), ['action' => 'delete', $lignebonderetoure->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignebonderetoure->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Lignebonderetoures'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Lignebonderetoure'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="lignebonderetoures view content">
            <h3><?= h($lignebonderetoure->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Bonderetoure') ?></th>
                    <td><?= $lignebonderetoure->has('bonderetoure') ? $this->Html->link($lignebonderetoure->bonderetoure->id, ['controller' => 'Bonderetoures', 'action' => 'view', $lignebonderetoure->bonderetoure->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($lignebonderetoure->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Article Id') ?></th>
                    <td><?= $this->Number->format($lignebonderetoure->article_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qte') ?></th>
                    <td><?= $this->Number->format($lignebonderetoure->qte) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qtestock') ?></th>
                    <td><?= $this->Number->format($lignebonderetoure->qtestock) ?></td>
                </tr>
                <tr>
                    <th><?= __('Couleur Id') ?></th>
                    <td><?= $lignebonderetoure->couleur_id === null ? '' : $this->Number->format($lignebonderetoure->couleur_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dimension Id') ?></th>
                    <td><?= $lignebonderetoure->dimension_id === null ? '' : $this->Number->format($lignebonderetoure->dimension_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Categorie Id') ?></th>
                    <td><?= $lignebonderetoure->categorie_id === null ? '' : $this->Number->format($lignebonderetoure->categorie_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Famille Id') ?></th>
                    <td><?= $lignebonderetoure->famille_id === null ? '' : $this->Number->format($lignebonderetoure->famille_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sousfamille1 Id') ?></th>
                    <td><?= $lignebonderetoure->sousfamille1_id === null ? '' : $this->Number->format($lignebonderetoure->sousfamille1_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sousfamille2 Id') ?></th>
                    <td><?= $lignebonderetoure->sousfamille2_id === null ? '' : $this->Number->format($lignebonderetoure->sousfamille2_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Unite Id') ?></th>
                    <td><?= $lignebonderetoure->unite_id === null ? '' : $this->Number->format($lignebonderetoure->unite_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tva Id') ?></th>
                    <td><?= $lignebonderetoure->tva_id === null ? '' : $this->Number->format($lignebonderetoure->tva_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
