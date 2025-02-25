<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Inventaire $inventaire
 */
?>
<style>
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('mahdi'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->fetch('script'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ajout Inventaire

  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index/' . $type]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<?php if ($type == 1) {   ?>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">

          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo $this->Form->create($inventaire, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
          <div class="box-body">
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('numero', ['label' => 'Numéro', 'value' => $code, 'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('date', ['label' => 'Date', 'id' => 'date', 'value' => $now]); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('pointdevente_id', ['label' => 'Site', 'value' => 25, 'id' => 'site-id', 'options' => $poindeventes, 'class' => 'form-control select2 depot']); ?>

            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('depot_id', ['label' => 'Dépot', 'value' => 6, 'id' => 'depot_id', 'class' => 'form-control select2']); ?>
            </div>
          </div>
          <section class="content-header">
            <h1 class="box-title"><?php echo __('Articles'); ?></h1>
          </section>

          <section class="content" style="width: 99%">
            <div class="row">
              <div class="box">
                <div class="box-header with-border">
                  <a class="btn btn-primary al ajouter_ligne_inventaire" table='addtable' index='index' id='' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                    <i class="fa fa-plus-circle "></i> Ajouter article</a>
                </div>
                <div class="panel-body">
                  <div class="table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                      <thead>
                        <tr width:"20px">
                          <td align="center" style="width: 50%;"><strong>Article</strong></td>
                          <td align="center" style="width: 20%;"><strong>Qte Théorique</strong></td>
                          <td align="center" style="width: 20%;"><strong>Qte Stock</strong></td>
                          <td align="center" style="width: 10%;"></td>

                        </tr>
                      </thead>
                      <tbody>
                        <tr class="tr" style="display: none !important">
                          <td align="center" table="ligner">
                            <!-- <label></label> -->
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

                          <td align="center" table="ligner">


                            <?php
                            echo $this->Form->input('qteTheorique', array('class' => ' form-control', 'type' => 'number', 'value' => '0', 'label' => '', 'index' => '', 'champ' => 'qteTheorique', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                            ?>
                          </td>
                          <td align="center" table="ligner">


                            <?php
                            echo $this->Form->input('qteStock', array('class' => ' form-control focus ajouttt', 'label' => '', 'index' => '', 'champ' => 'qteStock', 'table' => 'ligner', 'name' => '', 'id' => '', 'type' => 'number', 'step' => 'any'));
                            ?>
                          </td>

                          </td>

                          <td align="center">

                            <i index="0" id="" class="fa fa-times supLigne0" style="color: #c9302c;font-size: 22px;"></i>
                          </td>
                        </tr>
                        <input type="hidden" value="-1" id="index">
                      </tbody>
                    </table><br>


                  </div>

                </div>

                <div class="box-header with-border">
                  <a class="btn btn-primary al ajouter_ligne_inventaire" table='addtable' index='index' id='' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       margin-left: 100px;
                                       ">
                    <i class="fa fa-plus-circle "></i> Ajouter article </a>
                </div>

              </div>

            </div>


          </section>





          <!-- /.box-body -->
          <div align="center">
            <button type="submit" class="pull-right btn btn-success btn-sm " id="invBtnn" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

            <!-- <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'invBtnn']); ?> -->

          </div>
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
  </section>



<?php  }   ?>



<?php if ($type == 2) {   ?>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">

          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo $this->Form->create($inventaire, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
          <div class="box-body">
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('numero', ['label' => 'Numéro', 'value' => $code, 'readonly']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('date', ['label' => 'Date', 'id' => 'date', 'value' => $now]); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('pointdevente_id', ['label' => 'Site', 'value' => 25, 'id' => 'site-id', 'options' => $poindeventes, 'class' => 'form-control select2 depot']); ?>

            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('depot_id', ['label' => 'Dépot', 'value' => 6,  'id' => 'depot_id', 'class' => 'form-control select2']); ?>
            </div>
          </div>
          <section class="content-header">
            <h1 class="box-title"><?php echo __('Articles'); ?></h1>
          </section>

          <section class="content" style="width: 99%">
            <div class="row">
              <div class="box">
                <div class="box-header with-border">
                  <a class="btn btn-primary al ajouter_ligne_inventaire" table='addtable' index='index' id='' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                    <i class="fa fa-plus-circle "></i> Ajouter article </a>
                </div>
                <div class="panel-body">
                  <div class="table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                      <thead>
                        <tr width:"20px">
                          <td align="center" style="width: 50%;"><strong>Article</strong></td>
                          <td align="center" style="width: 20%;"><strong>Qte Théorique</strong></td>
                          <td align="center" style="width: 20%;"><strong>Qte Stock</strong></td>
                          <td align="center" style="width: 10%;"></td>

                        </tr>
                      </thead>
                      <tbody>
                        <tr class="tr" style="display: none !important">
                          <td align="center" table="ligner">
                            <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control ">

                            <!-- <label></label> -->
                            <select table="ligner" index champ="article_id" class="js-example-responsive articleQtest  ">
                              <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                              <?php foreach ($articles as $id => $article) {
                              ?>
                                <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                              <?php } ?>
                            </select>

                            <?php
                            //echo $this->Form->input('article_id',array('class'=>' form-control ','label'=>'','index'=>'','champ'=>'article_id','table'=>'ligner','name'=>'','empty'=>'Veuillez choisir !!','id'=>'') );   
                            ?>

                          <td align="center" table="ligner">


                            <?php
                            echo $this->Form->input('qteTheorique', array('class' => ' form-control', 'type' => 'number', 'value' => '0', 'label' => '', 'index' => '', 'champ' => 'qteTheorique', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                            ?>
                          </td>
                          <td align="center" table="ligner">


                            <?php
                            echo $this->Form->input('qteStock', array('class' => ' form-control ajouttt focus', 'label' => '', 'index' => '', 'champ' => 'qteStock', 'table' => 'ligner', 'name' => '', 'id' => '', 'type' => 'number', 'step' => 'any', 'min' => "0"));
                            ?>
                          </td>



                          <td align="center">

                            <i index="0" id="" class="fa fa-times supLigne" style="color: #c9302c;font-size: 22px;"></i>
                          </td>
                        </tr>





                        <input type="hidden" value="-1" id="index">
                      </tbody>
                    </table>

                    <div id="hechem">

                    </div>



                  </div>
                </div>

                <div class="box-header with-border">
                  <a class="btn btn-primary al ajouter_ligne_inventaire" table='addtable' index='index' id='' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                    <i class="fa fa-plus-circle "></i> Ajouter article </a>
                </div>
              </div>


            </div>


            <div align="center">

              <button type="button" id="invBtnn" class="btn btn-primary calculQ">Enregistrer</button>

              <input id="indexx" type="hidden" value="">

            </div>

          </section>





          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
  </section>

<?php   }   ?>



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
      //  alert('fff')
      e.preventDefault(); //
      if (event.which == 13) {
        // alert('dddd')
        var $tableBody = $('#tabligne').find("tbody"), //idftable
          $trLast = $tableBody.find("tr:last");
        //  $trNew = $trLast.clone();



        // $trLast.after($trNew);
        ajouter('tabligne', 'index');

        document.getElementById("invBtnn").scrollIntoView(); //idfbouton

        e.preventDefault();
        return false;
      }
      if (e.which === 13) {
        //if($('input').not(':hidden')  )
        {
          var index = $('.focus').index(this) + 1; //  class f les    select ili temchilhom 
          // console.log('this index '+ index);
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
  //   function suppligne() {

  //     index = Number($('#indexx').val());
  //     i = $(this).attr('index');
  //    // alert(i)

  // $('#supp'+i).parent().parent().hide();



  //   }

  function desactiveEnter() {
    return event.keyCode != 13;
    /* if (event.keyCode == 13) {
         event.keyCod
         e = 0;
         window.event.returnValue = false;
         //document.getElementById("text").innerHTML="&nbsp;&nbsp;&nbsp;Veuillez utiliser la souris pour valider ce devis ";
         bootbox.alert('&nbsp;&nbsp;&nbsp;?????? ??????? ?????? ???????? ')
     }*/
  }

  function ajouterlignepress() {

    //alert('ggg')

    if (event.keyCode == 120 || event.keyCode == 107 || event.keyCode == 13) {
      table = 'tabligne'

      ind = Number($('#index').val()) + 1;
      //alert(ind)
      //ind = Number($("#" + index).val()) + 1;

      $ttr = $("#" + table)
        .find(".tr")
        .clone(true);
      $ttr.attr("class", "");
      i = 0;
      tabb = [];
      $ttr.find("input,select,textarea,tr,td,div,ul,li").each(function() {

        tab = $(this).attr("table"); //alert(tab)
        champ = $(this).attr("champ");
        $(this).attr("index", ind);
        $(this).attr("id", champ + ind); //alert(champ);
        if (champ == "marchandisetype_id") {
          //alert(champ)
          $(this).attr("name", "data[" + tab + "][" + ind + "][" + champ + "][]");
          $(this).attr(
            "data-bv-field",
            "data[" + tab + "][" + ind + "][" + champ + "]"
          );
        } else {
          $(this).attr("name", "data[" + tab + "][" + ind + "][" + champ + "]");
          $(this).attr(
            "data-bv-field",
            "data[" + tab + "][" + ind + "][" + champ + "]"
          );
        }
        $type = $(this).attr("type");
        $(this).val("");
        if ($type == "radio") {
          $(this).attr("name", "data[" + champ + "]");
          //$(this).attr('value',ind);
          $(this).val(ind);
        }
        if (champ == "datedebut" || champ == "datefin") {
          $(this).attr("onblur", "nbrjour(" + ind + ")");
        }
        $(this).removeClass("anc");
        if ($(this).is("select", "multiple")) {
          //alert(champ);
          //alert(ind);
          tabb[i] = champ + ind; //alert(tabb[i]);
          i = Number(i) + 1;
        }
        // $(this).val('');
      });

      $ttr.find("i").each(function() {

        $(this).attr("index", ind);
      });
      $("#" + table).append($ttr);
      //alert(ind+"ind")
      $("#index").val(ind);

      $("#" + table)
        .find("tr:last")
        .show();
      $("#article_id" + ind).select2({
        width: "100%", // need to override the changed default
      });


      //indd = Number($("#" + index).val()) ;
      //alert(indd);
      $("#inserted" + ind).val(1);

      for (j = 0; j <= i; j++) {
        // alert(tabb[j]);
        //  $('marchandisetype_id1').attr('class','select2');
        //  uniform_select(tabb[j]); jareb
        //$('#'+tabb[j]).select2({ });
      }
    }
  }

  function showBtn() {

    ind = Number($('#indexx').val());
    for (i = 0; i <= ind; i++) {

      qteStock = $('#qteStock' + i).val();


      if (qteStock != '') {

        $('#invBtnn').show();

      }
    }


  }

  function alertInventaire() {

    index = Number($('#index').val());
    sup = Number($('#sup').val());
    date = $('#date').val();
    depot_id = $('#depot_id').val();

    if (date == '') {
      alert('Ajoutez une date', function() {});
      return false;

    } else if (depot_id == '') {
      alert('Selectionnez un depot', function() {});
      return false;

    }
    if (index == -1) {
      alert('Ajouter une ligne', function() {});
      return false;
    } else if (index != -1) {
      $nb = -1;
      for (i = 0; i <= Number(index); i++) {
        sup = $('#sup' + i).val();
        if (sup == 1) {
          $nb++;
        }
      }
      if ($nb == index) {
        alert('Ajouter une ligne', function() {});
        return false;

      }
    }
    for (i = 0; i <= Number(index); i++) {
      sup = $('#sup' + i).val();

      article_id = $('#article_id' + i).val();

      qteStock = $('#qteStock' + i).val();

      if ((article_id == null || article_id == '') && (sup != 1)) {
        alert('Selectionnez un article', function() {});
        return false;
      } else if ((qteStock == 0 || qteStock == '') && sup != 1) {
        alert('Ajouter la quantité en stock', function() {});
        return false;
      }
    }
  }

  function getQte() {

    date = $('#date').val();

    depot = $('#depot_id').val();

    ind = $('#index').val();
    // sup= $('#sup').val();

    tab = new Array;
    for (i = 0; i <= ind; i++) {
      sup = $('#sup' + i).val();

      v = $('#article_id' + i).val();

      if (sup != 1) {
        tab[i] = v;

      }
      //alert(tab[i]) 

    }
    var removeItem = undefined;
    tab = jQuery.grep(tab, function(value) {
      return value != removeItem;
    });


    for (i = 0; i <= ind; i++) {

      qteStock = $('#qteStock' + i).val();
      //  alert(qteStock)


      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Inventaires', 'action' => 'calculQte']) ?>",
        dataType: "json",
        data: {
          date: date,
          depot: depot,
          ind: ind,
          tab,
          tab,


        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          if ((qteStock != '')) {
            $('#hechem').html(data.res);
            $('#indexx').val(data.indexx);


          }

        }

      })


    }

  }



  $(function() {

    $('#depot_id').on('change', function() {

      $('html, body').animate({
        scrollTop: $("#tabligne").offset().top
      }, 1000);
      ajouter("tabligne", "index");
    })
    $('.ajouttt').on('change', function() {

      $('html, body').animate({
        scrollTop: $("#tabligne").offset().top
      }, 1000);
      ajouter("tabligne", "index");
    })

    $('.depot').on('change', function() {
      //  alert('hello');
      id = $('#site-id').val();
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

          $('#depot_id').html(data.select);

        }

      })
    });



    $('.articleQte').on('change', function() {

      //      getQte()

    });

    k = 0;

    $('.calculQ').on('click', function() {

      if (Number($(this).attr('count')) > 0) {

        $('#invBtnn').removeAttr("type").attr("type", "submit");
      }


      index = Number($('#index').val());

      x = alertInventaire();


      getQte()


      for (i = 0; i <= index; i++) {


        qteStock = $('#qteStock' + i).val();
        if ((qteStock !== '')) {
          //alert('hecheeem')
          $('.ajouter_ligne_inventaire').hide();

          /*     $('#invBtnn').hide();
           */
        }


        if ($('#hechem').height() == 3) {
          $('#invBtnn').removeAttr("type").attr("type", "submit");

        }



      }
      /* if ($('#hechem').children().length > 0 )
              {
                $('.ajouter_ligne_inventaire').hide() ;
                $('.fa fa-times supLigne').hide() ;

              }
              else {
                alert('rrr') ;
              } */
      if (x === undefined)
        k++;
      $(this).attr('count', k);

    })

    $('.articleQtest').on('change', function() {

      index = $(this).attr('index');
      article_id = $('#article_id' + index).val();
      date = $('#date').val();
      depot = $('#depot_id').val();

      $.ajax({
        method: "GET",
        type: "GET",
        url: "<?= $this->Url->build(['controller' => 'Inventaires', 'action' => 'getquantite']) ?>",
        dataType: "JSON",
        data: {
          idarticle: article_id,
          date: date,
          depot: depot,

        },
        success: function(data) {
          //  alert(data.qtes)

          $('#qteTheorique' + index).val(data.qtes);
          $('#qteStock' + index).focus();

        }

      })

    })



    $('.supLigne').on('click', function() {

      index = $('#index').val();
      ind = $(this).attr('index');

      $('#sup' + ind).val(1);

      $(this).parent().parent().hide();

      getQte()

    });
  });
</script>

<?php $this->end(); ?>