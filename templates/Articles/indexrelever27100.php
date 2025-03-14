<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
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
        <?php echo $this->Form->create($relevercommercials, ['type' => 'get']); ?>
        <div class="col-xs-6">
          <?php
          echo $this->Form->input('Date_debut', array('value' => $this->request->getQuery('Date_debut'), 'id' => 'Date_debut', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date', "required" => "on"));
          ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->input('Date_fin', array('value' => $this->request->getQuery('Date_fin'), 'id' => 'Date_fin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date', "required" => "on"));
          ?>
        </div>
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('commercial_id', ['label' => 'Commercial', 'value' => $this->request->getQuery('commercial_id'), 'empty' => 'Veuillez choisir !!', 'autocomplete' => 'off', "required" => "on"]); ?>
        </div>
        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
          <button type="submit" class="btn btn-primary btn-sm rel">Afficher</button>
          <a onclick="openWindow(1000, 1000, 'http://localhost:8765/relevercommercials/imprime?datedebut=<?php echo @$Date_debut; ?>&datefin=<?php echo @$Date_fin; ?>&commercial_id=<?php echo @$commercial_id; ?>')"><button class="btn btn-primary btn-sm">Imprimer</button></a>
          <?php echo $this->Html->link(__('Actualiser'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
    </div>
</section>
<h1>
  Relevé Commercials
</h1>
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
                    <td colspan="3">Solde Initiale</td>
                     <td colspan="3"><?php echo number_format(@$solde, 3, '.', ' '); ?></td>
                </tr>
              <?php
              $tot = 0;
              $totcr = 0;
              $tots = 0;
              foreach ($dat as $i => $relefe) :
                $tot = $tot + $relefe['debit'];
                $totcr = $totcr + $relefe['credit'];
                $tots = $tot + $totcr;
              ?>
                <tr>
                  <td align="center"><?php echo date("d/m/Y", strtotime(str_replace('-', '/', @$relefe['date']))); ?></td>
                  <td align="center"><?php echo @$relefe['type']; ?> N° <?php echo @$relefe['numero']; ?>
                    <?php echo (@$relefe['clients']); ?>
                    <?php
                    foreach ($dat[$i]['ligne'] as $j => $rel) : ?>
                      <?php if (@$rel['nouv_client'] == "TRUE") { ?>
                        (nouv_client)
                      <?php  } ?>
                    <?php endforeach; ?>
                    <?php echo @$relefe['paiements']; ?>
                  </td>
                  <td align="center"> <?php if (@$relefe['debit'] == "0.000") {
                                        echo '';
                                      } else {
                                        echo (@$relefe['debit']);
                                      } ?></td>
                  <td align="center"> <?php if (@$relefe['credit'] == "0.000") {
                                        echo '';
                                      } else {
                                        echo (@$relefe['credit']);
                                      } ?></td>
                  <td align="center"><button class='btn btn-xs btn-success affichereg' index="<?php echo $i; ?>"><i class='fa fa-eye'></i></button></td>
                </tr>
                <tr align="center" class='montreg' style="display: none !important" id="montreg<?php echo $i; ?>">
                  <td colspan="1"></td>
                  <td colspan="4">
                    <table class="table table-bordered table-striped table-bottomless">
                      <?php
                      foreach ($dat[$i]['ligne'] as $j => $rel) :
                        // debug($rel) ; die ;
                      ?>
                        <tr>
                          <td width="40%" align="center">
                            <?php echo @$rel['articles']; ?>
                            <?php if (@$rel['nouv_article'] == "TRUE") { ?>
                              (nouv_article)
                            <?php  } ?>
                            <?php echo @$relefe['articles']; ?>

                            <?php if (@$rel['lignebonlivraison_id'] != 0) { ?>
                              Com BL <?php echo @$rel['numero']; ?>
                            <?php  } ?>
                            <?php if (@$rel['lignebonusmalu_id'] != 0) { ?>
                              Com Bonus/Malus <?php echo @$rel['numeros']; ?>
                            <?php  } ?>
                          </td>
                          <td width="40%" align="center"><?php echo @$rel['montantcommissions']; ?><?php echo @$rel['montants']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </table>
                  </td>
                </tr>
              <?php endforeach; ?>
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
<?php $this->end(); ?>
<script>
  function openWindow(h, w, url) {
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
  }
</script>