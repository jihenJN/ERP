<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->fetch('script'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */

use PhpParser\Lexer\TokenEmulator\ReadonlyTokenEmulator;

?>
<?php echo $this->Html->css('select2'); ?>
<section class="content-header">
  <h1>
    Consultation Ordre de Fabrication
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
        <?php echo __('Retour'); ?></a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <?= $this->Form->create($ordrefabrication) ?>
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
          <div class="row">
            <div class="col-xs-6">
              <?php echo $this->Form->control('numero', ['label' => 'Numero', 'required' => 'off', 'id' => 'numero', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'readonly' => 'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('date', ['disabled' => true, "value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]) ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('pointdevente_id', ['id' => 'pointdevente_id', 'label' => 'site', 'options' => $pointdeventes, 'disabled' => true, 'class' => 'form-control select2 depot', 'readonly' => 'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('depot_id', ['id' => 'depot_id', 'options' => $depots, 'disabled' => true, 'class' => 'form-control select2', 'readonly' => 'readonly']); ?>
            </div>
          </div>




          <div class="panel-body">
            <div class="table-responsive ls-table">
              <table class="table table-bordered table-striped table-bottomless" id="addtable">



                <thead>
                  <tr width:20px>
                    <td align="center" style="width: 40%;"><strong>Article</strong></td>

                    <td align="center" style="width: 20%;"><strong>Quantite</strong></td>
                    <td align="center" style="width: 50%;"><strong>Quantite</strong></td>

                    <td align="center" style="width: 5%;"></td>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach ($lignes as $j => $lp) {
                  ?>
                    <tr>
                    <td>  
                        

                        <input value=" <?php echo $lp['article_id']?>"  type='hidden' champ="article_id" index="<?php echo $j ?>"  table="ligner" name="" class='form-control', readonly>
                        <input value=" <?php echo $lp['article']['Dsignation']?>"   class='form-control', readonly>
                                
                         
                      </td>
                      

                      <td>
                         <input value=" <?php echo $lp['quantite'] ?>" class='form-control' , readonly>

                      </td>
                      <td>
                        <?php foreach ($ligneligneordrefab as $k => $lg) { ?>
                          <table>
                            <thead>

                            </thead>
                            <tbody>
                              <tr bgcolor='#EDEDED'>
                                <td align='center' style='width: 25%;'><strong>Composant 1</strong></td>
                                <td align='center' style='width: 80%;'><strong>QuantitÃ© </strong></td>

                              </tr>
                              <tr>
                                <td align='left'><input readonly value="<?php echo $lg->article->Dsignation ?>" name='data[ligner][".$s."][Ofsfligne][".$i."][article_idm]' index=".$s." indexx=".$i." id='article_id' champ='article_idm' table='Ofsfligne' class='form-control'>

                                </td>
                                <td align='left'><input readonly value="<?php echo $lg->qte ?>" name='data[ligner][".$s."][Ofsfligne][".$i."][qte]' index=".$s." indexx=".$i." id='article_id' champ='article_idm' table='Ofsfligne' class='form-control calculqte'>
                              <tr index='".$i."' align='centre'>
                                <td champ='afef' class='afef' width='30%'></td>
                                <td id='".$i."' colspan='2' indexx='".$i."'>
                                  <table id='addtableaa".$i."' style='width:100%' align='center'>
                                    <thead>
                                      <tr bgcolor='#EDEDED'>
                                        <td align='center'>Composant2</td>
                                        <td align='center'>Quantite</td>


                                      </tr>
                                    </thead>
                                    <?php foreach ($ligneligneordrefab as $p => $ltttttt) { ?>
                                      <table>
                                        <thead>

                                        </thead>
                                        <tbody>

                                          <tr>
                                            <td align='left'><input readonly value="<?php echo $ltttttt->article->Dsignation ?>" name='data[ligner][".$s."][Ofsfligne][".$i."][article_idm]' index=".$s." indexx=".$i." id='article_id' champ='article_idm' table='Ofsfligne' class='form-control'>

                                            </td>
                                            <td align='left'><input readonly value="<?php echo $ltttttt->qte ?>" name='data[ligner][".$s."][Ofsfligne][".$i."][qte]' index=".$s." indexx=".$i." id='article_id' champ='article_idm' table='Ofsfligne' class='form-control calculqte'>
                                          <tr id='traaligne".$i."-".$j."' champ='traaligne'>
                                            <td width='30%'></td>
                                            <td id='afefligne".$i."-".$j."' champ='afefligne' class='afefligne".$i."-".$j."' colspan='3' id='afefligne".$i."-".$j."' indexx='".$i."'>
                                              <table indexx='".$i."' indexligneligne='".$j."' champ='addtableaaligne' id='addtableaaligne".$i."-".$j."' style='width:100%' align='center'>
                                                <thead>
                                                  <tr bgcolor='#EDEDED'>
                                                    <td align='center'>Composant3</td>
                                                    <td align='center'>Qte</td>

                                                  </tr>
                                                </thead>
                                                <?php foreach ($ligneligneligneordrefabsafa as $tt => $ffff) { ?>
                                                  <table>
                                                    <thead>

                                                    </thead>
                                                    <tbody>

                                                      <tr>
                                                        <td align='left'><input readonly value="<?php echo $ffff->article_id ?>" name='data[ligner][".$s."][Ofsfligne][".$i."][article_idm]' index=".$s." indexx=".$i." id='article_id' champ='article_idm' table='Ofsfligne' class='form-control'>

                                                        </td>
                                                        <td align='left'><input readonly value="<?php echo $ffff->qte ?>" name='data[ligner][".$s."][Ofsfligne][".$i."][qte]' index=".$s." indexx=".$i." id='article_id' champ='article_idm' table='Ofsfligne' class='form-control calculqte'>

                                                        </td>

                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                <?php } ?>

                                            </td>

                                          </tr>
                                        </tbody>
                                      </table>
                                    <?php } ?>
                                </td>

                              </tr>

                            </tbody>
                          </table>
                        <?php } ?>
                        <div id="divmp<?php echo $j ?>" index="<?php echo $j ?>"></div>
                      </td>




                </tbody>

              <?php } ?>

              </table>


              <?php echo $this->Form->end(); ?>
            </div>
            <!-- /.box -->
          </div>
        </div>
        <!-- /.row -->
</section>
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
<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
<?php $this->end(); ?>