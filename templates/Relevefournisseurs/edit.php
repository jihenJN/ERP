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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $relevefournisseur->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $relevefournisseur->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Relevefournisseurs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="relevefournisseurs form content">
            <?= $this->Form->create($relevefournisseur) ?>
            <fieldset>
                <legend><?= __('Edit Relevefournisseur') ?></legend>
                <?php
                    echo $this->Form->control('numclt');
                    echo $this->Form->control('fournisseur_id');
                    echo $this->Form->control('date', ['empty' => true]);
                    echo $this->Form->control('numero');
                    echo $this->Form->control('type');
                    echo $this->Form->control('typeimp');
                    echo $this->Form->control('debit');
                    echo $this->Form->control('credit');
                    echo $this->Form->control('impaye');
                    echo $this->Form->control('reglement');
                    echo $this->Form->control('avoir');
                    echo $this->Form->control('solde');
                    echo $this->Form->control('exercice_id');
                    echo $this->Form->control('typ');
                    echo $this->Form->control('nbligneimp');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
