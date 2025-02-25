<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Commandeclient $commandeclient
 * @var \Cake\Collection\CollectionInterface|string[] $clients
 * @var \Cake\Collection\CollectionInterface|string[] $pointdeventes
 * @var \Cake\Collection\CollectionInterface|string[] $depots
 * @var \Cake\Collection\CollectionInterface|string[] $cartecarburants
 * @var \Cake\Collection\CollectionInterface|string[] $materieltransports
 * @var \Cake\Collection\CollectionInterface|string[] $bonlivraisons
 */
?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
  <h1>
    Commande Client
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>
<section class="content" style="width: 98%">
  <div class="row">
    <div class="box ">
      <div class="panel-body">
        <div class="table-responsive ls-table">

          <?php echo $this->Form->create($commandeclient, ['role' => 'form']); ?>

          <div class="row">
            <div class="panel-body">
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('code',['value' => $code, 'label' => 'Code', 'required' => 'off', 'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'readonly' => 'readonly']); ?>
              </div>
              <div class="col-xs-5">
                <?php
                echo $this->Form->control('client_id', ['options' => $clients, 'empty' => 'Veuillez choisir !!']); ?></div>
                <div class="col-xs-1" style="margin-top: 31px;">
                <a onclick="openWindow(1000, 1000, 'http://localhost:8765/clients/add ');"><i class="fa fa fa-plus" style="color:success;font-size: 25px;"></i></a>
              </div>

              <div class="col-xs-6">
                <?php
                echo $this->Form->control('pointdevente_id', ['options' => $pointdeventes, 'empty' => 'Veuillez choisir !!']); ?>
              </div>
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('numero réference'); ?>
              </div>
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('depot_id', ['options' => $depots, 'empty' => 'Veuillez choisir !!']); ?>
              </div>
              <!-- <div class="col-xs-6">
                  <?php
                  echo $this->Form->control('bonlivraison_id', ['options' => $bonlivraisons, 'empty' => 'Veuillez choisir !!']); ?>
                </div> -->

              <div class="col-xs-6">
                <?php echo $this->Form->control('date', ['empty' => true, 'class' => "form-control pull-right"]);
                ?>
              </div>
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('commentaire'); ?>
              </div>
              <?php echo $this->Form->input('datedecreation', array('label' => false, 'type' => 'hidden', 'placeholder' => '', 'maxlength' => '30', 'class' => 'datepicker', 'required', 'default' => date('Y-m-d H:i:s'))); ?>










              <div class="col-md-12">
                <section class="content-header">
                  <h1 class="box-title"><?php echo __('Ligne commande client'); ?></h1>
                </section>
                <section class="content" style="width: 99%">
                  <div class="row">
                    <div class="box">
                      <div class="box-header with-border">
                        <a class="btn btn-primary  " table='addtable' index='index3' id='ajouter_ligne33' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                          <i class="fa fa-plus-circle "></i> ajouter Ligne commande client</a>

                      </div>
                      <div class="panel-body">
                        <div class="table-responsive ls-table">
                          <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                            <thead>
                              <tr width:20px>
                                <td align="center" nowrap="nowrap"><strong>Article</strong></td>
                                <td align="center" nowrap="nowrap"><strong>Quantité stock</strong></td>
                                <td align="center" nowrap="nowrap"><strong>quantite</strong></td>
                                <td align="center" nowrap="nowrap"><strong>prixht</strong></td>
                                <td align="center" nowrap="nowrap"><strong>Remise</strong></td>
                                <td align="center" nowrap="nowrap"><strong>PUNHT</strong></td>
                                <td align="center" nowrap="nowrap"><strong>Tva</strong></td>
                                <td align="center" nowrap="nowrap"><strong>Fodec</strong></td>
                                <td align="center" nowrap="nowrap"><strong>Ttc</strong></td>

                                <td align="center" nowrap="nowrap"></td>
                              </tr>
                            </thead>
                            <tbody>
                              <tr class="tr" style="display: none !important">
                              
                                <td style="width: 15%;" align="center">

                                  <?php
                                  echo $this->Form->input('sup', array('name' => 'sup', 'id' => '', 'champ' => 'sup', 'table' => 'tabligne3', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden'));
                                  
                                  echo $this->Form->control('article_id', ['options' => $articles, 'empty' => true, 'label' => '', 'table' => 'tabligne3', 'champ' => 'article_id', 'class' => 'form-control select getprixarticle Testdep getprixht single']); ?>
                                </td>
                                <td  style="width: 10%;" align="center">
                                  <input table="tabligne3" type='text' champ='qtestock' class='form-control getprixht getprixarticle' class='input' disabled>
                                </td>
                                <td style="width: 8%;" align="center">
                                  <input table="tabligne3" type='text' champ='qte' class='form-control getprixht ' class='input'>
                                </td>

                                <td style="width: 8%;" align="center">
                                  <input table="tabligne3" type='text' champ='prixht' class='form-control getprixht getprixarticle' class='input'>
                                </td>

                                <td style="width: 8%;" align="center">
                                  <input table="tabligne3" type='text' champ='remise' class='form-control getprixht' class='input'>
                                </td>

                                <td style="width: 8%;" align="center">
                                  <input table="tabligne3" type='text' champ='punht' class='form-control getprixht' class='input'>
                                </td>

                                <td style="width: 10%;" align="center">
                                  <input table="tabligne3" type='text' champ='tva' class='form-control getprixht' class='input'>
                                </td>

                                <td style="width: 12%;" align="center">
                                  <input table="tabligne3" type='text' champ='fodec' class='form-control getprixht' class='input'>
                                </td>
                                <td style="width: 12%;" align="center">
                                  <input table="tabligne3" type='text' champ='ttc' class='form-control getprixht' class='input'>
                                </td>
                                <td style="width: 5%;" align="center"><i class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;"></td>

                              </tr>
                            </tbody>
                          </table><br>
                          <input type="hidden" value=-1 id="index3">
                        </div>
                      </div>
                    </div>
                  </div>

                </section>
              </div>
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('totalht'); ?>
              </div>
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('totaltva'); ?>
              </div>
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('totalfodec'); ?>
              </div>
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('totalremise'); ?>
              </div>
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('totalttc'); ?>
              </div>

            </div>
          </div>

        </div>
        <button type="submit" class="pull-right btn btn-success btn-sm" id="pointv" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
        <?php echo $this->Form->end(); ?>
      </div>

</section>

</div>

</div>

</div>

</div>

</section>

<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<!-- DataTables -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<?php $this->end(); ?>
<script>
  
  function ajouter_ligne(table, index) {
    ind = Number($('#' + index).val()) + 1;

    $ttr = $('#' + table).find('.tr').clone(true);
    $ttr.attr('class', '');
    i = 0;
    tabb = [];
    $ttr.find('input,select,textarea,tr,td,div').each(function() {
      tab = $(this).attr('table'); //alert(tab)
      champ = $(this).attr('champ');
      $(this).attr('index', ind);
      $(this).attr('id', champ + ind);
      $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
      $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
      $type = $(this).attr('type');
      $(this).val('');
      if ($type == 'radio') {
        $(this).attr('name', 'data[' + champ + ']');
        //$(this).attr('value',ind);
        $(this).val(ind);
      }
      if ((champ == 'datedebut') || (champ == 'datefin')) {
        $(this).attr('onblur', 'nbrjour(' + ind + ')')
      }

      $(this).removeClass('anc');
      if ($(this).is('select')) {
        tabb[i] = champ + ind;
        i = Number(i) + 1;
      }
      // $(this).val('');

    })
    $ttr.find('i').each(function() {
      $(this).attr('index', ind);
    });
    $('#' + table).append($ttr);
    $('#' + index).val(ind);
    $('#' + table).find('tr:last').show();
    for (j = 0; j <= i; j++) {
      //  uniform_select(tabb[j]);
    }
    /*$('#datedebut'+ind).datetimepicker({
    timepicker: false,
    datepicker:true,
    mask:'39/19/9999',
    format:'d/m/Y'});
   $('#datefin'+ind).datetimepicker({
    timepicker: false,
    datepicker:true,
    mask:'39/19/9999',
    format:'d/m/Y'});
$('#date'+ind).datetimepicker({
    timepicker: false,
    datepicker:true,
    mask:'39/19/9999',
    format:'d/m/Y'});
           
   */
  }
</script>
<script>
function openWindow(h, w, url) {
  leftOffset = (screen.width/2) - w/2;
  topOffset = (screen.height/2) - h/2;
  window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
}
</script>
