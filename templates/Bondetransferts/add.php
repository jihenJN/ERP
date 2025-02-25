<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bonreceptionstock $bonreceptionstock
 */
?>
<?php echo $this->fetch('script'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('mahdi'); ?>
<?php echo $this->Html->script('hechem'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ajout bon de transfert
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($bondetransfert, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6"><?php
                                  echo $this->Form->control('numero', ['value' => $numero, "readonly" => true]);

                                  ?></div>
            <div class="col-md-6"><?php
                                  echo $this->Form->control('date', ['empty' => true, "value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]);

                                  ?></div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('pointdeventeentree_id', ['label' => 'Site arrive', 'empty' => 'Choisir Site !!', 'id' => 'sitearr_id', 'options' => $poindeventes, 'class' => 'form-control select2 depotarr ']); ?>

            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('pointdeventesortie_id', ['label' => 'Site sortie', 'empty' => 'Choisir Site !!', 'id' => 'sitesor_id', 'options' => $poindeventes,'class' => 'form-control select2 depotsort']); ?>
            </div>

            <div class="col-xs-6">
              <?php
              echo $this->Form->control('depotarrive_id', ['label' => 'Dépot arrive', 'empty' => 'Choisir depot !!', 'id' => 'depotarrive_id', 'class' => 'form-control select2']); ?>
            </div>

            <div class="col-xs-6">
              <?php
              echo $this->Form->control('depotsortie_id', ['label' => 'Dépot sortie', 'empty' => 'Choisir depot !!', 'id' => 'depotsortie_id', 'class' => 'form-control select2']); ?>
            </div>

          </div>

        </div>
        <!-- /.box-body -->
        <!-- /.box-header -->
        <section class="content-header">
          <h1 class="box-title"><?php echo __('Ligne bon de transfert'); ?></h1>
        </section>
        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">

              <div class="box-header with-border">
                <a class="btn btn-primary al ajouter_ligne_transfert" table='addtable' index='index' id='' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                  <i class="fa fa-plus-circle "></i> Ajouter article</a>

              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                    <thead>
                      <tr>
                        <td align="center" style="width: 50%;"><strong>Article</strong></td>
                        <td align="center" style="width: 25%;"><strong>Qte Stock</strong></td>
                        <td align="center" style="width: 20%;"><strong>Qte</strong></td>
                        <td align="center" style="width: 5%;"><strong></strong></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="tr" style="display: none !important">
                        <td align="center" table="ligner">
                          <label></label>
                          <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control">

                          <select table="ligner" index champ="article_id" class="js-example-responsive articleQtest  ">
                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                            <?php foreach ($articles as $id => $article) {
                            ?>
                              <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                            <?php } ?>
                          </select>

                          <?php
                          ?>
                        </td>

                        <td align="center" table="ligner">
                          <?php
                          echo $this->Form->input('qte', array('class' => ' form-control ', 'label' => '', 'index' => '', 'champ' => 'qte', 'table' => 'ligner', 'name' => '', 'id' => '', 'type' => 'text', 'readonly' => true));
                          ?>
                        </td>
                        <td align="center" table="ligner">
                          <?php
                          echo $this->Form->input('qteliv', array('class' => ' form-control tot focus', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'qteliv', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => ''));
                          ?>
                        </td>
                       



                        <td align="center">
                          <i class="fa fa-times supLigne0" style="color: #c9302c;font-size: 22px;"></i>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <input type="hidden" value="-1" id="index">

                  <br>
                </div>
              </div>
            </div>
          </div>

        </section>
        <div align="center" id="">

        <button type="submit" id="" class="btn btn-primary alertTr ">Enregistrer</button>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>

<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>

<script>
  $('.select2').select2({

  })
</script>
<script>
      $(document).ready(function() {



$(document).on('keyup', '.focus', function(e) {

    e.preventDefault(); //
    if (event.which == 13) {
        //alert('dddd')
        var $tableBody = $('#tabligne').find("tbody"), //idftable
            $trLast = $tableBody.find("tr:last");
        //  $trNew = $trLast.clone();

        ajouter('tabligne', 'index');

        document.getElementById("invBtnn").scrollIntoView(); //idfbouton

        e.preventDefault();
        return false;
    }
    if (event.which === 13) {
        //alert('hechem')
        //if($('input').not(':hidden')  )
        {
            var index = $('.focus').index(this) + 1;

            //  class f les    select ili temchilhom 
            $('.focus').eq(index).focus();
            event.preventDefault();
            return false;
        }
    }
    e.preventDefault();
    return false;
});








});
</script>
<script>
  $(function() {
    $('.depotarr').on('change', function() {
      ///alert('hechem');
      id = $('#sitearr_id').val();
      //alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Inventaires', 'action' => 'getDepot']) ?>",
        dataType: "json",
        data: {
          id: id,

        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {

          $('#depotarrive_id').html(data.select);

        }

      })
    });

    $('.depotsort').on('change', function() {
      ///alert('hechem');
      id = $('#sitesor_id').val();
      //alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Inventaires', 'action' => 'getDepot']) ?>",
        dataType: "json",
        data: {
          id: id,

        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {

          $('#depotsortie_id').html(data.select);
          

        }

      })
    });


    $('.articleQtest').on('change', function() {

      index = $(this).attr('index');
      article_id = $('#article_id' + index).val();
      date = $('#date').val();
      depot = $('#depotsortie_id').val();

      $.ajax({
        method: "GET",
        type: "GET",
        url: "<?= $this->Url->build(['controller' => 'Bonsortiestocks', 'action' => 'getquantite']) ?>",
        dataType: "JSON",
        data: {
          idarticle: article_id,
          date: date,
          depot: depot,

        },
        success: function(data) {
          //  alert(data.qtes)

          $('#qte' + index).val(data.qtes);
          $('#prix' + index).val(data.prix);
          $('#qteliv' + index).focus();

        }

      })

    })
    $('.tot').on('keyup', function() {

      ind = Number($('#index').val());
      for (j = 0; j <= index; j++) {
        qte = Number($('#qteliv' + j).val()) || 0;
      
        qtest = Number($('#qte' + j).val()) || 0; 
   
   if (Number(qte) > Number(qtest)   ) {
       alert('La quantité saisie doit etre inferieur à la quantite en stock !! ', function () { });
       $('#qteliv'+j).val('');
  
       return false ;

   }

      }

    })



  });
</script>



<script>
    const submitBtn = document.querySelector('button[type="submit"]');

    ///console.log(submitBtn)

    document.querySelector('form').addEventListener('submit', function() {

        submitBtn.disabled = true;
    });
</script>

<?php $this->end(); ?>