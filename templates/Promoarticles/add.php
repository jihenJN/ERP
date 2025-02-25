<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
  <h1>
    Promo article
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
        <?php echo $this->Form->create($promoarticle, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="box-body">
            <div class="col-xs-7">
              <?php
              echo $this->Form->control('typeclient_id', ['label' => 'Type client', 'id' => 'type', "class" => "form-control select2", 'empty' => 'Veuillez choisir !!', 'option' => $typeclients]); ?>
            </div>
            <div class="col-xs-6" style="margin-bottom: 10px;">
              <input style="margin-left: 10%;" type="radio" id="gouv" class="gouven" name="gouv" checked value=0>&nbsp;&nbsp; Tout Gouvernorat
              <input style="margin-left: 10%;" type="radio" id="gouv1" class="gouven" name="gouv" value=1>&nbsp;&nbsp; Personnalisé
            </div>
            <div class="col-xs-6" style="margin-bottom: 10px;">
              <input style="margin-left: 10%;" type="radio" id="parnat" class="valeur" name="type" value=0>&nbsp;&nbsp; Par nature
              <input style="margin-left: 10%;" type="radio" id="parval" class="valeur" name="type" value=1>&nbsp;&nbsp; Par valeur
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('datedebut', ['label' => 'Date debut', "class" => "form-control", 'type' => 'date']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('datefin', ['label' => 'Date fin', "class" => "form-control", 'type' => 'date']); ?>
            </div>
           <section class="content" style="display:none;" id="pro">
              <div class="box-body">
                <table id="tabligne" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <!-- <th width="25%" class=" text-center"><?= ('Code') ?></th>
                    <th width="25%" class=" text-center"><?= ('Code postale') ?></th> -->
                      <th width="40%" class=" text-left"><?= ('Gouvernorats') ?></th>
                      <th width="10%" class=" text-center"><button type="button"><i class="fa fa-eye text-red relver"></i></button></th>
                    </tr>
                  </thead>
                  <tbody class='cli' style="display: none;">

                    <?php
                    foreach ($gouvernorats as $i => $gouvernorat) :
                    ?>
                      <tr>
                        <td hidden>
                          <?php
                          echo $this->Form->control('sup', ["label" => "", "name" => "data[gouvpromoarticles][$i][sup]", "id" => 'sup' . $i, "index" => $i]);
                          ?>
                        </td>
                        <td hidden><?php echo $this->Form->control($gouvernorat->id, ["value" => $gouvernorat->id, "label" => "", "name" => "data[gouvpromoarticles][$i][gouvernorat_id]", "id" => 'gouvernorat_id' . $i, "index" => $i]); ?></td>
                        <!-- <td align="center"><?php // echo $gouvernorat->code 
                                                ?></td>
                      <td align="center"><?php // echo $gouvernorat->codepostale 
                                          ?></td> -->
                        <td align="left"><?php echo $gouvernorat->name ?></td>
                        <td align="center">
                          <?php
                          echo $this->Form->control('toutgouv', ["label" => "", "name" => "data[gouvpromoarticles][$i][toutgouv]", "id" => 'art' . $i, "index" => $i, "value" => "1", "checked", "type" => "checkbox"]);
                          ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    <input type="hidden" value=<?php echo $i ?> id="index">
                  </tbody>
                </table>
              </div>
            </section>
            <section class="content"  id="per">
              <div class="box-body">
                <table id="tabligne" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <!-- <th width="25%" class=" text-center"><?= ('Code') ?></th>
                    <th width="25%" class=" text-center"><?= ('Code postale') ?></th> -->
                      <th width="40%" class=" text-center"><?= ('Gouvernorats') ?></th>
                      <th width="10%" class=" text-center"><button type="button"><i class="fa fa-eye text-red relver"></i></button></th>
                    </tr>
                  </thead>
                  <tbody class='cli' style="display: none;">

                    <?php
                    foreach ($gouvernorats as $i => $gouvernorat) :
                    ?>
                      <tr>
                        <td hidden>
                          <?php
                          echo $this->Form->control('sup', ["label" => "", "name" => "data[gouvpromoarticles][$i][sup]", "id" => 'sup' . $i, "index" => $i]);
                          ?>
                        </td>
                        <td hidden><?php echo $this->Form->control($gouvernorat->id, ["value" => $gouvernorat->id, "label" => "", "name" => "data[gouvpromoarticles][$i][gouvernorat_id]", "id" => 'gouvernorat_id' . $i, "index" => $i]); ?></td>
                        <!-- <td align="center"><?php // echo $gouvernorat->code 
                                                ?></td>
                      <td align="center"><?php // echo $gouvernorat->codepostale 
                                          ?></td> -->
                        <td align="center"><?php echo $gouvernorat->name ?></td>
                      </tr>
                    <?php endforeach; ?>
                    <input type="hidden" value=<?php echo $i ?> id="index">
                  </tbody>
                </table>
              </div>
            </section>
            <!-- <section class="content">
              <div class="box-body">
                <table id="tabligne" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="40%" class=" text-center"><?= ('Raison_Sociale') ?></th>
                      <th width="30%" class=" text-center"><button type="button"><i class="fa fa-eye text-red rel"></i></button></th>
                    </tr>
                  </thead>
                  <tbody class='typecli'>

                    <?php
                    foreach ($clients as $c => $client) :
                    ?>
                      <tr>
                        <td hidden>
                          <?php
                          echo $this->Form->control('supc', ["label" => "", "name" => "data[clientpromoarticles][$c][supc]", "id" => 'supc' . $c, "index" => $c]);
                          ?>
                        </td>
                        <td hidden><?php echo $this->Form->control($client->id, ["value" => $client->id, "label" => "", "name" => "data[clientpromoarticles][$c][client_id]", "id" => 'client_id' . $c, "index" => $c]); ?></td>
                        <td align="center"><?php echo $client->Code ?> <?php echo $client->Raison_Sociale ?></td>
                        <td align="center">
                          <?php
                          echo $this->Form->control('checkk', ["label" => "", "name" => "data[clientpromoarticles][$c][checkk]", "id" => 'cli' . $c, "index" => $c, "value" => "1", "checked", "type" => "checkbox"]);
                          ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    <input type="hidden" value=<?php echo $c ?> id="index">
                  </tbody>
                </table>
              </div>
            </section> -->
            <section class="content" style="display:none;" id="valeur">
              <div>
                <a class="btn btn-primary aj33 " data-toggle="modal" data-target="#modal-default" table='addtable' index='index' id='ajouter_ligne3' style="
               margin-bottom: 20px;
               margin-top: 50px;
               margin-left: 89%;
               ">
                  <i class="fa fa-plus-circle "></i> Ajouter Article promo</a>
                <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                  <thead>
                    <tr>
                      <th width="35%"><?= ('Article') ?></th>
                      <th width="20%"><?= ('QTE MIN') ?></th>
                      <th width="20%"><?= ('QTE MAX') ?></th>
                      <th width="20%"><?= ('Valeur') ?></th>
                      <th width="5%"><?= ('') ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="tr" style="display: none !important">
                      <td align="center">
                        <input type="hidden" name="" id="" champ="sup0" table="lignepromoarticles" index="" class="form-control">
                        <select table="lignepromoarticles" index champ="article_id" class="form-control ">
                          <option value="" selected="selected">Veuillez choisir !!</option>
                          <?php foreach ($articles as $id => $article) {
                          ?>
                            <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td align="center">
                        <input table="lignepromoarticles" step="1" type="number" class="form-control " index="" name="" id="" champ="min">
                      </td>
                      <td align="center">
                        <input table="lignepromoarticles" step="1" type="number" class="form-control " index="" name="" id="" champ="max">
                      </td>
                      <td align="center">
                        <input table="lignepromoarticles" type="text" class="form-control " index="" name="" id="" champ="value">
                      </td>
                      <td align="center">
                        <i index="" id="" class="fa fa-times supLignepromo" style="color: #c9302c;font-size: 22px;"></i>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" value=-1 id="in">
              </div>
            </section>
            <section class="content" style="display:none;" id="nature">
              <div>
                <a class="btn btn-primary aj33 " data-toggle="modal" data-target="#modal-default" table='addtable' index='index' id='ajouter_promo' style="
               margin-bottom: 20px;
               margin-top: 50px;
               margin-left: 83%;
               ">
                  <i class="fa fa-plus-circle "></i> Ajouter Article promo</a>
                <table class="table table-bordered table-striped table-bottomless" id="tabligne333">
                  <thead>
                    <tr>
                      <th width="45%"><?= ('Article') ?></th>
                      <th width="30%"><?= ('QTE') ?></th>
                      <th width="20%"><?= ('Valeur') ?></th>
                      <th width="5%"><?= ('') ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="tr" style="display: none !important">
                      <td align="center">
                        <input type="hidden" name="" id="" champ="supn" table="natlignepromoarticles" index="" class="form-control">
                        <select table="natlignepromoarticles" index champ="article_id" class="form-control ">
                          <option value="" selected="selected">Veuillez choisir !!</option>
                          <?php foreach ($articles as $id => $article) {
                          ?>
                            <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td align="center">
                        <input table="natlignepromoarticles" step="1" type="number" class="form-control " index="" name="" id="" champ="qte">
                      </td>
                      <td align="center">
                        <input table="natlignepromoarticles" type="text" class="form-control " index="" name="" id="" champ="value">
                      </td>
                      <td align="center">
                        <i index="" id="" class="fa fa-times suppromo" style="color: #c9302c;font-size: 22px;"></i>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" value=0 id="indexx">
              </div>
            </section>
            <button type="submit" class="pull-right btn btn-success " id="pour" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
           
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
    $('.gouven').on('change', function() {
      m = 0;
      if ($('#gouv1').is(':checked')) {
        m = 1;
      }
      if ($('#gouv').is(':checked')) {
        m = 2;
      }
      //alert(m)
      if (m == 1) {
        $('#pro').attr('style', "display:true;");
        $('#per').attr('style', "display:none;");
      } else {
        $('#pro').attr('style', "display:none;");
        $('#per').attr('style', "display:true;");
      }
      if (m == 2) {
        $('#per').attr('style', "display:true;");
        $('#pro').attr('style', "display:none;");
      } else {
        $('#per').attr('style', "display:none;");
        $('#pro').attr('style', "display:true;");
      }
    });
    $('.valeur').on('change', function() {
      v = 0;
      if ($('#parval').is(':checked')) {
        v = 1;
      }
      if ($('#parnat').is(':checked')) {
        v = 2;
      }
      //alert(m)
      if (v == 1) {
        $('#valeur').attr('style', "display:true;");
        $('#nature').attr('style', "display:none;");
      }
      if (v == 2) {
        $('#valeur').attr('style', "display:none;");
        $('#nature').attr('style', "display:true;");
      }
    });

  });
</script>
<style>
.select2-selection__rendered {
    line-height: 25px !important;
}
.select2-container
.select2-selection--multiple{
    height: auto !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    border-color: #D2D6DE !important;
}
.select2-container
.select2-selection--single{
  height: 35px !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    border-color: #D2D6DE !important;
}
.select2-selection__arrow {
    height: 34px !important;
}
.select2-selection__choice{
  height: 24px !important;
  color: black !important;
  background-color: white !important;
  font-size: 18px !important;
}
.select2-container
{
  display: block;
  width:auto !important;
}
</style>
<?php $this->end(); ?>