<section class="content-header">
  <h1>
    Personnel
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
      <?php echo $this->Form->create($personnel, ['role' => 'form']); ?>
        <!-- /.box-header --> 
        <div class="box-body">
        <div class="row">
            <div class="col-xs-6">
              <?php
               echo $this->Form->control('fonction_id', ['options' => $fonctions,'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php  echo $this->Form->control('sexe_id', ['options' => $sexes, 'readonly']); ?>
            </div>
           
            <div class="col-xs-6">
              <?php echo $this->Form->control('situationfamiliale_id', ['label' => 'Situation Familiale','options' => $situationfamiliales,'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('nombreenfant',['label' => 'Nombre Enfant','readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php  echo $this->Form->control('matriculecnss',['label' => 'Matricle CNSS','readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('age',['readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('chefdefamille',['label' => 'Chef De Famille','readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('typecontrat_id', ['label' => 'Type Contrat','options' => $typecontrats,'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('pointdevente_id', ['label' => 'Point De Vente','options' => $pointdeventes, 'readonly']); ?>
            </div>
            <div class="col-xs-6">
            <?php echo $this->Form->control('dateentre', ['label' => 'Date Entree', 'empty' => true, 'class' => "form-control pull-right",'readonly']);
              ?>
            </div>
            <div class="col-xs-6" align="center">
                                    <?php echo $this->Html->image('imgart/' . $personnel->image, ['style' => 'max-width:100px;height:100px;']); ?>
                                </div>
          </div>
            </div>
        </div>
      </div>
    </div>
  </div>

</section>

