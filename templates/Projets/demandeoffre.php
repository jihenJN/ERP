<?php echo $this->Html->css('select2'); ?>
<div id="demandeoffredeprix" style="display:none;margin-top: 18px;">

  <section class="content-header">
    <h1>
      Commercial <small>
        <?php echo __(''); ?>
      </small>
    </h1>

  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <?php echo __(''); ?>
            </h3>
          </div>
          <?php echo $this->Form->create($thisprojetcommercial, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); 
          echo $this->Form->hidden('form_name', ['value' => 'projetcommercial']);
          ?>
          
          <div class="box-body">
            <div class="row">
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('verificationdossier', [
                  'type' => 'checkbox',
                  'label' => 'Vérification du dossier ',
                  'checked' => !empty($thisprojetcommercial->verificationdossier) && $thisprojetcommercial->verificationdossier == 1
                ]);
                ?>

                <?php
                echo $this->Form->control('evaluationcout', [
                  'type' => 'checkbox',
                  'label' => 'Evaluation du coût du projet ',
                  'checked' => !empty($thisprojetcommercial->evaluationcout) && $thisprojetcommercial->evaluationcout == 1
                ]);
                ?>
              </div>



              <div class="col-xs-6">
                <?php echo $this->Form->control('datecommercial', ['value'=>$thisprojetcommercial->datecommercial,'type' => 'datetime', 'label' => 'Reçu Commercial', 'class' => 'form-control ', 'id' => 'datecommercial']); ?>
              </div>
            </div>
          </div>


           <div align="center" id="eanr3" class="index"> 
            <button type="submit"  class="pull-right btn btn-success btn-sm"
              style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
          </div>

     


          <?php echo $this->Form->end(); ?>
        </div>
      </div>
    </div>
</div>

<script>
  document.getElementById('ajouter_lignearticle').addEventListener('click', function(event) {
    if (this.hasAttribute('disabled')) {
      event.preventDefault(); // Empêche l'action par défaut du bouton
    } else {
      // Votre code pour ajouter des lignes ici
    }
  });
</script>


<script>
 
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
 
  
  
  });
</script>
</div>