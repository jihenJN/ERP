<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visit $visit
 * @var \Cake\Collection\CollectionInterface|string[] $typeContacts
 * @var \Cake\Collection\CollectionInterface|string[] $clients
 * @var \Cake\Collection\CollectionInterface|string[] $visiteurs
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script> 
  <section class="content-header">
    <h1>
    Ajout Visite Technique
      <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
  </section>

  <!-- Main content -->
  <secton class="content">
    <div class="box">
        <div class="box-body">
            <div class="row">
            <?php echo $this->Form->create($visit, ['role' => 'form']); ?>
            <div class="box-body">
               <div class="row">
                 <div class="col-xs-6">
                   <?php echo $this->Form->control('numero',['label'=>'Numéro']);?>
                 </div>
                 <div class="col-xs-6">
                   <?php echo $this->Form->control('date_demande',['label'=>'Date Demande']);?>
                 </div>
                 <div class="col-xs-6">
                   <?php echo $this->Form->control('type_contact_id', ['options' => $typeContacts,'label'=>'Type Contact']); ?> 
                    </div>
                    <div class="col-xs-6">
                    <?php echo $this->Form->control('client_id', ['options' => $clients,'label'=>'Client']); ?> 
                    </div>
                    <div class="col-xs-6">
                    <?php echo $this->Form->control('lieu', ['label'=>'Lieu']); ?> 
                    </div>
                    <div class="col-xs-6">
                    <?php echo $this->Form->control('localisation', ['label'=>'Localisation']); ?> 
                    </div>
                    <div class="col-xs-6">
                    <?php echo $this->Form->control('date_prevu', ['label'=>'Date Prévu']); ?> 
                    </div>
                    <div class="col-xs-6">
                    <?php echo $this->Form->control('visiteur_id', ['options' => $visiteurs,'label'=>'Visiteur']); ?>
                    </div>
                    <div class="col-xs-6">
                    <?php echo $this->Form->control('date_visite', ['label'=>'Date Visite']); ?> 
                    </div>
                    <div class="col-xs-6">
                    <?php echo $this->Form->control('commentaire', ['label'=>'Commentaire']); ?> 
                    </div>
                 <?php echo $this->Form->end(); ?>
               </div>
               <button type="submit" class="pull-right btn btn-success" id="testde" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
            </div>

            </div>
        </div>
       
    </div>

<?php echo $this->Html->script('alert'); ?>