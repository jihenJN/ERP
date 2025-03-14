<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->css('select2'); ?>

<section class="content-header">
  <header>
    <h1 style="text-align:center;"> Commission Commercial
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
          echo $this->Form->control('commercial_id', ['class' => ' form-control select2 ', 'label' => 'Commercial', 'value' => $this->request->getQuery('commercial_id'), 'empty' => 'Veuillez choisir !!', 'autocomplete' => 'off', "required" => "on"]); ?>
        </div>
        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
          <button type="submit" class="btn btn-primary btn-sm rel">Afficher</button>
          <?php if ($this->request->getQuery('commercial_id')) { ?>
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
              <tr style="background-color: #ccc;">
                <th width="10%" class=" text-center"><?= ('Date') ?></th>
                <th width="52%" class=" text-center"><?= ('Client') ?></th>
                <th width="10%" class=" text-center"><?= ('Total point') ?></th>
                <th width="10%" class=" text-center"><?= ('Débit') ?></th>
                <th width="10%" class=" text-center"><?= ('Crédit') ?></th>
                <th width="5%" class=" text-center"><?= ('') ?></th>


              </tr>
            </thead>
            <tbody>
             
              <?php
              $tot = 0;
              $totcr = 0;
              $tots = 0;
              $totdebM = 0;
              $totcredM = 0;

              if ($dat) {
                foreach ($dat as $k => $v) {
                  $avis[$k] = $v['date'];
                }
                array_multisort($avis, SORT_ASC, $dat);
                // debug($dat);die;

                foreach ($dat as $i => $relefe) :

                //  $tot = $tot + $relefe['debit'];
                
                  if (@$relefe['debitM'] == "0.000" || @$relefe['debitM'] == null) {
                       $tot = $tot - $relefe['debit'];
                  }
                    if (@$relefe['creditM'] == "0.000" || @$relefe['creditM'] == null) {
                       $tot = $tot + $relefe['debit'];
                    }
                      $totcr = $totcr + $relefe['credit'];
                  $tots = ($tot - $totcr) + $solde;
                  $totdebM = $totdebM + $relefe['debitM'];
                  $totcredM = $totcredM + $relefe['creditM'];


              ?>
                  <tr style="background-color:#d9dedd;">
                    <td align="center"><?php echo date("d/m/Y", strtotime(str_replace('-', '/', @$relefe['date']))); ?></td>
                    <td align="center"><?php echo @$relefe['type']; ?>
                      <?php if (@$relefe['ty'] != "") { ?>
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
                    
                    <td>
                    <?php if (@$relefe['debitM'] == "0.000" || @$relefe['debitM'] == null) {
                            echo '';
                          } else {
                              if (@$rel['nouv_client'] == "TRUE"){
                                  @$relefe['debitM']=@$relefe['debitM']*2;
                              }
                            echo (@$relefe['debitM']);
                          } ?>
                    </td>

                    <td>
                    <?php if (@$relefe['creditM'] == "0.000" || @$relefe['creditM'] == null) {
                                echo '';
                              } else {
                                echo (@$relefe['creditM']);
                              } ?>

                    </td>

                    <td><button class='btn btn-xs btn-success affichereg' index="<?php echo $i; ?>"><i class='fa fa-eye'></i></button></td>

                  </tr>
                  <tr class='montreg' style="display: none !important" id="montreg<?php echo $i; ?>">
                    <td colspan="4" width="100%">
                      <table align="center" class="table table-bordered table-striped table-bottomless">
                        <thead>
                          <tr>
                            <th>Article</th>
                            <th>Quantité</th>
                            <th>Nb points</th>
                            <th>Total nb points</th>
                          </tr>
                        </thead>
                        <?php
                        foreach ($dat[$i]['ligne'] as $j => $rel) :
                          // debug($rel) ; die ;
                        ?>
                          <tr>
                            <td width="60%">
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
                                Bonus/Malus <?php echo @$rel['num']; ?><br><?php echo @$rel['art']; ?>
                              <?php  } ?>
                            </td>
                            <td>
                              <?php echo @$rel['qte']; ?>

                            </td>
                            <td>
                              <?php echo @$rel['nbpoint']; ?>

                            </td>
                            <td>
                              <?php
                              $comligne = 0;
                              if (@$rel['nouv_client'] == "TRUE") {
                                $comligne =  @$rel['nbpoint'] * @$rel['qte'] * 2;
                              } else {
                                $comligne =   @$rel['nbpoint'] * @$rel['qte'];
                              }

                              echo  $comligne;
                              ?>

                            </td>
                            <!-- <td   ><?php echo @$rel['montantcommissions']; ?><?php echo @$rel['montantss']; ?><?php echo @$rel['montants']; ?></td> -->
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
                <td colspan="2" align="center"><b> Total </b></td>
                <td align="center"> <?php echo number_format(@$tot, 3, '.', ' '); ?></td>
                <td align="center"> <?php echo number_format(@$totdebM, 3, '.', ' '); ?></td>
                <td align="center"> <?php echo number_format(@$totcredM, 3, '.', ' '); ?></td>

              </tr>
              <tr>
                <td colspan="2" align="center"><b> Total</b></td>
                <td colspan="2" align="center"> <?php echo number_format(@$totdebM-@$totcredM, 3, '.', ' '); ?></td>
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