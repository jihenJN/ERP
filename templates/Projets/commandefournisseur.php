<?php echo $this->Html->css('select2'); ?>
<div id="commandefournisseur" style="display: none;margin-top: 18px;">
  <section class="content-header">
    <h1>
      Finance
      <small>
        <?php echo __(''); ?>
      </small>
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <?php
          $session = $this->request->getSession();
          $com = $session->write('com', null);
          echo $this->Form->create($thisprojetfinance, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);
          echo $this->Form->hidden('form_name', ['value' => 'projetfinance']);

          ?>
          <div class="box-body">
            <div class="row">
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('verificationdevis', [
                  'type' => 'checkbox',
                  'label' => 'Vérification devis ',
                  'checked' => !empty($thisprojetfinance->verificationdevis) && $thisprojetfinance->verificationdevis == 1

                ]);
                ?>

                <?php
                echo $this->Form->control('verificationpaiement', [
                  'type' => 'checkbox',
                  'label' => 'Vérification mode de paiement ',
                  'checked' => !empty($thisprojetfinance->verificationpaiement) && $thisprojetfinance->verificationpaiement == 1

                ]);
                ?>
              </div>



              <div class="col-xs-6">
                <?php echo $this->Form->control('datefinance', ['value' => $thisprojetfinance->datefinance, 'type' => 'datetime', 'label' => 'Reçu aux finances', 'class' => 'form-control ', 'id' => 'datefinance']); ?>
              </div>
            </div>
          </div>

          <div align="center" id="e1" class="index">
            <button type="submit" class="pull-right btn btn-success btn-sm"
              style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
          </div>
          <?php echo $this->Form->end(); ?>
        </div>
      </div>
    </div>
  </section>
</div>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<script>
  $('.select2').select2({
    width: '100%' // need to override the changed default
  });
</script>
<script>
  $("#ajouter_ligne_commande").on("click", function() {

    index = Number($("#indexcommande").val());
    // alert(index);
    $("#article_id" + index).select2({

      width: "100%",
    });


  });
</script>
<!-- <style>
  .select2-selection__rendered {
    line-height: 31px !important;
  }

  .select2-container .select2-selection--single {
    height: 35px !important;
  }

  .select2-selection__arrow {
    height: 34px !important;

  }

  .select2-container {
    display: block;
    width: auto !important;
  }
</style> -->
<!-- <script>
  function testTVA() {
    var radioOUI = document.getElementById("OUI");
    var thtva = document.getElementById("thtva");

    if (radioOUI.checked) {
      thtva.style.display = "table-cell";
      console.log(thtva);
    } else {
      thtva.style.display = "none";
    }
  }

  // Attacher un gestionnaire d'événement au changement de l'état du bouton radio
  var radioButtons = document.querySelectorAll(".toggleTVA");
  for (var i = 0; i < radioButtons.length; i++) {
    radioButtons[i].addEventListener("change", toggleTVA);
  }
</script> -->