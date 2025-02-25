<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Piecereglement $piecereglement
 * @var \Cake\Collection\CollectionInterface|string[] $paiements
 * @var \Cake\Collection\CollectionInterface|string[] $reglements
 * @var \Cake\Collection\CollectionInterface|string[] $societes
 * @var \Cake\Collection\CollectionInterface|string[] $fournisseurs
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Piecereglements'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="piecereglements form content">
            <?= $this->Form->create($piecereglement) ?>
            <fieldset>
                <legend><?= __('Add Piecereglement') ?></legend>
                <?php
                    echo $this->Form->control('paiement_id', ['options' => $paiements, 'empty' => true]);
                    echo $this->Form->control('reglement_id', ['options' => $reglements, 'empty' => true]);
                    echo $this->Form->control('montant');
                    echo $this->Form->control('intericecredit');
                    echo $this->Form->control('date', ['empty' => true]);
                    echo $this->Form->control('carnetcheque_id');
                    echo $this->Form->control('cheque_id');
                    echo $this->Form->control('num');
                    echo $this->Form->control('echance', ['empty' => true]);
                    echo $this->Form->control('compte_id');
                    echo $this->Form->control('montant_brut');
                    echo $this->Form->control('montant_net');
                    echo $this->Form->control('to_id');
                    echo $this->Form->control('societe_id', ['options' => $societes, 'empty' => true]);
                    echo $this->Form->control('situation');
                    echo $this->Form->control('numeroachat');
                    echo $this->Form->control('importation_id');
                    echo $this->Form->control('montantdevise');
                    echo $this->Form->control('nbrmoins');
                    echo $this->Form->control('etatpiecereglement_id');
                    echo $this->Form->control('traitecredit_id');
                    echo $this->Form->control('reglefournisseur');
                    echo $this->Form->control('credit');
                    echo $this->Form->control('montantfrs');
                    echo $this->Form->control('impaye_regler');
                    echo $this->Form->control('numeropieceintegre');
                    echo $this->Form->control('fournisseur_id', ['options' => $fournisseurs]);
                    echo $this->Form->control('RG_Cours');
                    echo $this->Form->control('RG_MontantDev');
                    echo $this->Form->control('prop');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
