<!-- Content Header (Page header) -->
<?php

use Cake\ORM\TableRegistry;
?>

<?php

use Cake\Datasource\ConnectionManager;


$connection = ConnectionManager::get('default');

?>
<section class="content-header">
  <h1>
    Critères d'acceptation

  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'indexparametre']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">

        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($article, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);




          $info =  $article->Code . ' ' . $article->Dsignation ;
        


        ?>


        <div class="box-body">



          <div class="col-xs-12">
            <?php
            echo $this->Form->control('info', ['label' => 'Article', 'class' => 'form-control ', 'readonly', 'value' => $info]); ?>
          </div>





        </div>
        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">
              <div class="box-header with-border">
                <a class="btn btn-primary al ajouter_ligne_critere" table='addtable' index='index' id='' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                  <i class="fa fa-plus-circle "></i> Ajouter Critére </a>
              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                    <thead>
                      <tr width:"20px">
                        <td align="center" style="width: 30%;"><strong>Critére</strong></td>
                        <td align="center" style="width: 30%;"><strong>Option</strong></td>
                        <td align="center" style="width: 10%;"></td>

                      </tr>
                    </thead>
                    <tbody>
                      <tr class="tr" style="display: none !important">
                        <td align="center" table="ligner">
                          <label></label>
                          <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control">



                          <?php
                          echo $this->Form->control('critere_id', array('class' => ' form-control critere', 'type' => '', 'empty' => 'Veuillez choisir !!',  'label' => false, 'index' => '', 'champ' => 'critere_id', 'table' => 'ligner', 'name' => ''));
                          ?>


                        </td>

                        <td align="center" table="ligner">
                          <br>
                          <div champ="selectligne" table="ligner">
                          </div>
                        </td>


                        <td align="center">
                          <br>
                          <i index="0" id="" class="fa fa-times supLigneinv" style="color: #c9302c;font-size: 22px;"></i>
                        </td>
                      </tr>
                      <?php
                      $i = -1;

                      foreach ($lignes as $i => $li) :

                        $lignecriteresTable  = TableRegistry::getTableLocator()->get('Lignecriteres');
                        $lignecriteres = $lignecriteresTable->find('list', ['keyfield' => 'id', 'valueField' => 'description'])->where('critere_id=' . $li->critere_id);
                      ?>
                        <tr>
                          <td align="center">
                            <?php echo $this->Form->input('sup', array('name' => 'data[ligner][' . $i . '][sup]', 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'type' => 'hidden', 'class' => 'form-control'));
                            ?>
                            <?php echo $this->Form->input('id', array('label' => '', 'value' => $li->id, 'name' => 'data[ligner][' . $i . '][id]', 'type' => 'hidden', 'id' => 'name' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'class' => 'form-control')); ?>
                            <?php echo $this->Form->control('critere_id', array('class' => 'form-control critere select2', 'empty' => 'Veuillez choisir !!', 'label' => '', 'value' => $li->critere_id, 'champ' => 'critere_id', 'name' => 'data[ligner][' . $i . '][critere_id]', 'id' => 'critere_id' . $i, 'table' => 'ligner', 'index' => $i)); ?>


                          </td>

                          <td align="center" table="ligner">
                            <div table="ligner" id="selectligne<?php echo $i ?>">
                              <?php echo $this->Form->control('lignecritere_id', array('class' => 'form-control select2 ', 'options' => $lignecriteres, 'empty' => 'Veuillez choisir !!', 'label' => '', 'value' => $li->lignecritere_id, 'champ' => 'lignecritere_id', 'name' => 'data[ligner][' . $i . '][lignecritere_id]', 'id' => 'lignecritere_id' . $i, 'table' => 'ligner', 'index' => $i)); ?>

                            </div>
                          </td>

                          <td align="center">
                           
                            <i index="<?php echo $i ?>" class="fa fa-times supLigneinv" style="color: #C9302C;font-size: 22px;">
                          </td>
                        </tr>
                      <?php endforeach; ?>
                      <input type="hidden" value="<?php echo $i ?>" id="index">

                    </tbody>
                  </table><br>
                </div>
              </div>
            </div>

          </div>


        </section>



        <!-- /.box-body -->
        <div align="center">
          <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'article', 'class' => 'btn btn-sm btn-success']); ?>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>


<style>
  .checkbox-container {
    display: flex;
    align-items: center;
    justify-content: flex-start;
  }

  .checkbox-container input[type="checkbox"] {
    margin-right: 10px;
  }
</style>

<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>


<script>
  $(function() {

    $('.supLigneinv').on('click', function() {

      index = $('#index').val();
      ind = $(this).attr('index');

      $('#sup' + ind).val(1);

      $(this).parent().parent().hide();



    });


    $('.ajouter_ligne_critere').on('click', function() {
      //  alert('hello');
      index = Number($('#index').val());
      //alert(index)
      sup = $('#sup1' + index).val();
      // $('#qteTheorique' + index).val(0);
      // alert(sup +'sup')

      // alert(index+"index");
      article_id = $('#matierepremiere_id' + index).val();

      qteStock = $('#qteStock' + index).val();
      siteid = $('#site-id').val();
      depot_id = $('#depot_id').val();

      if (siteid == '' || depot_id == 'Veuillez choisir !!') {
        alert('Veuillez choisir dépot et Site !!');
        return;
      }

      //    alert(coffre==null);
      //     alert(coffre);
      //     alert(sup!=1);


      if (article_id == "" && sup != 1) {
        //$('div1').attr('display',true);
        // alert('Veuillez remplir la premiere ligne ');     
        // $('#al').attr('style',"display:true;");
        alert('Veuillez remplir la ligne ');
        // alert('Veillez remplir la ligne  ' + '' + (index + 1));
      } else {
        //$('.alert').hide();
        ajouter('tabligne', 'index');
        /* $('#depot_id').attr('readonly','readonly') ;
        $('#site-id').attr('readonly','readonly') ; */


      }

    });


    $('.critere').on('change', function() {


      index = $(this).attr('index');
      critere_id = $('#critere_id' + index).val();
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getoptions']) ?>",
        dataType: "json",
        data: {
          index: index,
          critere_id: critere_id,

        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {

          $('#selectligne' + index).html(data.select);
          $('#lignecritere_id' + index).select2();


        },


      })

    });



  });

  $('.select2').select2({

  })


  function ajouter(table, index) {
    ind = Number($('#' + index).val()) + 1;
    $ttr = $('#' + table).find('.tr').clone(true);
    $ttr.attr('class', '');
    i = 0;
    tabb = [];
    $ttr.find('input,select,textarea,tr,td,div').each(function() {
      tab = $(this).attr('table'); //alert(tab)
      champ = $(this).attr('champ');
      $(this).attr('index', ind);
      $(this).attr('id', champ + ind);
      $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
      $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
      $type = $(this).attr('type');
      $(this).val('');
      if ($type == 'radio') {
        $(this).attr('name', 'data[' + champ + ']');
        //$(this).attr('value',ind);
        $(this).val(ind);
      }
      if ((champ == 'datedebut') || (champ == 'datefin')) {
        $(this).attr('onblur', 'nbrjour(' + ind + ')')
      }

      $(this).removeClass('anc');
      if ($(this).is('select')) {
        tabb[i] = champ + ind;
        i = Number(i) + 1;
      }
      // $(this).val('');

    })
    $ttr.find('i').each(function() {
      $(this).attr('index', ind);
    });
    $('#' + table).append($ttr);
    $('#' + index).val(ind);
    $('#' + table).find('tr:last').show();
    for (j = 0; j <= i; j++) {
      //  uniform_select(tabb[j]);
    }
    $('#matierepremiere_id' + ind).select2();
    $('#article_id' + ind).select2();
    $('#unite_id' + ind).select2();
    $('#depot_id' + ind).select2();
    $('#fonction_id' + ind).select2();
    $('#typepf_id' + ind).select2();
    $('#fournisseur_id' + ind).select2();
    $('#critere_id' + ind).select2();
    $('#typearticle_id' + ind).select2();






    // $('#referenceartligne_id' + ind).select2();
    // $('#id_unitec' + ind).select2();
    // $('#id_unitem' + ind).select2();







  }
</script>


<?php $this->end(); ?>