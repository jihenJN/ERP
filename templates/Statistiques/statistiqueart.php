<!-- Content Header (Page header) -->
<!--  <section class="content-header">
      <h1>
        ChartJS
        <small>Preview sample</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Charts</a></li>
        <li class="active">ChartJS</li>
      </ol>
    </section>
 -->
<!-- Main content -->




<?php echo $this->Html->css('select2');
?>

<?php

use Cake\Datasource\ConnectionManager;

$connection = ConnectionManager::get('default'); ?>
<script type="text/javascript" src="js/Chart.min.js"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<section class="content" style="width: 99%">
  <div class="box">
    <div class="box-header">
    </div>

    <div class="box-body">

      <?php        //echo $datedebut;
      echo $this->Form->create($factureclients, ['type' => 'get']); ?>
      <div class="row">


        <div class="row">
          <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

            <div class="col-xs-6">
              <?php

              echo $this->Form->control('datedebut', array('required' => 'off', 'label' => 'Date début', 'value' => $datedebut, 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
              ?>
            </div>


            <div class="col-xs-6">
              <?php
              echo $this->Form->control('datefin', array('required' => 'off', 'label' => 'Date fin', 'value' => $datefin, 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
              ?>

            </div>

          </div>
        </div>
        <div class="row">
          <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">



            <div class="col-xs-6">
              <div class="form-group input select required">

                <label class="control-label" for="depot-id">Articles</label>

                <select name="article_id" id="article_id" class="form-control select2 control-label ">
                  <option value="" selected="selected">Veuillez choisir !!</option>

                  <?php foreach ($articles as $id => $articlee) {
                  ?>
                    <option value="<?php echo $articlee->id; ?>" <?php if ($this->request->getQuery('article_id') == $articlee->id) { ?> selected <?php } ?>>
                      <?php echo $articlee->Code . ' ' . $articlee->Dsignation ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <?php $listemois = ['Veuillez choisir !!', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
            $listeannees = [0 => 'Veuillez choisir !!', 2023 => '2023', 2024 => '2024', 2025 => '2025', 2026 => '2026', 2027 => '2027', 2028 => '2028', 2029 => '2029', 2030 => '2030']

            ?>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('annee', ['label' => 'Année', 'options' => $listeannees, 'class' => 'form-control select2', 'required' => 'off', 'value' => $this->request->getQuery('annee')]); ?>
            </div>
          </div>
        </div>
      </div>


      <div style="text-align:center">
        <button type="submit" class="btn btn-primary ">Afficher</button>
        <a href="<?php echo $this->Url->build(['action' => 'statistiqueart']); ?>" class="btn btn-primary"> Afficher tous</a>
        <!-- <a onclick="openWindow(1000, 1000, '/ERP/statistiques/imprimestatistiqueartclient?datedebut=<?php echo @$datedebut; ?>&datefin=<?php echo @$datefin; ?>&client_id=<?php echo @$this->request->getQuery('client_id'); ?>&article_id=<?php echo @$this->request->getQuery('article_id'); ?>')"
                    class="btn btn-primary">Imprimer</a> -->
      </div>
      <?php echo $this->Form->end(); ?>
    </div>
  </div>


</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Statistique Par Article</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body" style="height:500px;overflow: auto;">
          <table id="example1" class="table table-bordered table-striped">
            <thead style='background-color: #3c8dbc; color: white;'>
              <tr>
                <th>Article</th>
                <th width="19%" align="center">Quantité</th>
                <th width="25%" align="center">CA HT</th>
                <th width="25%" align="center">CA TTC</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($tabs as $i => $art) : ?>
                <tr  style="font-size: 14px;">
                  <td align="center"><?php echo $art['nom']; ?></td>
                  <td align="center"><?php echo $art['qte']; ?></td>
                  <td align="center"><?php echo $art['prixht']; ?></td>
                  <td align="center"><?php echo $art['ttc']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tr  style="font-size: 14px;">
              <td colspan="3" align="center" style='background-color: #3c8dbc; color: white;'><strong>Total Qte</strong></td>

              <td align="center"><strong><?php echo $totalqte; ?></strong></td>
            </tr>
            <tr  style="font-size: 14px;">
              <td colspan="3" align="center" style='background-color: #3c8dbc; color: white;'><strong>Total HT</strong></td>

              <td align="center"><strong><?php echo $totalht; ?></strong></td>
            </tr>
            <tr  style="font-size: 14px;">
              <td colspan="3" align="center" style='background-color: #3c8dbc; color: white;'><strong>Total TTC</strong></td>

              <td align="center"><strong><?php echo $totalttc; ?></strong></td>
            </tr>

          </table>



        </div>
        <!-- /.box-body -->
      </div>
      <!-- LINE CHART -->

      <!-- /.box -->

      <!-- BAR CHART -->

      <!-- /.box -->

    </div>
  </div>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Statistique Par Article</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body" style="overflow: auto;">
          <div id="chartContainer" class="inverted-labels" style="height: 370px; overflow: auto;"></div>


        </div>
        <!-- /.box-body -->
      </div>
      <!-- LINE CHART -->

      <!-- /.box -->

      <!-- BAR CHART -->

      <!-- /.box -->

    </div>

  </div>
  <?php
  $dataPoints = array();

  foreach ($tabs1 as $key => $article) {
      $dataPoints[] = array("label" => $article['nom'], "y" => $article['qte']);
  }
  
  // var_dump($dataPoints);


  ?>
  <!-- /.row -->
  <?php


  ?>
</section>
<script>
  function openWindow(h, w, url) {
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
  }
</script>
<script>
  window.onload = function() {
    var chart1 = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      theme: "light2", // "light1", "light2", "dark1", "dark2"
      title: {
        text: ""
      },
      axisY: {
        title: "Quantité Article"
      },
      data: [{
        type: "column",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
      }]
    });
    chart1.render();
  }
</script>
<!-- /.content -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/chart.js/Chart', ['block' => 'script']); ?>

<?php $this->start('scriptBottom'); ?>
<!-- page script -->
<script>
  $('.select2').select2()

</script>
<style type="text/css">
  .canvasjs-chart-credit {
    display: none;
  }

  /* .inverted-labels {
    display: flex;
    flex-direction: row-reverse;
} */
</style>
<?php $this->end(); ?>
