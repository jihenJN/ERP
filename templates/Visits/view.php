<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visit $visit
 */
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script> 
  <section class="content-header">
    <h1>
   Consultation Visite Technique
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
                    <?php echo $this->Form->control('numero', ['readonly' => 'readonly' ,'label'=>'Numéro']); ?>
                    </div>
                    <div class="col-xs-6">
                    <?php echo $this->Form->control('date_demande', ['readonly' => 'readonly','label'=>'Date Demande']); ?> 
                    </div>
                    <div class="col-xs-6">
                    <?php echo $this->Form->control('type_contact.libelle', ['readonly' => 'readonly' ,'label'=>'Type Contact']); ?> 
                    </div>
                    <div class="col-xs-6">
                    <?php echo $this->Form->control('client.Raison_Sociale', ['readonly' => 'readonly','label'=>'Client']); ?> 
                    </div>
                    <div class="col-xs-6">
                    <?php echo $this->Form->control('lieu', ['readonly' => 'readonly','label'=>'Lieu']); ?> 
                    </div>
                    <div class="col-xs-6">
                    <?php echo $this->Form->control('localisation', ['readonly' => 'readonly','label'=>'Localisation']); ?> 
                    </div>
                    <div class="col-xs-6">
                    <?php echo $this->Form->control('date_prevu', ['readonly' => 'readonly','label'=>'Date Prévu']); ?> 
                    </div>
                    <div class="col-xs-6">
                    <?php echo $this->Form->control('visiteur.nom', ['readonly' => 'readonly','label'=>'Visiteur']); ?> 
                    </div>
                    <div class="col-xs-6">
                    <?php echo $this->Form->control('date_visite', ['readonly' => 'readonly','label'=>'Date Visite']); ?> 
                    </div>
                    <div class="col-xs-6">
                    <?php echo $this->Form->control('commentaire', ['readonly' => 'readonly','label'=>'Commentaire']); ?> 
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
        </div>
    </div>
   
  </div>
  <!-- /.row -->
</section>
<?php echo $this->Html->script('alert'); ?>