<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Typecredit $typecredit
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script> 
<section class="content-header">
    <h1>
      Type Crédit
      <small><?php echo __('Modifier'); ?></small>
    </h1>   
    <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
  </section>





  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box ">
          
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo $this->Form->create($typecredit, ['role' => 'form']); ?>
            <div class="box-body">
                 <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                 <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('name', ['label' => 'Nom']);
                            ?>
                        </div>
                        
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('montant', ['label' => 'Montant']);
                            ?>
                        </div>
                        <!-- <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('mesuel', ['label' => 'Mensuel']);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('annuel', ['label' => 'Annuel']);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('sertype', ['label' => 'Sertype']);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('tuestrie', ['label' => 'Tuestrie']);
                            ?>
                        </div>-->
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('montantcredit', ['label' => 'Montant Crédit']);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('taux', ['label' => 'Taux d\'intérêt']);

                          //  echo $this->Form->control('taux', ['label' => 'Taux d intérét']);
                            ?>
                        </div> 
                        <div class="col-xs-6">
                        <?php
                                    echo $this->Form->control('frequence_id', array(
                                        'empty' => 'Veuillez choisir !!', 'options' => $frequences, 'class' => ' form-control ', 'name' => 'frequence_id', 'label' => 'Fréquence', 'id' => 'frequence_id', 'type' => '', 'class' => 'form-control select2  fournisseurreglement2'
                                    ));
                                    ?>
                        </div> 
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('montantremb', ['label' => 'Montant Remboursement']);

                          //  echo $this->Form->control('taux', ['label' => 'Taux d intérét']);
                            ?>
                        </div>
                     </div>
               <button type="submit" class="pull-right btn btn-success "  style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
          <?php echo $this->Form->end(); ?>
            </div>
            <!-- /.box-body -->

         
        </div>
        <!-- /.box -->
      </div>
  </div>
  <!-- /.row -->
</section>
<?php echo $this->Html->script('alert'); ?>
