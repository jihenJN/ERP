<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Typedemande $typedemande
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Typedemande'), ['action' => 'edit', $typedemande->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Typedemande'), ['action' => 'delete', $typedemande->id], ['confirm' => __('Are you sure you want to delete # {0}?', $typedemande->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Typedemandes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Typedemande'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="typedemandes view content">
            <h3><?= h($typedemande->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($typedemande->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($typedemande->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Demandeclients') ?></h4>
                <?php if (!empty($typedemande->demandeclients)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Client Id') ?></th>
                            <th><?= __('Dateconsulation') ?></th>
                            <th><?= __('Delaireponse') ?></th>
                            <th><?= __('Delaivoulu') ?></th>
                            <th><?= __('Delaiapprov') ?></th>
                            <th><?= __('Typedemande Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($typedemande->demandeclients as $demandeclients) : ?>
                        <tr>
                            <td><?= h($demandeclients->id) ?></td>
                            <td><?= h($demandeclients->client_id) ?></td>
                            <td><?= h($demandeclients->dateconsulation) ?></td>
                            <td><?= h($demandeclients->delaireponse) ?></td>
                            <td><?= h($demandeclients->delaivoulu) ?></td>
                            <td><?= h($demandeclients->delaiapprov) ?></td>
                            <td><?= h($demandeclients->typedemande_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Demandeclients', 'action' => 'view', $demandeclients->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Demandeclients', 'action' => 'edit', $demandeclients->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Demandeclients', 'action' => 'delete', $demandeclients->id], ['confirm' => __('Are you sure you want to delete # {0}?', $demandeclients->id)]) ?>
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
