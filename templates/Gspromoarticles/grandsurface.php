<?php 
use Cake\Datasource\ConnectionManager;
?>
<?php $this->layout = 'def'; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>

<?php
            $connection = ConnectionManager::get('default');
           // $id=(array)$id;
           $chaine=substr($id,0,-2);
           //debug($chaine);
            $multiid = explode(",", $chaine);
            //debug($multiid);
            foreach($multiid as $k=>$idgs){
             // debug($idgs);
            $ligne= $connection->execute("SELECT * FROM gspromoarticles WHERE  gspromoarticles.id = '".$idgs."';")->fetchAll('assoc');
         
            //debug($ligne);

            
          ?>

<section class="content-header">
  <h1>
    Promo article Grand surface
    <small><?php echo __(''); ?></small>
  </h1>
 
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
       
        <?php echo $this->Form->create($gspromoarticle, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);?>
       
        <div class="box-body">
          <div class="box-body">
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('datedebut', ['value'=>$ligne[0]['datedebut'] ,'label' => 'Date debut', "class" => "form-control", 'type' => 'date', 'disabled' => true]); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('datefin', ['value'=>$ligne[0]['datefin'],'label' => 'Date fin', "class" => "form-control", 'type' => 'date', 'disabled' => true]); ?>
            </div>
            <section class="content">
              <div class="box-body" >
                <table id="tabligne" class="table table-bordered table-striped" >
                  <thead>
                    <tr>
                      <th width="40%" class=" text-center"><?= ('Raison_Sociale') ?></th>
                      <th width="30%" class=" text-center"><button type="button"><i class="fa fa-eye text-red rel"></i></button></th>
                    </tr>
                  </thead>
                  <tbody class='typecli' style="display:none">
                    <?php
                    $c = 1;
                    foreach ($ligne as $c => $i) {
                      $lig= $connection->execute("SELECT * FROM clientgspromoarticles WHERE  clientgspromoarticles.gspromoarticle_id= '".$i['id']."';")->fetchAll('assoc');
                      //debug($lig);
                      foreach($lig as $k=>$l){
                      $social=$connection->execute("SELECT * FROM clients WHERE  clients.id= '".$l['client_id']."';")->fetchAll('assoc');
                     
                     //debug($social);
                    ?>
                      <tr>
                        <td hidden>
                          <?php
                          echo $this->Form->control('supc', ["label" => "", "name" => "data[clientgspromoarticles][$c][supc]", "id" => 'supc' . $c, "index" => $c]);
                          ?>
                        </td>
                        <td hidden><?php echo $this->Form->control($lig[$c]['client_id'], ["value" => $lig[$c]['client_id'], "label" => "", "name" => "data[clientgspromoarticles][$c][client_id]", "id" => 'client_id' . $c, "index" => $c]); ?></td>
                        <td align="center"><?php echo $social[$c]['Raison_Sociale'] ?></td>
                        <td hidden>
                          <input type="checkbox" index="<?php echo $c ?>" id="cli<?php echo $c ?>" name="data[clientgspromoarticles][<?php echo $c ?>][checkk]" champ="checkk" value="0" <?php if ($lig[$k]['checkk'] == 0) { ?> checked <?php } ?>>
                        </td>
                        <td align="center">
                          <input type="checkbox" index="<?php echo $c ?>" id="cli<?php echo $c ?>" name="data[clientgspromoarticles][<?php echo $c ?>][checkk]" champ="checkk" value="1" <?php if ($lig[$k]['checkk'] == 1) { ?> checked <?php } ?> disabled>
                        </td>
                      </tr>
                    <?php }} ?>
                    <input type="hidden" value=<?php echo $c ?> id="index">
                  </tbody>
                </table>
              </div>
            </section>
            <section class="content">
              <div>
                <table class="table table-bordered table-striped table-bottomless" id="tabligne333">
                  <thead>
                    <tr>
                      <th width="45%"><?= ('Article') ?></th>
                      <!-- <th width="30%"><?= ('QTE') ?></th> -->
                      <th width="20%"><?= ('Valeur') ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $p = -1;
                    foreach ($ligne as $p => $i) {
                      $art= $connection->execute("SELECT * FROM lignegspromoarticles WHERE  lignegspromoarticles.gspromoarticle_id= '".$i['id']."';")->fetchAll('assoc');
                    //debug($art);
                    foreach ($art as $r => $t){
                    $a=$connection->execute("SELECT * FROM articles WHERE  articles.id= '".$t['article_id']."';")->fetchAll('assoc');
                     
                     
                    ?>
                      <tr>
                        <td>
                          <?php echo $this->Form->input('id', array('champ' => 'id', "value" => $art[$p]['id'], 'name' => 'data[lignegspromoarticles][' . $p . '][id]', 'table' => 'lignegspromoarticles', 'class' => 'form-control', 'type' => 'hidden')); ?>
                          <?php echo $this->Form->input('supn', array('champ' => 'supn',  'name' => 'data[lignegspromoarticles][' . $p . '][supn]', 'table' => 'lignegspromoarticles', "id" => "supn" . $p, 'index' => $p, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                          <select style="margin-top: 2%;" table="lignegspromoarticles" index champ="article_id" class="form-control " name="data[lignegspromoarticles][<?php echo $p ?>][article_id]" disabled>
                            <option value="<?php echo $a[$c]['id']; ?>"><?php echo $a[$c]['Code'] . ' ' . $a[$c]['Dsignation'] ?></option>
                          </select>
                        </td>
                        <!-- <td align="center">
                          <?php //echo $this->Form->control('qte', ["value" => $art[$p]['qte'], 'name' => 'data[lignegspromoarticles][' . $p . '][qte]', "champ" => "qte", "id" => "qte" . $p, "index" =>  $p, "label" => "", "class" => "form-control aj3", "table" => "lignegspromoarticles", 'readonly']); ?>
                        </td> -->
                        <td align="center">
                          <?php echo $this->Form->control('value', ["value" => $art[$r]['value'], 'name' => 'data[lignegspromoarticles][' . $p . '][value]', "champ" => "value", "id" => "value" . $p, "index" =>  $p, "label" => "", "class" => "form-control aj3", "table" => "lignegspromoarticles", 'readonly']); ?>
                        </td>
                      </tr>
                    <?php } } ?>
                  </tbody>
                </table>
                <input type="hidden" value=0 id="indexx">
              </div>
            </section>
            <?php echo $this->Form->end(); ?>
         
          </div>
        </div>
      </div>
</section>
<?php } ?>


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