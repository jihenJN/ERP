<?php
echo $this->Form->create($thisprojetconception, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);
echo $this->Form->hidden('form_name', ['value' => 'projetconception']);
?>

<div id="offreggb" style="display:none;margin-top: 18px;">
  <section class="content-header">
    <h1>
      Conception
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
          <div class="row">


            <div class="col-xs-6">
              <?php echo $this->Form->control('personnel_id', ['value' => $thisprojetconception->personnel_id, 'empty' => 'Veuillez choisir !!', 'type' => '', 'label' => 'Chef Projet', 'options' => $personnels, 'class' => 'form-control select2', 'id' => 'chefprojet']); ?>
            </div>

            <div class="col-xs-6">
              <?php echo $this->Form->control('refconception', ['value' => $thisprojetconception->refconception, 'type' => '', 'label' => 'Réf Conception', 'class' => 'form-control ', 'id' => 'refconception']); ?>
            </div>

            <div class="col-xs-6">
              <?php echo $this->Form->control('typeconception_id', ['value' => $thisprojetconception->typeconception_id, 'empty' => 'Veuillez choisir !!', 'type' => '', 'label' => 'Type conception', 'options' => $typeconceptions, 'class' => 'form-control select2', 'id' => 'typeconception_id']); ?>
            </div>

            <div class="col-xs-6">
              <?php echo $this->Form->control('numeroreservation', ['value' => $thisprojetconception->numeroreservation, 'type' => '', 'label' => 'Réservation N°', 'class' => 'form-control ', 'id' => 'numeroreservation']); ?>
            </div>

            <div class="col-xs-6">
              <?php echo $this->Form->control('dateconception', ['value' => $thisprojetconception->dateconception, 'type' => 'datetime', 'label' => 'Reçu à la conception', 'class' => 'form-control ', 'id' => 'dateconception']); ?>
            </div>
          </div>









        </div>
      </div>
      <div align="center" class="addoffreggb">
        <button type="submit" class="pull-right btn btn-success btn-sm" id="poi1ntv"
          style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
      </div>
      <?php echo $this->Form->end(); 
      ?>

    </div>
  </section>
</div>
<div id="note" style="display:none;margin-top: 18px;">
  <?php //echo $this->Form->create($note, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);
  $session = $this->request->getSession();
  $authData = $session->read('Auth');
  if ($authData && is_object($authData)) {
    //debug($authData);
    $user_id = $authData->id;
    //debug($user_id);

  } ?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  </head>

  <body>
    <section class="content" style="width: 97%">
      <div class="row">
        <div class="box ">
          <div class="table-responsive ls-table">
            <div class="box-body pad">
              <div class="col-xs-6">
                <label>Note Publique</label>
                <textarea id="editor-container" name="note_publique" class="form-control test summernote" rows="10"
                  cols="80" style="height: 300px;">
                <?php echo ($notes->notepub); ?>
                </textarea>
              </div>
              <?php
              //debug($notes);
              if ($notes->user_id == $user_id) { ?>
                <div class="col-xs-6">
                  <label>Note Prive</label>
                  <textarea id="editor-container1" name="note_prive" class="form-control summernote" rows="10" cols="80"
                    style="height: 300px;">
                                  <?php echo $notes->noteprive; ?>
                              </textarea>
                </div>
              <?php } else { ?>
                <div class="col-xs-6">
                  <label>Note Prive</label>
                  <textarea id="editor-container1" name="note_prive" class="form-control summernote" rows="10" cols="80"
                    style="height: 300px;">

                              </textarea>
                </div>
              <?php } ?>

              <div><input type="hidden" name="user_id" value=<?php echo $user_id ?>></div>
              <button type="submit" class="pull-right btn btn-success btn-sm initial"
                style="margin-right:48%;margin-top: 10px;margin-bottom:20px;">Enregistrer</button>

            </div>
          </div>
        </div>

      </div>
    </section>
  </body>
</div>
<?php echo $this->Form->end(); ?>
<div id="popupOverlay2" class="overlay-container">
  <div class="popup-box">
    <!-- <h2 style="color: green;">Envoyer vers le fournisseur</h2> -->
    <div class="form-container">

      <input type="hidden" id="idligne">
      <?php echo $this->Form->control('description', ['rows' => 15, 'id' => 'descriptionlong']); ?>

      <button type="button" class="btn-envoyer appliquedes">
        Enregistrer
      </button>
    </div>

    <button class="btn-close-popup" onclick="togglePopup()">
      Close
    </button>
  </div>
</div>
<?php echo $this->Html->script('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'css']); ?>
<script>
  $(function() {
    $('.summernote').summernote({
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['fontsize', ['fontsize']],
        ['fontname', ['fontname']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']]
      ],
      fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Calibri',
        'Calibri light',
        'Sakkal Majalla',
        'Aldhabi',
        'Arabic typesetting',
        'Algerian',

        'Bell MT',
        'Bodoni MT',
        'Bookman Old Style',
        'Bradley Hand ITC',
        'Californian FB',
        'Centaur',
        'Century',
        'Corbel light',
        'Lucida Calligraphy',
        'Leelawadee UI',
        'Leelawadee UI Semilight',
        'Ink free',
        'Modern No. 20',
        'Monotype Corsiva',
        'Perpetua Titling MT',
        'Pristina',
        'Sitka text',
      ]
    });
  })
</script>
<style>
  .btn-open-popup:hover {
    background-color: #4C58AF;
  }

  .overlay-container {
    display: none;

    position: fixed;
    top: 20%;
    left: 0;
    width: 100%;
    height: 100%;
    background: transparent;
    justify-content: center;
    align-items: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    margin-left: 40%;

  }

  .popup-box {
    background: #fff;
    padding: 24px;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
    width: 320px;
    text-align: center;
    opacity: 0;
    transform: scale(0.8);
    animation: fadeInUp 0.5s ease-out forwards;
  }

  .form-container {
    display: flex;
    flex-direction: column;
  }

  .form-label {
    margin-bottom: 10px;
    font-size: 16px;
    color: #444;
    text-align: left;
  }

  .form-input {
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    width: 100%;
    box-sizing: border-box;
  }

  .btn-envoyer,
  .btn-close-popup {
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  .btn-envoyer {
    background-color: green;
    color: #fff;
  }

  .btn-close-popup {
    margin-top: 12px;
    background-color: #e74c3c;
    color: #fff;
  }

  .btn-envoyer:hover,
  .btn-close-popup:hover {
    background-color: #4caf50;
  }

  /* Keyframes for fadeInUp animation */
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Animation for popup */
  .overlay-container.show {
    display: flex;
    opacity: 1;
  }

  .btn-purple {
    background-color: #43899E;
    /* Changer la couleur de fond en violet */
    color: white;
    /* Changer la couleur du texte en blanc ou autre couleur lisible */
  }
</style>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2   class="addoffreggb" id="e1" id="poi1ntv"-->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>

<script>
  function togglePopup() {
    //console.log(id)
    $("#idligne").val("");
    $("#descriptionlong").val("");
    const overlay = document.getElementById('popupOverlay2');
    overlay.classList.toggle('show');
  }
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

    $('.appliquedes').on('click', function() {
      //alert('description')
      idligne = $("#idligne").val();
      $("#description" + idligne).val($("#descriptionlong").val());
      const overlay = document.getElementById('popupOverlay2');
      overlay.classList.toggle('show');

    });
    $('.description').on('click', function() {

      idligne = $(this).attr("index");
      $("#idligne").val(idligne);
      $("#descriptionlong").val($("#description" + idligne).val());
      const overlay = document.getElementById('popupOverlay2');
      overlay.classList.toggle('show');

    });
    $('.deviseSelect').on('change', function() {

      // var devise_id = $(this).val();
      devise_id = $('#devis_id').val();
      projet_id = $('#projet_id').val();
      // var devise = mapDevise(devise_id);
      devisachat_id = $('#devisachat_id').val();
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'getdevise']) ?>",
        dataType: "json",
        data: {
          devise_id: devise_id,
          projet_id: projet_id,
          devisachat_id: devisachat_id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          console.log(data)
          var devis = data.code;
          document.getElementById('tauxChange').value = data.taux;

          // if (data.taux != 0) {
          //   //alert( data.taux)
          //   document.getElementById('tauxChange').value = data.taux;

          // } else {
          //   getTauxChange(devis);
          // }
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

  function calcullll() {
    // index1 = $("#indexa").val();
    index = $("#indexoffreggb").val();
    taux = 1;
    tauxChange2 = $("#tauxChange").val();
    if (tauxChange2 != '' && Number(tauxChange2) != 0) {
      taux = $("#tauxChange").val();
    }
    // indexl = $("#indexa" + index).val();
    nbfergule = $("#nbfergule").val();
    // indexl = $("#indexa" + index).val();
    ferg = 3;
    if (nbfergule != '' && Number(nbfergule) != 0) {
      ferg = $("#nbfergule").val();

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
        prixrevient = Number(coutrevient) * Number(taux);
        $("#coutrevientdev" + i).val(Number(prixrevient).toFixed(ferg));
        console.log('mg ' + MG);
        if (MG && MQ) {
          alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
          $("#tauxdemarge" + i).val('');
          $("#tauxdemarque" + i).val('');
          $("#prixht" + i).val('');
          // $("#punht" + i).val('');
        } else if (MQ && Number(prixrevient) != 0) {
          marque = 100 - Number(MQ);

          //prixMG = Number(prixrevient) + (Number(MQ) * Number(prixrevient) / 100)
          prixMG = ((Number(prixrevient) * 100) / Number(marque)); ///Number(taux);
          // prixMG = Math.floor(prixMG); // Conversion en entier
          $("#prixht" + i).val(Number(prixMG).toFixed(ferg));
          //$("#prixht" + i).val(prixMG);
          //$("#punht" + i).val(prixMG);
          margel = Number(prixMG) * Number(MQ / 100); //*Number(taux);
          totalmarque = (Number(totalmarque) + Number(margel)).toFixed(ferg);

        } else if (MG && Number(prixrevient) != 0) {
          prixMQ = (Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100)); ///Number(taux); //alert(prixMQ)
          // alert(Number(prixMQ).toFixed(3));
          $("#prixht" + i).val(Number(prixMQ).toFixed(ferg));
          marquel = Number(prixMQ) * Number(MG / 100); //*Number(taux);
          totalmarge = (Number(totalmarge) + Number(marquel)).toFixed(ferg);
          // $("#punht" + i).val(prixMG);
        } else {
          if (Number(prixrevient) != 0) {
            $("#prixht" + i).val(Number(Number(prixrevient) /* /Number(taux) */ ).toFixed(ferg));
          }

        }
      }
    }
    // $("#totalmarge").val(Number(totalmarge).toFixed(ferg));
    // $("#totalmarque").val(Number(totalmarque).toFixed(ferg));
    getprixhtsonia();

  }

  $('.select2').select2({
    width: '100%' // need to override the changed default
  });
</script>
<script>
  $(document).ready(function() {
    $('#banque_id').on('change', function() {

      id = $('#banque_id').val();
      //  alert(id);
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Banques', 'action' => 'getcomptebanks']) ?>",
        dataType: "json",
        data: {
          id: id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {

          $('#comptesBank_id').html(data.select2);


        }
      });
    });
    $('#typeremise_id').on('change', function() {
      typeremise_id = $(this).val();
      if (typeremise_id == 1) {
        $('#remisetotaldiv').show();
        $('#remisetotal').val('');
        $('#remisetotalval').val('');
        $('#remisetotalvaldiv').hide();

      } else if (typeremise_id == 2) {
        $('#remisetotaldiv').hide();
        $('#remisetotalvaldiv').show();
        $('#remisetotalval').val('');
        $('#remisetotal').val('');
      }
    });
    $('.typeremise_idl').on('change', function() {
      typeremise_id = $(this).val();
      i = $(this).attr("index");
      if (typeremise_id == 1) {
        $('#divremise' + i).show();
        $('#remiseval' + i).val('');
        $('#remise' + i).val('');
        $('#divremiseval' + i).hide();

      } else if (typeremise_id == 2) {
        $('#divremise' + i).hide();
        $('#divremiseval' + i).show();
        $('#remise' + i).val('');
        $('#remiseval' + i).val('');
      }
    });
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
      devise_id = $('#devis_id').val();
      index = $("#indexoffreggb").val();
      nbfergule = $("#nbfergule").val();
      deviseprojet = $("#deviseprojet").val();
      taux = 1;
      tauxChange2 = $("#tauxChange").val();
      if (tauxChange2 != '' && Number(tauxChange2) != 0) {
        taux = $("#tauxChange").val();
      }
      i = $(this).attr('index');


      // indexl = $("#indexa" + index).val();
      ferg = 3;
      if (nbfergule != '' && Number(nbfergule) != 0) {
        ferg = $("#nbfergule").val();

      }
      champ = $(this).attr('champ');

      //virg = 2;
      // nbvirgule = $("#nbvirgule"+i).val();
      // if (nbvirgule != '' && Number(nbvirgule) != 0) {
      //     virg = Number(nbvirgule);

      // }
      virg = ferg;
      MG = $("#tauxdemarge" + i).val() || 0; //alert(MG)
      MQ = $("#tauxdemarque" + i).val() || 0; //alert(MQ)
      if (champ != "coutrevientdev") {
        coutrevient = $("#coutrevient" + i).val(); //alert(prixrevient)


        prixrevient = Number(coutrevient) * Number(taux);
        $("#coutrevientdev" + i).val(Number(prixrevient).toFixed(virg));

        console.log('mg ' + MG);

      } else {
        prixrevient = $("#coutrevientdev" + i).val();
        coutrevient = Number(prixrevient) / Number(taux);
        $("#coutrevient" + i).val(Number(coutrevient).toFixed(virg));
      }
      if (MG && MQ) {
        alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
        $("#tauxdemarge" + i).val('');
        $("#tauxdemarque" + i).val('');
        $("#prixht" + i).val('');
        // $("#punht" + i).val('');
      } else if (MQ && Number(prixrevient) != 0) {

        marque = 100 - Number(MQ);
        prixMG = ((Number(prixrevient) * 100) / Number(marque)); //*Number(taux);
        $("#prixht" + i).val(Number(prixMG).toFixed(virg));
      } else if (MG && Number(prixrevient) != 0) {
        prixMQ = (Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100)); //*Number(taux); //alert(prixMQ)
        $("#prixht" + i).val(Number(prixMQ).toFixed(virg));
      } else {
        if (Number(prixrevient) != 0) {
          $("#prixht" + i).val(Number(Number(prixrevient) /* /Number(taux) */ ).toFixed(virg));
        }

      }
      getprixhtsonia();

    });


    $(".calculprix13092024").on("keyup", function() {
      // index = $("#index").val();
      // index1 = $("#indexa").val();
      index = $("#indexoffreggb").val();
      taux = 1;
      tauxChange2 = $("#tauxChange").val();
      if (tauxChange2 != '' && Number(tauxChange2) != 0) {
        taux = $("#tauxChange").val();
      }
      // indexl = $("#indexa" + index).val();
      nbfergule = $("#nbfergule").val();
      // indexl = $("#indexa" + index).val();
      ferg = 3;
      if (nbfergule != '' && Number(nbfergule) != 0) {
        ferg = $("#nbfergule").val();

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
          //console.log('mg ' + MG);
          prixrevient = Number(coutrevient) * Number(taux);
          $("#coutrevientdev" + i).val(Number(prixrevient).toFixed(3));
          if (MG && MQ) {
            alert("Veuillez saisir uniquement un taux de marge ou un taux de marque.");
            $("#tauxdemarge" + i).val('');
            $("#tauxdemarque" + i).val('');
            $("#prixht" + i).val('');
            // $("#punht" + i).val('');
          } else if (MQ && Number(prixrevient) != 0) {
            marque = 100 - Number(MQ);

            //prixMG = Number(prixrevient) + (Number(MQ) * Number(prixrevient) / 100)
            prixMG = ((Number(prixrevient) * 100) / Number(marque)); ///Number(taux);
            // prixMG = Math.floor(prixMG); // Conversion en entier
            $("#prixht" + i).val(Number(prixMG).toFixed(3));
            //$("#prixht" + i).val(prixMG);
            //$("#punht" + i).val(prixMG);
            margel = Number(prixMG) * Number(MQ / 100); //*Number(taux);
            totalmarque = (Number(totalmarque) + Number(margel)).toFixed(ferg);

          } else if (MG && Number(prixrevient) != 0) {
            prixMQ = (Number(prixrevient) + (Number(MG) * Number(prixrevient) / 100)); ///Number(taux); //alert(prixMQ)
            // alert(Number(prixMQ).toFixed(3));
            $("#prixht" + i).val(Number(prixMQ).toFixed(ferg));
            marquel = Number(prixMQ) * Number(MG / 100); //*Number(taux);
            totalmarge = (Number(totalmarge) + Number(marquel)).toFixed(3);
            // $("#punht" + i).val(prixMG);
          } else {
            if (Number(prixrevient) != 0) {
              $("#prixht" + i).val(Number(Number(prixrevient) /* /Number(taux) */ ).toFixed(3));
            }

          }
        }
      }
      // $("#totalmarge").val(Number(totalmarge).toFixed(ferg));
      // $("#totalmarque").val(Number(totalmarque).toFixed(ferg));
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

  $('.ajoutdelai').on('click', function() {
    var index = $(this).attr('index');
    // alert(index)
    var currentUrl = window.location.href;
    var parentUrl = currentUrl.split('/').slice(0, 4).join('/');
    var link = parentUrl + "/delailivraisons/adddelai/";
    // alert(link);
    window.open(link, "_blank", "width=1000,height=1000");
    // openWindow(1000, 1000, link);
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
<style>
  .table>tbody>tr>td,
  .table>tbody>tr>th,
  .table>tfoot>tr>td,
  .table>tfoot>tr>th {
    padding: 0px !important;
  }
</style>