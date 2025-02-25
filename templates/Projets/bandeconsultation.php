<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Demandeoffredeprix $demandeoffredeprix
 */
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Select2 CSS -->



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->script('js_vieww_projet'); ?>
<?php echo $this->Html->script('dhouha'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->css('select2');

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Demande offre de prix
    <small>
      <?php echo __(''); ?>
    </small>
  </h1>
  <?php //debug($project_id); 
  ?>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'vieww', $project_id]); ?>"><i class="fa fa-reply"></i>
        <?php echo __('Retour'); ?>
      </a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box">
        <div class="box-header with-border">
          <h3 class="box-title">
            <?php echo __(''); ?>
          </h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($demandeoffredeprix, ['role' => 'form','type'=>'file', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-6">
              <?php echo $this->Form->control('date', ['readonly' => 'readonly', 'label' => 'Date', 'empty' => true, 'id' => 'datecommande', 'class' => "form-control pull-right"]);
              //                    echo $this->Form->control('date', ['empty' => true]);

              echo $this->Form->input('id', array('value' => $demandes['id'], 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden'));

              ?>

            </div>

            <div class="col-xs-6">
              <?php // echo $this->Form->control('numero',['label'=>'Numero','required' => 'off','id'=>'datecommande','div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control ','type'=>'','readonly'=>'readonly']); 
              echo $this->Form->control('numero', ['readonly' => 'readonly']); ?>
            </div>

            <div class="col-xs-6">
              <?php  echo $this->Form->control('file',['label'=>'Fichier','required' => 'off','id'=>'fichier','div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control ','type'=>'file']); 
              ?>
            </div>


          </div>
        </div>
        <section class="content-header" style="margin-left:20px">
          <h1 class="box-title">
            <?php echo __('Article'); ?>
          </h1>
        </section>

        <section class="content" style="width: 100%">
          <div class="row">
            <div class="box box">
              <div class="box-header with-border">
              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <?php  ?>
                  <table class="table table-bordered table-striped " id="tabligne0">
                    <thead>
                      <tr width:20px">
                        <td align="center" style="width: 20%;background-color: #F5F5F5 ;"><strong>Fournisseur</strong>
                        </td>
                        <td align="center" style="width: 80%;background-color: #F5F5F5 ;"><strong>Article</strong></td>

                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      foreach ($lignefs as $j => $ligiventaire) {
                        //debug($lignefs);die;
                        //debug($ligiventaire['nameF']);die;
                      ?>
                        <tr class="" style="">
                          <td align="center" style="background-color: white;">
                            <?php echo $this->Form->input('nameF', array('label' => 'Fournisseur', 'value' => $ligiventaire['nameF'], 'id' => 'nameF' . $j, 'name' => 'data[fligne][' . $j . '][nameF]', 'champ' => 'nameF', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control', 'style' => 'pointer-events:none'));
                            ?>
                            <?php echo $this->Form->input('fournisseur_id', array('value' => $ligiventaire['fournisseur_id'], 'label' => '', 'id' => 'fournisseur_id' . $j, 'name' => 'data[fligne][' . $j . '][fournisseur_id]', 'champ' => 'fournisseur_id', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden')); ?>
                            <?php echo $this->Form->input('devise_id', array('label' => 'Devise', 'empty' => 'Veuillez choisir !!!', 'id' => 'devise_id' . $j, 'name' => 'data[fligne][' . $j . '][devise_id]', 'champ' => 'devise_id', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control')); ?>
                            <?php echo $this->Form->input('conditionreglement_id', array('label' => 'Condition de reglement', 'empty' => 'Veuillez choisir !!!', 'id' => 'conditionreglement_id' . $j, 'name' => 'data[fligne][' . $j . '][conditionreglement_id]', 'champ' => 'conditionreglement_id', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control')); ?>
                            <?php echo $this->Form->input('paiement_id', array('label' => 'Mode de reglement', 'empty' => false, 'id' => 'paiement_id' . $j, 'name' => 'data[fligne][' . $j . '][paiement_id]', 'champ' => 'paiement_id', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => "form-control selectpicker helloselect", 'multiple', 'data-live-search' => "true", 'onchange' => 'hello(' . $j . ')', 'label' => 'Mode de reglèment', 'options' => $paiements)); ?>
                            <?php echo $this->Form->input('paim', array('label' => '', 'empty' => false, 'id' => 'paim' . $j, 'name' => 'data[fligne][' . $j . '][paim]', 'champ' => 'paim', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => "form-control ",  'type' => 'hidden')); ?>

                            <?php echo $this->Form->input('methodeexpedition_id', array('label' => 'Méthode d`expédition', 'empty' => 'Veuillez choisir !!!', 'id' => 'methodeexpedition_id' . $j, 'name' => 'data[fligne][' . $j . '][methodeexpedition_id]', 'champ' => 'methodeexpedition_id', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control')); ?>


                          </td>




                          <td style="background-color: white">


                            <table class="table table-bordered table-striped table-bottomless" id="tabligne1">
                              <thead>

                                <tr width:20px"="">
                                  <td align="center" style="width: 30%;background-color: #F5F5F5;font-size: 13px;"><strong>Nom du
                                      article</strong></td>
                                  <td align="center" style="width: 5%;background-color: #F5F5F5;font-size: 13px;"><strong>Code
                                      article/frs</strong></td>
                                  <td align="center" style="width: 7%;background-color: #F5F5F5 ;font-size: 13px;">
                                    <strong>Quantité</strong>
                                  </td>
                                  <td align="center" style="width: 7%;background-color: #F5F5F5 ;font-size: 13px;"><strong>coût de
                                      revient</strong></td>
                                      <?php if ($parametretaus->tauxdemarge == 1) {?>
                                  <td align="center" style="width: 7%;background-color: #F5F5F5;font-size: 13px;"><strong>Taux de marge</strong>
                                  </td>
                                  <?php } if ($parametretaus->tauxmarque == 1) {  ?>
                                  <td align="center" style="width: 7%;background-color: #F5F5F5;font-size: 13px;"><strong>Taux de marque</strong>
                                  </td>
                                  <?php } ?>
                                  <td align="center" style="width: 7%;background-color: #F5F5F5 ;font-size: 13px;"><strong>prix de
                                      vente</strong></td>
                                  <td align="center" style="width: 10%;background-color: #F5F5F5 ;font-size: 13px;"><strong>Total</strong>
                                  </td>
                                  <td align="center" style="width: 10%;background-color: #F5F5F5 ;font-size: 13px;"><strong>Date de livraison</strong>
                                  </td>
                                </tr>
                              </thead>
                              <tbody>


                                <?php foreach ($ligneas as $i => $ligne) {
                                  //                                              debug($ligne);die;
                                ?>

                                  <tr class="tr" style="">
                                    <td align="center" style="background-color: white;">
                                      <?php echo $this->Form->input('article_id', array('name' => 'data[fligne][' . $j . '][aligne][' . $i . '][article_id]', 'value' => $ligne['article_id'], 'id' => 'article_id' . $j . '-' . $i, 'champ' => 'article_id', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                      <?php echo $this->Form->input('ligne_id', array('value' => $ligne['id'], 'label' => '', 'id' => 'ligne_id' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][ligne_id]', 'champ' => 'ligne_id', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden')); ?>
                                      <?php echo $this->Form->input('designiationA', array('readonly' => 'readonly', 'style' => 'pointer-events:none;font-size: 13px;', 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][designiationA]', 'value' => $ligne['designiationA'], 'label' => '', 'id' => 'designiationA' . $j . '-' . $i, 'champ' => 'designiationA', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control')); ?>
                                    </td>
                                    <td align="center" table="" style="background-color: white">
                                      <?php echo $this->Form->input('codefrs', array('label' => '', 'id' => 'codefrs' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][codefrs]', 'champ' => 'codefrs', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'style' => 'font-size: 13px;', 'class' => 'form-control codefrs')); ?>
                                    </td>


                                    <td align="center">
                                      <?php echo $this->Form->input('qte', array('readonly' => 'readonly', 'value' => $ligne['qte'], 'style' => 'pointer-events:none', 'label' => '', 'id' => 'qte' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][qte]', 'champ' => 'qte', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'style' => 'font-size: 13px;', 'class' => 'form-control calculls')); ?>

                                    </td>
                                    <td align="center">
                                      <?php echo $this->Form->input('prix', array('label' => '', 'id' => 'prix' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][prix]', 'champ' => 'prix', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'style' => 'font-size: 13px;', 'class' => 'form-control validation prix calculprix calculls')); ?>

                                    </td>
                                    <?php if ($parametretaus->tauxdemarge == 1) {?>
                                    <td align="center">
                                      <?php echo $this->Form->input('tauxdemarge', array('label' => '', 'id' => 'tauxdemarge' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][tauxdemarge]', 'champ' => 'tauxdemarge', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'style' => 'font-size: 13px;', 'class' => 'form-control calculprix')); ?>
                                    </td>
                                    <?php } if ($parametretaus->tauxmarque == 1) {  ?>
                                    <td align="center">
                                      <?php echo $this->Form->input('tauxdemarque', array('label' => '', 'id' => 'tauxdemarque' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][tauxdemarque]', 'champ' => 'tauxdemarque', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'style' => 'font-size: 13px;', 'class' => 'form-control calculprix')); ?>
                                    </td>
                                    <?php } ?>
                                    <td align="center">
                                      <?php echo $this->Form->input('coutrevient', array('label' => '', 'id' => 'coutrevient' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][coutrevient]', 'champ' => 'coutrevient', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'style' => 'font-size: 13px;', 'class' => 'form-control')); ?>
                                    </td>
                                    <td align="center">
                                      <?php echo $this->Form->input('total', array('label' => '', 'id' => 'total' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][total]', 'champ' => 'total', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'style' => 'font-size: 13px;', 'class' => 'form-control total')); ?>

                                    </td>
                                    <td align="center">
                                      <?php echo $this->Form->input('datelivraison', array('label' => '', 'id' => 'datelivraison' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][datelivraison]', 'champ' => 'datelivraison', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'style' => 'font-size: 13px;', 'class' => 'form-control ', 'type' => 'date')); ?>

                                    </td>
                                  </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                            <input type="hidden" value="<?php echo $i; ?>" id="indexa<?php echo $j; ?>" />
                            <div class="col-lg-3 col-lg-offset-3 pull-right">

                              <?php echo $this->Form->input('t', array('label' => 'total des prix des articles:', 'id' => 't' . $j, 'name' => 'data[fligne][' . $j . '][t]', 'champ' => 'total', 'table' => 'fligne', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-4" >', 'after' => '</div>', 'class' => 'form-control total')); ?>


                            </div>

                          </td>


                        </tr>

                      <?php } ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <input type="hidden" value="<?php echo $j; ?>" id="index" />


            <div class="form-group">

              <div align="center" id="enr4" class="  alert" class="btn btn-primary">
                <?php echo $this->Form->submit(__('Enregistrer')) ?>
              </div>




              <!--                                
                                            <div class="col-lg-9 col-lg-offset-3 alert">
                                                <button id="enr4" type="submit" class="btn btn-primary">Enregistrer</button>
                                            </div>
                                      
                            -->



            </div>
            <?php echo $this->Form->end(); ?>
          </div>
      </div>
    </div>
  </div>
  <script>      $(".calculprix").on("keyup", function() {
      
        // index = $("#index").val();
        index1 = $("#indexa").val();
        index = $("#index").val();
        indexl = $("#indexa" + index).val();
        for (j = 0; j <= Number(index); j++) {
          prixMG = 0;
          prixMQ = 0;
          total = 0;
          for (i = 0; i <= Number(indexl); i++) {
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
              } else if (MQ) {
                marque = 100 - Number(MQ);
                prixMG = ((Number(prix) * 100) / Number(marque));
                console.log(prixMG)

                // prixMG = Number(prix) + (Number(MG) * Number(prix) / 100);
                // prixMG = Math.floor(prixMG); // Conversion en entier
                $("#coutrevient" + j + "-" + i).val(Number(prixMG).toFixed(3));
               // $("#coutrevient" + j + "-" + i).val(prixMG);
              } else if (MG) {
             //   prixMQ = Number(prix) + (Number(MQ) * Number(prix) / 100);
                prixMQ = (Number(prix) + (Number(MG) * Number(prix) / 100)); 
                $("#coutrevient" + j + "-" + i).val(Number(prixMQ).toFixed(3));
              }else{
                $("#coutrevient" + j + "-" + i).val(Number(prix).toFixed(3));
                
              }
            }
          }
        }
        calculeiis();
      });</script>



  <script>
    function hello(ind) {
      var button = document.querySelector('button[data-id="paiement_id' + ind + '"]');
      var title = button.getAttribute('title');
     // alert(title)
      $('#paim' + ind).val(title);
    }
    $(document).ready(function() {
      $('.selectpicker').selectpicker();
  


    });
  </script>