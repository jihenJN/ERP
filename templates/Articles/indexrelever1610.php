<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->css('select2'); ?>

<section class="content-header">
    <header>
        <h1 style="text-align:center;">   Relevé Commercials
</h1>
    </header>
</section>
<section class="content" style="width: 99%" style="background-color: white ;">
  <div class="box">
    <div class="box-body">
      <div class="row">
        <?php echo $this->Form->create($relevercommercials, ['type' => 'get']);

        //        debug($Date_debut);
        //         debug($Date_fin);
        ?>
        <div class="col-xs-6">
          <?php
          echo $this->Form->input('Date_debut', array('value' => @$Date_debut, 'id' => 'Date_debut', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date', "required" => "on"));
          ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->input('Date_fin', array('value' => @$Date_fin, 'id' => 'Date_fin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date', "required" => "on"));
          ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('commercial_id', [  'class'=>' form-control select2 '  , 'label' => 'Commercial', 'value' => $this->request->getQuery('commercial_id'), 'empty' => 'Veuillez choisir !!', 'autocomplete' => 'off', "required" => "on"]); ?>
        </div>
        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
          <button type="submit" class="btn btn-primary btn-sm rel">Afficher</button>
         <?php if($this->request->getQuery('commercial_id')){?>
          <a onclick="openWindow(1000, 1000, 'https://codifaerp.isofterp.com/demo/articles/imprime?Date_debut=<?php echo @$Date_debut; ?>&Date_fin=<?php echo @$Date_fin; ?>&commercial_id=<?php echo @$commercial_id; ?>')"><button class="btn btn-primary btn-sm">Imprimer</button></a>
          <a onclick="openWindow(1000, 1000, 'https://codifaerp.isofterp.com/demo/articles/imprimedet?Date_debut=<?php echo @$Date_debut; ?>&Date_fin=<?php echo @$Date_fin; ?>&commercial_id=<?php echo @$commercial_id; ?>')"><button class="btn btn-primary btn-sm">Imprimer details</button></a>
         <?php } ?>
          <?php echo $this->Html->link(__('Actualiser'), ['action' => '/indexrelever'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
    </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="15%" class=" text-center"><?= ('Date Opération') ?></th>
                <th width="52%" class=" text-center"><?= ('Libele') ?></th>
                <th width="15%" class=" text-center"><?= ('Debit') ?></th>
                <th width="15%" class=" text-center"><?= ('Credit') ?></th>
                <th width="3%" class=" text-center"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="1" align="center"><strong>SOLDE</strong></td>
                <td colspan="3" align="center"><?php echo number_format(@$solde, 3, '.', ' '); ?></td>
              </tr>
              <?php
              $tot = 0;
              $totcr = 0;
              $tots = 0;
              if ($dat) {
                foreach ($dat as $k => $v) {
                  $avis[$k] = $v['date'];
                }
                array_multisort($avis, SORT_ASC, $dat);
                //  debug($dat);die;
                foreach ($dat as $i => $relefe) :
                  $tot = $tot + $relefe['debit'];
                  $totcr = $totcr + $relefe['credit'];
                  $tots = ($tot - $totcr) + $solde;
              ?>
                  <tr>
                    <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/', @$relefe['date']))); ?></td>
                    <td><?php echo @$relefe['type']; ?>
                      <?php if (@$relefe['type'] == "Cloture période du ") { ?>
                        <?php echo date("d/m/Y", strtotime(str_replace('-', '/', @$relefe['datedebut']))); ?>
                        au <?php echo date("d/m/Y", strtotime(str_replace('-', '/', @$relefe['datefin']))); ?>
                      <?php  } ?>
                      N° <?php echo @$relefe['numero']; ?>
                      <?php echo (@$relefe['clients']); ?>
                      <?php
                      foreach ($dat[$i]['ligne'] as $j => $rel) :   $chaine = ''; ?>
                        <?php if (@$rel['nouv_client'] == "TRUE") { ?>
                        <?php $chaine = '(nv_client)';
                        } else {
                          $chaine = '';
                        }
                        ?>
                      <?php endforeach; ?>
                      <?php echo $chaine; ?>
                      <?php echo @$relefe['paiements']; ?>
                    </td>
                    <td> <?php if (@$relefe['debit'] == "0.000") {
                            echo '';
                          } else {
                            echo (@$relefe['debit']);
                          } ?></td>
                    <td> <?php if (@$relefe['credit'] == "0.000") {
                            echo '';
                          } else {
                            echo (@$relefe['credit']);
                          } ?></td>
                    <td><button class='btn btn-xs btn-success affichereg' index="<?php echo $i; ?>"><i class='fa fa-eye'></i></button></td>
                  </tr>
                  <tr align="center" class='montreg' style="display: none !important" id="montreg<?php echo $i; ?>">
                    <td >
                      <table class="table table-bordered table-striped table-bottomless">
                        <?php
                        foreach ($dat[$i]['ligne'] as $j => $rel) :
                          // debug($rel) ; die ;
                        ?>
                          <tr>
                            <td width="40%">
                              <?php if (@$rel['montantss'] > 0) { ?>
                                Bonus article :
                              <?php  } ?>
                              <?php if (@$rel['montantss'] < 0) { ?>
                                Malus article :
                              <?php  } ?>
                              <?php echo @$rel['articles']; ?>
                              <?php if (@$rel['nouv_client'] == "FALSE") { ?>
                                <?php if (@$rel['nouv_article'] == "TRUE") { ?>
                                  (nv_article)
                                <?php  } ?>
                              <?php  } ?>
                              <?php echo @$relefe['articles']; ?>

                              <?php if (@$rel['lignebonlivraison_id'] != 0) { ?>
                                Com BL N° <?php echo @$rel['numero']; ?><br><?php echo @$rel['arti']; ?>
                              <?php  } ?>
                              <?php if (@$rel['lignebonusmalu_id'] != 0) { ?>
                                Bonus/Malus N° <?php echo @$rel['num']; ?><br><?php echo @$rel['art']; ?>
                              <?php  } ?>

                            </td>
                            <td width="40%"><?php echo @$rel['montantcommissions']; ?><?php echo @$rel['montantss']; ?><?php echo @$rel['montants']; ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </table>
                    </td>
                  </tr>
              <?php endforeach;
              } ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2" align="center"><b> Total Debit/Credit</b></td>
                <td align="center"> <?php echo number_format(@$tot, 3, '.', ' '); ?></td>
                <td align="center"> <?php echo number_format(@$totcr, 3, '.', ' '); ?></td>
              </tr>
              <tr>
                <td colspan="2" align="center"><b> Total</b></td>
                <td colspan="2" align="center"> <?php echo number_format(@$tots, 3, '.', ' '); ?></td>
              </tr>
            </tfoot>
          </table>



        </div>
      </div>
    </div>
  </div>
</section>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {
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
</script>
<script>
  $('.select2').select2()
</script>
<?php $this->end(); ?><script>
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