<?php

use Cake\Datasource\ConnectionManager;

$connection = ConnectionManager::get('default');
?>
<!-- <section class="content-header">
  <header>
    <h4 style="text-align:center;"> Projets</h4>
  </header>
</section> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<section class="content-header">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
  <?php echo $this->Html->script('salma'); ?>
  <?php echo $this->Html->script('js_vieww_projet'); ?>
  <?php echo $this->Html->css('vieww'); ?>
  <?php echo $this->Html->css('select2'); ?>
  <?php
  $add = "";
  $edit = "";
  $delete = "";
  $view = "";
  $session = $this->request->getSession();
  $abrv = $session->read('abrvv');
  $lien = $session->read('lien_projet' . $abrv);
  foreach ($lien as $k => $liens) {
    if (@$liens['lien'] == 'projets') {
      $add = $liens['ajout'];
      $edit = $liens['modif'];
      $delete = $liens['supp'];
    }
  }
  ?>
  <td colspan="3">
    <div style="float: left;font-size: 12px;margin-left:10px;"><strong>Projets</strong></div>
    <div style="float: right;font-size: 12px;margin-right:10px;">
      <strong>
        <?php if ($add == 1) { ?>
          <?php
          echo $this->Html->link(
            '<span class="fa fa-plus-circle valignmiddle btnTitle-icon"></span><span class="valignmiddle text-plus-circle btnTitle-label hideonsmartphone">
          Nouveau projet</span>',
            ['action' => 'add', 'type' => '0'],
            [
              'class' => 'btnTitle',
              'escape' => false,
            ]
          );
          ?>

          <!-- <div class="pull-right" style="margin-right:10px;">
      <?php  // echo $this->Html->link(__('Nouveau produit'), ['action' => 'add'], ['class' => 'btn btn-plus btn-sm']);
        ?>
  </div> -->
        <?php } ?>
      </strong>
    </div>
  </td>
  <br><br>
  <!-- <h1>
    Recherche
  </h1> -->
</section>
<section class="content" style="width: 99%" style="background-color: white ;">
  <div class="box">
    <div class="box-header">
    </div>
    <div class="box-body">
      <div class="row">
        <?php echo $this->Form->create($projets, ['type' => 'get']); ?>
        <div class="col-xs-1" style="display: flex;">
          Du :</div>
        <div class="col-xs-1">
          Au :</div>
        <div class="col-xs-1">
          Reference: </div>
        <div class="col-xs-2">
          Tiers: </div>
        <div class="col-xs-1">
          Libelle: </div>
        <div class="col-xs-2">
          Visibilité: </div>
        <div class="col-xs-2">
          Prob.opp: </div>
        <div class="col-xs-2" style="display: flex;">
          Action:
        </div>
        <div class="col-xs-1">
          <?php echo $this->Form->control('datedebut', ['placeholder' => 'Date Debut', 'required' => 'off', 'label' => false, 'value' => $this->request->getQuery('datedebut'), 'autocomplete' => 'off', 'type' => 'date', 'class' => 'form-control control-label']); ?>
        </div>
        <div class="col-xs-1">
          <?php echo $this->Form->control('datefin', ['placeholder' => 'Date Fin', 'required' => 'off', 'label' => false, 'value' => $this->request->getQuery('datefin'), 'autocomplete' => 'off', 'type' => 'date', 'class' => 'form-control control-label']); ?>
        </div>
        <div class="col-xs-1">
          <?php echo $this->Form->control('name', ['placeholder' => 'Reference', 'required' => 'off', 'label' => false, 'value' => $this->request->getQuery('name'), 'autocomplete' => 'off', 'class' => 'form-control control-label']); ?>
        </div>
        <div class="col-xs-2">
          <?php echo $this->Form->control('client_id', ['placeholder' => 'Tiers', 'options' => $clients, 'required' => 'off', 'empty' => true, 'label' => false, 'value' => $this->request->getQuery('client_id'), 'autocomplete' => 'off', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label']); ?>
        </div>
        <div class="col-xs-1">
          <?php echo $this->Form->control('libelle', ['placeholder' => 'Libelle', 'required' => 'off', 'label' => false, 'value' => $this->request->getQuery('libelle'), 'autocomplete' => 'off', 'class' => 'form-control control-label']); ?>
        </div>
        <div class="col-xs-2">
          <?php echo $this->Form->control('personnel_id', ['placeholder' => 'Visibilité', 'label' => false, 'value' => $this->request->getQuery('personnel_id'), 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'class' => 'form-control select2 control-label']); ?>
        </div>
        <div class="col-xs-2">
          <?php echo $this->Form->control('opportunite_id', ['placeholder' => 'Prob.opp', 'label' => false, 'value' => $this->request->getQuery('opportunite_id'), 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'class' => 'form-control select2 control-label']); ?>
        </div>
        <div class="col-xs-2" style="display: flex;">
          <button type="submit" class="btn btn-default custom-width-button">
            <i class="fa fa-search"></i>
          </button>

          <?php echo $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-default btn-large fa fa-remove']) ?>

          <div class="dropdown" style="position: relative;">
            <a href="javascript:void(0);" id="showColumnList" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false" style="position: relative; z-index: 1;">
              <i class="fa fa-list" style="font-size: 30px; "></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="showColumnList"
              style="position: absolute; top: 100%;z-index: 2;left: -432%;">
              <li><input type="checkbox" style="font-size: 14px;" id="col-ref-checkbox">Libellé </li>
              <li><input type="checkbox" style="font-size: 14px;" id="col-Libelle-checkbox">Référence </li>
              <li><input type="checkbox" style="font-size: 14px;" id="col-client-checkbox">Client</li>
              <li><input type="checkbox" style="font-size: 14px;" id="col-montantfacutreclient-checkbox">M.H.T F.client
              </li>
              <li><input type="checkbox" style="font-size: 14px;" id="col-montantfacutrefournisseur-checkbox">M.H.T
                F.fournisseur</li>
              <li><input type="checkbox" style="font-size: 14px;" id="col-montantoptiondiverse-checkbox">M.H.T operation
                diverses</li>
              <li><input type="checkbox" style="font-size: 14px;" id="col-benifice-checkbox"> Bénifice</li>
              <li><input type="checkbox" style="font-size: 14px;" id="col-chargé-checkbox"> Chargé</li>
              <li><input type="checkbox" style="font-size: 14px;" id="col-debut-checkbox"> Date debut</li>
              <li><input type="checkbox" style="font-size: 14px;" id="col-fin-checkbox"> Date fin</li>
              <li><input type="checkbox" style="font-size: 14px;" id="col-visibilite-checkbox">Visibilité</li>
              <li><input type="checkbox" style="font-size: 14px;" id="col-opportunité-checkbox">Prob.opp</li>
              <li><input type="checkbox" style="font-size: 14px;" id="col-detail-checkbox">Details</li>
              <li><input type="checkbox" style="font-size: 14px;" id="col-actions-checkbox">Actions</li>
            </ul>
          </div>
        </div>
       


        <div class="col-xs-3">
          Tri:
          <select name="trie" id="" class="form-control select2 control-label">
            <option value="">Veuillez choisir !!</option>
            <?php foreach ($listtries as $li => $listtri) { ?>
              <option value="<?php echo $li ?>" <?php if ($tri==$li) {
               echo "selected";
              }?>><?php echo $listtri ?></option>
            <?php } ?>
          </select>

        </div>
      </div>
    </div>
    <?php echo $this->Form->end(); ?>
    <section class="content" style="width: 100%">
      <div class="box-header">
      </div>
      <div class="">
        <div  class="outer" style="width:100%; height:529px; overflow:auto;overflow-x:scroll;">
        <table  width="98%" class="table table-bordered table-striped table-bottomless table-responsive ">
          <thead  >
           
            <th hidden>id</th>
              <th  align="center">
                <?= ('Réf.') ?>
              </th>
              <th  align="center" >
                <?= ('Libellé.') ?>
              </th>
              <th  align="center" >
                <?= ('Client') ?>
              </th>
              <th width="6%" align="center" >
                <?= ('Nom alternatif de Client') ?>
              </th>
              <th width="8%" align="center">
                <?= ('M.H.T F.client') ?>
              </th>
              <th width="8%" align="center" >
                <?= ('M.H.T F.fournisseur') ?>
              </th>
              <th width="8%" align="center">
                <?= ('M.H.T op diverses') ?>
              </th>
              <th width="7%" align="center" >
                <?= ('Bénifice') ?>
              </th>
              <th width="7%" align="center" >
                <?= ('Chargé') ?>
              </th>
              <th width="6%" align="center">
                <?= ('Date debut') ?>
              </th>
              <th width="6%" align="center" >
                <?= ('Date fin') ?>
              </th>
              <th width="6%" align="center" >
                <?= ('Visibilité') ?>
              </th>
              <th width="7%" align="center" >
                <?= ('Prob. opp') ?>
              </th>
              <th width="6%" align="center">
                <?= ('Lien Export') ?>
              </th>
              <th width="6%" align="center">
                <?= ('Lien Etude') ?>
              </th>
              <!-- <th width="6%" align="center" class="col-opportunité" style="font-size: 9px;">
                <?= ('Lien Export') ?>
              </th> -->
              <!-- <th width="2%" align="center" class="col-opportunité" style="font-size: 9px;">
                <?= ('Tache Projets') ?>
              </th> -->
              <th width="6%" >
                <?= __('Détail') ?>
              </th>
              <th width="10%">
                <?= __('Actions') ?>
              </th>
        
          </thead>
          <tbody>
            <?php
            foreach ($projets as $i => $projet):
              $projet_id = $projet->id;
              $htclients = $connection->execute("SELECT COALESCE(SUM(totalht), 0)  AS somme_totalht FROM factureclients WHERE projet_id = $projet_id; ")->fetchAll('assoc');
              $htfournisseurs = $connection->execute("SELECT  COALESCE(SUM(ht), 0)  AS somme_ht FROM factures WHERE projet_id = $projet_id;")->fetchAll('assoc');
              $bénifice = $htclients[0]['somme_totalht'] - $htfournisseurs[0]['somme_ht'];
              ?>
              <tr>
              <td hidden><?= h($projet->id) ?></td>
                <td class="col-ref afficher" style="font-size: 12px;" index="<?php echo $projet['id']; ?>">
                  <?= h($projet->libelle) ?>
                  <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $projet['id'], 'label' => '', 'champ' => 'id', 'type' => 'hidden', 'class' => 'form-control']); ?>
                </td>
                <td class="col-Libelle afficher" style="font-size: 12px;" index="<?php echo $projet['id']; ?>"
                  title="<?php echo $projet->name; ?>">
                  <?php

                  $nom_projet = $projet->name; // Récupère le nom du client depuis $projet
                
                  if (strlen($nom_projet) > 10) {
                    $nom_projet = substr($nom_projet, 0, 10) . '...';
                  }

                  echo $nom_projet; ?>
                </td>
                <td class="col-client afficherclient" style="font-size: 12px;"
                  idclient="<?php echo $projet['client_id']; ?>" index="<?php echo $projet['id']; ?>"
                  title="<?php echo $projet->client->nom; ?>">
                  <?php //echo ($projet->client->nom) 
                    $nom_client = $projet->client->nom; // Récupère le nom du client depuis $projet
                  
                    if (strlen($nom_client) > 10) {
                      $nom_client = substr($nom_client, 0, 10) . '...';
                    }

                    echo $nom_client;
                    ?>
                </td>
                <td class="col-client afficherclient" style="font-size: 12px;"
                  idclient="<?php echo $projet['client_id']; ?>" index="<?php echo $projet['id']; ?>">
                  <?= h($projet->client->Raison_Sociale) ?>
                </td>
                <td class="col-montantfacutreclient afficher" style="font-size: 12px;"
                  index="<?php echo $projet['id']; ?>">
                  <?= h($htclients[0]['somme_totalht']) ?>
                </td>
                <td class="col-montantfacutrefournisseur afficher" style="font-size: 12px;"
                  index="<?php echo $projet['id']; ?>">
                  <?= h($htfournisseurs[0]['somme_ht']) ?>
                </td>
                <td class="col-montantoptiondiverse afficher" style="font-size: 12px;"
                  index="<?php echo $projet['id']; ?>">
                  <?= h('0.000') ?>
                </td>
                <td class="col-benifice afficher" style="font-size: 12px;" index="<?php echo $projet['id']; ?>">
                  <?= h($bénifice) ?>
                </td>
                <td class="col-chargé afficher" style="font-size: 12px;" index="<?php echo $projet['id']; ?>">
                  <?= h($projet->personnel->nom) ?>
                </td>
                <td class="col-debut afficher" style="font-size: 12px;" index="<?php echo $projet['id']; ?>">
                  <?= $this->Time->format($projet->date, 'dd/MM/y'); ?>
                </td>
                <td class="col-fin afficher" style="font-size: 12px;" index="<?php echo $projet['id']; ?>">
                  <?= $this->Time->format($projet->datefin, 'dd/MM/y'); ?>
                </td>
                <td class="col-visibilite afficher" style="font-size: 12px;" index="<?php echo $projet['id']; ?>">
                  <?php if ($projet->visibilite == 1) { ?>
                    <?php echo ("Contacts projet ") ?>
                  <?php } else { ?>
                    <?php echo "Tout le monde" ?>
                  <?php } ?>
                </td>
                <td class="col-opportunité afficher" style="font-size: 12px;" index="<?php echo $projet['id']; ?>">
                  <?= h($projet->opportunite->name) ?>
                </td>
                <td class="" align="center" style="max-width: 200px;overflow-wrap: break-word;">
                  <?php if ($projet->lien) { ?>
                    <a href="<?php echo htmlspecialchars($projet->lien); ?>" target="_blank"
                      style="display: inline-block; max-width: 100%;">

                      <?php //echo $projet->lien; 
                          ?> lien
                    </a>
                  <?php } ?>
                </td>
                <td class="" align="center" style="max-width: 200px;overflow-wrap: break-word;">
                  <?php if ($projet->lien) { ?>
                    <a href="<?php echo htmlspecialchars($projet->lienetude); ?>" target="_blank"
                      style="display: inline-block; max-width: 100%;"> lien
                      <?php //echo $projet->lienetude; 
                          ?>
                    </a>
                  <?php } ?>
                </td>
                <!-- <td class="" align="center" style="max-width: 200px;overflow-wrap: break-word;">
                  <a href="<?php echo htmlspecialchars($projet->lienexport); ?>" target="_blank"
                    style="display: inline-block; max-width: 100%;">
                    <?php echo $projet->lienexport; ?>
                  </a>
                </td> -->




                <!-- <td class="col-detail " align="center">
                  <?php if ($projet->etatTache != 1) { ?>
                    <?php echo $this->Html->link('<i class="fa fa-plus-square" aria-hidden="true"></i>', ['controller' => 'tacheprojets', 'action' => 'add', $projet->id], ['class' => 'btn btn-xs btn-custom btn-success', 'escape' => false,]); ?>
                  <?php } ?>
                  <?php if ($projet->etatTache == 1) { ?>
                    <?php echo $this->Html->link('<i class="fa fa-users" aria-hidden="true"></i>', ['controller' => 'tacheprojets', 'action' => 'edit', $projet->id], ['class' => 'btn btn-xs btn-custom btn-warning', 'escape' => false,]); ?>
                  <?php } ?>
                  <?php if ($projet->etatTache == 1) { ?>
                    <?php echo $this->Html->link('<i class="fa fa-trash" aria-hidden="true"></i>', ['controller' => 'tacheprojets', 'action' => 'delete', $projet->id], ['class' => 'btn btn-xs btn-custom btn-danger', 'escape' => false,]); ?>
                  <?php } ?>

                </td> -->
                <td class="col-detail " align="center">
                  <?php echo $this->Html->link('<i class="fa fa-info-circle" title="Consulter la vue d`ensemble du projet ' . $nom_projet . '"></i>', ['action' => 'vieww', $projet->id], ['class' => 'btn btn-xs btn-custom btn-primary', 'escape' => false,]); ?>
                </td>
                <td class="col-actions" align="center">
                  <?php echo $this->Html->link("<button class='btn btn-xs btn-success' title='Consulter le projet " . $nom_projet . "'><i class='fa fa-search'></i></button>", array('action' => 'view', $projet->id), array('escape' => false)); ?>
                  <?php if ($edit == 1) { ?>
                    <?php
                    echo $this->Html->link("<button class='btn btn-xs btn-warning' title='Modifier le projet " . $nom_projet . "'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $projet->id), array('escape' => false));
                    ?>
                  <?php } ?>
                  <?php if ($delete == 1) { ?>
                    <?php
                    echo ("<button type=button index= '" . $i . "' id='delete" . $i . "' class='btn btn-xs btn-danger deleteprojet' title='Supprimer le projet " . $nom_projet . "'><i class='fa fa-trash'></i></button>");
                    ?>
                  <?php } ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>

        </table>
        
        </div>
        <br><br>
        <h2> Courbe de progression </h2>
        <div class="chart-container2">

          <canvas id="progressChart"></canvas>
        </div>
        <!-- <?php
        $progressDataJson = json_encode($progressData);
        $projectNamesJson = json_encode(array_keys($progressData));
        $projectIDs = array_keys($progressData); ?> -->
      </div>
  </div>


  <script>
    var projectNames = <?php echo $projectNamesJson; ?>;
    var progressData = <?php echo $progressDataJson; ?>;
    var labels = projectNames.reverse().map(function (id) {
      return progressData[id].name;
    });
    var progressPercentages = Object.values(progressData).map(function (project) {
      return project.progress;
    });
    var xAxisLabels = [
      '',
      '',
      'Projet',
      'Offre GGB',
      'Demande O Prix',
      'Commande Clients',
      'Commande Fournisseur',
      'Factures Fournisseur',
      'Facture Clients',
      'Reglement Fournisseur',
      'Règlement Clients',
    ];
    var ctx = document.getElementById('progressChart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Progression',
          data: progressPercentages,
          backgroundColor: '#3c8dbc',
          borderColor: '#222d32',
          borderWidth: 1
        }]
      },
      options: {
        indexAxis: 'y',
        scales: {
          x: {
            beginAtZero: true,
            ticks: {
              callback: function (value, index, values) {
                return xAxisLabels[index];
              },
            },
          },
          y: {
            beginAtZero: true
          }
        },
        onClick: function (event, elements) {
          if (elements.length > 0) {
            var index = elements[0].index;
            var projectId = projectNames[index];
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split("/").slice(0, -1).join("/");
            var link = parentUrl + "/projets/vieww/" + projectId;
            $(location).attr("href", link);
          }
        }

      }
    });


    document.addEventListener("DOMContentLoaded", function () {
      var checkboxes = document.querySelectorAll('ul.dropdown-menu input[type="checkbox"]');

      checkboxes.forEach(function (checkbox) {
        var targetColumn = checkbox.id.replace("-checkbox", ""); // Obtenez le nom de la colonne correspondante
        var columns = document.querySelectorAll('.' + targetColumn);

        // Fonction pour mettre à jour l'état des cases à cocher
        function updateCheckboxes() {
          var allChecked = Array.from(columns).every(function (column) {
            return column.style.display !== "none";
          });
          checkbox.checked = allChecked;
        }

        // Mettre à jour l'état initial des cases à cocher
        updateCheckboxes();

        // Ajouter un écouteur de changement aux cases à cocher
        checkbox.addEventListener("change", function () {
          columns.forEach(function (column) {
            if (checkbox.checked) {
              column.style.display = "table-cell";
            } else {
              column.style.display = "none";
            }
          });
        });

        // Mettre à jour l'état des cases à cocher lorsque les colonnes sont modifiées manuellement
        columns.forEach(function (column) {
          column.addEventListener("change", function () {
            updateCheckboxes();
          });
        });
      });
    });


    // document.addEventListener("DOMContentLoaded", function() {
    //   var checkboxes = document.querySelectorAll('ul.dropdown-menu input[type="checkbox"]');

    //   checkboxes.forEach(function(checkbox) {
    //     var targetColumn = checkbox.id.replace("-checkbox", ""); // Obtenez le nom de la colonne correspondante
    //     var columns = document.querySelectorAll('.' + targetColumn);

    //     checkbox.addEventListener("change", function() {
    //       columns.forEach(function(column) {
    //         if (checkbox.checked) {
    //           column.style.display = "table-cell";
    //         } else {
    //           column.style.display = "none";
    //         }
    //       });
    //     });
    //   });
    // });
  </script>

  <?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
  <?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
  <?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
  <?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

  <!-- Select2 -->
  <?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
  <?php $this->start('scriptBottom'); ?>
  <style>
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

    .custom-width-button {
      width: 50px;
      /* Ajustez la largeur souhaitée en pixels */
    }

    .btn-large {
      font-size: 15px;
      padding: 8px 18px;
    }
  </style>

  <style>
    .hidden {
      display: none;
    }

    .dropbtn {
      background-color: #3498db;
      color: white;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
    }

    .dropdown-menu {
      position: absolute;
      left: 70px;
      cursor: pointer;
      max-height: 400px;
      width: 200px;
      overflow-y: auto;
    }

    .dropdown-menu input[type="checkbox"]+label {
      font-weight: normal;
    }

    .dropdown-menu label:hover {
      background-color: #ddd;
    }

    .dropdown:hover .dropdown-menu {
      display: block;
    }
  </style>
  <style>
     .outer {
    width: 100%;
    -layout: fixed;
  }

  .outer th {
    text-align: left;
    top: 0;
    position: sticky;
    background-color: white;
  }
  
  </style>
  <style>
    .select2-selection__rendered {
      line-height: 25px !important;
    }

    .select2-container .select2-selection--single {
      height: 35px !important;
      border-radius: 0 !important;
      box-shadow: none !important;
      border-color: #D2D6DE !important;
    }

    .select2-selection__arrow {
      height: 34px !important;
    }

    .select2-selection__choice {
      height: 24px !important;
      color: black !important;
      background-color: white !important;
      font-size: 18px !important;
    }

    .select2-container {
      display: block;
      width: auto !important;
    }
  </style>
  <script>
    function openWindow(h, w, url) {
      leftOffset = (screen.width / 2) - w / 2;
      topOffset = (screen.height / 2) - h / 2;
      window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
    $(function () {
      $('#example 1').DataTable()
      $('#example 2').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': true,
        'info': true,
        'autoWidth': false
      })

      $(".afficher").on("mouseover", function () {
        $(this).css("cursor", "pointer");
        $(this).css("color", "blue");

      });

      $(".afficher").on("mouseout", function () {
        $(this).css("cursor", "default");
        $(this).css("color", "initial");

      });

      $(".afficher").on("click", function () {
        index = $(this).attr('index');
        var currentUrl = window.location.href;
        var parentUrl = currentUrl.split('/').slice(0, -1).join('/');
        var link = parentUrl + "/projets/vieww/" + index;
        $(location).attr('href', link);
      });
      $(".afficherclient").on("mouseover", function () {
        $(this).css("cursor", "pointer");
        $(this).css("color", "blue");

      });

      $(".afficherclient").on("mouseout", function () {
        $(this).css("cursor", "default");
        $(this).css("color", "initial");

      });

      $(".afficherclient").on("click", function () {
        index = $(this).attr('idclient');
        var currentUrl = window.location.href;
        var parentUrl = currentUrl.split('/').slice(0, -1).join('/');
        var link = parentUrl + "/clients/view/" + index;
        $(location).attr('href', link);
      });
    })
    $(function () {
      $('.deleteprojet').on('click', function () {
        ind = $(this).attr('index');
        id = $('#id' + ind).val();
        $.ajax({
          method: "GET",
          url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'verifprojets']) ?>",
          dataType: "json",
          data: {
            id: id,
          },
          headers: {
            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
          },
          success: function (data) {
            if (data.commandeclients != 0) {
              alert('Projets déja existe dans une commande clients');
            } else if (data.reglementclients != 0) {
              alert('Projets déja existe dans un reglement clients');
            } else if (data.reglementfournis != 0) {
              alert('Projets déja existe dans un reglement fournisseur');
            } else if (data.taches != 0) {
              alert('Projets déja existe dans un Taches');
            } else if (data.commandefournisseurs != 0) {
              alert('Projets déja existe dans un commande fournisseurs');
            } else if (data.factureclients != 0) {
              alert('Projets déja existe dans un facture eclients');
            } else if (data.demandeoffredeprixes != 0) {
              alert('Projets déja existe dans un demande offre de prix');
            } else if (data.factures != 0) {
              alert('Projets déja existe dans un factures');
            } else {
              if (confirm('Voulez vous vraiment supprimer cet enregistrement')) {
                var currentUrl = window.location.href;
                var parentUrl = currentUrl.split('/').slice(0, -1).join('/');
                var link = parentUrl + "/Projets/delete/" + id;
                window.location.href = link;
              }
            }
          }
        })
      });
    });
    $('.url').on('click', function () {
      var currentUrl = window.location.href;
      var parentUrl = currentUrl.split('/').slice(0, -3).join('/');
      var link = parentUrl + "/demandeoffredeprixes/addarticles/" + currentindex;
      $(location).attr('href', link);
    });
    $('.select2').select2()
    $('#datemask').inputmask('dd/mm/yyyy', {
      'placeholder': 'dd/mm/yyyy'
    })
    $('#datemask2').inputmask('mm/dd/yyyy', {
      'placeholder': 'mm/dd/yyyy'
    })
    $('[data-mask]').inputmask()
    $('#reservation').daterangepicker()
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      format: 'MM/DD/YYYY h:mm A'
    })
  </script>
  <?php $this->end(); ?>
  