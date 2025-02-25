<?php $this->layout = 'AdminLTE.print'; ?>
<br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<div style="display:flex">
  <div style="margin-left:4%">
    <?php
    echo $this->Html->image('m.png', ['alt' => 'CakePHP', 'height' => '140px', 'width' => '200px']); ?>
  </div>
  <div style="margin-left:25%" class="box">
    Société Laboratoires Grenat <br>
    Route de Teboulbi km 5 <br>
    Phone:20182836 <br>
    Mail :contact@laboratoires-grenat.com <br>
  </div>
</div>
<!-- <table width="100%">
  <tr>
    <td width="45%" height="50px">
    </td>
    <td width="55%">
    </td>
  </tr>
  <tr>
    <td colspan="2"><br>
      <hr>
    </td>
  </tr>
  <tr>
    <td width="100%" align="center">
      <span style="font-weight: bold;"> </span>
    </td>
  </tr>
</table> -->

<div class="text-center">
  <h3  style="margin-left:40%">Commande Client</h3>
</div>
<section class="content">
  <div class="row">
    <div class="col-md-12">


      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th>Point de vente</th>
              <th>Depot</th>
              <th>client</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($commandeclients as $commandeclient) : ?>
              <tr>
                <td><?php
                    if (isset($commandeclient->pointdevente)) {
                      echo  h($commandeclient->pointdevente->name);
                    }
                    ?></td>
                <td><?php
                    if (isset($commandeclient->depot)) {
                      echo  h($commandeclient->depot->name);
                    }
                    ?></td>
                <td>
                  <?php if (isset($commandeclient->client)) {
                    echo  h($commandeclient->client->name);
                  } ?></td>
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