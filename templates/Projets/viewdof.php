<section class="content-header">
  <h1>
    Demande offre de prixes
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'vieww/', $project_id]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo __(''); ?></h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-6">
              <?php echo $this->Form->control('date', ['value' => h($demandeoffredeprix->date), "readonly" => true, 'label' => 'Date', 'empty' => true, 'id' => 'date', 'class' => "form-control pull-right"]);
              ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('numero', ['value' =>  h($demandeoffredeprix->numero), "readonly" => true, 'label' => 'Numero', 'required' => 'off', 'id' => 'datecommande', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'readonly' => 'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('projet_id', ['disabled' => 'true', 'champ' => 'projet_id', 'options' => $projets, 'value' => $demandeoffredeprix->projet_id, 'empty' => 'Veuillez choisir un projet !!!']); ?>
            </div>
          </div>
          <section class="content-header">
            <?php if (!empty($demandeoffredeprix->lignedemandeoffredeprixes)) : ?>
              <h1 class="box-title"><?php echo __(' Les articles'); ?></h1>
          </section>
          <section class="content" style="width: 99%">
            <div class="row">
              <div class="box">
                <div class="panel-body">
                  <div class="table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless" id="tabligne0">
                      <thead>
                        <tr width:20px">
                          <td align="center" style="width: 40%;"><strong>Nom du article</strong></td>
                          <td align="center" style="width: 40%;"><strong>Quantite</strong></td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($ligneas as $i => $lignedemandeoffredeprixes) :
                        ?>
                          <tr class="tr" style="">
                            <td align="" class="" id="">
                              <div style="margin-left:9px;">
                                <?php echo $this->Form->control('a', ['label' => '', 'value' => h($lignedemandeoffredeprixes->designiationA), "readonly" => true, 'id' => 'article_id', 'champ' => 'article_id', 'name' => '', 'table' => 'lignea', 'empty' => 'Veuillez choisir !!']); ?> </div>
                              <div style="visibility:hidden;width:300px;">
                                <?php echo $this->Form->control('a', ['label' => '', 'value' => h($lignedemandeoffredeprixes->designiationA), "readonly" => true, 'id' => 'article_idd', 'champ' => 'article_idd', 'name' => '', 'table' => 'lignea']); ?> </div>
                              <div style="margin-top:-50px;margin-left:330px">
                              </div>
                            </td>
                            <td align="center">
                              <?php echo $this->Form->control('a', ['label' => '',  'value' => h($lignedemandeoffredeprixes->qte), 'name' => '', "readonly" => true, 'champ' => 'qte', 'table' => 'lignea', 'id' => 'qte']); ?>
                            </td>
                            <input type="hidden" value="<?php echo $i ?>" id="index0">
                          <?php endforeach; ?>
                      </tbody>
                    </table><br>
                  </div>
                </div>
              </div>
            </div>

          </section>
          <section class="content-header">
            <h1 class="box-title"><?php echo __('Fournisseurs'); ?></h1>
          </section>

          <section class="content" style="width: 99%">
            <div class="row">
              <div class="box">
                <div class="panel-body">
                  <div class="table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless" id="tabligne1">
                      <thead>
                        <tr width:20px">
                          <td align="center" style="width: 50%;"><strong>Nom du fournisseur</strong></td>
                          <td align="center" style="width: 50%;"><strong>E_mail fournisseur</strong></td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($lignefs as $j => $lignedemandeoffredeprixes) :
                          //dd($lignedemandeoffredeprixes);
                        ?>
                          <tr class="tr">
                            <td align="" class="" id="">
                              <div style="margin-left:9px;">
                                <?php echo $this->Form->control('a', ['label' => '', "readonly" => true, 'value' => h($lignedemandeoffredeprixes->nameF), 'id' => 'fournisseur_id', 'champ' => 'fournisseur_id', 'name' => '', 'table' => 'lignef', 'empty' => 'Veuillez choisir !!']); ?> </div>
                              <div style="visibility:hidden;">
                                <?php echo $this->Form->control('a', ['label' => '', "readonly" => true, 'value' => h($lignedemandeoffredeprixes->nameF), 'id' => 'fournisseur_idd', 'champ' => 'fournisseur_idd', 'name' => '', 'table' => 'lignef']); ?> </div>
                              <div style="margin-top:-50px;margin-left:430px">
                              </div>
                            </td>

                            <td>
                              <?php echo $this->Form->control('a', ['label' => '', "readonly" => true, 'value' => h($lignedemandeoffredeprixes->mail), 'id' => '', 'champ' => 'mail', 'index' => '', 'name' => '', 'table' => 'lignef']); ?>
                              <!-- <span title="ajout paiement"> <a onclick="flvFPW1(wr + 'Fournisseurs/addpaiement', 'UPLOAD', 'width=1100,height=500,scrollbars=yes', 0, 2, 2);return document.MM_returnValue" href="http://localhost:8765/paiements/add"  target='_blank' champ="orderr" value="0" class="btn btn-primary"><i class="fa fa fa-plus"></i></a> </span>      -->
                            </td>
                            <input type="hidden" value="<?php echo $j ?>" id="index1">

                          <?php endforeach ?>
                      </tbody>
                    </table><br>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
      <!-- /.box -->
    </div>
  <?php endif; ?>
</section>
<!--

 Main content 
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa "></i>
          <h3 class="box-title"><?php echo __(''); ?></h3>
        </div>
         /.box-header 
        <div class="box-body">
          <dl class="dl-horizontal">
            <dt scope="row"><?= __('Numero') ?></dt>
            <dd><?= h($demandeoffredeprix->numero) ?></dd>
            
      
            <dt scope="row"><?= __('Date') ?></dt>
            <dd><?= h($demandeoffredeprix->date) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>



  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-share-alt"></i>
          <h3 class="box-title"><?= __('Lignedemandeoffredeprixes') ?></h3>
        </div>
         /.box-header 
        <div class="box-body">
          <?php if (!empty($demandeoffredeprix->lignedemandeoffredeprixes)) : ?>
          <table class="table table-hover">
              <tr>
                  
                   
                    <th scope="col"><?= __('DesigniationA') ?></th>
               
                    <th scope="col"><?= __('NameF') ?></th>
                    <th scope="col"><?= __('Qte') ?></th>
                   
              </tr>
              <?php foreach ($demandeoffredeprix->lignedemandeoffredeprixes as $lignedemandeoffredeprixes) : ?>
              <tr>
                 
                
                    <td><?= h($lignedemandeoffredeprixes->designiationA) ?></td>
                
                    <td><?= h($lignedemandeoffredeprixes->nameF) ?></td>
                    <td><?= h($lignedemandeoffredeprixes->qte) ?></td>
                     
              </tr>
              <?php endforeach; ?>
          </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

</section>-->