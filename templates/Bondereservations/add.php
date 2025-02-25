<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bondereservation $bondereservation
 */
?>
<!-- Content Header (Page header) -->


<section class="content-header">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
  <ol class="breadcrumb">
    <li><a href="</*?php echo $this->Url->build(['action' => 'index']); */?>"><i class="fa fa-dashboard"></i> </*?php echo __('Home'*/); ?></a></li>
  </ol>


  <div class="row">
    <div class="col-md-12">
      <div style="margin-bottom:10px" type="submit"><?php echo $this->Html->link(__('retour'), ['action' => 'index'], ['class' => 'btn btn-success ']) ?>
      </div>
    </div>

</section>


<section class="content-header">
  <h1 class="box-title"><?php echo __('Ajout bon de reservation'); ?></h1>

</section>
<section class="content" style="width: 99%">
  <div class="row">
    <div class="box box-primary">

      <div class="panel-body">
        <div>

          <?php echo $this->Form->create($bondereservation, ['role' => 'form']); ?>
          <div class="box ">
            <div class="row">
              <div class="panel-body">
                <div class="col-xs-6">
                  <?php
                  echo $this->Form->control('numero', array('default' => $mm, 'readonly' => "readonly"));
                  ?>
                </div>
                <div class="col-xs-6">
                  <?php
                  echo $this->Form->control('depot_id', ['options' => $depots, 'empty' => 'Veuillez choisir !!', 'required', 'class' => 'form-control', 'id' => 'depot_id']); ?>
                </div>
                <div class="col-xs-6">
                  <?php echo $this->Form->control('date', ['empty' => true,  'id' => 'date_id']);
                  ?>
                </div>

                <div class="col-xs-6">
                  <?php
                  echo $this->Form->control('pointdevente_id', ['options' => $pointdeventes, 'empty' => 'Veuillez choisir !!', 'required', 'id' => 'pointdevente_id', 'label' => 'Point de vente']); ?>
                </div>
                <?php echo $this->Form->input('datecreation', array('label' => false, 'id' => 'datecreation', 'type' => 'hidden', 'placeholder' => '', 'maxlength' => '30', 'class' => 'datepicker', 'required', 'default' => date('Y-m-d H:i:s'))); ?>

                <div class="col-md-6">

                  <div class="col-md-11">
                    <div class="form-group">

                      <?php
                      echo $this->Form->control('client_id', ['empty' => 'Veuillez choisir !!', 'options' => $clients, 'required', 'id' => 'client_id']); ?>


                    </div>
                  </div>
                  <div class="col-md-1" style="padding-top:25px;">
                    <!--  <a onclick="openWindow(1000, 1000, 'http://localhost:8765/Clients/add');"><button class="btn btn-xs btn-primary "> <i class="fa fa fa-plus"></i></button></a>-->
<!--                    <a onclick="openWindow(1000, 1000, 'http://localhost:8765/clients/add ');"><i class="fa fa fa-plus" style="color:success;font-size: 30px;"></i></a>-->

                  </div>


                </div>
              </div>



            </div>

            <div class="col-md-12">

              <section class="content-header">
                <h1 class="box-title"><?php echo __('Ligne bon de reservation'); ?></h1>
              </section>
              <section class="content" style="width: 99%">
                <div class="row">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <a class="btn btn-primary  testdepotvide" table='addtable' index='index2' id='ajouter_ligne2' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                        <i class="fa fa-plus-circle "></i> ajouter Ligne bon de reservation</a>

                    </div>
                    <div class="panel-body">
                      <div class="table-responsive ls-table">
                        <table class="table table-bordered table-striped table-bottomless" id="tabligne2">
                          <thead>
                            <tr width:20px">


                              <td align="center" nowrap="nowrap"><strong>Article</strong></td>
                              <td align="center" nowrap="nowrap"><strong>Quantité stock</strong></td>
                              <td align="center" nowrap="nowrap"><strong>quantite</strong></td>

                              <td align="center" nowrap="nowrap"></td>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="tr testdepotvide" style="display: none !important">

                              <td style="width: 30%;" align="center" class="testdepotvide">

                                <?php echo $this->Form->input('sup', array('name' => '', 'id' => 'sup', 'champ' => 'sup', 'table' => 'tabligne2', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                ?>
                                <div class="testdepotvide">
                                  <?php
                                  echo $this->Form->control('article_id', ['options' => $articles, 'empty' => 'Veuillez choisir !!', 'label' => '', 'table' => 'tabligne2', 'champ' => 'article_id', 'class' => 'articleidbl1 form-control', 'id' => 'article_id']); ?>

                                </div>
                              </td>


                              </td>

                              <td style="width: 30%;" align=" center">
                                <input table="tabligne2" type='text' champ='qtestock' class='form-control' id='' class='input' style="margin-right:50%;margin-top: 20px;" disabled>
                              </td>
                              <td style="width: 30%;" align="center">
                                <input table="tabligne2" type='text' champ='quantite' class='getprixarticle form-control ' style="margin-right:50%;margin-top: 20px;" id='' class='input number'>
                              </td>


                              <td align="center"><i index="" id="" class="fa fa-times supLigne" style="font-size: 22px;color: #C9302C;margin-right:50%;margin-top: 20px;"></td>

                            </tr>
                          </tbody>
                        </table><br>
                        <input type="hidden" value=-1 id="index2">
                      </div>
                    </div>
                  </div>
                </div>

              </section>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center ">
        <?php echo $this->Form->submit(__('enregistrer'), ['class' => 'btn btn-primary TestQte']); ?>


        <?php echo $this->Form->end(); ?>
      </div>

</section>
</div>

</div>

</div>

</div>

</section>

<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<!-- DataTables -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<?php $this->end(); ?>
<script>
  $(function() {
    function ajouter_ligne(table, index) {
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
      /*$('#datedebut'+ind).datetimepicker({
        timepicker: false,
        datepicker:true,
        mask:'39/19/9999',
        format:'d/m/Y'});
      $('#datefin'+ind).datetimepicker({
        timepicker: false,
        datepicker:true,
        mask:'39/19/9999',
        format:'d/m/Y'});
    $('#date'+ind).datetimepicker({
        timepicker: false,
        datepicker:true,
        mask:'39/19/9999',
        format:'d/m/Y'});
           
   */
    }


    function openWindow(h, w, url) {
      leftOffset = (screen.width / 2) - w / 2;
      topOffset = (screen.height / 2) - h / 2;
      window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }

    $('.TestQte').on('mousemove', function() {
      index = $('#index2').val();


      article_id = $('#article_id' + index).val();
      for (var i = 0; i <= index; i++) {
        sup = $('#sup' + i).val();
        //alert(sup);

        if (sup != 1) {
          art = $('#article_id' + i).val();
          if (art == "") {
            alert('Choisir article svp ', function() {});
            return false;
          }
          quantite_id = $('#quantite' + i).val();
          if (quantite_id == "") {
            alert('Choisir quantite svp  ', function() {});
            return false;
          }
        } else {
          alert('ajouter Ligne bon de reservation')
        }
      }
      pointdevente_id = $('#pointdevente_id').val();
      if (pointdevente_id == "") {
        alert('Choisir point de vente svp ', function() {});
        return false;
      }
      depot_id = $('#depot_id').val();
      if (depot_id == "") {
        alert('Choisir depot svp ', function() {});
        return false;
      }
      client_id = $('#client_id').val();
      if (client_id == "") {
        alert('Choisir client svp ', function() {});
        return false;
      }
      date_id = $('#date_id').val(); //alert(date_id)
      if (date_id == "") {
        alert('choisir date SVP', function() {});
        return false
      }
      if (index == -1) {
        alert('ajouter ligne bon de reservation', function() {});
        return false;
      }
    });

    $('#ajouter_ligne2').on('click', function() {

      index = Number($('#index2').val());
      sup = $('#sup' + index).val();

      coffre = $('#article_id' + index).val(); //alert(index)
      coffree = $('#qtestock' + index).val(); //alert(index)
      coffreee = $('#quantite' + index).val(); //alert(index)

      if (coffre == "" && sup != 1) {
        alert('Veuillez remplir la premiere ligne', function() {});
      } else {
        ajouter_ligne('tabligne2', 'index2');
      }




    });
    $('.supLigne').on('click', function() {
      alert('hh');
      //index = $(this).attr('index');
      index = $(this).attr('index');
      // alert(index)
      //bootbox.confirm("�tes-vous s�r de supprimer la ligne!!", function (result) {
      // if (result) {
      $('.supLigne').each(function() {
        ind = $(this).attr('index');
        if (ind == index) {
          $('#sup' + index).val(1);
          $(this).parent().parent().hide();
        }
      })
      //}


    })

    $('.supkh').on('click', function() {
      index = $(this).attr('index');
      $('#sup' + index).val(1);
      $(this).parent().parent().hide();

    })




    $('.testdepotvide').on('mousemove', function() {
      index = Number($('#index2').val());

      depot_id = $('#depot_id').val();
      if (depot_id == '') {
        alert('choisir un depot SVP', function() {});
        return false
      }

    })


    $(function() {
      $('.articleidbl1').on('change', function() {
        inde = $(this).attr('index');

        article_id = $('#article_id' + index).val();
        datecreation = $('#datecreation').val();
        depot_id = $('#depot_id').val();


        $.ajax({
          method: "GET",
          type: "GET",
          url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getquantite']) ?>",
          dataType: "JSON",
          data: {
            idarticle: article_id,
            idadepot: depot_id,


          },
          success: function(response) {

            qtestockx = response.qtestockx;

            $('#qtestock' + inde).val(qtestockx);

          }

        })
      });
    });
  })
</script>
<script>
  function openWindow(h, w, url) {
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
  }
</script>