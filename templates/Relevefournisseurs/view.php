<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Relevefournisseur $relevefournisseur
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Relevefournisseur'), ['action' => 'edit', $relevefournisseur->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Relevefournisseur'), ['action' => 'delete', $relevefournisseur->id], ['confirm' => __('Are you sure you want to delete # {0}?', $relevefournisseur->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Relevefournisseurs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Relevefournisseur'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="relevefournisseurs view content">
            <h3><?= h($relevefournisseur->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Numclt') ?></th>
                    <td><?= h($relevefournisseur->numclt) ?></td>
                </tr>
                <tr>
                    <th><?= __('Numero') ?></th>
                    <td><?= h($relevefournisseur->numero) ?></td>
                </tr>
                <tr>
                    <th><?= __('Typ') ?></th>
                    <td><?= h($relevefournisseur->typ) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($relevefournisseur->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fournisseur Id') ?></th>
                    <td><?= $relevefournisseur->fournisseur_id === null ? '' : $this->Number->format($relevefournisseur->fournisseur_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Debit') ?></th>
                    <td><?= $relevefournisseur->debit === null ? '' : $this->Number->format($relevefournisseur->debit) ?></td>
                </tr>
                <tr>
                    <th><?= __('Credit') ?></th>
                    <td><?= $relevefournisseur->credit === null ? '' : $this->Number->format($relevefournisseur->credit) ?></td>
                </tr>
                <tr>
                    <th><?= __('Impaye') ?></th>
                    <td><?= $relevefournisseur->impaye === null ? '' : $this->Number->format($relevefournisseur->impaye) ?></td>
                </tr>
                <tr>
                    <th><?= __('Reglement') ?></th>
                    <td><?= $relevefournisseur->reglement === null ? '' : $this->Number->format($relevefournisseur->reglement) ?></td>
                </tr>
                <tr>
                    <th><?= __('Avoir') ?></th>
                    <td><?= $relevefournisseur->avoir === null ? '' : $this->Number->format($relevefournisseur->avoir) ?></td>
                </tr>
                <tr>
                    <th><?= __('Solde') ?></th>
                    <td><?= $relevefournisseur->solde === null ? '' : $this->Number->format($relevefournisseur->solde) ?></td>
                </tr>
                <tr>
                    <th><?= __('Exercice Id') ?></th>
                    <td><?= $relevefournisseur->exercice_id === null ? '' : $this->Number->format($relevefournisseur->exercice_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nbligneimp') ?></th>
                    <td><?= $relevefournisseur->nbligneimp === null ? '' : $this->Number->format($relevefournisseur->nbligneimp) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($relevefournisseur->date) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Type') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($relevefournisseur->type)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Typeimp') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($relevefournisseur->typeimp)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
