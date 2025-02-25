<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compte $compte
 * @var string[]|\Cake\Collection\CollectionInterface $agences
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
  <h1>
    Compte
    <small><?php echo __('Modifier'); ?></small>
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
      <div class="box ">

        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($compte, ['role' => 'form']); ?>
        <div class="box-body">
          <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('numero', ['label' => 'Numéro']);
              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->control('date', ['class' => 'form-control']);
              //echo $this->Form->control('numero', ['value' => $mm, 'readonly' => 'readonly']);
              ?>

            </div>
            <div class="col-md-6">
              <?php

              echo $this->Form->control('agence_id', array(
                'empty' => 'Veuillez choisir !!', 'options' => $agences, 'class' => ' form-control ', 'name' => 'agence_id', 'label' => 'Agences', 'id' => 'agence_id', 'type' => '', 'class' => 'form-control select2'
              ));
              ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('montant', ['label' => 'Solde']);
              ?>
            </div>

            <div class="col-md-6">
              <?php

              echo $this->Form->control('banque_id', array(
                'empty' => 'Veuillez choisir !!', 'options' => $banques, 'class' => ' form-control ', 'name' => 'banque_id', 'label' => 'Banque', 'id' => 'banque_id', 'type' => '', 'class' => 'form-control select2'
              ));
              ?>

            </div>
          </div> <br><br>

          <div class="col-md-12">
            <div class="box-header with-border">
              <a class="btn btn-primary btn " table="addtable" id="ajouter_lignecompte" index="index" style="
         float: right;
         margin-bottom: 5px;
         ">
                <i class="fa fa-plus-circle "></i> Ajouter ligne</a>

            </div>
          </div>

          <table class="table table-bordered table-striped table-bottomless" id="idtable3">
            <thead>

              <tr width:20px>

                <td align="center" style="width: 10%; font: size 20px;"><strong>Type Crédit</strong></td>



                <td align="center" style="width: 7%;"></td>

              </tr>
            </thead>
            <tbody>
              <tr>
                <?php if (!empty($lignecompte)) :  ?>
                  <?php $j = 0;
                  foreach ($lignecompte as $i => $res) :
                    //  debug($res);
                    $j++;
                    //dd($res)    ;
                  ?>




                    <td align="center">
                      <?php echo $this->Form->input('sup', array('name' => "data[ligner][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => '', 'class' => 'form-control', 'type' => 'hidden')); ?>

                      <?php echo $this->Form->input('compte_id', array('label' => '', 'readonly' => 'readonly', 'value' => $res->compte_id, 'name' => 'data[ligner][' . $i . '][compte_id]', 'type' => 'hidden', 'id' => 'compte_id' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>


                      <?php echo $this->Form->input('id', array('label' => '', 'readonly' => 'readonly', 'value' => $res->id, 'name' => 'data[ligner][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>


                      <?php   //$connection = ConnectionManager::get('default');



                      echo $this->Form->control('typecredit_id', array('empty' => 'Veuillez choisir !!', 'type' => '', 'label' => '', 'options' => $typecredits, 'value' => $res->typecredit_id, 'name' => 'data[ligner][' . $i . '][typecredit_id]',  'id' => 'typecredit_id' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'class' => 'form-control'));
                      ?>

                    </td>




                    <td align="center">
                      <i id="" class="fa fa-times supLigne3" style="color: #c9302c;font-size: 22px;" index="<?php echo $i ?>"></i>
                    </td>

              </tr>
            <?php endforeach; ?>
          <?php endif; ?>

          <tr class="tr" style="display: none !important">

            <td align="center" table="ligner">

              <?php
              echo $this->Form->input('typecredit_id', array('class' => ' form-control ', 'label' => '', 'index' => '', 'champ' => 'typecredit_id', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => ''));
              ?>



              <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control">
            </td>









            <td align="center">
              <i index class="fa fa-times supLigne3" style="color: #c9302c;font-size: 22px;"></i>
            </td>
          </tr>

            </tbody>

            <input value="-1" id="index" type="hidden">

          </table>

          <br>



          <button type="submit" class="pull-right btn btn-success " style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box-body -->


      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>
<?php echo $this->Html->script('alert'); ?>
<script type="text/javascript">
  $(document).ready(function() {

    $('.supLigne3').on('click', function() {

      index = $('#index').val();
      ind = $(this).attr('index');
      ///alert(ind);
      // alert(index);
      $('#sup' + ind).val('1');
      $(this).parent().parent().hide();


    })
    $('#ajouter_lignecompte').on('click', function() {
      // alert('click') ;
      index = Number($('#index').val());
      // alert(index);
      ajouter('idtable3', 'index');
    });



    function ajouter(table, index) {


      ind = Number($('#' + index).val()) + 1;
      $ttr = $('#' + table).find('.tr').clone(true);
      $ttr.attr('class', '');
      i = 0;
      tabb = [];
      $ttr.find('input,select,textarea,tr,td,div,ul,li').each(function() {
        tab = $(this).attr('table'); //alert(tab)
        champ = $(this).attr('champ');
        $(this).attr('index', ind);
        $(this).attr('id', champ + ind); //alert(champ);
        if (champ == 'marchandisetype_id') {
          //alert(champ)
          $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + '][]');
          $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
        } else {
          $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
          $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
        }
        $type = $(this).attr('type');
        if (champ !== 'tva' && champ !== 'fodec' && champ !== 'remise') {
          $(this).val('');
        }
        // if (champ !== 'tva') {
        //     $(this).val('');
        // } else if (champ !== 'fodec') {
        //     $(this).val('');
        // } else if (champ !== 'remise') {
        //     $(this).val('');
        // }

        // $(this).val('');
        if ($type == 'radio') {
          $(this).attr('name', 'data[' + champ + ']');
          //$(this).attr('value',ind);
          $(this).val(ind);
        }
        if ((champ == 'datedebut') || (champ == 'datefin')) {
          $(this).attr('onblur', 'nbrjour(' + ind + ')')
        }
        $(this).removeClass('anc');
        if ($(this).is('select', 'multiple')) {
          //alert(champ);
          //alert(ind);
          tabb[i] = champ + ind; //alert(tabb[i]);
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

      $("#compte_id" + ind).select2({
        width: '100%' // need to override the changed default
      });
      $("#article" + ind).select2({
        width: '100%' // need to override the changed default
      });
      $("#article_id" + ind).select2({
        width: '100%' // need to override the changed default
      });
      $("#banque_id" + ind).select2({
        width: '100%' // need to override the changed default
      });
      $("#typeexon_id" + ind).select2({
        width: '100%' // need to override the changed default
      });
      $("#gouvernorat_id" + ind).select2({
        width: '75%' // need to override the changed default
      });
      for (j = 0; j <= i; j++) {
        // alert(tabb[j]);
        //  $('marchandisetype_id1').attr('class','select2');
        //  uniform_select(tabb[j]); jareb
        //$('#'+tabb[j]).select2({ });
      }
      $("#article_id" + ind).select2({
        width: '75%' // need to override the changed default
      });
      $("#categorie_id" + ind).select2({
        width: '100%' // need to override the changed default
      });
      // $("#categorie_id" + ind).select2({
      //   width: '100%' // need to override the changed default
      // });
      // $("#quantite" + ind).select2({
      //   width: '100%' // need to override the changed default
      // });
      $("#unitescontenaire_id" + ind).select2({
        width: '100%' // need to override the changed default
      });

    }


  });
</script>

<?php $this->end(); ?>
<?php echo $this->Html->script('alert'); ?>