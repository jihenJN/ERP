<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Typecontact $typecontact
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Typecontact'), ['action' => 'edit', $typecontact->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Typecontact'), ['action' => 'delete', $typecontact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $typecontact->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Typecontacts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Typecontact'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="typecontacts view content">
            <h3><?= h($typecontact->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Libelle') ?></th>
                    <td><?= h($typecontact->libelle) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($typecontact->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
