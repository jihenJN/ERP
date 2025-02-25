<?php
error_reporting(E_ERROR | E_PARSE);
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Projet $projet
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('dhouha'); ?>
<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->script('js_vieww_projet'); ?>
<?php echo $this->Html->script('controle_ggb.js');?>

<section class="content-header">
  <h1>


    Nouvelle opp. ou projet

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
          <h3 class="box-title"></h3>
        </div>
        <?php echo $this->Form->create($projet, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13", 'type' => 'file']); ?>
        <div class="box-body">
          <div class="row" style="color: blue">
            <div class="col-xs-6">
              <?php echo $this->Form->control('libelle', ['value' => $code, 'class' => 'form-control ', 'champ' => 'libelle', 'label' => 'Réf.', 'readonly' => 'readonly', 'id' => 'ref']); ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('name', ['class' => 'form-control ', 'champ' => 'name', 'label' => 'Libellé', 'id' => 'lib']); ?>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-2">
              <h5><strong> USAGE </strong></h5>
            </div>
            <div class="col-xs-3">
              <label for="suivre_opportunite">Suivre une opportunité</label>
              <?php echo $this->Form->checkbox('suivre_opportunite', ['class' => 'form-check-input']); ?>
            </div>
            <div class="col-xs-3">
              <label for="suivre_tache">Suivre une tâche</label>
              <?php echo $this->Form->checkbox('suivre_tache', ['class' => 'form-check-input']); ?>
            </div>
            <div class="col-xs-3">
              <label for="facturer_temps_passe">Facturer le temps passé</label>
              <?php echo $this->Form->checkbox('facturer_temps_passe', ['class' => 'form-check-input']); ?>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-5" style="color: blue">
              <?php echo $this->Form->control('client_id', ['empty' => 'Veuillez choisir un tier!!', 'class' => 'form-control select2', 'id' => 'client_id', 'label' => 'Tiers']); ?>
            </div>
            <div class="col-xs-1" style="margin-top: 31px;">
              <a><i class="fa fa fa-plus urlcli" style="color:success;font-size: 25px;"></i></a>
            </div>
            <div class="col-xs-6">
              <span><strong>Visibilité</strong></span>
              <select name="visibilite" class="form-control select2 control-label" id="visibilite">
                <option value="">Veuillez choisir !!</option>
                <option value="0">Contacts projet </option>
                <option value="1">Tout le monde</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <?php echo $this->Form->control('date', ['required' => 'off', 'id' => 'datedebut', 'type' => 'date', 'class' => 'form-control testdate', 'label' => 'Date debut']); ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('datefin', ['required' => 'off', 'id' => 'datefin', 'type' => 'date', 'class' => 'form-control', 'label' => 'Date de fin prévue']); ?>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6" style="color: blue">
              <?php echo $this->Form->control('opportunite_id', ['required' => 'off', 'empty' => 'Veuillez choisir !!!!', 'id' => 'opportunite_id', 'class' => 'form-control select2', 'label' => 'Statut opportunité']); ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('personnel_id', ['required' => 'off', 'empty' => 'Veuillez choisir !!!!', 'id' => 'personnel_id', 'value' => $personnel_id, 'class' => 'form-control', 'label' => 'Commercial']); ?>
            </div>

          </div>



          <div class="row">
            <div class="col-xs-6">
              <?php echo $this->Form->control('description', ['required' => 'off', 'id' => 'description', 'type' => 'textarea', 'class' => 'form-control', 'label' => 'Description']); ?>

              <?php //echo $this->Form->control('lienexport', ['required' => 'off', 'id' => 'lienexport', 'type' => 'text', 'class' => 'form-control', 'label' => 'Lien Export']); 
              ?>
            </div>


          </div>
          <div class="row">
            <div class="col-xs-6">
            </div>
            <div class="col-xs-6">
            </div>

          </div>
        </div>
        <section class="content-header">
          <h1 class="box-title">
            <?php echo __('Les fichiers'); ?>
          </h1>
        </section>
        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">
              <div class="box-header with-border">
                <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_pdf' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                  <i class="fa fa-plus-circle "></i> Ajouter fichier</a>

              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="tabfichier">
                    <thead style="display:'none'">
                      <tr width:"20px">
                        <td align="center" style="width: 25%;"><strong>Fichier</strong></td>
                        <td align="center" style="width: 25%;"></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="tr" style="display: none !important">
                        <!--  <td style="width: 8%;" align="center">
                                <input type="hidden" name="" id="" champ="sup0" table="ligne" index="" class="form-control" >                              
                            </td>                                                    
                                                    -->

                        <td align="center" style="width: 25%;">
                          <input table="fichier" id="" name="" champ="sup1" index="" class="form-control" type="hidden">

                          <?php echo $this->Form->control('pdf', ['class' => 'form-control', 'type' => 'file', 'label' => '', 'champ' => 'pdf', 'table' => 'fichier',]); ?>

                          <!-- <input table="ligne" id="" name=""champ="personnel_id" index="" class="form-control"> -->
                        </td>
                        <td align="center" style="width: 25%;">
                          <i index="0" id="" name="" class="fa fa-times supLigne1"
                            style="color: #c9302c;font-size: 22px;"></i>
                        </td>

                      </tr>


                      <input type="hidden" value="-1" id="index0">
                    </tbody>
                  </table><br>
                </div>
              </div>
            </div>
          </div>

        </section>
        <section class="content-header">
          <h1 class="box-title">
            <?php echo __('Les responsables'); ?>
          </h1>
        </section>
        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">
              <div class="box-header with-border">
                <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_ligne0' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                  <i class="fa fa-plus-circle "></i> Ajouter responsable</a>
              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="tablignee">
                    <thead>
                      <tr width:"20px">
                        <td align="center" style="width: 25%;"><strong>Nom du responsable</strong></td>
                        <td align="center" style="width: 25%;"></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="tr" style="display: none !important">
                        <!--  <td style="width: 8%;" align="center">
                                <input type="hidden" name="" id="" champ="sup0" table="ligne" index="" class="form-control" >                              
                            </td>  --->
                        <td align="center">
                          <input table="ligne" id="" name="" champ="sup1" index="" class="form-control" type="hidden">
                          <?php echo $this->Form->control('personnel_id', ['option' => $commercials, 'required' => 'off', 'index' => '', 'id' => '', 'name' => '', 'champ' => 'personnel_id', 'table' => 'ligne', 'empty' => 'Veuillez choisir !!!!', 'class' => 'form-control', 'label' => '']); ?>
                          <!-- <input table="ligne" id="" name=""champ="personnel_id" index="" class="form-control"> -->
                        </td>
                        <td align="center">
                          <i index="0" id="" name="" class="fa fa-times supLigne1"
                            style="color: #c9302c;font-size: 22px;"></i>
                        </td>
                      </tr>
                      <input type="hidden" value="-1" id="indexx">
                    </tbody>
                  </table><br>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- <section class="content-header">
          <h1 class="box-title">
            <?php echo __('Fournisseurs'); ?>
          </h1>
        </section>
        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">
              <div class="box-header with-border">
                <a class="btn btn-primary al" table='addtable' index='index1' id='ajouter_ligne14' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                  <i class="fa fa-plus-circle "></i> Ajouter fournisseur</a>
              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="tabligne1">
                    <thead>
                      <tr width:20px">
                        <td align="center" style="width: 50%;"><strong>Nom du fournisseur</strong></td>
                        <td align="center" style="width: 10%;"></td>

                        <td align="center" style="width: 50%;"></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="tr" style="display: none !important">
                        <td align="center">
                          <?php echo $this->Form->input('sup1', array('name' => '', 'id' => '', 'champ' => 'sup1', 'table' => 'lignef', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                          ?>
                          <div id="" index="" champ='f1' class="col-md-10">
                            <?php echo $this->Form->input('a', array('label' => '', 'options' => $fournisseurs, 'name' => '', 'id' => 'id', 'class' => 'form-control getmailfrns', 'champ' => 'fournisseur_id', 'table' => 'lignef', 'div' => 'form-group', 'between' => '<div class="col-sm-12 " >', 'after' => '</div>', 'empty' => 'Veuillez Choisir !!')); ?>
                          </div>
                           <div index="" id="" champ="inputfour" class="col-md-10" style="display: none !important">
                            <?php echo $this->Form->input('a', array('label' => '', 'name' => '', 'id' => 'id', 'class' => 'form-control', 'champ' => 'nameF', 'table' => 'lignef', 'div' => 'form-group', 'between' => '<div class="col-sm-12 " >', 'after' => '</div>')); ?>
                          </div>
                          <br>
                          <span title="Ajouter fournisseur"> <a href="javascript:;" index=""
                              class="btn btn-primary ajofournisseur"><i class='fa fa fa-plus'></i></a></span>
                        </td>
                        <td align="center">
                          <div style="position: static; margin-top: 6px;">
                            <a><i class="fa fa fa-plus urlfour" style="color: success; font-size: 20px;"></i></a>
                          </div>
                        </td>

                        <td align="center">
                          <i index="0" id="" class="fa fa-times supLigneFournisseur"
                            style="color: #c9302c;font-size: 22px;"></i>
                        </td>
                      </tr>
                      <input type="hidden" value="-1" id="index1">
                    </tbody>
                  </table><br>
                </div>
              </div>
            </div>
          </div>
        </section> -->
        <!-- <section class="content-header">
          <h1 class="box-title">
            <?php echo __(' Les articles'); ?>
          </h1>
        </section>
        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">
              <div class="box-header with-border">
                <a class="btn btn-primary al" table='addtable' index='index0' id='ajouter_ligneameni' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                  <i class="fa fa-plus-circle "></i> Ajouter article</a>
              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="tabligne5">
                    <thead>
                      <tr width:20px>
                        <td align="center" style="width: 30%;"><strong>Nom du article</strong></td>
                        <td align="center" style="width: 10%;"></td>

                        <td align="center" style="width: 20%;"></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="tr" index="" name="" champ="trarticle" table="article"
                        style="display: none !important">
                        <td align="center">
                          <div champ="ar1" id='' class="col-md-10">
                            <?php echo $this->Form->input('sup0', array('name' => '', 'id' => '', 'champ' => 'sup0', 'table' => 'lignea', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                            <?php echo $this->Form->input('a', array('label' => '', 'options' => $articles, 'index' => '', 'name' => '', 'id' => 'article_id', 'champ' => 'article_id', 'table' => 'lignea', 'empty' => 'Veuillez choisir !!', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>')); ?>
                          </div>
                           <div champ="ar2" id='' style="display: none !important" class="col-md-10">
                            <input table="lignea" type='text' index="" id="article_idd" champ='article_idd'
                              class='form-control' class='input'>
                          </div>
                          <span title="ajout article"> <a href="javascript:;" class="btn btn-primary b1"><i
                                class='fa fa fa-plus'></i></a></span>
                        </td>
                        <td align="center">
                          <div style="position: static; margin-top: 6px;">
                            <a><i class="fa fa fa-plus urlarticlee" style="color: success; font-size: 20px;"></i></a>
                          </div>
                        </td>

                        <td align="center">
                          <i index="0" id="" class="fa fa-times supLigneart"
                            style="color: #c9302c;font-size: 22px;"></i>
                        </td>
                      </tr>
                      <input type="hidden" value="-1" id="index5">
                    </tbody>
                  </table><br>
                </div>
              </div>
            </div>
          </div>
        </section> -->


        
        <!-- <section class="content-header">
          <h1 class="box-title">
            <?php echo __(' Les clients'); ?>
          </h1>
        </section>
        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">
              <div class="box-header with-border">
                <a class="btn btn-primary al" table='addtable' index='index0' id='ajouter_lignecl' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                  <i class="fa fa-plus-circle "></i> Ajouter client</a>
              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="tabligne6">
                    <thead>
                      <tr width:20px>
                        <td align="center" style="width: 30%;"><strong>Nom du client</strong></td>
                        <td align="center" style="width: 10%;"></td>

                        <td align="center" style="width: 20%;"></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="tr" index="" name="" champ="trarticle" table="client" style="display: none !important">
                        <td align="center">
                          <div champ="cliselect" id='' class="col-md-10">
                            <?php echo $this->Form->input('sup6', array('name' => '', 'id' => '', 'champ' => 'sup6', 'table' => 'lignec', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                            <?php echo $this->Form->input('a', array('label' => '', 'options' => $clients, 'index' => '', 'name' => '', 'id' => 'client_id', 'champ' => 'nameC', 'table' => 'lignec', 'empty' => 'Veuillez choisir !!', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>')); ?>
                          </div>

                        
                        </td>
                       
                        <td align="center">
                          <div class="col-xs-1" style="margin-top: 31px;">
                            <a><i class="fa fa fa-plus url" style="color:success;font-size: 25px;"></i></a>
                          </div>
                        </td>
                        <td align="center">
                          <i index="0" id="" class="fa fa-times supLignecl" style="color: #c9302c;font-size: 22px;"></i>
                        </td>
                      </tr>
                      <input type="hidden" value="-1" id="index6">
                    </tbody>
                  </table><br>
                </div>
              </div>
            </div>
          </div>
        </section> -->
        <div class="col-xs-1 pull-right">
          <input type="hidden" value=<?php echo $nbrejours->nbrejours ?> id="nbrej">
        </div>
        <div class="boutons-container">
          <a href="<?php echo $this->Url->build(['action' => 'index']); ?>" class="button">Annuler</a>
          <?php echo $this->Form->submit('Créer brouillon', ['id' => 'verifprojets']); ?>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>
<script>
  $(document).ready(function() {
    $('.testdate').change(function() {
      var datedebut = $('#datedebut').val();
      var nbrejours = $('#nbrej').val();
      var dateDebut = new Date(datedebut);
      var dateFin = new Date(dateDebut.getTime() + (nbrejours * 24 * 60 * 60 * 1000));
      var day = ("0" + dateFin.getDate()).slice(-2);
      var month = ("0" + (dateFin.getMonth() + 1)).slice(-2);
      var year = dateFin.getFullYear();
      var dateFinFormat = year + '-' + month + '-' + day;
      $('#datefin').val(dateFinFormat);
    });
  });
</script>
<script>
  $(function() {
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

          $('#Compteee_id').html(data.select);


        }
      });
    });
  });
</script>
<script>
  $('#verifprojets').on('click', function() {
    // libelle = $('#libelle').val();
    // name = $('#name').val();
    libelle = $('#lib').val();
    ref = $('#ref').val();
    devise_id = $('#devise_id').val();
    if (libelle === '') {
      alert('veuillez remplir le champ Libelle');
      event.preventDefault();
    } else if (ref === '') {
      alert('veuillez remplir le champ  Reference')
      event.preventDefault();

    } else if (devise_id === '') {
      alert('veuillez choisir le devise')
      event.preventDefault();

    }
  });
</script>
<script>
  $(document).ready(function() {
    var clickCounter2 = 0;

    $('.urlarticlee').on('click', function() {
      var index = $(this).attr('index');
      var currentUrl = window.location.href;
      // alert(currentUrl);
      var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
      // alert(parentUrl);
      var link = parentUrl + "/articles/addarticle/" + index;
      // alert(link);
      window.open(link, "_blank", "width=1000,height=1000");
    });

    $('.urlfour').on('click', function() {
      var index = $(this).attr('index');
      var currentUrl = window.location.href;
      var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
      var link = parentUrl + "/fournisseurs/addfournisseur/" + index;
      // alert(link);
      window.open(link, "_blank", "width=1000,height=1000");
    });
    $('.url').on('click', function() {
      var index = $(this).attr('index');
      // alert(index)
      var currentUrl = window.location.href;
      var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
      var link = parentUrl + "/clients/addclient/" + index;
      // alert(link);
      window.open(link, "_blank", "width=1000,height=1000");
      // openWindow(1000, 1000, link);
    });
    $('.urlcli').on('click', function() {
      var index = $(this).attr('index');
      // alert(index)
      var currentUrl = window.location.href;
      var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
      var link = parentUrl + "/clients/addcli/";
      // alert(link);
      window.open(link, "_blank", "width=1000,height=1000");
      // openWindow(1000, 1000, link);
    });
    $('.urlclient').on('click', function() {
      var index = $(this).attr('index');
      var currentUrl = window.location.href;
      var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
      var link = parentUrl + "/projets/addclients/" + index;
      // alert(link);
      window.open(link, "_blank", "width=1000,height=1000");
    });

  });
</script>
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'css']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min', ['block' => 'css']); ?>
<!-- iCheck for checkboxes and radio inputs -->
<?php echo $this->Html->css('AdminLTE./plugins/iCheck/all', ['block' => 'css']); ?>
<!-- Bootstrap Color Picker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min', ['block' => 'css']); ?>
<!-- Bootstrap time Picker -->
<?php echo $this->Html->css('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<!-- InputMask -->
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.extensions', ['block' => 'script']); ?>
<!-- date-range-picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/moment/min/moment.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'script']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min', ['block' => 'script']); ?>
<!-- bootstrap color picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
<!-- bootstrap time picker -->
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>

<?php $this->start('scriptBottom'); ?>
<style>
  .boutons-container {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .button {
    /* display: inline-block; */
    padding: 10px 20px;
    font-size: 12px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    /* transition: background-color 0.3s ease; */
  }

  .button:hover {
    background-color: #2980b9;
  }

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
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()
    // $("#verifenr").on("mouseover", function () {
    //   client_id = $("#client_id").val();//alert(client_id)
    //   opportunite_id = $("#opportunite_id").val();
    //   datedebut = $("#datedebut").val();
    //   datefin = $("#datefin").val();
    //   if (client_id == "") {
    //     alert("Veuillez choisir un tier !!", function () { });
    //     return false;
    //   } if (datedebut == "") {
    //     alert("Veuillez entrer la date de debut !!", function () { });
    //     return false;
    //   }if (datefin == "") {
    //     alert("Veuillez entrer la date fin !!", function () { });
    //     return false;
    //   }if (opportunite_id == "") {
    //     alert("Veuillez choisir une Statut opportunit� !!", function () { });
    //     return false;
    //   }
    // });
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {
      'placeholder': 'dd/mm/yyyy'
    })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', {
      'placeholder': 'mm/dd/yyyy'
    })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      format: 'MM/DD/YYYY h:mm A'
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker({
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
      },
      function(start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })



    // $('.url').on('click', function () {
    //   var currentUrl = window.location.href;
    //   var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
    //   var link = parentUrl + "/projets/addclients/3";
    //   openWindow(1000, 1000, link);
    // });


    $('.url1').on('click', function() {
      var currentUrl = window.location.href;
      var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
      var link = parentUrl + "/projets/addcommmm/9";
      openWindow(1000, 1000, link);
    });

    $('.urldevise').on('click', function() {
      var currentUrl = window.location.href;
      var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
      var link = parentUrl + "/projets/adddevise/";
      openWindow(1000, 1000, link);
    });

    $('.urlbanque').on('click', function() {
      var currentUrl = window.location.href;
      var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
      var link = parentUrl + "/projets/addbanque/";
      openWindow(1000, 1000, link);
    });

    function openWindow(width, height, url) {
      var left = (screen.width - width) / 2;
      var top = (screen.height - height) / 2;
      window.open(url, '_blank', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
    }
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<?php $this->end(); ?>