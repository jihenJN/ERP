<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Demandeoffredeprix $demandeoffredeprix
 */
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<!--?php echo $this->Html->script('controle_frs'); ?-->
<?php echo $this->Html->css('select2'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Demande offre de prix
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index/' . $typeof]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo __(''); ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($demandeoffredeprix, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box-body">
                    <div class="row">

                        <div class="col-xs-6">
                            <?php echo $this->Form->control('date', ['label' => 'Date', 'empty' => true, 'id' => 'date', 'class' => "form-control pull-right ajoutlignearticle  ajoutlignefournisseur"]);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('numero', ['value' => $b, 'label' => 'Numero', 'required' => 'off', 'id' => 'datecommande', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'readonly' => 'readonly']); ?>
                        </div>
                    </div>


                    <section class="content-header">
                        <h1 class="box-title"><?php echo __('Fournisseurs'); ?></h1>
                    </section>

                    <section class="content" style="width: 99%">
////////
                    <div class=" tab-content" id="fichart" >
  

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <?php echo __('Article'); ?>
            </h3>
            <a class="btn btn-primary ajouterlignematriceee " table='addtablea' index='index'
                tr="tra" style="float: right;  position: relative; top: -25px;"><i class="fa fa-plus-circle"></i></a>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-bottomless" id="addtablea"
                style="width:100%" align="center">
                <thead>
                    <tr bgcolor="#EDEDED">
                        <td width="" align="center">fournisseur</td>
        
                        <td width="" align="center"></td>

                    </tr>
                </thead>
                <tbody>
                    <tr champ="tra" class="tra" style="display:none;">
                        <td align="left">
                            <?php echo $this->Form->input('sup', array('name' => '', 'id' => '', 'champ' => 'sup', 'table' => 'Ofsfligne', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                            <div style="margin-top:10px">
                                <!--?php echo $this->Form->input('fournisseur_id', array('empty' => 'Veuillez choisir', 'label' => '', 'id' => 'fournisseur_id', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'fournisseur_id', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '')); ?-->
                                <?php echo $this->Form->control('fournisseur_id', array('empty' => 'Veuillez choisir','options' =>  $fournisseurs, 'label' => '', 'id' => 'fournisseur_id', 'name' => '', 'table' => 'Ofsfligne', 'champ' => 'fournisseur_id', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                               
                            </div>
                             <!--?php echo $this->Form->control('a', array('label' => '', 'options' =>  $fournisseurs, 'name' => '', 'id' => 'fournisseur_id', 'class' => 'form-control ', 'champ' => 'fournisseur_id', 'table' => 'lignef', 'empty' => 'Veuillez Choisir !!')); ?-->
                        </td>

                   
                        <td align="center">
                            <i index="" class="fa fa-times supor"
                                style="color: #c9302c;font-size: 22px;">
                        </td>
                    </tr>
                    <tr class="traa" champ='traa' style="display:none">
                        <td width='30%'></td>
                        <td champ="afef" class="afef" colspan="3" id="" index="">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <?php echo __('Article'); ?>
                                    </h3>
                                    <a class="btn btn-primary ajouterligne1 " tabletype='addtableaa'
                                        indexlignetype='indexa' trtype="traaa" style="
                                       float: right; 
                                       position: relative;
                                       top: -25px;
                                       "><i class="fa fa-plus-circle"></i> </a>
                                </div>
                                <div class="panel-body">
                                    <table
                                        class="table table-bordered table-striped table-bottomless"
                                        index="" indexligne='indexa' champ="addtableaa" id=""
                                        style="width:100%" align="center">
                                        <thead>
                                            <tr bgcolor="#EDEDED">
                                                <td align="center">Article</td>
                                                <td align="center">Qte</td>
                                              

                                                <td align="center"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="traaa" style="display:none;" id="traaa"
                                                champ='traaa' index="">
                                                <td>
                                                    <?php echo $this->Form->input('supp2', array('name' => '', 'type' => 'hidden', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'supp2', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    <div style="margin-top:5px">
                                                        <!--?php echo $this->Form->input('article_id', array('name' => '', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'article_idt', 'id' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px"));
                                                        ?-->
                                                         <?php echo $this->Form->control('art_id', array('name' => '', 'label' => '', 'options' => $articles,'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'art_id', 'id' => 'art_id', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => '', 'empty' => 'Veuillez Choisir !!', "style" => "width:100% ; height:32px",));
                                                        ?>
                                                    </div>
                                                    <!--?php echo $this->Form->control('a', array('label' => '', 'options' => $articles, 'index' => '', 'name' => '', 'id' => 'article_id', 'champ' => 'article_id', 'table' => 'lignea', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control')); ?-->
                                                </td>
                                                <td>
                                                    <?php echo $this->Form->input('qte', array('name' => '', 'label' => '', 'indexligne' => '', 'index' => '', 'table' => 'Ofsfligne', 'tableligne' => 'Phaseofsf', 'champ' => 'qte', 'id' => 'qte', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                    ?>
                                                </td>
                                        
                                          
                                                <td align="center">
                                                    <i indexligne="" index=""
                                                        class="fa fa-times supor2"
                                                        style="color: #c9302c;font-size: 22px;">
                                                </td>
                                            </tr>
                                       
                                        </tbody>
                                    </table>
                                    <input type="hidden" value="-1" class="" id="" champ="indexa" />
                                </div>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
            <input type="hidden" value="-1" id="index" />
        </div>
    </div>
</div>

</section>












                    <div align="center" id="enr3" class="index">
                        <?php //echo $this->Form->submit(__('Enregistrer')); 
                        ?>
                        <button type="submit" class="pull-right btn btn-success btn-sm" id="" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
            <!-- /.box -->
        </div>

</section>
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
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-d    a        t              epicker.min', ['block' => 'script']); ?>
<!-- bootstrap color picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
<!-- bootstrap time picker -->
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {
        $(".ajouterligne1ligne").on('click', function () {
    table = $(this).attr('table'); //alert(table+" table");
    index = $(this).attr('indexligneligne');

    //alert(index)
    //i = $(this).attr('indexligne');
    //alert(i)

    itd = $(this).attr('index');
    itd1 = $(this).attr('indexligne');

    $('#tdcompp').show();
    $('#tdcompp'+itd+'-'+itd1 ).show();

    //alert(index+" indexligneligne") ;      
    tr = $(this).attr('tr'); //alert(tr+" tr") ;    
    //alert(tr)
    ind = Number($('#' + index).val()) + 1; //alert(ind+" ind");
    $('#' + index).val(ind);

    $ttr = $('#' + table).find('.' + tr).clone(true); //alert(tr)
    //     $ttr = $('#traaligne1-0' ).find('.traaaligne').clone(true);console.log($ttr);
    $ttr.attr('class', '');
    i = 0; //alert(i)
    tabb = [];//alert(tabb)
    vc = 0;
    tabd = [];
    //  alert( $ttr.find())
    $ttr.find('input,control,select,div,td,textarea,a,tr,table,i').each(function () {


      tab = $(this).attr('table');//alert(tab+"tab")
      champ = $(this).attr('champ');// alert(champ+"champ")
      tableligneligne = $(this).attr('tableligneligne');//alert(tableligneligne+"tableligneligne")
      tableligne = $(this).attr('tableligne');//alert(tableligne+"tableligne")
      index = $(this).attr('index');//alert(index)
      indexligne = $(this).attr('indexligne');
      //alert(indexligne+"indexligne")
      indexligneligne = $(this).attr('indexligneligne');
      if (champ == 'article_idd') {
        //              alert(index+'index');
        //              alert(ind+'indexligne');
      }
      //alert('index'+index);alert('tableligne'+tableligne)
      $(this).attr('indexligneligne', ind);
      $(this).attr('id', champ + index + '-' + indexligne + '-' + ind);
      $(this).attr('name', 'data[' + tab + '][' + index + '][' + tableligne + '][' + indexligne + '][' + tableligneligne + '][' + ind + '][' + champ + ']');
      $(this).attr('data-bv-field', 'data[' + tab + '][' + index + '][' + tableligne + '][' + indexligne + '][' + tableligneligne + '][' + ind + '][' + champ + ']');
      $(this).removeClass('anc');
      if ($(this).is('select')) {

        tabb[i] = champ + index + '-' + indexligne + '-' + ind;
        // alert(tabb[i]);
        i = Number(i) + 1;

      }

      // alert($(this).attr('class'));

      //  $(this).val('');
    }
    )
    index = $(this).attr('index');  //alert(index);
    indexligne = $(this).attr('indexligne');//alert(indexligne);
    ///  alert(indexligne)
    $ttr.find('i').each(function () {
      $(this).attr('index', index);
    });
    $ttr.find('i').each(function () {

      $(this).attr('indexligne', indexligne);
      $(this).attr('indexligneligne', ind);
      //alert(indexligne);
    });

    //   $("#article_idd" +index+'-'+indexligne+'-'+ ind).data('select2').destroy();

    $ttr.attr('style', '');
    $('#' + table).append($ttr);
    $('#' + index).val(ind);
    $('#' + table).find('tr:last').show();

    index = $(this).attr('index');//alert(index+'index');
    indexligne = Number($('#indexa' + index).val());//alert(indexligne+'indexligne');
    //$("#article_idd" +index+'-'+indexligne+'-'+ ind).select2("destroy");
    //            $('input[type=button]').click(function () {
    //
    //   
    //    var noOfDivs = $('.tooltest0').length;
    //    var clonedDiv = $('.tooltest0').first().clone(true);
    //    clonedDiv.insertBefore("#tool-placeholder");
    //    clonedDiv.attr('id', 'tooltest' + noOfDivs);
    //    
    //
    //    $('.toollist').select2({ //apply select2 to my element
    //        placeholder: "Search your Tool",
    //        allowClear: true
    //    });
    //
    //
    //
    //});
    //  alert(ind+"ind")
    //         window.setTimeout(function(){
    //  $('select').select2('destroy');
    //}, 3000);

    $ttr.find('i').each(function () {
      $(this).attr('indexligneligne', ind);
    });
    index = Number($('#index').val());//alert(index+'index');
    indexligne = Number($('#indexa' + index).val());

    $("#article_idd" + index + '-' + indexligne + '-' + ind).select2({
      width: '100%' // need to override the changed default
    })


    $("#unite_id" + index + '-' + indexligne + '-' + ind).select2({
      width: '100%' // need to override the changed default
    })

    $ttr.attr('style', '');
    $('#' + table).append($ttr);
    //           $("#article_idd"+index+'-'+indexligne+'-'+ ind).select2('destroy');      
    //                $("#article_idd" +index+'-'+indexligne+'-'+ ind).select2({
    //            width: '100%' // need to override the changed default
    //        }); 
    // $('#' + indexligne).val(ind);  
    // alert($ttr);
    // $('#' + table).find('tr:last').show();
    for (j = 0; j <= i; j++) {
      // uniform_select(tabb[j]);
      // uniform_select(tabd[j]);      
    }
 
  });












  $(".ajouterligne1").on('click', function () {
    table = $(this).attr('table');
    index = $(this).attr('indexligne');
  
    itd = $(this).attr('index');//alert(itd);

    $('#tdcomp').show();
    $('#tdcomp'+itd).show();
    tr = $(this).attr('tr'); //alert(tr) ;
    ind = Number($('#' + index).val()) + 1; //alert(ind);
    $('#' + index).val(ind);
    $ttr = $('#' + table).find('.' + tr).clone(true); //console.log($ttr);
    $ttr.attr('class', '');
    i = 0;
    tabb = [];
    vc = 0;
    tabd = [];
    $ttr.find('a,input,control,select,div,td,textarea,tr,table,i').each(function () {
      //alert($ttr.find('a'));
      tab = $(this).attr('table'); //alert(tab);
      champ = $(this).attr('champ');// console.log(champ);
      tableligne = $(this).attr('tableligne'); //alert(tableligne);
      tableligneligne = $(this).attr('tableligneligne'); //alert(tableligneligne);
      index = $(this).attr('index');//alert('index'+index);
      indexligne = $(this).attr('indexligne');
      indexligneligne = $(this).attr('indexligneligne');
     /// console.log(indexligneligne);
      if (champ == 'article_id') {
        //              alert(index+'index');
        //              alert(ind+'indexligne');

          //alert(champ)
        //alert('index'+index);alert('tableligne'+tableligne)
        //alert(index+'inddexx')
        //alert(ind+'inddds')
        $(this).attr('indexligne', ind); // alert( $(this).attr('indexligne'));
        $(this).attr('index', index); //alert( $(this).attr('index'));
        $(this).attr('id', champ + index + '-' + ind);//alert( $(this).attr('id'));
        $(this).attr('name', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' + champ + ']');
        $(this).attr('data-bv-field', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' + champ + ']');
        $(this).removeClass('anc');
      }
      if (champ == 'qte') {
        //              alert(index+'index');
        //              alert(ind+'indexligne');

       // alert(champ)
        //alert('index'+index);alert('tableligne'+tableligne)

        $(this).attr('indexligne', ind); 
        $(this).attr('index', index); //alert( $(this).attr('index'));
        $(this).attr('id', champ + index + '-' + ind);//alert( $(this).attr('id'));
        $(this).attr('name', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' + champ + ']');
        $(this).attr('data-bv-field', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' + champ + ']');
        $(this).removeClass('anc');
      }

      if (champ == 'art_id') {
        //              alert(index+'index');
        //              alert(ind+'indexligne');

      
        //alert('index'+index);alert('tableligne'+tableligne)
       
        $(this).attr('indexligne', ind); 
        $(this).attr('index', index); //alert( $(this).attr('index'));
        $(this).attr('id', champ + index + '-' + ind);//alert( $(this).attr('id'));
        $(this).attr('name', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' + champ + ']');
        $(this).attr('data-bv-field', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' + champ + ']');
        $(this).removeClass('anc');
      }





      if (champ == 'coeff') {
        //              alert(index+'index');
        //              alert(ind+'indexligne');

        //    alert(champ)
        //alert('index'+index);alert('tableligne'+tableligne)

        $(this).attr('indexligne', ind); // alert( $(this).attr('indexligne'));
        $(this).attr('index', index); //alert( $(this).attr('index'));
        $(this).attr('id', champ + index + '-' + ind);//alert( $(this).attr('id'));
        $(this).attr('name', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' + champ + ']');
        $(this).attr('data-bv-field', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' + champ + ']');
        $(this).removeClass('anc');
      }
      if (champ == 'unite_id') {
      
        $(this).attr('indexligne', ind); // alert( $(this).attr('indexligne'));
        $(this).attr('index', index); //alert( $(this).attr('index'));
        $(this).attr('id', champ + index + '-' + ind);//alert( $(this).attr('id'));
        $(this).attr('name', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' + champ + ']');
        $(this).attr('data-bv-field', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' + champ + ']');
        $(this).removeClass('anc');
      }
      if (champ == 'article_idt') {
        //              alert(index+'index');
        //              alert(ind+'indexligne');

        //    alert(champ)
        //alert('index'+index);alert('tableligne'+tableligne)

        $(this).attr('indexligne', ind); // alert( $(this).attr('indexligne'));
        $(this).attr('index', index); //alert( $(this).attr('index'));
        $(this).attr('id', champ + index + '-' + ind);//alert( $(this).attr('id'));
        $(this).attr('name', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' + champ + ']');
        $(this).attr('data-bv-field', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' + champ + ']');
        $(this).removeClass('anc');
      }
	  if (champ == 'unite_idt') {
      
        $(this).attr('indexligne', ind); // alert( $(this).attr('indexligne'));
        $(this).attr('index', index); //alert( $(this).attr('index'));
        $(this).attr('id', champ + index + '-' + ind);//alert( $(this).attr('id'));
        $(this).attr('name', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' + champ + ']');
        $(this).attr('data-bv-field', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' + champ + ']');
        $(this).removeClass('anc');
      }
      if (champ == 'supp2') {
        //              alert(index+'index');
        //              alert(ind+'indexligne');

        //    alert(champ)
        //alert('index'+index);alert('tableligne'+tableligne)

        $(this).attr('indexligne', ind); // alert( $(this).attr('indexligne'));
        $(this).attr('index', index); //alert( $(this).attr('index'));
        $(this).attr('id', champ + index + '-' + ind);//alert( $(this).attr('id'));
        $(this).attr('name', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' + champ + ']');
        $(this).attr('data-bv-field', 'data[' + tab + '][' + index + '][' + tableligne + '][' + ind + '][' + champ + ']');
        $(this).removeClass('anc');
      }



      if ($(this).is('select')) {
        tabb[i] = champ + index + '-' + ind;
        // alert(tabb[i]);
        i = Number(i) + 1;
      }

      if ($(this).hasClass('ajouterligne1ligne')) {
        tabletypeligne = $(this).attr('tabletypeligne');//alert(tabletypeligne+"tabletypeligne")
        indexlignetypeligne = $(this).attr('indexlignetype');//alert(indexlignetypeligne+"tabletypeligne")
        trtypeligne = $(this).attr('trtypeligne');//alert(trtypeligne+"trtypeligne")
        // tabletype='addtablea' index ='' indexlignetype='indexa' trtype="tra"
        $(this).attr('table', tabletypeligne + index + '-' + ind);
        $(this).attr('indexligneligne', indexligneligne + index + '-' + ind);
        $(this).attr('tr', trtypeligne + index + '-' + ind);

      }


      ///////////////
      if ($(this).hasClass('indexaligne1')) {
        indextype = $(this).attr('indextype');
        $(this).attr('id', indextypeligne + index + '-' + ind);
      }
      if ($(this).hasClass('traaligne')) {
        $(this).attr('id', 'traaligne' + index + '-' + ind);
        // $(this).attryle','display:none;');
      }
      // alert(champ+"champ");
      if ($(this).hasClass('traaaligne')) {
        //  alert(afefef)
        $(this).attr('id', 'traaaligne' + index + '-' + ind);
        $(this).attr('style', 'display:none;');
      }
    

    })
    $ttr.find('i').each(function () {
      $(this).attr('indexligne', ind);
    });
    $ttr.attr('style', '');




    $('#' + table).append($ttr);

   

    for (j = 0; j <= i; j++) {
        
    }
    $ttr = $('#' + table).find('.traaligne').clone(true);//console.log($ttr);
    $ttr.attr('class', '');
    i = 0;
    tabb = [];
    vc = 0;
    tabd = [];
    $ttr.find('input,control,select,div,td,textarea,tr,a,table,i').each(function () {
      tab = $(this).attr('table');//alert(tab+"rabb")
      champ = $(this).attr('champ');//console.log(champ); 
      index = $(this).attr('index');//console.lfog(champ);
      $(this).attr('index', ind);
      $(this).attr('id', champ + ind);
      $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
      $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
      if (champ == 'article_id') {
        //   $(this).attr('indexligne', 0);
        $(this).attr('indexligneligne', 0);
        $(this).attr('indexligne', ind);
        $(this).attr('index', index);
        // alert(champ+'champ')
        // alert(index+'index')
        //alert(ind+'ind')
        $(this).attr('id', champ + index + '-' + ind + '-0');
        tabb[i] = champ + index + '-' + ind + '-0';
        i = Number(i) + 1;
        // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
        $(this).attr('name', ' data[Ofsfligne][' + index + '][Phaseofsf][' + ind + '][Phaseofsfligne][0][' + champ + ']');
        $(this).attr('data-bv-field', 'data[Ofsfligne][' + index + '][Phaseofsf][' + ind + '][Phaseofsfligne][0][' + champ + ']');
      }
      if (champ == 'addtableaaligne') {
        $(this).attr('indexligneligne', 0);
        $(this).attr('indexligne', 0);
        $(this).attr('index', ind);
        $(this).attr('id', champ + index + '-' + ind);
        tabb[i] = champ + index + '-' + ind + '-0';
        i = Number(i) + 1;
      }


      if (champ == 'qte'||champ =='art_id') {
        $(this).attr('indexligneligne', 0);
        $(this).attr('indexligne', ind); //alert($(this).attr('indexligne'));
        $(this).attr('index', index);
       
        // alert(index+'index')
        //alert(ind+'ind')

        $(this).attr('id', champ + index + '-' + ind + '-0');
        tabb[i] = champ + index + '-' + ind + '-0';
        i = Number(i) + 1;
        // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
        $(this).attr('name', ' data[Ofsfligne][' + index + '][Phaseofsf][' + ind + '][Phaseofsfligne][0][' + champ + ']'); //alert($(this).attr('name'));
        $(this).attr('data-bv-field', 'data[Ofsfligne][' + index + '][Phaseofsf][' + ind + '][Phaseofsfligne][0][' + champ + ']');
      }
      if (champ == 'coeff') {
        $(this).attr('indexligneligne', 0);
        $(this).attr('indexligne', ind); //alert($(this).attr('indexligne'));
        $(this).attr('index', index);
        // alert(champ+'champ')
        // alert(index+'index')
        //alert(ind+'ind')

        $(this).attr('id', champ + index + '-' + ind + '-0');
        tabb[i] = champ + index + '-' + ind + '-0';
        i = Number(i) + 1;
        // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
        $(this).attr('name', ' data[Ofsfligne][' + index + '][Phaseofsf][' + ind + '][Phaseofsfligne][0][' + champ + ']'); //alert($(this).attr('name'));
        $(this).attr('data-bv-field', 'data[Ofsfligne][' + index + '][Phaseofsf][' + ind + '][Phaseofsfligne][0][' + champ + ']');
      }
      if (champ == 'unite_id') {
        $(this).attr('indexligneligne', 0);
        $(this).attr('indexligne', ind); //alert($(this).attr('indexligne'));
        $(this).attr('index', index);
        // alert(champ+'champ')
        // alert(index+'index')
        //alert(ind+'ind')

        $(this).attr('id', champ + index + '-' + ind + '-0');
        tabb[i] = champ + index + '-' + ind + '-0';
        i = Number(i) + 1;
        // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
        $(this).attr('name', ' data[Ofsfligne][' + index + '][Phaseofsf][' + ind + '][Phaseofsfligne][0][' + champ + ']'); //alert($(this).attr('name'));
        $(this).attr('data-bv-field', 'data[Ofsfligne][' + index + '][Phaseofsf][' + ind + '][Phaseofsfligne][0][' + champ + ']');
      }
      if (champ == 'article_idd') {
        $(this).attr('indexligneligne', 0);
        $(this).attr('indexligne', ind); //alert($(this).attr('indexligne'));
        $(this).attr('index', index);
        // alert(champ+'champ')
        // alert(index+'index')
        //alert(ind+'ind')

        $(this).attr('id', champ + index + '-' + ind + '-0');
        tabb[i] = champ + index + '-' + ind + '-0';
        i = Number(i) + 1;
        // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
        $(this).attr('name', ' data[Ofsfligne][' + index + '][Phaseofsf][' + ind + '][Phaseofsfligne][0][' + champ + ']'); //alert($(this).attr('name'));
        $(this).attr('data-bv-field', 'data[Ofsfligne][' + index + '][Phaseofsf][' + ind + '][Phaseofsfligne][0][' + champ + ']');
      }
if (champ == 'unite_idd') {
        $(this).attr('indexligneligne', 0);
        $(this).attr('indexligne', ind); //alert($(this).attr('indexligne'));
        $(this).attr('index', index);
        // alert(champ+'champ')
        // alert(index+'index')
        //alert(ind+'ind')

        $(this).attr('id', champ + index + '-' + ind + '-0');
        tabb[i] = champ + index + '-' + ind + '-0';
        i = Number(i) + 1;
        // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
        $(this).attr('name', ' data[Ofsfligne][' + index + '][Phaseofsf][' + ind + '][Phaseofsfligne][0][' + champ + ']'); //alert($(this).attr('name'));
        $(this).attr('data-bv-field', 'data[Ofsfligne][' + index + '][Phaseofsf][' + ind + '][Phaseofsfligne][0][' + champ + ']');
      }

      if ($(this).hasClass('supor2')) {
        //alert('afefefef')
        // tabletype='addtablea' index ='' indexlignetype='indexa' trtype="tra"
        $(this).attr('indexligne', ind);
        $(this).attr('index', index);
      }






      if (champ == 'supp3') {
        $(this).attr('indexligneligne', 0);
        $(this).attr('indexligne', ind);
        $(this).attr('index', index);
        //  alert( $(this).attr('index'));
        //   alert( $(this).attr('indexligne'));
        //     alert( $(this).attr('indexligneligne'));


        // alert(champ+'champ')
        // alert(index+'index')
        //alert(ind+'ind')

        $(this).attr('id', champ + index + '-' + ind + '-0');
        tabb[i] = champ + index + '-' + ind + '-0';
        i = Number(i) + 1;
        // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
        $(this).attr('name', ' data[Ofsfligne][' + index + '][Phaseofsf][' + ind + '][Phaseofsfligne][0][' + champ + ']');
        $(this).attr('data-bv-field', 'data[Ofsfligne][' + index + '][Phaseofsf][' + ind + '][Phaseofsfligne][0][' + champ + ']');
      }
      if ($(this).hasClass('supor3')) {
        //alert('ind')
        //alert('afefefef')
        // tabletype='addtablea' index ='' indexlignetype='indexa' trtype="tra"
        $(this).attr('indexligneligne', 0);
        $(this).attr('indexligne', ind);
        $(this).attr('index', index);
      }

      //            $(this).removeClass('anc');
      //            if ($(this).is('select')) {
      //                tabb[i] = champ + ind;
      //                // alert(tabb[i]);
      //                i = Number(i) + 1;
      //            }
      //alert($(this).hasClass('ajouterligne1ligne'))
      /////////////////////////////////////////
      if ($(this).hasClass('ajouterligne1ligne')) {
        tabletypeligne = $(this).attr('tabletypeligne');//alert(tabletypeligne+"tabletypeligne")
        indexlignetypeligne = $(this).attr('indexlignetypeligne');//alert(indexlignetypeligne+"tabletypeligne")

        trtypeligne = $(this).attr('trtypeligne');//alert(trtypeligne+"trtypeligne")
        // tabletype='addtablea' index ='' indexlignetype='indexa' trtype="tra"
        $(this).attr('table', tabletypeligne + index + '-' + ind);
        $(this).attr('indexligneligne', indexlignetypeligne + index + '-' + ind);
        $(this).attr('tr', trtypeligne + index + '-' + ind);

      }

      if (champ == 'indexaligne') {
        // if ($(this).hasClass('indexaligne')) {
        indextypeligne = $(this).attr('indexligneligne');
        //alert(indextypeligne+'jjjjjjj')
        $(this).attr('id', champ + index + '-' + ind);
      }
      //alert(champ)
      if ($(this).hasClass('traaligne')) {
        $(this).attr('id', 'traaligne' + index + '-' + ind);
        // $(this).attr('style','display:none;');
      }
      // alert($(this).hasClass)
      if ($(this).hasClass('traaaligne')) {

        $(this).attr('id', 'traaaligne' + index + '-' + ind);
        $(this).attr('class', 'traaaligne' + index + '-' + ind);
        // $("#traaaligne"+index+'-'+ind).parent().hide();
        //  $("#traaaligne" +index+'-'+ind).parent().hide();
        $(this).attr('style', "display:none;important");
      }
      /////////////////////////////////

      /////////////////
      //              if ($(this).hasClass('traaa')) {
      //                
      //                 $(this).attr('class','traaa'+ind);
      //                 $(this).attr('id','traaa'+ind);
      //             }
      //  $(this).val('');
    })
    $ttr.find('i').each(function () {
      $(this).attr('index', ind);
    });
    $ttr.attr('style', '');
    $('#' + table).append($ttr);
    $('#' + index).val(ind);
    index = $(this).attr('index');//alert(index)
    indexligne = $(this).attr('indexligne');
    $('#' + table).find('tr:last').show();
    // alert(index)
    //  alert(ind)
    //   console.log("#article_id" +index+'-'+'0')
    //           $('select').select2({
    //            width: '100%' // need to override the changed default
    //        });addClass('sirine');

    $("#article_idt" + index + '-' + ind).
      select2({
        width: '100%' // need to override the changed default
      });


    $("#unite_idt" + index + '-' + ind).
      select2({
        width: '100%' // need to override the changed default
      });
    sup3(index, ind)
    //  $("#article_idd" +index+'-'+ind+'-0').
    //                select2({
    //            width: '100%' // need to override the changed default
    //        });
    // for (j = 0; j <= i; j++) {
    //  uniform_select(tabb[j]);
    //     }
    // alert('#date_debut'+ind);
    //                 $('#date_debut'+ind).datetimepicker({
    //        timepicker: false,
    //        datepicker:true,
    //        mask:'39/19/9999',
    //        format:'d/m/Y'});
    //        for (k 
    //        = 0; k <= vc; k++) {
    //            // alert(tabd[k])
    //            $('#' + tabd[k]).datetimepicker({
    //                timepicker: false,
    //                datepicker: true,
    //                mask: '39/19/9999',
    //                format: 'd/m/Y'});
    //        }
  });

  $(".ajouterlignematriceee").on('click', function () {
    //alert();
    table = $(this).attr('table');//id table
    index = $(this).attr('index') || 0;// id max compteur
    tr = $(this).attr('tr'); //class class type
    ind = Number($('#' + index).val()) + 1;
    $('#' + index).val(ind);
    $ttr = $('#' + table).find('.' + tr).clone(true);//console.log($ttr);
    $ttr.attr('class', '');
    i = 0;
    tabb = [];
    vc = 0;
    tabd = [];
    $ttr.find('input,select,div,td,textarea,tr,a,table,i').each(function () {
      tab = $(this).attr('table');
      champ = $(this).attr('champ');//console.log(champ);

      $(this).attr('index', ind);
      $(this).attr('id', champ + ind);
      $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
      $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
      if (tab == 'Ligneinventaire' && champ == 'article_id') {
        $(this).attr('onchange', 'artcilecode(this.value,' + ind + ')');
      }
      $(this).removeClass('anc');
      if ($(this).is('select')) {
        tabb[i] = champ + ind;
        // alert(tabb[i]);
        i = Number(i) + 1;
      }
      if ($(this).hasClass('ajouterligne1')) {
        tabletype = $(this).attr('tabletype');
        indexlignetype = $(this).attr('indexlignetype');

        trtype = $(this).attr('trtype');
        // tabletype='addtablea' index ='' indexlignetype='indexa' trtype="tra"
        $(this).attr('table', tabletype + ind);
        $(this).attr('indexligne', indexlignetype + ind);
        $(this).attr('tr', trtype + ind);

      }

      if ($(this).hasClass('indexa1')) {

        indextype = $(this).attr('indextype');
        $(this).attr('id', indextype + ind);
      }
      if ($(this).hasClass('traa')) {


        $(this).attr('id', 'traa' + ind);
        // $(this).attryle','display:none;');
      }
      if ($(this).hasClass('traaa')) {


        $(this).attr('id', 'traaa' + ind);
        $(this).attr('style', 'display:none;');
      }

      // alert($(this).attr('class')); tra
      if ($(this).hasClass('date')) {
        tabd[vc] = champ + ind;
        //alert(tabd[vc]);
        vc = Number(vc) + 1;
      }
      //  $(this).val('');

    })
    $ttr.find('i').each(function () {
      $(this).attr('index', ind);
    });
    $ttr.attr('style', '');
    $('#' + table).append($ttr);
    $('#' + index).val(ind);
    $('#' + table).find('tr:last').show();
    $("#article_id" + ind).select2({
      width: '100%' // need to override the changed default
    });
    $("#unite_id" + ind).select2({
      width: '100%' // need to override the changed default
    });

    //                $("#article_id" +ind+'0').select2({
    //            width: '100%' // need to override the changed default
    //        });
    //    alert(index+'ggindex')
    //        alert(ind+'ind')
    //        console.log("#article_id" +ind+'-'+'0');
    //       $("#article_id" +ind+'-'+'0').select2({
    //            width: '100%' // need to override the changed default
    //        });
    for (j = 0; j <= i; j++) {
      //  uniform_select(tabb[j]);
    }

    // alert('#date_debut'+ind);
    //                 $('#date_debut'+ind).datetimepicker({
    //        timepicker: false,
    //        datepicker:true,
    //        mask:'39/19/9999',
    //        format:'d/m/Y'});
    //        for (k = 0; k <= vc; k++) {
    //            // alert(tabd[k])
    //            $('#' + tabd[k]).datetimepicker({
    //                timepicker: false,
    //                datepicker: true,
    //                mask: '39/19/9999',
    //                format: 'd/m/Y'});
    //        }
    // ajouter  desueimme ligne

    $ttr = $('#' + table).find('.traa').clone(true);//console.log($ttr);
    $ttr.attr('class', '');
    i = 0;
    tabb = [];
    vc = 0;
    tabd = [];
    $ttr.find('input,select,div,td,textarea,tr,a,table,i').each(function () {
      tab = $(this).attr('table');
      champ = $(this).attr('champ');//console.log(champ);
      $(this).attr('index', ind);
      $(this).attr('id', champ + ind);
      $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
      $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
      ////article_id
      if (champ == 'article_id') {

        $(this).attr('indexligne', 0);
        $(this).attr('index', ind);
        $(this).attr('id', champ + ind + '-' + '0');
        tabb[i] = champ + ind + '-' + '0';
        i = Number(i) + 1;
        // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
        $(this).attr('name', ' data[Ofsfligne][' + ind + '][Phaseofsf][0][' + champ + ']');
        $(this).attr('data-bv-field', 'data[Ofsfligne][' + ind + '][Phaseofsf][0][' + champ + ']');

      }


      if (champ == 'qte') {

        $(this).attr('indexligne', 0);
        $(this).attr('index', ind);
        $(this).attr('id', champ + ind + '-' + '0');
        tabb[i] = champ + ind + '-' + '0';
        i = Number(i) + 1;
        // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
        $(this).attr('name', ' data[Ofsfligne][' + ind + '][Phaseofsf][0][' + champ + ']');
        $(this).attr('data-bv-field', 'data[Ofsfligne][' + ind + '][Phaseofsf][0][' + champ + ']');
      }
      if (champ == 'art_id') {
        //              alert(index+'index');
        //              alert(ind+'indexligne');

        //alert('index'+index);alert('tableligne'+tableligne)
        $(this).attr('indexligne', 0); // alert( $(this).attr('indexligne'));
        $(this).attr('index', ind); //alert( $(this).attr('index'));
        $(this).attr('id', champ + ind +  '-0' );//alert( $(this).attr('id'));
        tabb[i] = champ + ind + '-' + '0';
        i = Number(i) + 1;
        $(this).attr('name', 'data[' + tab + ']['+ind+'][Phaseofsf][0][' + champ + ']');
        $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][Phaseofsf][0][' + champ + ']');
        $(this).removeClass('anc');
      }

      if (champ == 'coeff') {

        $(this).attr('indexligne', 0);
        $(this).attr('index', ind);
        $(this).attr('id', champ + ind + '-' + '0');
        tabb[i] = champ + ind + '-' + '0';
        i = Number(i) + 1;
        // data[Ligneordrefab][0][Phaseordrefabrication][1][personnel_id]
        $(this).attr('name', ' data[Ofsfligne][' + ind + '][Phaseofsf][0][' + champ + ']');
        $(this).attr('data-bv-field', 'data[Ofsfligne][' + ind + '][Phaseofsf][0][' + champ + ']');
      }


      if (champ == 'phaseproduction_id') {
        $(this).attr('indexligne', 0);
        $(this).attr('index', ind);
        $(this).attr('id', champ + ind + '-' + '0');
        tabb[i] = champ + ind + '-' + '0';
        i = Number(i) + 1;
        $(this).attr('name', ' data[Ofsfligne][' + ind + '][Phaseofsf][0][' + champ + ']');
        $(this).attr('data-bv-field', 'data[Ofsfligne][' + ind + '][Phaseofsf][0][' + champ + ']');
      }
      if (champ == 'supp') {
        $(this).attr('indexligne', 0);
        $(this).attr('index', ind);
        $(this).attr('id', champ + ind + '-' + '0');
        tabb[i] = champ + ind + '-' + '0';
        i = Number(i) + 1;
        $(this).attr('name', ' data[Ofsfligne][' + ind + '][Phaseofsf][0][' + champ + ']');
        $(this).attr('data-bv-field', 'data[Ofsfligne][' + ind + '][Phaseofsf][0][' + champ + ']');
      }
      if (tab == 'Ligneinventaire' && champ == 'article_id') {
        $(this).attr('onchange', 'artcilecode(this.value,' + ind + ')');
      }
      //            $(this).removeClass('anc');
      //            if ($(this).is('select')) {
      //                tabb[i] = champ + ind;
      //                // alert(tabb[i]);
      //                i = Number(i) + 1;
      //            }
      if ($(this).hasClass('ajouterligne1')) {
        tabletype = $(this).attr('tabletype');
        indexlignetype = $(this).attr('indexlignetype');
        trtype = $(this).attr('trtype');
        // tabletype='addtablea' index ='' indexlignetype='indexa' trtype="tra"
        $(this).attr('table', tabletype + ind);
        $(this).attr('indexligne', indexlignetype + ind);
        $(this).attr('tr', trtype + ind);
      }
      if ($(this).hasClass('traa')) {
        $(this).attr('id', 'traa' + ind);
        // $(this).attr('style','display:none;');
      }
      if ($(this).hasClass('traaa')) {
        $(this).attr('id', 'traaa' + ind);
        $(this).attr('class', 'traaa' + ind);
        $(this).attr('style', 'display:none;');
      }
      if ($(this).hasClass('indexa1')) {

        indextype = $(this).attr('indextype');
        $(this).attr('id', indextype + ind);
      }
      //              if ($(this).hasClass('traaa')) {
      //                
      //                 $(this).attr('class','traaa'+ind);
      //                 $(this).attr('id','traaa'+ind);
      //             }

      //  $(this).val('');

    })
    $ttr.find('i').each(function () {
      $(this).attr('index', ind);

    });
    $ttr.attr('style', '');
    $('#' + table).append($ttr);
    $('#' + index).val(ind);
    $('#' + table).find('tr:last').show();
    // alert(ind)
    $("#article_id" + ind).select2({
      width: '100%' // need to override the changed default
    });
    //$('#' + table).find('tr:last .traa').attr('style', 'display:none');
    for (j = 0; j <= i; j++) {
      // uniform_select(tabb[j]);

    }


  });

        //Initialize Select2 Elements
        $('.select2').select2()
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()
        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: ' MM/DD/YYYY h:mm A'
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
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
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
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
</script>




<?php $this->end(); ?>