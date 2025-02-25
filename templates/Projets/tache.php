<div id="projettache" style="display:none;margin-top: 18px;">
  <section class="content-header">
    <h1>
      Nouvelle taches
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box ">
          <div class="box-header with-border">
            <h3 class="box-title"></h3>
          </div>
          <?php echo $this->Form->create($tach, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>

          <div class="box-body">
            <div class="row">
              <div class="col-xs-6">
                <?php echo $this->Form->control('ref', ['table' => 'tabTache', 'class' => 'form-control ', 'champ' => 'ref', 'label' => 'Réf.']); ?>
              </div>
              <div class="col-xs-6">
                <?php echo $this->Form->control('libellee', ['table' => 'tabTache', 'class' => 'form-control ', 'champ' => 'libelle', 'label' => 'Libellé.']); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <?php echo $this->Form->control('projet_id', ['table' => 'tabTache',  'options' => $projets, 'value' => $project_id, 'empty' => 'Veuillez choisir un projet !!', 'class' => 'form-control ', 'champ' => 'projet_id', 'label' => 'Fille du projet/tâche', 'style' => "pointer-events: none;",  'readonly']); ?>
              </div>
              <div class="col-xs-6">
                <?php echo $this->Form->control('progression_id', ['table' => 'tabTache',  'empty' => 'Veuillez choisir une pourcentage !!', 'required' => 'off', 'id' => 'date', 'class' => 'form-control select2', 'label' => 'Progression déclarée']); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <?php echo $this->Form->control('dated', ['table' => 'tabTache',  'required' => 'off', 'id' => 'date', 'type' => 'datetime', 'class' => 'form-control', 'label' => 'Date début']); ?>
              </div>
              <div class="col-xs-6">
                <?php echo $this->Form->control('datefinn', ['table' => 'tabTache',  'required' => 'off', 'id' => 'date', 'type' => 'datetime', 'class' => 'form-control', 'label' => 'Date fin']); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <?php echo $this->Form->control('descriptionn', ['table' => 'tabTache',  'required' => 'off', 'type' => 'textarea', 'id' => 'opportunite_id', 'class' => 'form-control', 'label' => 'Description']); ?>
              </div>
              <div class="col-xs-6">
                <?php echo $this->Form->control('contact', ['table' => 'tabTache',  'required' => 'off', 'id' => 'contact', 'type' => 'textarea', 'class' => 'form-control', 'label' => 'Contact']); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-3">
                <label>Charge de travail prévue :</label>
                <?php echo $this->Form->control('duree', ['table' => 'tabTache',  'required' => 'off', 'id' => 'duree', 'type' => 'number', 'class' => 'form-control', 'label' => '', 'placeholder' => 'Heures']); ?>
                <?php echo $this->Form->control('dureem', ['table' => 'tabTache',  'required' => 'off', 'id' => 'dureem', 'type' => 'number', 'class' => 'form-control', 'label' => '', 'placeholder' => 'Minutes']); ?>
              </div>
              <div class="col-xs-3">
                <?php echo $this->Form->control('personnel_id', ['empty' => 'Veuillez choisir un personnel !!', 'style' => 'margin-top:20px', 'required' => 'off', 'id' => 'personnel_id', 'class' => 'form-control ', 'label' => 'Affecté à']); ?>
              </div>

            </div>
            <div align="center">
              <?php echo $this->Form->submit('Ajouter'); ?>
            </div>
          </div>

          <?php echo $this->Form->end(); ?>
        </div>
      </div>
    </div>
  </section>
</div>