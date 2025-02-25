<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Importation $importation
 * @var \Cake\Collection\CollectionInterface|string[] $fournisseurs
 * @var \Cake\Collection\CollectionInterface|string[] $devises
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Importations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="importations form content">
            <?= $this->Form->create($importation) ?>
            <fieldset>
                <legend><?= __('Add Importation') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('numero');
                    echo $this->Form->control('date', ['empty' => true]);
                    echo $this->Form->control('dateliv', ['empty' => true]);
                    echo $this->Form->control('fournisseur_id', ['options' => $fournisseurs, 'empty' => true]);
                    echo $this->Form->control('devise_id', ['options' => $devises, 'empty' => true]);
                    echo $this->Form->control('montantachat');
                    echo $this->Form->control('tauxderechenge');
                    echo $this->Form->control('prixachat');
                    echo $this->Form->control('avis');
                    echo $this->Form->control('transitaire');
                    echo $this->Form->control('ddttva');
                    echo $this->Form->control('assurence');
                    echo $this->Form->control('divers');
                    echo $this->Form->control('fraisfinancie');
                    echo $this->Form->control('magasinage');
                    echo $this->Form->control('fournisseuravis');
                    echo $this->Form->control('fournisseurtransitaire');
                    echo $this->Form->control('fournisseurddttva');
                    echo $this->Form->control('fournisseurassurence');
                    echo $this->Form->control('fournisseurdivers');
                    echo $this->Form->control('fournisseurfraisfinancie');
                    echo $this->Form->control('fournisseurmagasinage');
                    echo $this->Form->control('totale');
                    echo $this->Form->control('coefficien');
                    echo $this->Form->control('coeff');
                    echo $this->Form->control('etat');
                    echo $this->Form->control('situation_id');
                    echo $this->Form->control('Coefficientchoisi');
                    echo $this->Form->control('regler');
                    echo $this->Form->control('facturer');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
