<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visit $visit
 * @var \Cake\Collection\CollectionInterface|string[] $typeContacts
 * @var \Cake\Collection\CollectionInterface|string[] $clients
 * @var \Cake\Collection\CollectionInterface|string[] $visiteurs
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Visits'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="visits form content">
            <?= $this->Form->create($visit) ?>
            <fieldset>
                <legend><?= __('Add Visit') ?></legend>
                <?php
                    echo $this->Form->control('numero');
                    echo $this->Form->control('date_demande', ['empty' => true]);
                    echo $this->Form->control('type_contact_id', ['options' => $typeContacts]);
                    echo $this->Form->control('client_id', ['options' => $clients]);
                    echo $this->Form->control('lieu');
                    echo $this->Form->control('localisation');
                    echo $this->Form->control('date_prevu', ['empty' => true]);
                    echo $this->Form->control('visiteur_id', ['options' => $visiteurs]);
                    echo $this->Form->control('date_visite', ['empty' => true]);
                    echo $this->Form->control('commentaire');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
