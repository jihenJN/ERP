<?php
error_reporting(E_ERROR | E_PARSE);

use Cake\Datasource\ConnectionManager;

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Projet $projet
 */
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php // echo $this->Html->script('dhouha'); z
?>
<?php // echo $this->Html->script('alert'); 
?>

<?php // echo $this->Html->css('select2'); 
?>
<?php echo $this->Html->script('js_vieww_projet'); ?>
<?php // echo $this->Html->script('controle_frs'); 
?>
<?php // echo $this->Html->css('select2'); 
?>
<?php // echo $this->Html->css('vieww'); 
?>
<?php // echo $this->Html->script('hechem'); 
?>
<?php echo $this->Form->create($projet, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13", 'type' => 'file']); ?>

<!-- <section class="content-header">
  <h1>
    Visualiser Projet
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
        <?php echo __('Retour'); ?>
      </a></li>
  </ol>
</section> -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box ">
        <div class="choisir" align="center" style="margin-left:50px; margin-top:10px;">
          <!-- <button type="button" id='projetsbtn' style="width: 10%;" class="btn btn-primary btn-sm active">Vue d'ensemble</button>
          <button type="button" id='tempsconsommebtn' style="width: 10%;" class="btn btn-primary btn-sm">Temps Consommé</button>
          <button type="button" id='demandeoffredeprixbtn' style="width: 12%;" class="deduction btn btn-primary btn-sm">Demande Offre de Prix</button>
          <button type="button" id='commandefournisseurbtn' style="width: 13%;" class="deduction btn btn-primary btn-sm">Commande Fournisseur</button>
          <button type="button" id='offreggbbtn' style="width: 10%;" class="btn btn-primary btn-sm">Offre GGB</button> -->

          <!-- <button type="button" id='contactprojet' style="width: 10%;" class="btn btn-primary btn-sm">Contacts du Projet</button> -->
          <!-- <button type="button" id='tacheprojet' style="width: 10%;" class="btn btn-primary btn-sm">Taches</button> -->
          <!--       <button type="button" id='vueensemble' style="width: 10%;" class="btn btn-primary btn-sm">Vue d'ensemble</button>
          <button type="button" id='fichierjoint' style="width: 10%;" class="btn btn-primary btn-sm">Fichiers Joints</button> -->
          <!-- <button type="button" id='factureclientbtn' style="width: 14%;" class="btn btn-primary btn-sm">Facture Client</button> -->
        </div>
        <div class="column-responsive column-120">
          <div class="box" style="margin-left: 10px;width: 98%;margin-top: 50px;background-color:#f3f4f7;">
            <div class="box-body">
              <?php // include('detailprojet.php'); 
              ?>
              <?php // include('tache.php'); 
              ?>
              <?php // include('tempsconsomme.php'); 
              ?>
              <?php // include('demandeoffre.php'); 
              ?>
              <?php // include('commandefournisseur.php'); 
              ?>
              <?php // include('offreggb.php'); 
              ?>
              <div id="demandeoffredeprix" style="display:true;margin-top: 18px;">
                <section class="content-header">
                  <h1>
                    Demande offre de prix
                    <small>
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
                        <?php // echo $this->Form->create($projet, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13", 'type' => 'file']); 
                        ?>
                        <div class="box-body">
                          <div class="row">
                            <div class="col-xs-6">
                              <?php echo $this->Form->control('date', ['table' => 'tabledemandeoffre', 'name' => 'data[tabledemandeoffre][0][date]', 'label' => 'Date', 'type' => 'date', 'empty' => true, 'id' => 'date', 'class' => "form-control pull-right"]);
                              ?>
                            </div>
                            <div class="col-xs-6">
                              <?php echo $this->Form->control('numerodof', ['table' => 'tabledemandeoffre', 'name' => 'data[tabledemandeoffre][0][numero]',  'value' => $num_dof, 'label' => 'Numero',  'required' => 'off', 'id' => 'datecommande', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'readonly' => 'readonly']); ?>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-6">
                              <?php echo $this->Form->control('projet_id', ['value' => $project_id, 'empty' => 'Veuillez choisir un projet!!', 'class' => 'form-control ', 'style' => "pointer-events: none;",  'readonly', 'champ' => 'projet_id', 'label' => 'Projet']); ?>
                            </div>
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
                                  <a class="btn btn-primary al" table='addtable' index='index' id='ajouter_lignearticle' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                    <i class="fa fa-plus-circle "></i> Ajouter Article</a>
                                </div>
                                <div class="panel-body">
                                  <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                                      <thead>
                                        <tr width:"20px">
                                          <td align="center" style="width: 40%;"><strong>Nom du article</strong></td>
                                          <td align="center" style="width: 10%;"></td>
                                          <td align="center" style="width: 40%;"><strong>Quantité</strong></td>
                                          <td align="center" style="width: 10%;"></td>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr class="tr" style="display: none !important">
                                          <td align="center" style=width:80%; table="ligner">
                                            <div id="ar1" champ=''>
                                              <?php echo $this->Form->input('sup0', array('name' => '', 'id' => '', 'champ' => 'sup0', 'table' => 'lignea', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                              <?php echo $this->Form->input('a', array('label' => '', 'options' => $articles, 'value' => '30', 'index' => '', 'name' => '', 'id' => 'article_id', 'champ' => 'article_id', 'table' => 'lignea', 'empty' => 'Veuillez choisir !!', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'empty' => 'Veuillez Choisir !!')); ?>
                                            </div>
                                            <div id="ar2" champ='' style="display: none !important">
                                              <input table="lignea" type='text' index="" id="article_idd" champ='article_idd' class='form-control' class='input'>
                                            </div>
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
                                            <i index="0" id="" class="fa fa-times supLigne0" style="color: #c9302c;font-size: 22px;"></i>
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
                          <!-- <section class="content-header">
                            <h1 class="box-title">
                              <?php echo __('Tiers'); ?>
                            </h1>
                          </section>
                          <section class="content" style="width: 99%">
                            <div class="row">
                              <div class="box">
                                <div class="box-header with-border">
                                  <a class="btn btn-primary" table='addtable' index='index1' id='ajouter_ligne_fournisseur' style="float: right; margin-bottom: 5px;">
                                    <i class="fa fa-plus-circle "></i> Ajouter Tiers</a>
                                </div>
                                <div class="panel-body">
                                  <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne1">
                                      <thead>
                                        <tr width:20px">
                                          <td align="center" style="width: 40%;"><strong>Nom du Tiers</strong></td>
                                          <td align="center" style="width: 10%;"></td>
                                          <td align="center" style="width: 40%;"><strong>E_mail Tiers</strong></td>
                                          <td align="center" style="width: 10%;"></td>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr class="tr" style="display: none !important">
                                          <td align="center">
                                            <?php echo $this->Form->input('sup1', array('name' => '', 'id' => '', 'champ' => 'sup1', 'table' => 'lignef', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                            <div id="" index="" champ='f1'>
                                              <?php echo $this->Form->input('a', array('label' => '', 'value' => '16', 'options' => $fournisseurs, 'name' => '', 'id' => 'id', 'class' => 'form-control getmailfrns', 'champ' => 'fournisseur_id', 'table' => 'lignef', 'div' => 'form-group', 'between' => '<div class="col-sm-12 " >', 'after' => '</div>', 'empty' => 'Veuillez Choisir !!')); ?>
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
                          </section> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div align="center" id="e1nr3" class="index">
        <button type="submit" class="pull-right btn btn-success btn-sm" id="boutondetail" style="margin-right:48%;margin-top: 10px;margin-bottom:20px;">Enregistrer</button>
        <!-- < ?php echo $this->Html->link(__('  Valider  '), ['action' => 'viewwdem', $project_id], ['class' => 'btn btn-primary mb-2 enrg  testetap']) ?>
        < ?php echo $this->Html->link('<button type="button" class="btn btn-xs btn-info"><i class="fa fa-check"></i></button>', ['action' => 'viewwdem', $project_id], ['escape' => false]); ?> -->
      </div>
    </div>
  </div>

</section>
<?php echo $this->Form->end(); ?>

<section>
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
</section>
<script>
  $(document).ready(function() {
    $(".getmailfrns").on("change", function() {
      ind = $(this).attr("index");
      index = $("#index1").val();
      fournisseur_id = $("#fournisseur_id" + ind).val();
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
            console.log(data);
            $("#mail" + ind).val(data.mail);
          },
        });
      } else {
        $("#mail" + ind).val("");
      }
    });
  });
</script>