<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
  <h1>
    Tarif
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box ">
        <?php echo $this->Form->create($tarif, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('typeclient_id', ['options' => $typeclients, 'empty' => 'Veuillez choisir !!', 'readonly']);
            ?>
          </div>
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th><?= ('Designiation') ?></th>
                  <th><?= ('Code') ?></th>
                  <th><?= ('Prix') ?></th>
                </tr>
              </thead>
              <tbody>

                <?php
                foreach ($articles as $article) :
                ?>
                  <tr>
                    <td hidden><?php echo $this->Form->control($article->id, ["value" => $article->id]); ?></td>
                    <td><?php echo $article->Dsignation ?></td>
                    <td><?php echo $article->Code ?></td>
                    <td><?php
                        echo $this->Form->control('prix', ['readonly', 'label' => '']);
                        ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <?php echo $this->Form->end(); ?>
        </div>
      </div>
    </div>
</section> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
  <h1>
    Tarifs
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
      <div class="box ">
        <?php echo $this->Form->create($tarif, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="col-xs-6">
            <?php

            echo $this->Form->control('date', ['type' => 'hidden', 'value' => date('Y-d-m H:i:s')]);
            echo $this->Form->control('typeclient_id', ['options' => $typeclients, 'empty' => 'Veuillez choisir !!', 'label' => 'Type Client']);
            ?>
          </div>
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th><?= ('Code') ?></th>
                  <th><?= ('Designiation') ?></th>
                  <th><?= ('Prix') ?></th>
                  <th><?= ('Tarif Client') ?></th>
                  <th><?= ('') ?></th>
                </tr>
              </thead>
              <tbody>

                <?php
                //debug($articles);die;
                foreach ($tarifclients as $i => $tarifclient) :
                  //  debug($tarifclient->article_id);die;
                ?>
                  <tr>
                    
                      <?php
                      echo $this->Form->control('sup0', ["label" => "", "name" => "data[tarifclients][$i][sup0]", "id" => 'sup0' . $i, "index" => $i, "type"=>"hidden"]); ?>
                      <?php
                      echo $this->Form->control('article_id', ["value" => $tarifclient->article_id, "label" => "", "name" => "data[tarifclients][$i][article_id]", "id" => 'article_id' . $i, "index" => $i, "type"=>"hidden"]); ?>
                    
                    <td><?php echo $tarifclient->article->Code ?></td>
                    <td><?php echo $tarifclient->article->Dsignation ?></td>
                    <td><?php echo $tarifclient->article->Prix_LastInput ?></td>
                    <td>
                      <?php
                      echo $this->Form->control('prix', ["value" => $tarifclient->prix, "label" => "", "name" => "data[tarifclients][$i][prix]", "id" => 'prix' . $i, "index" => $i]); ?>
                    </td>
                    <td align="center">
                      <i index="<?php echo $i ?>" id="" class="fa fa-times supLigne" style="color: #c9302c;font-size: 22px;"></i>
                    </td>
                  <?php endforeach; ?>
                  </tr>
                  <input type="hidden" value=<?php echo $i ?> id="index">
              </tbody>
            </table>
          </div>
          <button type="submit" class="pull-right btn btn-success btn-sm" id="pvr" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
</section>