<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Critere $critere
 */
?>
<style>
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }


</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('mahdi'); ?>

<?php echo $this->Html->css('select2'); ?>
<?php echo $this->fetch('script'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ajout Critère d'acceptation 

  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

 <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">

          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo $this->Form->create($critere, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
          <div class="box-body">
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('name', ['label' => 'Nom']); ?>
            </div>
            

           
          </div>
          <section class="content-header">
            <h1 class="box-title"><?php echo __(''); ?></h1>
          </section>

          <section class="content" style="width: 99%">
            <div class="row">
              <div class="box">
                <div class="box-header with-border">
                  <a class="btn btn-primary al ajouter_ligne_critere" table='addtable' index='index' id='' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                    <i class="fa fa-plus-circle "></i> Ajouter option</a>
                </div>
                <div class="panel-body">
                  <div class="table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                      <thead>
                        <tr width:"20px">
                          <td align="center" style="width: 50%;"><strong>Description</strong></td>
                        
                          <td align="center" style="width: 10%;"></td>

                        </tr>
                      </thead>
                      <tbody>
                        <tr class="tr" style="display: none !important">
                          <td align="center" table="ligner">
                     
                            <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control">

                            <?php
                            echo $this->Form->input('description', array('class' => ' form-control', 'type' => '',  'label' => false, 'index' => '', 'champ' => 'description', 'table' => 'ligner', 'name' => ''));
                            ?> 

                          </td>

                          <td align="center">

                            <i index="0" id="" class="fa fa-times supLigneinv" style="color: #c9302c;font-size: 22px;"></i>
                          </td>
                        </tr>
                        <input type="hidden" value="-1" id="index">
                      </tbody>
                    </table><br>


                  </div>

                </div>

                <!-- <div class="box-header with-border">
                  <a class="btn btn-primary al ajouter_ligne_critere" table='addtable' index='index' id='' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       margin-left: 100px;
                                       ">
                    <i class="fa fa-plus-circle "></i> Ajouter matière première </a>
                </div> -->

              </div>

            </div>


          </section>





          <!-- /.box-body -->
          <div align="center">

            <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'invmpBtnn','class'=>'btn btn-sm btn-success']); ?>

          </div>
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
  </section>



=





<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>

<script>
  $('.select2').select2({

  })
  $("form").submit(function() {
      $('#invmpBtnn').attr('disabled', 'disabled');
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

        document.getElementById("invmpBtnn").scrollIntoView(); //idfbouton

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

      article_id = $('#matierepremiere_id' + i).val();

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

  


  $(function() {

 


    $('.supLigneinv').on('click', function() {

      index = $('#index').val();
      ind = $(this).attr('index');

      $('#sup' + ind).val(1);

      $(this).parent().parent().hide();

      getQte()

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
  });
</script>

<?php $this->end(); ?>