<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <div style="margin-bottom:10px" type="submit"><?php echo $this->Html->link(__('retour'), ['action' => 'index'], ['class' => 'btn btn-success ']) ?>
      </div>
    </div>



</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-info"></i>
          <h3 class="box-title"><?php echo __('      Consultation bon de reservation '); ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box">
          <div class="box-header">
          </div>
          <?php echo $this->Form->create($bondereservation, ['role' => 'form']); ?>
          <div class="box-body">
            <div class="row">
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('numero', ["readonly"=>true]); ?>
              </div>
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('depot', ['value' => $bondereservation->depot->name, "readonly"=>true]); ?></div>
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('date', ['class' => 'form-control pull-right', "readonly"=>true,]); ?>
              </div>

              <div class="col-xs-6">
                <?php
                echo $this->Form->control('pointdevente', ['value' => $bondereservation->pointdevente->name, "readonly"=>true]); ?></div>

              <div class="col-xs-6">
                <?php
                echo $this->Form->control('client', ['value' => $bondereservation->client->Contact,"readonly"=>true]); ?></div>



              <div class="col-xs-6">

                <?php echo $this->Form->end(); ?>
                <!-- /.box -->
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="box box-solid">
                <?php if (!empty($lignebondereservationss)) : ?>

                  <div class="box-header with-border">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"> Ligne bon de reservation</h3>
                  </div>
                  <div class="box-body">
                    <table class="table table-bordered table-striped table-bottomless">
                      <tr>
                        <td align="center" nowrap="nowrap"><strong>Article</strong></td>
                        <td align="center" nowrap="nowrap"><strong>Quantité stock</strong></td>
                        <td align="center" nowrap="nowrap"><strong>quantite</strong></td>

                      </tr>
                      <?php foreach ($lignebondereservationss  as $lignebondereservations) : ?>
                        <tr>
                          <td style="width: 30%;" align="center">
                            <?= h($lignebondereservations->article->Dsignation) ?>
                          </td>
                          <td style="width: 30%;" align="center">
                            <?= h($lignebondereservations->quantitéstock) ?>
                          </td>
                          <td style="width: 30%;" align="center">
                            <?= h($lignebondereservations->quantite) ?>
                          </td>


                        </tr>
                      <?php endforeach; ?>
                    </table>
                  </div>
                <?php endif; ?>

              </div>
            </div>
          </div>
        </div>
</section>