
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('salma'); ?>
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_commercialmenus' . $abrv);
//debug($lien);die;
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'bonusmalus') {
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  //debug($liens);die;
}

if ($add == 1) { ?>
  <div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['controller'=>'Commercials' ,'action' => 'bonusmaluscommercial'], ['class' => 'btn btn-success btn-sm']) ?>
  </div>
<?php  } ?>
<br> <br><br>

<section class="content-header">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
    <h1>
        Recherche
    </h1>
</section>
<section class="content" style="width: 99%" style="background-color: white ;">
    <div class="box">
        <div class="box-body">
            <div class="row">

                <?php echo $this->Form->create($bonusmaluscommercials, ['type' => 'get']); ?>







                <div class="col-xs-6">
                    <?php echo $this->Form->control('commercial_id', ['class' => 'form-control select2 control-label', 'label' => 'Commercial', 'value' => $this->request->getQuery('commercial_id'), 'empty' => 'Veuillez choisir !!', 'required' => 'off']); ?>
                </div>



                <div class="pull-right" style="margin-right:44%;margin-top: 20px;">
                    <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
                    <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
                    <!--          <a onclick="openWindow(1000, 1000, 'http://localhost:8765/commandes/imprimerrecherche?commercial_id=<?= $commercial_id ?>&client_id=<?= $client_id ?>&numero=<?= $numero ?>');"><button class="btn btn-primary btn-sm">Imprimer Recherche</button></a>-->
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>

<section class="content-header">
    <h1>
        Bonus malus commercial
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="20%" align="center"><?= ('Date début') ?></th>
                                <th width="20%" align="center"><?= ('Date fin') ?></th>


                                <th width="20%" align="center"><?= ('Commercial') ?></th>
                                <th width="20%" align="center"><?= ('Total') ?></th>




                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($bonusmaluscommercials as $i => $bonusmalus) : //debug($commande->date) 
                                ?>
                                <tr>

                                    <td><?=
                                        $this->Time->format(
                                                $bonusmalus->datedebut,
                                                'd/MM/y'
                                        );
                                        ?></td>
                                    <td><?=
                                        $this->Time->format(
                                                $bonusmalus->datefin,
                                                'd/MM/y'
                                        );
                                        ?></td>


                                    <td> <?php echo $bonusmalus->commercial->name ?></td>
                                    <td> <?php echo $bonusmalus->total ?></td>


                                    <td>


                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $bonusmalus->id), array('escape' => false)); ?>
                                        <?php //echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $bonusmalus->id), array('escape' => false)); ?>


                                        <?php if ($delete == 1) {
                                        echo $this->Form->postLink("<button class='deleteConfirm btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $bonusmalus->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # %s?', $bonusmalus->id));
                                         } ?>
                                    </td>



                                </tr>




                            <?php endforeach;
                            ?>

                        </tbody>


                    </table>





                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>

<!-- DataTables -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
    $('.select2').select2()
</script>
<?php $this->end(); ?>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>