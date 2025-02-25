<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Remiseescompte $remiseescompte
 */
?>

<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
  <h1>
  Remise/Escompte
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>
<br />
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box">

        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($remiseescompte, [
          'role' => 'form', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"
        ]); ?>
        <div class="box-body">
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('typeclient_id', ['id' => 'typeclient_id', 'disabled'=>true,'options' => $typeclient,  'label' => 'Type client ', 'class' => 'form-control ff select2']);
          ?>
        </div>
          
          <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
            <thead>
              <tr>
                <th><?= ('Montant MIN') ?></th>
                <th><?= ('Montant MAX') ?></th>
                <th><?= ('Pourcentage') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = -1;
              foreach ($remiseqtes as $i => $remiseqte) :
              ?>
                <tr>
                  <td style="width: 30%;" align="center">
                    <?php echo $this->Form->control('qtemin', ["value" => $remiseqte->qtemin,'readonly'=>'readonly','name' => 'data[remiseqtes1][' . $i . '][qtemin]', "champ" => "qtemin", "id" => "qtemin" . $i, "index" =>  $i, "label" => "", "class" => "form-control aj3", "table" => "remiseqtes1"]); ?>
                   </td>
                  <td style="width: 30%;" align="center">
                    <?php echo $this->Form->control('qtemax', ["value" => $remiseqte->qtemax,'readonly'=>'readonly','name' => 'data[remiseqtes1][' . $i . '][qtemax]', "champ" => "qtemax", "id" => "qtemax" . $i, "index" =>  $i, "label" => "", "class" => "form-control aj3", "table" => "remiseqtes1"]); ?>
                  </td>
                  <td style="width: 30%;" align="center">
                    <?php echo $this->Form->control('pourcentage', ["value" => $remiseqte->pourcentage, 'readonly'=>'readonly',"placeholder" => "99.99", 'name' => 'data[remiseqtes1][' . $i . '][pourcentage]', "champ" => "pourcentage", "id" => "pourcentage" . $i, "index" =>  $i, "label" => "", "class" => "form-control aj3", "table" => "remiseqtes1"]); ?>
                  </td>
                  
                </tr>
              <?php endforeach; ?>
             
            </tbody>
          </table>
          <input type="hidden" value="<?php echo $i ?>" id="in">
          <br><br>
         
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box-body -->


      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>
<?php echo $this->Html->script('alert'); ?>

