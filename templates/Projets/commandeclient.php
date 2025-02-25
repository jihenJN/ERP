<div id="commandeclient" style="display:none;margin-top: 18px;">
  <section class="content-header">
    <h1>
      Commande Client 
      <small>
        <?php echo __(''); ?>
      </small>
    </h1>
  </section>
  <script>
    function desactiverSelection() {
      var selectElement = document.getElementById("ch81");
      selectElement.disabled = true;
    }
  </script>
  <section class="content" style="width: 98%">
    <div class="row">
      <div class="box ">
        <div class="panel-body">
          <div class="table-responsive ls-table">

            <?php echo $this->Form->create($commandeclient, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
            <div <?= $type ?>>
              <div class="row">

                <div class="col-md-6">
                  <?php echo $this->Form->control('id', ['table' => 'tablecommandeclientedit', 'name' => 'data[tablecommandeclient][0][id]', 'type' => 'hidden']); ?>

                  <?php echo $this->Form->control('code', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][code]', 'value' => $code, 'label' => 'Code', 'required' => 'off', 'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'readonly' => 'readonly']); ?>
                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('projet_id', ['options' => $projets, 'value' => $project_id, 'id' => 'projet_id', 'name' => 'projet_idggb', 'disabled', 'empty' => 'Veuillez choisir !!', 'class' => "form-control"]); ?>
                </div>
                <div class="col-xs-6" hidden>
                  <?php echo $this->Form->control('depot_id', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][depot_id]', 'class' => "form-control", 'value' => '9', 'empty' => 'Veuillez choisir !!']); ?>
                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->input('datedecreation', array('table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][datedecreation]', 'value' => $this->Time->format('now', 'd/MM/y'), 'label' => 'Date de creation', 'type' => 'date', 'placeholder' => '',  'class' => 'form-control', 'required')); ?>

                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->input('date', array('name' => 'data[tablecommandeclient][0][date]', 'type' => 'datetime', 'readonly' => 'readonly', 'value' => $this->Time->format('now', 'd/MM/y'), 'label' => 'Date', 'id' => 'date', 'div' => 'form-group ', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control')); ?>
                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('commentaire', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][commentaire]']); ?>
                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->input('client_id', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][client_id]', 'value' => $client['client_id'], 'class' => 'form-control select2', 'id' => 'client_id', 'label' => 'Tiers', 'empty' => 'Veuillez choisir !!']); ?>
                </div>
                <div class="col-md-6">
                  <div height="60px">

                    <label class="control-label" for="unipxte-id" style="margin-top: 25px;">TVA:</label>
                    OUI <input type="radio" name="data[tablecommandeclient][0][tvaOnOff]" index="0" champ="tvaOnOff" table="tablecommandeclient" value="1" id="OUI" class="toggleOffreGGB " style="margin-right: 17px">
                    NON <input type="radio" name="data[tablecommandeclient][0][tvaOnOff]" index="0" champ="tvaOnOff" table="tablecommandeclient" value="0" id="NON" class="toggleOffreGGB " checked>
                  </div>
                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->input('paiement_id', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][paiement_id]', 'value' => '', 'class' => 'form-control select2 ', 'multiple' => 'multiple', 'id' => 'paiement_id', 'label' => 'Mode de reglèment', 'options' => $paiements, 'empty' => false]); ?>
                </div>

                <div class="col-md-6">
                  <?php echo $this->Form->input('duree_validite', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][duree_validite]', 'type' => 'number', 'value' => '15', 'class' => 'form-control', 'id' => 'duree_validite', 'label' => 'Duree de validite en Jours']); ?>
                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->input('incoterm_id', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][incoterm_id]', 'value' => '', 'class' => 'form-control select2', 'id' => 'incoterm_id', 'label' => 'Incoterm en Total', 'empty' => 'Veuillez choisir !!']); ?>
                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->input('incotermpdf_id', ['name' => 'data[tablecommandeclient][0][incotermpdf_id]', 'class' => 'form-control select2', 'id' => 'incotermpdf_id', 'label' => 'Incoterm Pdf', 'empty' => 'Veuillez choisir !!']); ?>
                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->input('pay', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][pay]', 'type' => 'text', 'class' => 'form-control ', 'id' => 'pay_id', 'label' => 'Pay', 'empty' => 'Veuillez choisir !!']); ?>
                </div>
         



                <div class="col-md-6" id="deviseSelect">
                  <?php echo $this->Form->input('devis_id', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][devis_id]', 'value' => '', 'class' => 'form-control', 'id' => 'devis_id', 'label' => 'Devises ', 'options' => $devises, 'empty' => 'Veuillez choisir !!']); ?>
                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('tauxdechange', ['label' => 'Taux de change de devise ', 'name' => 'data[tablecommandeclient][0][tauxdechange]', 'id' => 'tauxChange', 'class' => 'form-control', 'readonly']); ?>
                  <div id="message"></div>
                </div>
                <div class="col-md-6" id="deviseSelect2">
                  <?php echo $this->Form->input('devis2_id', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][devis2_id]', 'value' => '', 'class' => 'form-control', 'id' => 'devis_id2', 'label' => 'Devises en dinar', 'options' => $devises, 'empty' => 'Veuillez choisir !!']); ?>
                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('tauxdechange2', ['label' => 'Taux de change de devise en dinar', 'name' => 'data[tablecommandeclient][0][tauxdechange2]', 'id' => 'tauxChange2', 'class' => 'form-control', 'readonly']); ?>
                  <div id="message2"></div>
                </div>


                <div class="col-md-6">
                  <?php //echo $this->Form->input('conditionreglement_id', ['name' => 'data[tablecommandeclient][0][conditionreglement_id]', 'class' => 'form-control select2', 'id' => 'conditionreglement_id', 'label' => 'Condition de reglement', 'empty' => 'Veuillez choisir !!']); ?>
                  <div class="row">
                    <div class="col-md-10" id="selectcondreg">
                    <?php echo $this->Form->input('conditionreglement_id', ['name' => 'data[tablecommandeclient][0][conditionreglement_id]', 'class' => 'form-control select2', 'id' => 'conditionreglement_id', 'label' => 'Condition de reglement', 'empty' => 'Veuillez choisir !!']); ?>
                    </div>
                    <div class="col-md-1" style="margin-top: 31px;">

                      <a><i class="fa fa-plus urlcondreg" style="color:success;font-size: 25px;"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->input('delailivraison_id', ['name' => 'data[tablecommandeclient][0][delailivraison_id]', 'class' => 'form-control select2', 'id' => 'delailivraison_id', 'label' => 'Délai de livraison', 'empty' => 'Veuillez choisir !!']); ?>
                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->input('methodeexpedition_id', ['name' => 'data[tablecommandeclient][0][methodeexpedition_id]', 'class' => 'form-control select2', 'id' => 'methodeexpedition_id', 'label' => 'Méthode d`expédition', 'empty' => 'Veuillez choisir !!']); ?>
                </div>

                <div class="col-md-6">
                  <?php echo $this->Form->input('datelivraison', array('name' => 'data[tablecommandeclient][0][datelivraison]', 'type' => 'date',  'value' => $this->Time->format('now', 'd/MM/y'), 'label' => 'Date de livraison', 'id' => 'datelivraison', 'class' => 'form-control')); ?>
                </div>

                <div class="col-md-6">
                  <?php echo $this->Form->control('remisetotal', ['id'=>'remisetotal','label' => 'Remise relative sur le total', 'name' => 'data[tablecommandeclient][0][remisetotal]', 'id' => 'remisetotal', 'type' => 'nombre', 'class' => 'form-control']); ?>
                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('nbfergule', ['label' => 'Nombre de chiffre aprés le firgule', 'name' => 'data[tablecommandeclient][0][nbfergule]', 'id' => 'nbfergule', 'type' => 'nombre', 'class' => 'form-control']); ?>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-10" id="selecttransp">
                      <?php echo $this->Form->input('modetransport_id', ['table' => 'tablecommandeclient', 'name' => 'data[tablecommandeclient][0][modetransport_id]', 'value' => '', 'class' => 'form-control select2', 'id' => 'modetransport_id', 'label' => 'Mode transports', 'empty' => 'Veuillez choisir !!']); ?>
                    </div>
                    <div class="col-md-1" style="margin-top: 31px;">

                      <a><i class="fa fa-plus urltransport" style="color:success;font-size: 25px;"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div>
                    <label class="control-label" style="margin-top: 25px;">Détait des montant de transport en pdf:</label>
                    OUI <input type="radio" name="data[tablecommandeclient][0][detailtransport]" index="0" champ="detailtransport" table="tablecommandeclient" value="1" id="OUItransport" class="toggleOffreGGBtransport " style="margin-right: 17px">
                    NON <input type="radio" name="data[tablecommandeclient][0][detailtransport]" index="0" champ="detailtransport" table="tablecommandeclient" value="0" id="NONtransport" class="toggleOffreGGBtransport " checked>
                  </div>
                </div>
              </div>
            </div>





            <!---------------------edit------------------->









            <div <?= $type2 ?>>
              <div class="box-body">
                <div class="row">

                  <div class="col-md-6">
                    <?php echo $this->Form->control('id', ['table' => 'tablecommandeclientedit', 'name' => 'data[tablecommandeclientedit][id]', 'type' => 'hidden']); ?>

                    <?php echo $this->Form->control('code', ['readonly', 'name' => 'data[tablecommandeclientedit][code]', 'table' => 'tablecommandeclientedit', 'disabled' => true]); ?>
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" id="codetauxdechange" table='tablecommandeclientedit' name='data[tablecommandeclientedit][codetauxdechange]' value="<?php echo $code; ?>">
                    <?php
                    echo $this->Form->control('client_id', ['disabled' => true, 'name' => 'data[tablecommandeclientedit][client_id]', 'id' => 'client_id', 'empty' => 'Veuillez choisir !!!', 'class' => "form-control select2", 'options' => $clients]);
                    ?>
                  </div>
                  <div class="col-md-6">
                    <?php echo $this->Form->input('datedecreation', array('table' => 'tablecommandeclientedit', 'name' => 'data[tablecommandeclientedit][datedecreation]', 'value' => $this->Time->format('now', 'd/MM/y'), 'label' => 'Date de creation', 'type' => 'date', 'placeholder' => '',  'class' => 'form-control', 'required')); ?>

                  </div>
                  <div class="col-md-6">
                    <?php
                    echo $this->Form->control('date', ['disabled' => true, 'name' => 'data[tablecommandeclientedit][date]']);
                    ?>
                  </div>
                  <div class="col-md-6">
                    <?php echo $this->Form->control('commentaire', ['readonly' => true, 'name' => 'data[tablecommandeclientedit][commentaire]', 'rows' => 1]); ?>
                  </div>
                  <div class="col-md-6">
                    <?php
                    echo $this->Form->control('projet_id', ['disabled' => true, 'name' => 'data[tablecommandeclientedit][projet_id]', 'empty' => 'Veuillez choisir !!!', 'class' => "form-control select2",]);

                    ?>
                  </div>
                  <div hidden class="col-md-6">
                    <?php
                    echo $this->Form->control('depot_id', ['disabled' => true, 'name' => 'data[tablecommandeclientedit][depot_id]', 'options' => $depots, 'empty' => 'Veuillez choisir !!!', 'class' => "form-control select2",]);

                    ?>
                  </div>
                  <div class="col-md-6">
                    <div height="60px">
                      <label class="control-label" for="unipxte-id">TVA:</label>
                      OUI <input type="radio" disabled value="1" id="OUI" name='data[tablecommandeclientedit][tvaOnOff]' class="toggleEditcomclient" <?php if ($commandeclient->tvaOnOff == 1)
                                                                                                                                                        echo "checked"; ?>>
                      NON <input type="radio" disabled value="0" id="NON" class="toggleEditcomclient" name='data[tablecommandeclientedit][tvaOnOff]' <?php if ($commandeclient->tvaOnOff == 0)
                                                                                                                                                        echo "checked"; ?>>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <?php echo $this->Form->input('paiement_id', ['disabled' => true, 'name' => 'data[tablecommandeclientedit][paiement_id]', 'value' => $gg, 'table' => 'tablecommandeclientedit', 'name' => 'paiement_id', 'class' => 'form-control select2 ', 'multiple' => 'multiple', 'id' => 'paiement_id', 'label' => 'Mode de reglèment', 'options' => $paiements, 'empty' => false]); ?>
                  </div>

                  <div class="col-md-6">
                    <?php echo $this->Form->input('duree_validite', ['disabled' => true, 'name' => 'data[tablecommandeclientedit][duree_validite]', 'type' => 'number', 'value' => '15', 'class' => 'form-control', 'id' => 'duree_validite', 'label' => 'Duree de validite en Jours']); ?>
                  </div>
                  <div class="col-md-6">
                    <?php echo $this->Form->input('incotermpdf_id', ['disabled' => true, 'name' => 'data[tablecommandeclientedit][incotermpdf_id]', 'value' => $commandeclient->incotermpdf_id, 'class' => 'form-control', 'id' => 'incotermpdf_id', 'label' => 'Incoterm Pdf', 'empty' => 'Veuillez choisir !!']); ?>
                  </div>
                  <div class="col-md-6">
                    <?php echo $this->Form->input('pay', ['readonly' => true, 'table' => 'tablecommandeclientedit', 'type' => 'text', 'name' => 'data[tablecommandeclientedit][pay]', 'class' => 'form-control ', 'id' => 'pay_id', 'label' => 'Pay']); ?>
                  </div>
                  <div class="col-md-6">
                    <?php echo $this->Form->input('incoterm_id', ['disabled' => true, 'name' => 'data[tablecommandeclientedit][incoterm_id]', 'value' => $commandeclient->incoterm_id, 'class' => 'form-control', 'id' => 'incoterm_id', 'label' => 'Incoterm en Total', 'empty' => 'Veuillez choisir !!']); ?>
                  </div>






                  <div class="col-md-6" id="deviseSelect">
                    <?php echo $this->Form->input('devis_id', ['disabled' => true, 'name' => 'data[tablecommandeclientedit][devis_id]',  'value' => $commandeclient->devis_id, 'class' => 'form-control', 'id' => 'devis_id', 'label' => 'Devises', 'options' => $devises]); ?>
                  </div>
                  <div class="col-md-6">
                    <?php echo $this->Form->control('tauxdechange', ['disabled' => true, 'name' => 'data[tablecommandeclientedit][tauxdechange]', 'label' => 'Taux de change de devise', 'value' => $commandeclient->tauxdechange, 'id' => 'tauxChange', 'class' => 'form-control', 'readonly']); ?>
                    <div id="message"></div>
                  </div>
                  <div class="col-xs-6" id="deviseSelect2">
                    <?php echo $this->Form->input('devis2_id', ['value' => $commandeclient->devis2_id, 'disabled' => true, 'table' => 'tablecommandeclientedit', 'name' => 'data[tablecommandeclientedit][devis2_id]',  'class' => 'form-control', 'id' => 'devis_id2', 'label' => 'Devises en dinar ', 'options' => $devises, 'empty' => 'Veuillez choisir !!']); ?>
                  </div>
                  <div class="col-xs-6">
                    <?php echo $this->Form->control('tauxdechange2', ['value' => $commandeclient->tauxdechange2, 'disabled' => true, 'name' => 'data[tablecommandeclientedit][tauxdechange2]', 'label' => 'Taux de change de devise  en dinar ', 'id' => 'tauxChange2', 'class' => 'form-control', 'readonly']); ?>
                    <div id="message2"></div>
                  </div>


                  <div class="col-md-6">
                    <?php echo $this->Form->input('conditionreglement_id', ['value' => $commandeclient->conditionreglement_id, 'disabled' => true, 'name' => 'data[tablecommandeclientedit][conditionreglement_id]', 'class' => 'form-control select2', 'id' => 'conditionreglement_id', 'label' => 'Condition de reglement', 'empty' => 'Veuillez choisir !!']); ?>
                  </div>
                  <div class="col-md-6">
                    <?php echo $this->Form->input('delailivraison_id', ['value' => $commandeclient->delailivraison_id, 'disabled' => true, 'name' => 'data[tablecommandeclientedit][delailivraison_id]', 'class' => 'form-control select2', 'id' => 'delailivraison_id', 'label' => 'Délai de livraison', 'empty' => 'Veuillez choisir !!']); ?>
                  </div>
                  <div class="col-md-6">
                    <?php echo $this->Form->input('methodeexpedition_id', ['value' => $commandeclient->methodeexpedition_id, 'disabled' => true, 'name' => 'data[tablecommandeclientedit][methodeexpedition_id]', 'class' => 'form-control select2', 'id' => 'methodeexpedition_id', 'label' => 'Méthode d`expédition', 'empty' => 'Veuillez choisir !!']); ?>
                  </div>

                  <div class="col-md-6">
                    <?php echo $this->Form->input('datelivraison', array('value' => $commandeclient->datelivraison, 'disabled' => true, 'name' => 'data[tablecommandeclientedit][datelivraison]', 'type' => 'date', 'label' => 'Date de livraison', 'id' => 'datelivraison', 'div' => 'form-group ', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control')); ?>
                  </div>

                  <div class="col-md-6">
                    <?php echo $this->Form->control('remisetotal', ['value' => $commandeclient->remisetotal, 'readonly' => true, 'label' => 'Remise relative sur le total', 'name' => 'data[tablecommandeclientedit][remisetotal]', 'id' => 'remisetotal', 'type' => 'text', 'class' => 'form-control number']); ?>
                  </div>
                  <div class="col-md-6">
                    <?php echo $this->Form->control('nbfergule', ['value' => $commandeclient->nbfergule, 'readonly' => true, 'label' => 'Nombre de chiffre aprés le firgule', 'name' => 'data[tablecommandeclientedit][nbfergule]', 'id' => 'nbfergule', 'type' => 'text', 'class' => 'form-control number']); ?>
                  </div>
                  <div class="col-md-6">

                    <?php echo $this->Form->input('modetransport_id', ['value' => $commandeclient->modetransport_id, 'disabled' => true, 'table' => 'tablecommandeclientedit', 'name' => 'data[tablecommandeclientedit][modetransport_id]', 'class' => 'form-control select2', 'id' => 'modetransport_id', 'label' => 'Mode transports', 'empty' => 'Veuillez choisir !!']); ?>

                  </div>
                  <div class="col-md-6">
                    <div height="60px">
                      <label class="control-label" style="margin-top: 25px;">Détait des montant de transport en pdf:</label>
                      OUI <input type="radio" disabled name="data[tablecommandeclientedit][detaittransport]" index="0" champ="detaittransport" table="tablecommandeclientedit" value="1" id="OUItransport" class="toggleOffreGGBtransport " <?php if ($commandeclient->detaittransport == 1) echo "checked"; ?> style="margin-right: 17px">
                      NON <input type="radio" disabled name="data[tablecommandeclientedit][detaittransport]" index="0" champ="detaittransport" table="tablecommandeclientedit" value="0" id="NONtransport" class="toggleOffreGGBtransport " <?php if ($commandeclient->detaittransport == 0) echo "checked"; ?>>
                    </div>
                  </div>
                </div>
              </div>
              <section class="content-header">
                <h1 class="box-title">
                  <?php echo __('Ligne demande client produit'); ?>
                </h1>
              </section>
              <section class="content" style="width: 99%">
                <div class="row">
                  <div class="box">
                    <div class="box-header with-border">
                      <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_ligne33s' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                        <i class="fa fa-plus-circle "></i> Ajouter ligne produit </a>
                    </div>
                    <div class="panel-body">
                      <div class="table-responsive ls-table">
                        <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                          <?php
                          $margemarque = "";

                          if (!empty($lignecommandeclients)) {
                            $res = current($lignecommandeclients);
                            if ($res->tauxdemarque != null) {
                              $margemarque = " Taux de marque";
                            } else {
                              $margemarque = " Taux de marge";
                            }
                          }
                          ?>
                          <thead>
                            <tr width:20px>
                              <td align="center" nowrap="nowrap"><strong>Fournisseur</strong></td>

                              <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; Produit&thinsp; &thinsp; &thinsp; </strong></td>
                              <td align="center" nowrap="nowrap"><strong>Description</strong> </td>
                              <td align="center" nowrap="nowrap"><strong>Unité</strong></td>
                              <td align="center" nowrap="nowrap"><strong>Quantite</strong> </td>
                              <td align="center" nowrap="nowrap"><strong>Prix de revient  en <?php echo $deviseprojet ?></strong></td>
                              <td align="center" nowrap="nowrap"><strong>Prix de revient en devise</strong></td>
                              <td align="center" nowrap="nowrap"><strong>Taux de marge</strong></td>
                              <td align="center" nowrap="nowrap"><strong>Taux de marque</strong></td>

                              <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; PrixHT&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong></td>

                              <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; Remise&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong></td>
                              <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; PUNHT&thinsp; &thinsp; &thinsp; </strong></td>
                              <td nowrap="nowrap" id='thtva' align="center" style="display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>">
                                <strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; Tva&thinsp; &thinsp; &thinsp;&thinsp; &thinsp; </strong>
                              </td>

                              <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; TTC&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong></td>

                              <td align="center" nowrap="nowrap"></td>
                            </tr>
                          </thead>
                          <tbody>


                            <tr class='tr' style="display: none !important">
                              <td style="width: 15%;" align="center">
                                <?php
                                echo $this->Form->control('fournisseur_id', ['options' => $fournisseurs, 'empty' => 'Veuillez choisir !!', 'label' => '', 'table' => 'lignecommandeclientsedit', 'champ' => 'fournisseur_id', 'class' => 'form-control frarticle']); ?>
                              </td>
                              <td style="width: 15%;" align="center">
                                <?php
                                echo $this->Form->input('type', array('name' => '', 'id' => '', 'champ' => 'type', 'value' => '1', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden'));

                                echo $this->Form->input('sup0', array('name' => '', 'id' => '', 'champ' => 'sup0', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden'));
                                echo $this->Form->control('article_id', ['options' => $articles, 'empty' => 'Veuillez choisir !!', 'label' => '', 'table' => 'lignecommandeclientsedit', 'champ' => 'article_id', 'class' => 'form-control getprixarticle']); ?>
                              </td>
                              <td style="width: 15%;">
                                <?php echo $this->Form->input('description', array('champ' => 'description', 'label' => '', 'name' => '', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>
                              </td>
                              <td style="width: 8%;">
                                <label for=""></label>

                                <select champ="unite_id" table="lignecommandeclientsedit" class="form-control " id="" style="top: 10%;">
                                  <option value=""></option>
                                  <?php foreach ($unites as $key => $unit) {

                                  ?>
                                    <option value="<?php echo $unit['id'] ?>"><?php echo $unit['name'] ?></option>
                                  <?php  } ?>
                                </select>

                              </td>

                              <td align="center" style="width: 6%;">
                                <?php echo $this->Form->input('qte', array('champ' => 'qte', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                              </td>
                              <td align="center">
                                <?php echo $this->Form->input('coutrevient', array('champ' => 'coutrevient', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix')); ?>
                              </td>
                              <td align="center">
                                                        <?php echo $this->Form->input('coutrevientdev', array('readonly','champ' => 'coutrevientdev', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix ')); ?>
                                                    </td>
                              <td align="center">
                                <?php echo $this->Form->input('tauxdemarge', array('champ' => 'tauxdemarge', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix')); ?>
                              </td>
                              <td align="center">
                                <?php echo $this->Form->input('tauxdemarque', array('champ' => 'tauxdemarque', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix')); ?>
                              </td>
                              <td align="center">
                                <?php echo $this->Form->input('prixht', array('champ' => 'prixht', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number  ')); ?>
                              </td>
                              <td align="center">
                                <?php echo $this->Form->input('remise', array('champ' => 'remise', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number ')); ?>
                              </td>
                              <td align="center">
                                <?php echo $this->Form->input('punht', array('champ' => 'punht', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number ')); ?>
                              </td>
                              <td champ="tdtva" table="tablelignetva" id="" name="" index="" style="display:none;" align="center">
                                <?php echo $this->Form->input('tva', array('champ' => 'tva', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number ')); ?>
                              </td>
                          
                              <td align="center">

                                <?php echo $this->Form->input('ttc', array('champ' => 'ttc', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number ')); ?>
                              </td>
                              <td style="width:2%" align="center"><i id="" class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;"></td>
                            </tr>
                          </tbody>
                        </table><br>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <section class="content-header">
                <h1 class="box-title">
                  <?php echo __('Ligne demande client service'); ?>
                </h1>
              </section>
              <section class="content" style="width: 99%">
                <div class="row">
                  <div class="box">
                    <div class="box-header with-border">
                      <a class="btn btn-primary  " table='addtablem' index='indexm' id='ajouter_ligne33m' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                        <i class="fa fa-plus-circle "></i> Ajouter ligne demande client</a>
                    </div>
                    <div class="panel-body">
                      <div class="table-responsive ls-table">
                        <table class="table table-bordered table-striped table-bottomless" id="tabligne3m">
                          <?php
                          $margemarque = "";

                          if (!empty($lignecommandeclients)) {
                            $res = current($lignecommandeclients);
                            if ($res->tauxdemarque != null) {
                              $margemarque = " Taux de marque";
                            } else {
                              $margemarque = " Taux de marge";
                            }
                          }
                          ?>
                          <thead>
                            <tr width:20px>

                              <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; Service&thinsp; &thinsp; &thinsp; </strong></td>
                              <td align="center" nowrap="nowrap"><strong>Description</strong>
                              </td>
                              <td align="center" nowrap="nowrap"><strong>Unité</strong></td>
                              <td align="center" nowrap="nowrap"><strong>Quantite</strong>
                              </td>
                              <td align="center" nowrap="nowrap"><strong>Prix de revient  en <?php echo $deviseprojet ?></strong></td>
                              <td align="center" nowrap="nowrap"><strong>Prix de revient en devise</strong></td>
                              <td align="center" nowrap="nowrap"><strong>Taux de marge</strong></td>
                              <td align="center" nowrap="nowrap"><strong>Taux de marque</strong></td>

                              <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; PrixHT&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong></td>

                              <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; Remise&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong></td>
                              <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; PUNHT&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong></td>
                              <td nowrap="nowrap" id='thtva' align="center" style="display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'table-cell' : 'none'; ?>">
                                <strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; Tva&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong>
                              </td>

                              <td align="center" nowrap="nowrap"><strong>&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; TTC&thinsp; &thinsp; &thinsp; &thinsp; &thinsp; </strong></td>

                              <td align="center" nowrap="nowrap"></td>
                            </tr>
                          </thead>
                          <tbody>


                            <tr class='tr' style="display: none !important">
                              <td style="width: 15%;" align="center">
                                <?php
                                echo $this->Form->input('sup0', array('name' => '', 'id' => '', 'champ' => 'sup0', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden'));
                                echo $this->Form->input('type', array('name' => '', 'id' => '', 'champ' => 'type', 'value' => '2', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden'));

                                echo $this->Form->control('article_id', ['options' => $articleservices, 'empty' => 'Veuillez choisir !!', 'label' => '', 'table' => 'lignecommandeclientsedit', 'champ' => 'article_id', 'class' => 'form-control getprixarticle']); ?>
                              </td>
                              <td style="width: 15%;">
                                <?php echo $this->Form->input('description', array('champ' => 'description', 'label' => '', 'name' => '', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>
                              </td>
                              <td style="width: 8%;">

                                <select champ="unite_id" table="lignecommandeclientsedit" class="form-control " id="">
                                  <option value=""></option>
                                  <?php foreach ($unites as $key => $unit) {

                                  ?>
                                    <option value="<?php echo $unit['id'] ?>"><?php echo $unit['name'] ?></option>
                                  <?php  } ?>
                                </select>

                              </td>

                              <td align="center" style="width: 6%;">
                                <?php echo $this->Form->input('qte', array('champ' => 'qte', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                              </td>
                              <td align="center">
                                <?php echo $this->Form->input('coutrevient', array('champ' => 'coutrevient', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix')); ?>
                              </td>
                              <td align="center">
                                                        <?php echo $this->Form->input('coutrevientdev', array('readonly','champ' => 'coutrevientdev', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix ')); ?>
                                                    </td>
                              <td align="center">
                                <?php echo $this->Form->input('tauxdemarge', array('champ' => 'tauxdemarge', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix')); ?>
                              </td>
                              <td align="center">
                                <?php echo $this->Form->input('tauxdemarque', array('champ' => 'tauxdemarque', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number  calculprix')); ?>
                              </td>
                              <td align="center">
                                <?php echo $this->Form->input('prixht', array('champ' => 'prixht', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number ')); ?>
                              </td>
                              <td align="center">
                                <?php echo $this->Form->input('remise', array('champ' => 'remise', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixhtson number')); ?>
                              </td>
                              <td align="center">
                                <?php echo $this->Form->input('punht', array('champ' => 'punht', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                              </td>
                              <td champ="tdtva" table="tablelignetva" id="" name="" index="" style="display:none;" align="center">
                                <?php echo $this->Form->input('tva', array('champ' => 'tva', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                              </td>
                              <!-- <td align="center">
                                                          <?php echo $this->Form->input('fodec', array('champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                                                        </td> -->
                              <td align="center">

                                <?php echo $this->Form->input('ttc', array('champ' => 'ttc', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclientsedit', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number getprixhtson ')); ?>
                              </td>
                              <td style="width:2%" align="center"><i id="" class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;"></td>
                            </tr>
                          </tbody>
                        </table><br>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" value="-1" id="indexoffreggb">

              </section>
              <div class="row">
                <div class="col-md-6">
                  <?php echo $this->Form->control('totalht', ['name' => 'data[tablecommandeclientedit][totalht]', 'readonly' => true, 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $totalttc)]); ?>
                </div>
                <div id="divtva" class="col-xs-3" style="display:<?php echo ($commandeclient->tvaOnOff == 1) ? 'block' : 'none'; ?>">
                  <?php echo $this->Form->control('totaltva', ['name' => 'data[tablecommandeclientedit][totaltva]', 'readonly' => true, 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $commandeclient->totaltva)]); ?>
                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('totalfodec', ['name' => 'data[tablecommandeclientedit][totalfodec]', 'readonly' => true, 'label' => 'Total Taux de Marque', 'id' => 'totalmarque', 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $commandeclient->totalfodec)]); ?>
                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('totalmarge', ['name' => 'data[tablecommandeclientedit][totalmarge]', 'readonly' => true, 'label' => 'Total Taux de Marge', 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $commandeclient->totalmarge), 'id' => 'totalmarge']); ?>
                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('totalremise', ['name' => 'data[tablecommandeclientedit][totalremise]', 'readonly' => true, 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $commandeclient->totalremise)]); ?>
                </div>
                <div class="col-md-6">
                  <?php echo $this->Form->control('totalttc', ['name' => 'data[tablecommandeclientedit][totalttc]', 'readonly' => true, 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $totalttc)]) ?>
                  <?php
                  echo $this->Form->control('totalttcdl', ['name' => 'data[tablecommandeclientedit][totalttcdl]', 'readonly' => true, 'id' => 'totalttcdl', 'type' => 'hidden', 'value' => sprintf("%01." . $commandeclient->nbfergule . "f", $commandeclient->totalttcdl),  'label' => 'Total TTC', 'readonly' => true]); ?>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div align="center" class="addoffreggb" >
        <button type="submit" class="pull-right btn btn-success btn-sm" id="poi1ntv" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
      </div>
      <?php echo $this->Form->end(); ?>

    </div>
  </section>
</div>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2   class="addoffreggb" id="e1" id="poi1ntv"-->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>

<script>
  $(document).ready(function() {
    var selectPS = document.getElementById('ch81');
    var ajouterligneGGB = document.getElementById('ajouter_ligne_offreggb');
    $("#ch81").on("change", function() {
      val = $(this).val(); //alert(val)
      if (Number(val)) {
        ajouterligneGGB.classList.remove("disabled");
      } else {
        ajouterligneGGB.classList.add("disabled");
      }
    });
  });
</script>
<script>
  function getTauxChange(devise) {
    const apiKey = 'fba6e8ad2ac7e46125bc58df';
    const url = `https://v6.exchangerate-api.com/v6/${apiKey}/latest/${devise}`;
    fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error('Erreur lors de la récupération des données');
        }
        return response.json();
      })
      .then(data => {
        const tauxTND = data.conversion_rates.TND;
        document.getElementById('tauxChange').value = tauxTND;
        document.getElementById('message').textContent = '';
      })
      .catch(error => {
        document.getElementById('message').textContent = 'Erreur: Impossible de récupérer le taux de change.';
        document.getElementById('tauxChange').value = '';

      });
  }

  function getTauxChange2(devise) {
    const apiKey = 'fba6e8ad2ac7e46125bc58df';
    const url = `https://v6.exchangerate-api.com/v6/${apiKey}/latest/${devise}`;
    fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error('Erreur lors de la récupération des données');
        }
        return response.json();
      })
      .then(data => {
        const tauxTND = data.conversion_rates.TND;
        document.getElementById('tauxChange2').value = tauxTND;
        document.getElementById('message2').textContent = '';
      })
      .catch(error => {
        document.getElementById('message2').textContent = 'Erreur: Impossible de récupérer le taux de change.';
        document.getElementById('tauxChange2').value = '';

      });
  }
  $(document).ready(function() {
    $('#deviseSelect').on('change', function() {
      // var devise_id = $(this).val();
      devise_id = $('#devis_id').val();
      projet_id = $('#projet_id').val();
      // var devise = mapDevise(devise_id);

      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'getdevise']) ?>",
        dataType: "json",
        data: {
          devise_id: devise_id,
          projet_id:projet_id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          console.log(data)
          var devis = data.code;
         
          if(data.taux!=0){
        //alert( data.taux)
            document.getElementById('tauxChange').value = data.taux;

          }else{
            getTauxChange(devis);
          }
          calcullll()
        }

      })
    });
    $('#deviseSelect2').on('change', function() {
      // var devise_id = $(this).val();
      devise_id = $('#devis_id2').val();
      // var devise = mapDevise(devise_id);

      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'getdevise']) ?>",
        dataType: "json",
        data: {
          devise_id: devise_id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          console.log(data)
          var devis = data.code;
          getTauxChange2(devis);
          //getprixhtsonia()
        }

      })
    });
  });
</script>
<script>
  function openWindow(h, w, url) {
    //alert()
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
  }
  function calcullll(){
      // index1 = $("#indexa").val();
      index = $("#indexoffreggb").val();
      taux=1;
      tauxChange2 = $("#tauxChange").val();
      if (tauxChange2!='' && Number(tauxChange2)!=0) {
        taux = $("#tauxChange").val(); 
      }
      // indexl = $("#indexa" + index).val();
      nbfergule = $("#nbfergule").val();
      // indexl = $("#indexa" + index).val();
      ferg=3;
      if (nbfergule!='' && Number(nbfergule)!=0) {
        ferg=$("#nbfergule").val();
        
      }
      prixMG = 0;
      prixMQ = 0;
      total = 0;
      totalmarge = 0;
      totalmarque = 0;

      for (i = 0; i <= Number(index); i++) {
        sup = $("#sup0" + i).val() || 0;
        if (Number(sup) != 1) {
          coutrevient = $("#coutrevient" + i).val(); //alert(prixrevient)
          MG = $("#tauxdemarge" + i).val() || 0; //alert(MG)
          MQ = $("#tauxdemarque" + i).val() || 0; //alert(MQ)
          prixrevient=Number(coutrevient)*Number(taux);
          $("#coutrevientdev" + i).val(Number(prixrevient).toFixed(ferg));
          console.log('mg ' + MG);
          if (MG && MQ) {
            alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
            $("#tauxdemarge" + i).val('');
            $("#tauxdemarque" + i).val('');
            $("#prixht" + i).val('');
            // $("#punht" + i).val('');
          } else if (MQ &&  Number(prixrevient)!=0) {
            marque=100-Number(MQ);

            //prixMG = Number(prixrevient) + (Number(MQ) * Number(prixrevient) / 100)
            prixMG = ((Number(prixrevient)*100)/Number(marque));///Number(taux);
           // prixMG = Math.floor(prixMG); // Conversion en entier
            $("#prixht" + i).val(Number(prixMG).toFixed(ferg));
            //$("#prixht" + i).val(prixMG);
            //$("#punht" + i).val(prixMG);
            margel = Number(prixMG) * Number(MQ / 100);//*Number(taux);
            totalmarque = (Number(totalmarque) + Number(margel)).toFixed(ferg);
           
          } else if (MG &&  Number(prixrevient)!=0) {
            prixMQ =(Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100));///Number(taux); //alert(prixMQ)
           // alert(Number(prixMQ).toFixed(3));
            $("#prixht" + i).val(Number(prixMQ).toFixed(ferg));
            marquel = Number(prixMQ) * Number(MG / 100);//*Number(taux);
            totalmarge = (Number(totalmarge) + Number(marquel)).toFixed(ferg);
            // $("#punht" + i).val(prixMG);
          } else {
            if ( Number(prixrevient)!=0) {
              $("#prixht" + i).val(Number(Number(prixrevient)/* /Number(taux) */).toFixed(ferg));
            }
           
          }
        }
      }
      $("#totalmarge").val(Number(totalmarge).toFixed(ferg));
      $("#totalmarque").val(Number(totalmarque).toFixed(ferg));
      getprixhtsonia();

  }

  $('.select2').select2({
    width: '100%' // need to override the changed default
  });
</script>
<script>
  $(document).ready(function() {
    $(".calcull").on("keyup", function() {
      index = $("#index").val(); //nombre de ligne total
      index1 = $("#indexa").val();
      index = $("#index").val();
      indexl = $("#indexoffreggb").val();
      tt = 0;
      total = 0;
      for (i = 0; i <= Number(indexl); i++) {
        sup = $("#sup" + i).val() || 0;
        if (Number(sup) != 1) {
          qte = $("#qte" + j + "-" + i).val();
          prix = $("#prix" + j + "-" + i).val();
          tot = Number(qte) * Number(prix);
          total = Number(total) + Number(tot);
          $("#total" + j + "-" + i).val(Number(tot).toFixed(3)); ///('afef')
        }

        tt = Number(tt) + Number(total);
        $("#t" + j).val(Number(tt).toFixed(3));
      }
    });
    $(".calculprix").on("keyup", function() {
      // index = $("#index").val();
      // index1 = $("#indexa").val();
      index = $("#indexoffreggb").val();
      taux=1;
      tauxChange2 = $("#tauxChange").val();
      if (tauxChange2!='' && Number(tauxChange2)!=0) {
        taux = $("#tauxChange").val(); 
      }
      // indexl = $("#indexa" + index).val();
      nbfergule = $("#nbfergule").val();
      // indexl = $("#indexa" + index).val();
      ferg=3;
      if (nbfergule!='' && Number(nbfergule)!=0) {
        ferg=$("#nbfergule").val();
        
      }
      prixMG = 0;
      prixMQ = 0;
      total = 0;
      totalmarge = 0;
      totalmarque = 0;

      for (i = 0; i <= Number(index); i++) {
        sup = $("#sup0" + i).val() || 0;
        if (Number(sup) != 1) {
          coutrevient = $("#coutrevient" + i).val(); //alert(prixrevient)
          MG = $("#tauxdemarge" + i).val() || 0; //alert(MG)
          MQ = $("#tauxdemarque" + i).val() || 0; //alert(MQ)
          console.log('mg ' + MG);
          prixrevient=Number(coutrevient)*Number(taux);
          $("#coutrevientdev" + i).val(Number(prixrevient).toFixed(ferg));
          if (MG && MQ) {
            alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
            $("#tauxdemarge" + i).val('');
            $("#tauxdemarque" + i).val('');
            $("#prixht" + i).val('');
            // $("#punht" + i).val('');
          } else if (MQ &&  Number(prixrevient)!=0) {
            marque=100-Number(MQ);

            //prixMG = Number(prixrevient) + (Number(MQ) * Number(prixrevient) / 100)
            prixMG = ((Number(prixrevient)*100)/Number(marque));///Number(taux);
           // prixMG = Math.floor(prixMG); // Conversion en entier
            $("#prixht" + i).val(Number(prixMG).toFixed(ferg));
            //$("#prixht" + i).val(prixMG);
            //$("#punht" + i).val(prixMG);
            margel = Number(prixMG) * Number(MQ / 100);//*Number(taux);
            totalmarque = (Number(totalmarque) + Number(margel)).toFixed(ferg);
           
          } else if (MG &&  Number(prixrevient)!=0) {
            prixMQ =(Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100));///Number(taux); //alert(prixMQ)
           // alert(Number(prixMQ).toFixed(3));
            $("#prixht" + i).val(Number(prixMQ).toFixed(ferg));
            marquel = Number(prixMQ) * Number(MG / 100);//*Number(taux);
            totalmarge = (Number(totalmarge) + Number(marquel)).toFixed(ferg);
            // $("#punht" + i).val(prixMG);
          } else {
            if ( Number(prixrevient)!=0) {
              $("#prixht" + i).val(Number(Number(prixrevient)/* /Number(taux) */).toFixed(ferg));
            }
           
          }
        }
      }
      $("#totalmarge").val(Number(totalmarge).toFixed(ferg));
      $("#totalmarque").val(Number(totalmarque).toFixed(ferg));
      getprixhtsonia();

    });
  });
</script>
<!-- <script>
    $(document).ready(function () {
      $(".calculprix").on("keyup", function () {
        // index = $("#index").val();
        index1 = $("#indexa").val();
        index = $("#indexoffreggb").val();
        indexl = $("#indexa" + index).val();
          prixMG = 0;
          prixMQ = 0;
          total = 0;
          for (i = 0; i <= Number(index); i++) {
            sup = $("#sup" + i).val() || 0;
            if (Number(sup) != 1) {
              prix = $("#prix" + j + "-" + i).val(); //alert(prix)
              MG = $("#tauxdemarge" + j + "-" + i).val(); //alert(MG)
              MQ = $("#tauxdemarque" + j + "-" + i).val(); //alert(MQ)
              if (MG && MQ) {
                alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
                $("#tauxdemarge" + j + "-" + i).val('');
                $("#tauxdemarque" + j + "-" + i).val('');
                $("#coutrevient" + j + "-" + i).val('');
              } else if (MG) {
                prixMG = Number(prix) + (Number(MG) * Number(prix) / 100);
                prixMG = Math.floor(prixMG); // Conversion en entier
                $("#coutrevient" + j + "-" + i).val(prixMG);
              } else if (MQ) {
                prixMQ = Number(prix) + (Number(MQ) * Number(prix) / 100);
                $("#coutrevient" + j + "-" + i).val(Number(prixMQ).toFixed(3));
              }
            
          }
        }
      });
    });
  </script> -->
<script>
  $("#ajouter_ligne_offreggb").on("click", function() {
    id = $("#ch81").val();
    if (id == "Veuillez choisir !!") {
      alert("Vous devez choisir Produit ou Service");
    } else {
      ajouter_lignefares("tabligne3", "indexoffreggb");
    }
  });
  $('.urlcondreg').on('click', function() {
    var index = $(this).attr('index');
    // alert(index)
    var currentUrl = window.location.href;
    var parentUrl = currentUrl.split('/').slice(0, 4).join('/');
    var link = parentUrl + "/conditionreglements/addmode/";
    // alert(link);
    window.open(link, "_blank", "width=1000,height=1000");
    // openWindow(1000, 1000, link);
  });
  $('.urltransport').on('click', function() {
    var index = $(this).attr('index');
    // alert(index)
    var currentUrl = window.location.href;
    var parentUrl = currentUrl.split('/').slice(0, 4).join('/');
    var link = parentUrl + "/modetransports/addmode/";
    // alert(link);
    window.open(link, "_blank", "width=1000,height=1000");
    // openWindow(1000, 1000, link);
  });
  $('.categorieggb').on('click', function() {
    id = $("#ch81").val();
    if (id == "Veuillez choisir !!") {
      event.preventDefault();
    };
    id = $(this).val();
    index = $(this).attr('index');
    $.ajax({
      method: "GET",
      url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'getcategorieoffrggb']) ?>",
      dataType: "json",
      data: {
        id: id,
        index: index,
      },
      headers: {
        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
      },
      success: function(data) {
        $('#tdarticle' + index).html(data.select);
        setTimeout(function() {
          $('#tdarticle' + index + ' select').select2();
        }, 100);
        // $('#ch81').prop('disabled', true);

      }
    })
  });
</script>
<style>
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  ;

  input[type="number"] {
    -moz-appearance: textfield;
  }
</style>