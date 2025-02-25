<?php echo $this->Html->css('select2'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
  <h1>
    Ajouter remise client
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <?php echo $this->Form->create($remiseclient, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
      <div class="box ">
        <div class="row">
          <div class="box-body">
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('typeclient_id', ['empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ', 'options' => $typeclients ,'label'=>'Type client']);
              ?>
            </div>
            <div class="col-xs-6" hidden>
              <?php
              echo $this->Form->control('code', ['value' => $code, 'label' => 'Code', 'required' => 'off', 'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'readonly' => 'readonly']);
              ?>
            </div>
            <section class="content" style="width: 99%">
              <div>
                <a class="btn btn-primary aj33 " data-toggle="modal" data-target="#modal-default" table='addtable' index='index' id='ajouter_ligne3' style="
               float: right;
               margin-bottom: 20px;
               ">
                  <i class="fa fa-plus-circle "></i> Ajouter Remise/client</a>
                <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                  <thead>
                    <tr>
                      <th><?= ('Montant  MIN') ?></th>
                      <th><?= ('Montant  MAX') ?></th>
                      <th><?= ('Remise %') ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="tr" style="display: none !important">
                      <td align="center">
                        <input type="hidden" name="" id="" champ="sup" table="ligneremiseclients" index="" class="form-control">
                        <input table="ligneremiseclients" type="text" class="form-control aj33" index="" name="" id="" champ="min">
                      </td>
                      <td align="center">
                        <input table="ligneremiseclients" type="text" class="form-control  aj33" index="" name="" id="" champ="max" value="">
                      </td>
                      <td align="center">
                        <input table="ligneremiseclients" type="text" class="form-control " index="" name="" id="" champ="remise" placeholder="99.99">
                      </td>
                      <td align="center">
                        <i index="" id="" class="fa fa-times supLigne" style="color: #c9302c;font-size: 22px;"></i>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" value=-1 id="in">
              </div>
            </section>
            <button type="submit" class="pull-right btn btn-success btn-sm" id="testde" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
            <?php echo $this->Form->end(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('alert'); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $('.select2').select2()
  $(".aj33").on("mouseover", function() {
    index = $(this).attr("index"); //alert(index)
    if (index > 0) {
      i = Number(index - 1); //alert(i);
      qte = Number($("#max" + i).val());
      q = qte + 1;
      //q = qte;
      $("#min" + index).val(q);
    }
  });
</script>
<?php $this->end(); ?>