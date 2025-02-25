<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<section class="content-header">
  <h1>
    Consultation remise client
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
            <!-- <div class="col-xs-6">
              <?php
              //echo $this->Form->control('code', ['value' => 1, 'label' => 'Code', 'required' => 'off', 'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'readonly' => 'readonly']);
              ?>
            </div> -->
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('typeclient_id', ['options' => $typeclients,'disabled'=>'true' , 'class'=>'form-control select2']);
              ?>
            </div>
            <section class="content" style="width: 99%">
              <div>
                <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                  <thead>
                    <tr>
                      <th><?= ('Montant  MIN') ?></th>
                      <th><?= ('Montant  MAX') ?></th>
                      <th><?= ('Remise %') ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = -1;
                    foreach ($ligneremiseclients as $i => $ligneremiseclient) :
                    ?>
                      <tr>
                        <td style="width: 30%;" align="center">
                          <?php echo $this->Form->control('min', ["value" => $ligneremiseclient->min, 'name' => 'data[ligneremiseclients][' . $i . '][min]', "champ" => "min", "id" => "min" . $i, "index" =>  $i, "label" => "", "class" => "form-control aj3", "table" => "ligneremiseclients",'readonly']); ?>
                          <?php echo $this->Form->input('sup', array('champ' => 'sup', 'table' => 'ligneremiseclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control','readonly')); ?>
                        </td>
                        <td style="width: 30%;" align="center">
                          <?php echo $this->Form->control('max', ["value" => $ligneremiseclient->max, 'name' => 'data[ligneremiseclients][' . $i . '][max]', "champ" => "max", "id" => "max" . $i, "index" =>  $i, "label" => "", "class" => "form-control aj3", "table" => "ligneremiseclients",'readonly']); ?>
                        </td>
                        <td style="width: 30%;" align="center">
                          <?php echo $this->Form->control('remise', ["value" => $ligneremiseclient->remise, "placeholder" => "99.99", 'name' => 'data[ligneremiseclients][' . $i . '][remise]', "champ" => "remise", "id" => "remise" . $i, "index" =>  $i, "label" => "", "class" => "form-control aj3", "table" => "ligneremiseclients",'readonly']); ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    
                  </tbody>
                </table>
                <input type="hidden" value="<?php echo $i ?>" id="in">
              </div>
            </section>
            <?php echo $this->Form->end(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php echo $this->Html->script('alert'); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(".aj33").on("mouseover", function() {
    index = $(this).attr("index"); //alert(index)
    if (index > 0) {
      i = Number(index - 1); //alert(i);
      qte = Number($("#max" + i).val());
      // q = qte + 1;
      q = qte;
      $("#min" + index).val(q);
    }
  });
</script>

<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>

<script>
  $('.select2').select2({

  })
</script>
<?php $this->end(); ?>
