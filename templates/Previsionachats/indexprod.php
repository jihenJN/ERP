<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Previsionachat $previsionachat
 */
?>
<?php use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
 ?> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script> 
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->css('select2'); ?>

<?php $connection = ConnectionManager::get('default'); ?>
<section class="content-header">
<header>
    <h1 style="text-align:center;" >Prévision production</h1>
</header>
</section> 
<section class="content" style="width: 99%" style="background-color: white ;">
<?php echo $this->Form->create($listart, ['type' => 'get']);
//debug($listart);
?>

  <div class="box">
    <div class="box-body">
      <div class="row">
        <div class="col-xs-6">
          <label> Du </label>
        <select id="moi-id1"  class="form-control select2 verifMois" name="moi_debut"  value="<?php echo $moi_debut ?>" >
        <option  value="<?php echo  $moi_debut ?>"  selected="selected">Veuillez choisir </option>
               <?php foreach ($mois as $j => $moi) {
                    ?>
                  <option <?php if ($moi->id == $moi_debut) { ?> selected="selected" <?php } ?> value="<?php echo $moi->id; ?>"><?php echo $moi->name ?></option>
                              <?php } ?>
                   
        </select>
        </div>
        <div class="col-xs-6">
          <label> Au </label>
        <select    id="moi-id2" class="form-control select2  verifMois" name="moi_fin"   value="<?php echo $moi_fin ?>" >
                   <option  value="<?php echo  $moi_fin ?>"  selected="selected">Veuillez choisir </option>
               <?php foreach ($mois as $j => $moi) {
                    ?>
                     <option <?php if ($moi->id == $moi_fin) { ?> selected="selected" <?php } ?> value="<?php echo $moi->id; ?>"><?php echo $moi->name ?></option>
                              <?php } ?>
                   
        </select>

        </div>

        

        </div>
<br>
        <div class="row">
        <div class="col-xs-6">
          <label> Article </label>
        <select   class="form-control select2" name="article_id" id="article_id" value='<?php $this->request->getQuery('article_id') ?>'>
                   <option value="" selected="selected">Veuillez choisir </option>
               <?php foreach ($articles as $j => $art) {
                    ?>
                     <option <?php if ($art->id == $article_id) { ?> selected="selected" <?php } ?> value="<?php echo $art->id; ?>"><?php echo $art->Code . ' ' . $art->Dsignation ?></option>
                              <?php } ?>
                   
        </select>
        </div>
 
        <div class="col-xs-6">
        <label> Familles </label>
        <select name="famille_id" id="famille_id" class="form-control select2" value='<?php $this->request->getQuery('famille_id') ?>'>
                   <option value="" selected="selected">Veuillez choisir </option>
               <?php foreach ($famillespf as $id => $fa) {
                    ?>
                     <option <?php if ($fa->id == $famille_id) { ?> selected="selected" <?php } ?> value="<?php echo $fa->id; ?>"><?php echo $fa->Nom ?></option>
                              <?php } ?>
                   
        </select>
        </div>

        </div>
       
        <br>
        
        <div class="row">
        
        <div class="col-xs-6">
        <div id="divsousfam1" class="form-group input text required">
                        <label class="control-label" for="name">Sous famille</label>
                        <select class="form-control select2" name="sousfamille1_id" id="sousfamille1_id" value='<?php $this->request->getQuery('sousfamille1_id') ?>'>
                            <option value="" selected="selected" disabled>Veuillez choisir </option>
                            <?php foreach ($sousfamille1s as $id => $sousfamille) {   
                              ?>
                                <option <?php if($this->request->getQuery('sousfamille1_id')==$id){?> selected="selected"<?php } ?> value="<?php echo $id; ?>"><?php echo $sousfamille ?></option>
                            <?php } ?>
                        </select>
                    </div>
        </div>


        
        <div class="col-xs-6">
        <div id="divsousfam2" class="form-group input text required">
                        <label class="control-label" for="name">Sous sous famille</label>
                        <select class="form-control select2" name="sousfamille2_id" id="sousfamille2_id" value='<?php $this->request->getQuery('sousfamille2_id') ?>'>
                            <option value="" selected="selected" disabled>Veuillez choisir  </option>
                            <?php foreach ($sousfamille2s as $id => $ssousfamille) { ?>
                                <option <?php if($this->request->getQuery('sousfamille2_id')==$id){?> selected="selected"<?php } ?> value="<?php echo $id; ?>"><?php echo $ssousfamille ?></option>
                            <?php } ?>
                        </select>
                    </div>
        </div>
        
        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
          <button type="submit" class="btn btn-primary btn-sm  alertArt   ">Afficher</button>
          <?php if ($listart != null) { ?>
          <a    onclick="openWindow(1000, 1000, 'https://gcip.isofterp.com/gcip/Previsionachats/impprod?moi_debut=<?php echo @$moi_debut; ?>&moi_fin=<?php echo @$moi_fin; ?>&article_id=<?php echo @$article_id; ?>&famille_id=<?php echo @$famille_id; ?>')"><button class="btn btn-primary btn-sm  ">Imprimer</button></a>
          <?php } ?>
          <?php echo $this->Html->link(__('Actualiser'), ['action' => 'indexprod'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
        <?php echo $this->Form->end(); ?>
    
    </div>
</section>
<section class="content-header">
  <h1>
  Articles
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
                  <th   width="20%"   class="actions text-center">  <?php echo('Reference ') ;?></th>
                  <th   width="40%"   class="actions text-center "><?php echo('Designation') ;?></th>
                  <th   width="10%"   class="actions text-center "><?php echo('Qte Théorique') ;?></th>
                  <th   width="10%"   class="actions text-center "><?php echo('Total Besoin') ;?></th>
                  <th   width="20%"   class="actions text-center "><?php echo('Total Besoin Achat') ;?></th>


            </tr>
          </thead>
          <tbody>

          <?php foreach ($listart as $i => $art):
          //debug($art->id) ;
                $time = new FrozenTime('now', 'Africa/Tunis'); 
                $date=$time->i18nFormat('yyyy-MM-dd HH:mm:ss');
       // debug($date);
          $qtebesoin = $connection->execute('SELECT SUM(ligneprevisionachats.qte) as q from ligneprevisionachats where article_id='.$art->id.'  AND   moi_id>='.$moi_debut.'  AND  moi_id <='.$moi_fin.'    ' )->fetchAll('assoc');
          $qtestock = $connection->execute("select stockbassem(" . $art->id . ",'" . $date . "','0','0') as v")->fetchAll('assoc');
        
          $total =  $qtebesoin[0]['q'] -  $qtestock[0]['v'] ; 
       
   
            ?>

                <tr>
                  
                    <td align="center">  
                    <?= h($art->Code) ?>
                    </td>

                    <td align="center">
                    <?= h($art->Dsignation) ?>  
                    </td> 

                    <td align="center">
                    <?= h($qtestock[0]['v']) ?>  
                    </td>

                    <td align="center">
                    <?= h( $qtebesoin[0]['q']) ?>  
                    </td>

                    <td align="center">
                    <?php if (  $total <= 0) {
                            echo '0' ;
                    }  else { 
                      echo $total ; 
                     }
                      ?> 
                    </td>
                    
                    
                     
                </tr>
                <?php endforeach; ?>
          </tbody>
        </table>


       
       
        
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>


<!-- daterange picker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'css']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min', ['block' => 'css']); ?>
<!-- iCheck for checkboxes and radio inputs -->
<?php echo $this->Html->css('AdminLTE./plugins/iCheck/all', ['block' => 'css']); ?>
<!-- Bootstrap Color Picker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min', ['block' => 'css']); ?>
<!-- Bootstrap time Picker -->
<?php echo $this->Html->css('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<!-- InputMask -->
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.extensions', ['block' => 'script']); ?>
<!-- date-range-picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/moment/min/moment.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'script']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min', ['block' => 'script']); ?>
<!-- bootstrap color picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
<!-- bootstrap time picker -->
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>

<?php $this->start('scriptBottom'); ?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })


  $(function() {
    $('#example2').DataTable()
    $('#example1').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': false,
      'info': true,
      'autoWidth': false
    })
  })
</script>


<script>
    //    $(function () {

    //    $('.impprodd').on('click', function () {
    //     moi1_id = $('#moi-id1').val();
    //     moi2_id = $('#moi-id2').val(); 
    //   //  alert(moi1_id);
    //     var tab = new Array;
    //     conteur = $('#conteur').val();
    //     //alert(conteur)
    //     for (var i = 0; i <= conteur; i++) {
          
    //         v = $('#article_id' + i).val();  
    //             tab[i] = v;
    //             //alert(tab[i])
            
    //     }
    //     var removeItem = undefined;
    //     tab = jQuery.grep(tab, function (value) {
    //         return value != removeItem;
    //     });
    // //alert(tab);

    //   window.open("http://localhost/codifa1111/Previsionachats/impprod/" + tab);
     
    //       $.ajax({
    //     method: "GET",
    //     url: "<?= $this->Url->build(['controller' => 'Previsionachats', 'action' => 'impprod']) ?>",
    //     dataType: "json",
    //     data: {
        
    //       moiId1 : moi1_id , 
    //       moiId2 : moi2_id , 

    //     },
    //     headers: {
    //       'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
    //     },
    //     success: function(data) {

        

    //     }

    //   })
    // })


    //     });

 

</script>

<script>
  function openWindow(h, w, url) {
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
  }
</script>

<script>
  $(function() {
$('#famille_id').on('change', function() {
//  alert('hh')
        idfam = $('#famille_id').val();
        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getsousfamille1']) ?>",
            dataType: "json",
            data: {
                idfam: idfam,

            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(data) {
                $('#divsousfam1').html(data.select);
      }


        })

    });
});






function getsousfamille2(param) {

//alert('hello');
id = $('#sous').val();
// alert(id)
$.ajax({
    method: "GET",
    url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getsousf']) ?>",
    dataType: "json",
    data: {
        idfam: id,

    },
    headers: {
        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
    },
    success: function(data) {


      $('#divsousfam2').html(data.select);
       
  

    }

});



}
</script>

<?php $this->end(); ?>