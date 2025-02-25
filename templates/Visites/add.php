<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visite $visite
 * @var \Cake\Collection\CollectionInterface|string[] $clients
 * @var \Cake\Collection\CollectionInterface|string[] $demandeclients
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Visites'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="visites form content">
            <?= $this->Form->create($visite) ?>
            <fieldset>
                <legend><?= __('Add Visite') ?></legend>
                <?php
                    echo $this->Form->control('client_id', ['options' => $clients, 'empty' => true]);
                    echo $this->Form->control('demandeclient_id', ['options' => $demandeclients, 'empty' => true]);
                    echo $this->Form->control('datecontact', ['empty' => true]);
                    echo $this->Form->control('dateplanifie', ['empty' => true]);
                    echo $this->Form->control('trdemande');
                    echo $this->Form->control('description');
                    echo $this->Form->control('piece');
                    echo $this->Form->control('schema');
                    echo $this->Form->control('datecptrendu', ['empty' => true]);
                    echo $this->Form->control('visiteur');
                    echo $this->Form->control('responsable');
                    echo $this->Form->control('tel');
                    echo $this->Form->control('adresse');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
