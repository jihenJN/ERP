<section class="content-header">
  <h1>
    Consultation zone delegation

  </h1>

</section>

<!-- Main content -->
<section class="content" style="width: 99%">
  <div class="row">
    <div class="box">
     
      <div class="panel-body">
        <div class="table-responsive ls-table">

        <div class="col-xs-6">
            <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $zonedelegation->numero, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
        </div>

            <div class="col-xs-6">
            <?php echo $this->Form->control('zone', ['readonly' => 'readonly', 'value' => $zonedelegation->zone->name, 'label' => 'Zone', 'required' => 'off']); ?>
            </div>
          <table class="table table-bordered table-striped table-bottomless" id="tabligne6">

            <thead>
              <tr width:20px">
                <td align="center" style="width: 15%;"><strong>Gouvernorat</strong></td>
                <td align="center" style="width: 20%;"> <strong>Delegations</strong> </td>


              </tr>
            </thead>
            <tbody>
              <tr>
                <?php foreach ($gouv as $gv) :
                  //debug($gv) ;
                ?>
                  <td align="center">




                    <input value="<?php echo $gv->gouvernorat->name ?>" readonly class="form-control">


                  </td>

                  <td>
                    <div class="table-responsive ls-table">
                      <table style="width:70%" align="center" class="table table-bordered table-striped table-bottomless">
                        <thead>

                        </thead>
                        <tbody>
                          <?php
                          // echo $ind ;
                        // debug($tab[$gv->gouvernorat_id]); 
                          foreach ($tab[$gv->gouvernorat_id] as $j  => $b) {
                       // debug($b);
                          ?>
                            <tr>
                              <td>

                                <input readonly value="<?php echo $b['deleg'] ?>" index="<?php echo $j ?>" table="delegation" champ="name" name="" table="delegation" id="deleg<?php echo $j ?>" class="form-control">

                              </td>


                            </tr>
                          <?php } ?>
                        </tbody>




                      </table>


                    </div>
                  </td>

              </tr>


              <?php endforeach; ?>


            


            </tbody>
          </table>


        </div>
      </div>
    </div>


  </div>

</section>