<div id="histoprojet" style="display:none;margin-top: 18px;">
<?php use Cake\Datasource\ConnectionManager; ?>   

    <section class="content-header">
        <h1 class="box-title">
            <?php echo __(' Historique projet'); ?>
        </h1>
    </section>
    <section class="content" style="width: 99%">
        <div class="row">
            <div class="box">

                <div class="panel-body">
                    <div class="table-responsive ls-table">
                        <table class="table table-bordered table-striped table-bottomless">
                            <thead>
                                <tr width:"20px">
                                    <td hidden align="center" style="width: 10%;"><strong>Utilisateur </strong></td>
                                    <td align="center" style="width: 10%;"><strong>Personnel</strong></td>
                                    <!-- <td align="center" style="width: 10%;"><strong>date de création</strong></td> -->
                                    <td align="center" style="width: 10%;"><strong>date d'opération</strong></td>
                                    <td align="center" style="width: 10%;"><strong>Opération</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                   $connection = ConnectionManager::get('default');
                                foreach ($tracemisejours as $t => $tracemisejour) {
                                    $personnel = $connection->execute('SELECT * FROM personnels WHERE id='.$tracemisejour['user']['personnel_id'].'; ')->fetch('assoc');
                                $operation="";
                                if ($tracemisejour['operation']=='edit'  || $tracemisejour['operation']=='modification') {
                                  $operation="modification";
                                }else if ($tracemisejour['operation']=='add' || $tracemisejour['operation']=='ajout') {
                                    $operation="creation";
                                }
                                else if ($tracemisejour['operation'] == 'duplicate') {
                                    $operation = "duplication";
                                } else{
                                    $operation="suppression";
                                }
                                ?>
                              <tr>
                                <td> 
                                <a href="javascript:void(0);"  onclick="window.open('<?php echo $this->Url->build(['controller' => 'personnels', 'action' => 'detail',$projet->personnel->id]); ?>', '_blank')" 
       class="btn btn-secondary" 
       data-toggle="tooltip" 
       data-html="true" >
       <?php echo $personnel['nom'].' '. $personnel['prenom']?>
    </a>
                                <!-- <a href="../../personnels/view/<?php echo $tracemisejour['user']['personnel_id'] ?>" style="text-decoration: underline;">  <?php echo $personnel['nom'].' '. $personnel['prenom']?></a>   -->
                                  </td>
                                <td><?php echo $tracemisejour['date']->format("Y-m-d").' '.$tracemisejour['heure']?></td>
                                <td><?php echo $operation?></td>
                              </tr>
                              <?php }  ?>
                            </tbody>

                        </table><br>
                        <!-- <div align="center">
                            <button type="submit" class="pull-right btn btn-success btn-sm" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                        </div> -->

                    </div>
                </div>

            </div>
        </div>
    </section>
    

</div>

