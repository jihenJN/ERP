<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visit $visit
 * @var string[]|\Cake\Collection\CollectionInterface $typeContacts
 * @var string[]|\Cake\Collection\CollectionInterface $clients
 * @var string[]|\Cake\Collection\CollectionInterface $visiteurs
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $visit->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $visit->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Visits'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="visits form content">
            <?= $this->Form->create($visit) ?>
            <fieldset>
                <legend><?= __('Edit Visit') ?></legend>
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
