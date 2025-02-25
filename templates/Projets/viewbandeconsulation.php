<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Demandeoffredeprix $demandeoffredeprix
 */
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('controle_frs'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Demande offre de prix
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'vieww', $project_id]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo __(''); ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($demandeoffredeprix, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
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



          </div>
        </div>
        <section class="content-header" style="margin-left:20px">
          <h1 class="box-title"><?php echo __('Article'); ?></h1>
        </section>

        <section class="content" style="width: 93%">
          <div class="row">
            <div class="box box">
              <div class="box-header with-border">
              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <?php /*if (!empty($demandeoffredeprix->lignedemandeoffredeprixes)): 
                                             //debug($demandeoffredeprix->lignedemandeoffredeprixes);die
;                                             
                                             */ ?>
                  <table class="table table-bordered table-striped " id="tabligne0">
                    <thead>
                      <tr width:20px">
                        <td align="center" style="width: 20%;"><strong>Fournisseur</strong></td>
                        <td align="center" style="width: 80%;"><strong>Article</strong></td>

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
                            <?php echo $this->Form->input('nameF', array('label' => '', 'readonly' => 'readonly', 'value' => $ligiventaire['nameF'], 'id' => 'nameF' . $j, 'name' => 'data[fligne][' . $j . '][nameF]', 'champ' => 'nameF', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control'));
                            ?>
                            <?php echo $this->Form->input('fournisseur_id', array('value' => $ligiventaire['fournisseur_id'], 'label' => '', 'id' => 'fournisseur_id' . $j, 'name' => 'data[fligne][' . $j . '][fournisseur_id]', 'champ' => 'fournisseur_id', 'index' => $j, 'table' => 'fligne', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden')); ?>




                          </td>




                          <td style="background-color: white">


                            <table class="table table-bordered table-striped table-bottomless" id="tabligne1">
                              <thead>

                                <tr width:20px"="">
                                  <td align="center" style="width: 20%;"><strong>Nom du article</strong></td>
                                  <td align="center" style="width: 25%;"><strong>Code article/frs</strong></td>
                                  <td align="center" style="width: 20%;"><strong>Quantité</strong></td>
                                  <td align="center" style="width: 20%;"><strong>Prix</strong></td>
                                  <td align="center" style="width: 25%;"><strong>Total</strong></td>

                                </tr>
                              </thead>
                              <tbody>


                                <?php foreach ($ligneas as $i => $ligne) {
                                  //                                              debug($ligne);die;
                                ?>

                                  <tr class="tr" style="">
                                    <td align="center" style="background-color: white">
                                      <?php echo $this->Form->input('article_id', array('name' => 'data[fligne][' . $j . '][aligne][' . $i . '][article_id]', 'value' => $ligne['article_id'], 'id' => 'article_id' . $j . '-' . $i, 'champ' => 'article_id', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                                      <?php echo $this->Form->input('ligne_id', array('value' => $ligne['id'], 'label' => '', 'id' => 'ligne_id' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][ligne_id]', 'champ' => 'ligne_id', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden')); ?>
                                      <?php echo $this->Form->input('designiationA', array('readonly' => 'readonly', 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][designiationA]', 'value' => $ligne['designiationA'], 'label' => '', 'id' => 'designiationA' . $j . '-' . $i, 'champ' => 'designiationA', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control')); ?>
                                    </td>
                                    <td align="center" table="" style="background-color: white">
                                      <?php echo $this->Form->input('codefrs', array('label' => '', 'id' => 'codefrs' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][codefrs]', 'champ' => 'codefrs', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control codefrs')); ?>
                                    </td>


                                    <td align="center">
                                      <?php echo $this->Form->input('qte', array('value' => $ligne['qte'], 'readonly' => 'readonly', 'label' => '', 'id' => 'qte' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][qte]', 'champ' => 'qte', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control calcull')); ?>

                                    </td>
                                    <td align="center">
                                      <?php echo $this->Form->input('prix', array('label' => '', 'id' => 'prix' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][prix]', 'champ' => 'prix', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control validation prix calcull')); ?>

                                    </td>
                                    <td align="center">
                                      <?php echo $this->Form->input('total', array('label' => '', 'id' => 'total' . $j . '-' . $i, 'name' => 'data[fligne][' . $j . '][aligne][' . $i . '][total]', 'champ' => 'total', 'table' => 'fligne', 'tableligne' => 'aligne', 'indexligne' => $i, 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'class' => 'form-control total')); ?>

                                    </td>
                                  </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                            <input type="hidden" value="<?php echo $i; ?>" id="indexa<?php echo $j; ?>" />
                            <div class="col-lg-9 col-lg-offset-3">

                              <?php echo $this->Form->input('t', array('label' => 'total des prix des articles', 'id' => 't' . $j, 'name' => 'data[fligne][' . $j . '][t]', 'champ' => 'total', 'table' => 'fligne', 'index' => $j, 'div' => 'form-group', 'between' => '<div class="col-sm-4" >', 'after' => '</div>', 'class' => 'form-control total')); ?>


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