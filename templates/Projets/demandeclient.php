<?php echo $this->Html->css('select2'); ?>
<div id="demandeclient" style="display:none;margin-top: 18px;">

  <section class="content-header">
    <h1>
      Demande client
      <small>
        <?php echo __(''); ?>
      </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
          <?php echo __('Retour'); ?>
        </a></li>
    </ol>
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
          <?php echo $this->Form->create($demandeoffredeprix, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
          <div class="box-body">
            <div class="row">
              <div class="col-xs-6">
                <?php echo $this->Form->control('date', ['table' => 'tabledemandeoffre', 'type' => 'date', 'name' => 'data[tabledemandeoffre][0][date]', 'value' => $dateAujourdhui, 'label' => 'Date', 'empty' => true, 'id' => 'date', 'class' => "form-control pull-right"]);
                ?>
              </div>
              <div class="col-xs-6">
                <?php echo $this->Form->control('numero', ['table' => 'tabledemandeoffre', 'name' => 'data[tabledemandeoffre][0][numero]', 'value' => $num_dof, 'label' => 'Numero', 'required' => 'off', 'id' => 'datecommande', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control  ', 'type' => '', 'readonly' => 'readonly']); ?>
              </div>
              <div class="col-xs-6">
                <?php echo $this->Form->control('projet_id', ['table' => 'tabledemandeoffre', 'name' => 'data[tabledemandeoffre][0][projet_id]', 'value' => $project_id, 'empty' => 'Veuillez choisir un projet!!', 'class' => 'form-control select2', 'champ' => 'projet_id', 'label' => 'Projet']); ?>
              </div>
              <!--  <div class="col-xs-6">
                <label> Produit | Service </label>
                <select name="typearticle" class="form-control select2" id="selectproduitouservice">
                  <option value=""> Veuillez choisir !!
                  <option value="1" <?php if ($demandeoffredeprix->typearticle == 1) { ?> selected <?php } ?>> Produit
                  <option value="2" <?php if ($demandeoffredeprix->typearticle == 2) { ?> selected <?php } ?>> Service
                </select>
              </div> -->
            </div>

            <section class="content-header">
              <h1 class="box-title">
                <?php echo __(' Les articles'); ?>
              </h1>
            </section>
            <section class="content" style="width: 99%">
              <div class="row">
                <div class="box">
                  <div class="box-header with-border">
                    <!-- <a class="btn btn-primary al categorie" table='addtable' index='index' id='ajouter_lignearticle'
                      style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                      <i class="fa fa-plus-circle "></i> Ajouter Article</a> -->
                    <a class="btn btn-primary al categorie " style=" float: right;margin-bottom: 5px;" table='addtable' index='index' id='ajouter_lignearticle'>
                      Ajouter Article <i class="fa fa-plus-circle "></i>
                    </a>
                  </div>
                  <div class="panel-body">
                    <div class="table-responsive ls-table">
                      <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                        <thead>
                          <tr>
                            <td align="center" style="width: 40%;"><strong>Nom du article</strong></td>
                            <td align="center" style="width: 10%;"></td>
                            <td align="center" style="width: 40%;"><strong>Quantité</strong></td>
                            <td align="center" style="width: 10%;"></td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="tr" style="display: none !important">
                            <td champ="tdarticle">
                              <?php
                              echo $this->Form->control('article_id', ['empty' => 'Veuillez choisir !!!', 'index' => '', 'id' => '', 'options' => $articles, 'name' => '', 'label' => '', 'table' => 'lignea', 'champ' => 'article_id', 'class' => 'form-control   ']); ?>

                            </td>
                            <td hidden>
                              <?php echo $this->Form->input('sup0', array('name' => '', 'id' => '', 'champ' => 'sup0', 'table' => 'lignea', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => '', 'class' => 'form-control')); ?>
                            </td>
                            <td align="center">

                              <div style="position: static; margin-top: 6px;">
                                <a><i class="fa fa fa-plus urlarticle" style="color: success; font-size: 20px;"></i></a>
                              </div>
                            </td>
                            <td align="center">
                              <?php echo $this->Form->control('a', ['label' => '', 'name' => '', 'value' => '30', 'class' => ' form-control enr80', 'index' => '', 'champ' => 'qte', 'table' => 'lignea', 'id' => 'qte']); ?>
                            </td>
                            <td align="center">
                              <i index="0" id="" class="fa fa-times supLigneArticle1" style="color: #c9302c;font-size: 22px;"></i>
                            </td>
                          </tr>
                          <input type="hidden" value="-1" id="indexarticle">
                        </tbody>
                      </table><br>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <section class="content-header" style="margin-top:-2%;">
              <h1 class="box-title">
                <?php echo __('Fournisseurs'); ?>
              </h1>
            </section>
            <section class="content" style="width: 99%;margin-top:4%;">
              <div class="row">
                <div class="box">
                  <div class="box-header with-border">
                    <a class="btn btn-primary" table='addtable' index='index1' id='ajouter_ligne_fournisseur' style="float: right; margin-bottom: 5px;">
                      <i class="fa fa-plus-circle "></i> Ajouter Fournisseur</a>
                  </div>
                  <div class="panel-body">
                    <div class="table-responsive ls-table">
                      <table class="table table-bordered table-striped table-bottomless" id="tabligne1">
                        <thead>
                          <tr width:20px">
                            <td align="center" style="width: 40%;"><strong>Nom du fournisseur</strong></td>
                            <td align="center" style="width: 10%;"></td>
                            <td align="center" style="width: 40%;"><strong>E_mail fournisseur</strong></td>
                            <td align="center" style="width: 10%;"></td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="tr" style="display: none !important">
                            <td align="center">
                              <?php echo $this->Form->input('sup1', array('name' => '', 'id' => '', 'champ' => 'sup1', 'table' => 'lignef', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                              <!-- <div id="" index="" champ='f1'>
                                <?php echo $this->Form->input('a', array('label' => '', 'value' => '16', 'options' => $fournisseursOptions, 'name' => '', 'id' => 'id', 'class' => 'form-control getmailfrns', 'champ' => 'fournisseur_id', 'table' => 'lignef', 'div' => 'form-group', 'between' => '<div class="col-sm-12 " >', 'after' => '</div>', 'empty' => 'Veuillez Choisir !!')); ?>
                              </div> -->
                              <br>
                              <div id="" index="" champ='f1'>
                                <select name="fournisseur_id" id="fournisseur_id" class="form-control  control-label getmailfrns" champ="fournisseur_id" table="lignef">
                                  <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                  <?php foreach ($fournisseurss as $id => $four) { ?>
                                    <option value="<?php echo $four->id; ?>">
                                      <?php echo $four->name ?>
                                    </option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div index="" id="" champ="inputfour" style="display: none !important">
                                <?php echo $this->Form->input('a', array('label' => '', 'name' => '', 'id' => 'id', 'class' => 'form-control', 'champ' => 'nameF', 'table' => 'lignef', 'div' => 'form-group', 'between' => '<div class="col-sm-12 " >', 'after' => '</div>')); ?>
                              </div>
                              <br>
                            </td>
                            <td align="center">
                              <div style="position: static; margin-top: 6px;">
                                <a><i class="fa fa fa-plus urlfournisseur" style="color: success; font-size: 20px;"></i></a>
                              </div>
                            </td>
                            <td>
                              <?php echo $this->Form->input('a', array('label' => '', 'value' => 'contact@globalgypse.com', 'name' => '', 'class' => 'form-control', 'champ' => 'mail', 'table' => 'lignef', 'div' => 'form-group', 'between' => '<div class="col-sm-12 " >', 'after' => '</div>')); ?>
                            </td>
                            <td align="center">
                              <i index="0" id="" class="fa fa-times supLigneFournisseur" style="color: #c9302c;font-size: 22px;"></i>
                            </td>
                          </tr>
                          <input type="hidden" value="-1" id="index1">
                        </tbody>
                      </table><br>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <div align="center" id="eanr3" class="index">
              <?php echo $this->Form->submit(__('Enregistrer')); ?>

            </div>
            <?php echo $this->Form->end(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    document.getElementById('ajouter_lignearticle').addEventListener('click', function(event) {
      if (this.hasAttribute('disabled')) {
        event.preventDefault(); // Empêche l'action par défaut du bouton
      } else {
        // Votre code pour ajouter des lignes ici
      }
    });
  </script>
  <style>
    #ajouter_lignearticle.disabled {
      pointer-events: none;
      opacity: 0.5;
    }
  </style>
  <script>
    $(document).ready(function() {
      var selectproduitouservice = document.getElementById('selectproduitouservice');
      var ajouterligne = document.getElementById('ajouter_lignearticle');

      $("#selectproduitouservice").on("change", function() {
        val = $(this).val(); //alert(val)
        if (Number(val)) {
          ajouterligne.classList.remove("disabled");
        } else {
          ajouterligne.classList.add("disabled");
        }
      });
    });
  </script>
  <script>
    $('.categorie').on('click', function() {
      id = $("#selectproduitouservice").val();
      index = $("#indexarticle").val();
      ind = index + 1;
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'getcategorie']) ?>",
        dataType: "json",
        data: {
          id: id,
          index: index,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          $('#tdarticle' + ind).html(data.select);
          $('#tdarticle' + ind + ' select').select2();
          $('#selectproduitouservice').prop('disabled', true);
        }
      })
    });
  </script>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      var select = $('#selectproduitouservice');
      var ajouterLigneArticle = $('#ajouter_lignearticle');

      // Désactiver le bouton par défaut
      ajouterLigneArticle.prop('disabled', true);

      // Ajouter un gestionnaire d'événements pour la modification de la sélection
      select.change(function() {
        if ($(this).val()) {
          ajouterLigneArticle.prop('disabled', false); // Activer le bouton si une option est sélectionnée
        } else {
          ajouterLigneArticle.prop('disabled', true); // Désactiver le bouton si aucune option n'est sélectionnée
        }
      });

      // Ajouter un gestionnaire d'événements au clic sur le bouton
      ajouterLigneArticle.click(function(event) {
        if ($(this).prop('disabled')) {
          event.preventDefault(); // Empêcher le comportement par défaut du bouton si celui-ci est désactivé
        } else {
          // Code pour ajouter une ligne ici
        }
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      var clickCounter2 = 0;
      $(".ajofournisseur").on("click", function() {
        clickCounter2++;
        index = $("#index1").val();
        ind = $(this).attr("index");
        // alert(ind);
        t2 = clickCounter2 % 2;
        console.log(t2);
        if (t2 == 1) {
          $("#mail" + ind).val("");
          $("#f1" + ind).val(0);
          $("#inputfour" + ind).val("");
          $("#f1" + ind).attr("style", "display:none;");
          $("#inputfour" + ind).attr("style", "display:true;");
        } else if (t2 == 0) {
          $("#mail" + ind).val("");
          $("#f1" + ind).val("");
          $("#inputfour" + ind).val("");
          $("#f1" + ind).attr("style", "display:true;");
          $("#inputfour" + ind).attr("style", "display:none;");
        }
      });
      $('.urlarticle').on('click', function() {
        var index = $(this).attr('index');
        var currentUrl = window.location.href;
        var parentUrl = currentUrl.split('/').slice(0, -3).join('/');
        var link = parentUrl + "/demandeoffredeprixes/addarticle/" + index;
        // alert(link);
        window.open(link, "_blank", "width=1000,height=1000");
      });
      $('.urlfournisseur').on('click', function() {
        var index = $(this).attr('index');
        var currentUrl = window.location.href;
        var parentUrl = currentUrl.split('/').slice(0, -3).join('/');
        var link = parentUrl + "/demandeoffredeprixes/addfournisseur/" + index;
        // alert(link);
        window.open(link, "_blank", "width=1000,height=1000");
      });
      $(".getmailfrns").on("change", function() {
        //alert("dhouha");
        ind = $(this).attr("index");
        index = $("#index1").val(); //alert(index)
        fournisseur_id = $("#fournisseur_id" + ind).val();
        // alert(fournisseur_id);
        if (fournisseur_id != "") {
          $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Demandeoffredeprixes', 'action' => 'getmail']) ?>",
            dataType: "json",
            data: {
              fournisseur_id: fournisseur_id,
            },
            headers: {
              "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
            },
            success: function(data) {
              // alert(data.mail);
              $('#mail' + ind).val(data.mail);
              // $('#gouvernorat').select2();
              // // uniform_select('sousfamille1_id');
            },
          });
        } else {
          $('#mail' + ind).val("");
        }
      });
    });
  </script>
  </div>