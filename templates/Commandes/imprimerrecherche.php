<?php $this->layout = 'AdminLTE.print'; ?>
<br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<div style="display:flex">
    <div style="margin-left:4%">
        <?php
        echo $this->Html->image('mm.png', ['alt' => 'CakePHP', 'height' => '110px', 'width' => '200px']); ?>
    </div>
    <div style="width: 38%;margin-left:23%" class="box" align="center">
        Société CODIFA <br>
        Rte Fouchana 1.8 km 1135 naassen <br>
        Phone : (+216) 71 398 404 / (+216) 71 398 158 <br>
        Mail : codifa@gnet.tn <br>
    </div>
</div>
<div class="text-center">
  <h3 style="margin-left:40%">Commande </h3>
</div>
<section class="content">
  <div class="row">
    <div class="col-md-12">


      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th align="center">N°</th>
              <th align="center">Date</th>
              <th align="center">Client</th>
              <th align="center">Total</th>
              <th align="center">Commercial</th>



            </tr>
          </thead>
          <tbody>
            <?php foreach ($commandes as $commande) : ?>
              <tr>
                
                <td align="center" style="width: 20%;"><?= h($commande->numero) ?></td>
                <td align="center " style="width: 20%;"><?= h($commande->date) ?></td>
                <td>
                  <?php if (isset($commande->client)) {
                    echo  h($commande->client->name);
                  } ?></td>
                  <td align="center" style="width: 20%;"><?= h($commande->total) ?></td>
                <td align="center" style="width: 20%;"><?php
                    if (isset($commande->commercial)) {
                      echo  h($commande->commercial->name);
                    }
                    ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  </div>
  <!-- /.row -->
  </div>

</section>
</div>