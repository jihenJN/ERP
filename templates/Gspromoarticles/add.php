<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->css('select2'); ?>
<section class="content-header">
  <h1>
    Promo article Grand surface
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <?php echo $this->Form->create($gspromoarticle, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="box-body">
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('datedebut', ['label' => 'Date debut', "class" => "form-control", 'type' => 'date']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('datefin', ['label' => 'Date fin', "class" => "form-control", 'type' => 'date']); ?>
            </div>
            <div class="col-xs-6" >
                <?php echo $this->Form->control('remarque', ['label' => 'Remarque', 'class' => 'form-control ']); ?>
            </div>
           <section class="content">
              <div class="box-body">
                <table id="tabligne" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="40%" class=" text-center"><?= ('Raison sociale') ?></th>
                      <th width="30%" class=" text-center"><button type="button"><i class="fa fa-eye text-red rel"></i></button></th>
                    </tr>
                  </thead>
                  <tbody class='typecli' style="display:none">

                    <?php
                    //debug($clients);die;
                    foreach ($clients as $c => $client) :
                    ?>
                      <tr>
                        <td hidden>
                          <?php
                          echo $this->Form->control('supc', ["label" => "", "name" => "data[clientgspromoarticles][$c][supc]", "id" => 'supc' . $c, "index" => $c]);
                          ?>
                        </td>
                        <td hidden><?php echo $this->Form->control($client->id, ["value" => $client->id, "label" => "", "name" => "data[clientgspromoarticles][$c][client_id]", "id" => 'client_id' . $c, "index" => $c]); ?></td>
                        <td align="left"><?php echo $client->Code ?> <?php echo $client->Raison_Sociale ?></td>
                        <td align="center">
                          <?php
                          echo $this->Form->control('checkk', ["label" => "", "name" => "data[clientgspromoarticles][$c][checkk]", "id" => 'cli' . $c, "index" => $c, "value" => "1", "type" => "checkbox"]);
                          ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    <input type="hidden" value=<?php echo $c ?> id="index">
                  </tbody>
                </table>
              </div>
            </section>
            <section class="content">
              <div>
                <a class="btn btn-primary aj33 " data-toggle="modal" data-target="#modal-default" table='addtable' index='index' id='ajouter_gspromo' style="
               margin-bottom: 20px;
               margin-top: 50px;
               margin-left: 83%;
               ">
                  <i class="fa fa-plus-circle "></i> Ajouter Article promo</a>
                <table class="table table-bordered table-striped table-bottomless" id="tabligne333">
                  <thead>
                    <tr>
                      <th width="45%"><?= ('Article') ?></th>
                      <th width="20%"><?= ('Valeur') ?></th>
                      <th width="5%"><?= ('') ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="tr" >
                      <td align="center">
                        <input type="hidden" name="" id="" champ="supn" table="lignegspromoarticles" index="" class="form-control">
                        <select table="lignegspromoarticles" index champ="article_id" class="form-control" id="">
                          <option value="" selected="selected">Veuillez choisir !!</option>
                          <?php foreach ($articles as $id => $article) {
                          ?>
                            <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td align="center" hidden>
                        <input table="lignegspromoarticles" type="text" class="form-control " index="" name="" id="" champ="qte">
                      </td>
                      <td align="center">
                        <input table="lignegspromoarticles" type="text" class="form-control " index="" name="" id="" champ="value">
                      </td>
                      <td align="center">
                        <i index="" id="supn" class="fa fa-times suppromo" style="color: #c9302c;font-size: 22px;"></i>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" value=0 id="indexx">
              </div>
            </section>
            <button type="submit" class="pull-right btn btn-success " id="pourr" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
           
            <?php echo $this->Form->end(); ?>
          </div>
        </div>
      </div>
</section>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {
    $('.select2').select2()
    //alert('m')
  });
</script>
<?php $this->end(); ?>