<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->fetch('script'); ?>
<?php echo $this->Html->script('safa'); ?>
<?php echo $this->Html->script('ajouterlignematrice'); ?>
<?php echo $this->Html->css('select2'); ?>


<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordrefabrication $ordrefabrication
 * @var \Cake\Collection\CollectionInterface|string[] $depots
 * @var \Cake\Collection\CollectionInterface|string[] $pointdeventes
 * @var \Cake\Collection\CollectionInterface|string[] $articles
 */
?>

<section class="content-header">
    <h1>


        Ajout plan commercial Industriel

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <?php echo $this->Form->create(($plancommercialindustriel), ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?> 
    <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box ">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

<div id="my-div" style="overflow-x: scroll;">

                    <div class="box-body">

                        <div class="row">


                            <div class="col-xs-6">
                                <?php echo $this->Form->control('numero', ['label' => 'Numéro', 'required' => 'off', 'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'readonly' => 'readonly', 'value' => $mm]); ?>


                            </div>
                            <div class="col-xs-6">
                                <?php echo $this->Form->control('date', ["value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]) ?>

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <label> Mois Du </label>
                                <select id="moisdu" class="form-control select2 changeM" name="moisdu_id" value="<?php echo $moisdu ?>">
                                    <option value="<?php echo $moisdu ?>" selected="selected">Veuillez choisir </option>
                                    <?php foreach ($mois as $j => $moi) {
                                    ?>
                                        <option <?php if ($moi->id == $moisdu) { ?> selected="selected" <?php } ?> value="<?php echo $moi->id; ?>"><?php echo $moi->name ?></option>
                                    <?php } ?>

                                </select>
                            </div>

                            <div class="col-xs-6">
                                <label> Mois Au </label>
                                <select id="moisau" class="form-control select2  changeM " name="moisau_id" value="<?php echo $moisau ?>">
                                    <option value="<?php echo $moisau ?>" selected="selected">Veuillez choisir </option>
                                    <?php foreach ($mois as $j => $moi) {
                                    ?>
                                        <option <?php if ($moi->id == $moisau) { ?> selected="selected" <?php } ?> value="<?php echo $moi->id; ?>"><?php echo $moi->name ?></option>
                                    <?php } ?>

                                </select>

                            </div>

                        </div>

                        <br>
                        <div class="row">
                            <div class="col-xs-6">

                                <?php echo $this->Form->control('marge', ['required' => 'off', 'id' => 'marge', 'label' => 'Marge(%)', 'div' => 'form-group', 'between' => '<div class="col-sm-10" >', 'after' => '</div>', 'class' => 'form-control ']); ?>
                            </div>
                        </div>

<!-- 
                        <div class="form-group">
                            <div class="pull-right" style="margin-right:50%;margin-top: 20px;">





                            </div>
                        </div> -->


                        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
                            <button class="btn btn-primary alertbtnn  plan afficher" id="afficher" type="button">
                                Afficher
                            </button>
                            <button id="plansub" type='submit' class='btn btn-primary' style='display:none ;'>Enregistrer</button>
                        </div>

                        <br>

                        <div id="divmp">
                        </div>
                        <input type="hidden" id="hechem" value="0">
                        <input type="hidden" id="indexa" value="">

                        <?php echo $this->Form->end(); ?>
                    </div>
</div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>


<!-- <style>
    .select2-selection__rendered {
        line-height: 25px !important;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        border-color: #D2D6DE !important;
    }

    .select2-selection__arrow {
        height: 34px !important;
    }

    .select2-selection__choice {
        height: 24px !important;
        color: black !important;
        background-color: white !important;
        font-size: 18px !important;
    }

    .select2-container {
        display: block;
        width: auto !important;
    }
</style> -->
<style>
input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
}
input[type="number"] {
    -moz-appearance: textfield;
}

</style>


<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    })
</script>
<script>
    $(document).ready(function() {

        // $('.changeM').on('change', function() {


        //     h = $("#hechem").val();
        //     //// alert(h)

        //     if (h == 1) {
        //         $('#plansub').hide();
        //         $('#afficher').show();
        //         $("#hechem").val('0');
        //     }




        // });


        $('.plan').on('click', function() {
            //  alert('hello');
            //index = $(this).attr('index');//alert(index)
            //article_id = $('#article_id' + index).val() || 0;

            moisdu = $("#moisdu").val();
            moisau = $("#moisau").val();
            marge = $("#marge").val();

            //alert(id)
            if (marge == '') {
                alert('Saisi une marge', function() {});
                return false;

            } else if (moisdu == '') {

                alert('Choisir un moi de debut SVP !!', function() {});
                return false;


            } else if (moisau == '') {

                alert('Choisir un moi du fin SVP !!', function() {});
                return false;


            } else if (Number(moisau) < Number(moisdu)) {

                alert('Choisir un moi de debut supérieur au moi du fin', function() {});
                $('#moisau').val('');

                return false;


            } else {
                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Plancommercialindustriels', 'action' => 'getplan']) ?>",
                    dataType: "json",
                    data: {
                        moisau: moisau,
                        moisdu: moisdu,
                        marge:marge,
                        //index:index,

                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function(data, status, settings) {



                        $('#divmp').html(data.res);
                        $('#indexa').val(data.indexa);
                        //alert(data.indexa);
                      //  $('#afficher').attr('style', "display:none;");
                        $('#divmp').show();
                        $('#plansub').show();
                        $("#hechem").val('1');

                    },
                    error: function(data) {
                        //alert(data.res);
                        $('#divmp').html(null);

                    }

                })

            }




        });

        // $('.alertbtnn').on('click', function() {

        //     moisdu = $("#moisdu").val();
        //     moisau = $("#moisau").val();
        //     marge = $("#marge").val();

        //     //alert(id)
        //     if (marge == '') {
        //         alert('Saisi une marge', function () { });
        //         return false ;

        //     } else if (moisdu == '') {

        //         alert('Choisir un moi de debut SVP !!', function () { });
        //         return false ;


        //     } else if (moisau == '') {

        //         alert('Choisir un moi du fin SVP !!' , function () { });
        //         return false ;


        //     } else if (Number(moisau) < Number(moisdu)) {

        //         alert('Choisir un moi de debut supérieur au moi du fin', function () { });
        //         $('#moisau').val('');

        //         return false ;


        //     }

        // });

    });
</script>
<script>
    function prodQte() {

        index = $("#indexa").val();

        for (i = 0; i <= Number(index); i++) {
            qtepratique = $("#lancerpdp" + i).val();

            if (Number(qtepratique) > 0) {
                $("#lancerpdp" + i).val('');
            } else {
                $("#lancerpdp" + i).val('');

            }


        }

    }
 


    function scrollPage() {
        var div = document.getElementById("my-div");
        div.scrollLeft = div.scrollWidth;
    }
    // Appel de la fonction scrollPage() lorsque la page est chargée.
    window.onload = function() {
        scrollPage();
    }
</script>

<?php $this->end(); ?>