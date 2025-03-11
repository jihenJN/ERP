<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bonsortiestock $bonsortiestock
 */
?>
<?php echo $this->fetch('script'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('mahdi'); ?>
<?php echo $this->Html->script('hechem'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>


<section class="content-header">
 <h1>
   Ajout bon de sortie stock
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
       </div>
       <!-- /.box-header -->
       <!-- form start -->
       <?php echo $this->Form->create($bonsortiestock, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13",]); ?>
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
              echo $this->Form->control('pointdevente_id', ['label' => 'Site', 'empty' => 'Choisir Site !!', 'id' => 'site-id', 'options' => $poindeventes, 'class' => 'form-control select2 depot']); ?>

           </div>
           <div class="col-xs-6" id="divdepot">
             <?php
                                    echo $this->Form->control('depot_id', ['label' => 'Dépot',  'empty' => 'Veuillez choisir !!', 'id' => 'dd', 'class' => 'form-control select2','options' => $depots]); ?>
                                    </div>

           <div class="col-xs-6" hidden>
             <?php
              echo $this->Form->control('typesortie_id', ['label' => 'Type de sortie', 'empty' => 'Veuillez choisir !!', 'id' => 'typesortie_id', 'class' => 'form-control select2']); ?>
           </div>

           <div class="col-xs-6">
             <?php
              echo $this->Form->control('typesortiee', ['label' => 'Type de sortie',  'id' => 'typesortie_id', 'class' => 'form-control ']); ?>
           </div>
           <div class="col-xs-6" hidden>
             <?php
              echo $this->Form->control('machine_id', [
                'label' => 'Machine',
                'required' => 'off',
                'empty' => 'Veuillez choisir!!!',
                'class' => 'form-control select2 ',
                'type' => 'select',
                'options' => $machines

              ]);
              ?>
           </div>

           <div class="col-xs-6">
             <?php echo $this->Form->control('remarque', ['label' => 'Remarque', 'class' => 'form-control ', 'type' => 'textarea']); ?>

           </div>

         </div>

       </div>
       <!-- /.box-body -->
       <!-- /.box-header -->
       <section class="content-header">
         <h1 class="box-title"><?php echo __('Ligne bon de sortie'); ?></h1>
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
                     <tr>
                       <td align="center" style="width: 35%;"><strong>Article</strong></td>
                       <td align="center" style="width: 15%;"><strong>Qte Stock</strong></td>
                       <td align="center" style="width: 15%;"><strong>Qte</strong></td>
                       <td align="center" style="width: 15%;"><strong>Prix</strong></td>
                       <td align="center" style="width: 15%;"><strong>Total</strong></td>
                       <td align="center" style="width: 5%;"></td>
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
                       </td>
                       <td align="center" table="ligner">
                         <?php
                          echo $this->Form->input('qtestock', array('class' => ' form-control ', 'label' => '', 'index' => '', 'champ' => 'qtestock', 'table' => 'ligner', 'name' => '', 'id' => '', 'type' => 'text', 'readonly' => true));
                          ?>
                       </td>
                       <td align="center" table="ligner">
                         <?php
                          echo $this->Form->input('qte', array('class' => ' form-control focus tot', 'type' => 'number', 'step' => 'any', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'qte', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => ''));
                          ?>
                       </td>

                       <td align="center" table="ligner">
                         <?php
                          echo $this->Form->input('prix', array('class' => ' form-control', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'prix', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                          ?>
                       </td>
                       <td align="center" table="ligner">
                         <?php
                          echo $this->Form->input('total', array('class' => ' form-control', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'total', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
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

       <button type="submit" class="pull-right btn btn-success btn-sm  btncheck" id="" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

       </div>
       <?php echo $this->Form->end(); ?>
     </div>
     <!-- /.box -->
   </div>
 </div>
 <!-- /.row -->
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
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
 $('.select2').select2({

 })
</script>
<script>
 $(function() {

  $('.btncheck').on('mouseover', function() {
    date=$('#date').val();
    site=$('#site-id').val();
    depot=$('#depot_id').val();

    if (date=='' || date==null){
      alert('Veuillez choisir la date', function() {});
      return false ;
    }

    if (site=='' || site==null){
      alert('Veuillez choisir le site', function() {});
      return false ;
    }

    if (depot=='' || depot==null || depot=="Veuillez choisir !!"){
      alert('Veuillez choisir le dépot', function() {});
      return false ;
    }

    index = Number($('#index').val());
    sup = Number($('#sup').val());
  
    if (index == -1) {
      alert('Ajouter une ligne', function() {});
          return false ;
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
        return false ;

      }
    }
    for (i = 0; i <= Number(index); i++) {
      sup = $('#sup' + i).val();

      article_id = $('#article_id' + i).val();

      qte = $('#qte' + i).val();

      if ((article_id == null || article_id == '') && (sup != 1)) {
        alert('Selectionnez un article SVP', function() {});
        return false;
      } else if ((qte == 0 || qte == '') && sup != 1) {
        alert('Ajouter une quantite SVP', function() {});
        return false;
      }
    }


  })
   $('.depot').on('change', function() {
     ///alert('hechem');
     id = $('#site-id').val();
     //alert(id)
     $.ajax({
       method: "GET",
       url: "<?= $this->Url->build(['controller' => 'Inventaires', 'action' => 'getDepotbs']) ?>",
       dataType: "json",
       data: {
         id: id,

       },
       headers: {
         'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
       },
       success: function(data) {

         $('#divdepot').html(data.select);
         $('#depot_id').select2();



       }

     })
   });


   $('.articleQtest').on('change', function() {

     index = $(this).attr('index');
     //alert(index)
     article_id = $('#article_id' + index).val();
     date = $('#date').val();
     depot = $('#depot_id').val();

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

         $('#qtestock' + index).val(data.qtes);
         $('#prix' + index).val(data.prix);
         $('#qte' + index).focus();

       }

     })

   })
   $('.tot').on('keyup', function() {

     ind = Number($('#index').val());
     for (j = 0; j <= ind; j++) {
       qte = Number($('#qte' + j).val()) || 0;
       qtest = Number($('#qtestock' + j).val()) || 0;

       // if (Number(qte) > Number(qtest)) {
       //   alert('La quantité saisie doit etre inferieur à la quantité en stock !! ', function() {});
       //   $('#qte' + j).val('');
       //   $('#total' + j).val(0);

       //   return false;

       // }

       prix = Number($('#prix' + j).val()) || 0;

       tot = Number(qte) * Number(prix);
       $("#total" + j).val(Number(tot).toFixed(3));


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