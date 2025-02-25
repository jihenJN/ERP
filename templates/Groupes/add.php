<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Groupe $groupe
 */
echo $this->Html->script('tar1');
?>
<?php echo $this->Html->css('select2'); ?>


<section class="content-header">
  <h1>
    Ajouter groupe
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
      <!-- general form elements -->
      <div class="box box-primary">

        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($groupe, ['role' => 'form','onkeypress' => "return event.keyCode!=13",]); ?>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-6">

              <?php
              echo $this->Form->control('client_id', ['options' => $clients, 'empty' => 'Veuillez choisissez !!', 'class' => 'form-control select2']);
              ?>
            </div>
          </div>


          <div class="col-xs-6" style="float:right ;"> <a class="btn btn-primary ajouterligne_man" table="addtable" index="index" style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
              <i class="fa fa-plus-circle "></i> Ajouter ligne</a></div>
          <table class="table table-bordered table-striped table-bottomless" id="addtable">



            <thead>
              <tr width:20px>
                <td align="center" style="width: 25%; font: size 20px;"><strong>Clients</strong></td>


                <td align="center" style="width: 25%;"></td>
              </tr>
            </thead>
            <tbody>
              <tr class="tr" style="display: none ">

                <td align="center" table="ligner">

                  <input type="hidden" id="" champ="supp" name="" table="ligner" index="" class="form-control">
                  <div class="form-group input select">
                    <select table="ligner" champ="personnel_id" name="" id="personnel" class="form-control checkclient " index>
                      <option value=''>Veuillez choisissez !!</option>

                      <?php foreach ($clientsl as $client) :
                      ?>

                        <option value="<?php echo $client->id ?>"><?php echo $client->Raison_Sociale ?></option>

                      <?php endforeach   ?>

                    </select>
                  </div>
                </td>







                <td align="center">
                  <i index id="" class="fa fa-times supLigne0tar" style="color: #c9302c;font-size: 22px;"></i>
                </td>
              </tr>
              <input type="" value="-1" id="index" hidden>
            </tbody>
          </table><br>
          <button type="submit" class="pull-right btn btn-success btn-sm" id="boutoncomm" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

        </div>
        <!-- /.box-body -->


        <?php echo $this->Form->end(); ?>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>

<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>

<script>
  $(document).ready(function() {
    $('.select2').select2()
    $('#client-id').select2({
      width: "100%"
    });

  });
</script>