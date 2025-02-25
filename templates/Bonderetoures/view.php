<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bonderetoure $bonderetoure
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Bonderetoure'), ['action' => 'edit', $bonderetoure->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Bonderetoure'), ['action' => 'delete', $bonderetoure->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bonderetoure->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Bonderetoures'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Bonderetoure'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bonderetoures view content">
            <h3><?= h($bonderetoure->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Numero') ?></th>
                    <td><?= h($bonderetoure->numero) ?></td>
                </tr>
                <tr>
                    <th><?= __('Marque') ?></th>
                    <td><?= h($bonderetoure->marque) ?></td>
                </tr>
                <tr>
                    <th><?= __('Serie') ?></th>
                    <td><?= h($bonderetoure->serie) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cin') ?></th>
                    <td><?= h($bonderetoure->cin) ?></td>
                </tr>
                <tr>
                    <th><?= __('Chauffeur') ?></th>
                    <td><?= h($bonderetoure->chauffeur) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($bonderetoure->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pointdevente Id') ?></th>
                    <td><?= $bonderetoure->pointdevente_id === null ? '' : $this->Number->format($bonderetoure->pointdevente_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Depot Id') ?></th>
                    <td><?= $bonderetoure->depot_id === null ? '' : $this->Number->format($bonderetoure->depot_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Materieltransport Id') ?></th>
                    <td><?= $bonderetoure->materieltransport_id === null ? '' : $this->Number->format($bonderetoure->materieltransport_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cartecarburant Id') ?></th>
                    <td><?= $bonderetoure->cartecarburant_id === null ? '' : $this->Number->format($bonderetoure->cartecarburant_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Conffaieur Id') ?></th>
                    <td><?= $bonderetoure->conffaieur_id === null ? '' : $this->Number->format($bonderetoure->conffaieur_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Chauffeur Id') ?></th>
                    <td><?= $bonderetoure->chauffeur_id === null ? '' : $this->Number->format($bonderetoure->chauffeur_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Kilometragedepart') ?></th>
                    <td><?= $bonderetoure->kilometragedepart === null ? '' : $this->Number->format($bonderetoure->kilometragedepart) ?></td>
                </tr>
                <tr>
                    <th><?= __('Kilometragearrive') ?></th>
                    <td><?= $bonderetoure->kilometragearrive === null ? '' : $this->Number->format($bonderetoure->kilometragearrive) ?></td>
                </tr>
                <tr>
                    <th><?= __('Poste') ?></th>
                    <td><?= $bonderetoure->poste === null ? '' : $this->Number->format($bonderetoure->poste) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fournisseur Id') ?></th>
                    <td><?= $bonderetoure->fournisseur_id === null ? '' : $this->Number->format($bonderetoure->fournisseur_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($bonderetoure->date) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Lignebonderetoures') ?></h4>
                <?php if (!empty($bonderetoure->lignebonderetoures)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Article Id') ?></th>
                            <th><?= __('Qte') ?></th>
                            <th><?= __('Qtestock') ?></th>
                            <th><?= __('Bonderetoure Id') ?></th>
                            <th><?= __('Couleur Id') ?></th>
                            <th><?= __('Dimension Id') ?></th>
                            <th><?= __('Categorie Id') ?></th>
                            <th><?= __('Famille Id') ?></th>
                            <th><?= __('Sousfamille1 Id') ?></th>
                            <th><?= __('Sousfamille2 Id') ?></th>
                            <th><?= __('Unite Id') ?></th>
                            <th><?= __('Tva Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($bonderetoure->lignebonderetoures as $lignebonderetoures) : ?>
                        <tr>
                            <td><?= h($lignebonderetoures->id) ?></td>
                            <td><?= h($lignebonderetoures->article_id) ?></td>
                            <td><?= h($lignebonderetoures->qte) ?></td>
                            <td><?= h($lignebonderetoures->qtestock) ?></td>
                            <td><?= h($lignebonderetoures->bonderetoure_id) ?></td>
                            <td><?= h($lignebonderetoures->couleur_id) ?></td>
                            <td><?= h($lignebonderetoures->dimension_id) ?></td>
                            <td><?= h($lignebonderetoures->categorie_id) ?></td>
                            <td><?= h($lignebonderetoures->famille_id) ?></td>
                            <td><?= h($lignebonderetoures->sousfamille1_id) ?></td>
                            <td><?= h($lignebonderetoures->sousfamille2_id) ?></td>
                            <td><?= h($lignebonderetoures->unite_id) ?></td>
                            <td><?= h($lignebonderetoures->tva_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Lignebonderetoures', 'action' => 'view', $lignebonderetoures->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Lignebonderetoures', 'action' => 'edit', $lignebonderetoures->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Lignebonderetoures', 'action' => 'delete', $lignebonderetoures->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lignebonderetoures->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
