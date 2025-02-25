<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<!-- <style>
    th {
  position: sticky !important;
  
}
</style> -->
<style>
    /*     table tbody,
    table thead {
        display: block;
    }

    table tbody {
        overflow: auto;
        height: 500px;
    } */

    /*  @media (min-width: 1201px) {
  td,th {
    width: 50%;
  }
}  */
    /* td
{
    width: 11%;
}
th {
    width: 11%;

} */
</style>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php

use Cake\Datasource\ConnectionManager;
?>

<section class="content-header">
    <header>
        <h1 style="text-align:center;">Bon de commande retour marchandise</h1>
    </header>
</section>


<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_achat' . $abrv);
// debug($lien);die;
foreach ($lien as $k => $liens) {
    if (@$liens['lien'] == 'commandes') {
        $add = $liens['ajout'];
        $edit = $liens['modif'];
        $delete = $liens['supp'];
        $valide = $liens['valide'];
        $imp = $liens['imprimer'];
    }
    //debug($liens);die;
}


if ($add == 1) {
?>
    <div class="pull-left" style="margin-left:25px;margin-top: 20px">
    </div>
<?php } ?>
<br> <br><br>


<section class="content-header">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
    <h1>
        Recherche
    </h1>

</section>
<section class="content" style="width: 99%" style="background-color: white ;">
    <div class="box">
        <div class="box-body">
            <div class="row">

                <?php echo $this->Form->create($commandes, ['type' => 'get']); ?>

                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->input('datedebut', array('required' => 'off', 'label' => 'Date début', 'value' => $this->request->getQuery('datefin'), 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                            ?>

                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->input('datefin', array('required' => 'off', 'label' => 'Date fin', 'value' => $this->request->getQuery('datedebut'), 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                            ?> </div>
                    </div>
                </div>

                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('commercial_id', ['class' => 'form-control select2 control-label', 'label' => 'Commercial', 'value' => $this->request->getQuery('commercial_id'), 'empty' => 'Veuillez choisir !!', 'required' => 'off']); ?>
                        </div>
                        <div class="col-xs-6">

                            <div class="form-group input select required">

                                <label class="control-label" for="depot-id">Clients</label>

                                <select name="client_id" id="client" class="form-control select2 control-label " value='<?php $this->request->getQuery('client_id') ?>'>
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                    <?php foreach ($clients as $id => $client) {
                                    ?>
                                        <option value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                        <div class="col-xs-6">
                            <?php echo $this->Form->control('numero', ['label' => 'Numero', 'value' => $this->request->getQuery('numero'), 'required' => 'off']); ?>
                        </div>




                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('zone_id', [
                                'class' => 'form-control select2 control-label',
                                'required' => 'off', 'label' => 'Zones ', 'options' => $zones, 'empty' => 'Veuillez choisir !!', 'value' => $this->request->getQuery('zone_id')
                            ]);
                            ?>
                        </div>

                    </div>
                </div>



                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                        <div class="col-xs-6">
                            <div class="form-group input select required">

                                <label class="control-label" for="depot-id">Articles</label>

                                <select name="article_id" id="article_id" class="form-control select2 control-label " value='<?php $this->request->getQuery('article_id') ?>'>
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                    <?php foreach ($articles as $id => $articlee) {
                                    ?>
                                        <option value="<?php echo $articlee->id; ?>" <?php if ($article == $articlee->id) { ?> selected <?php } ?>><?php echo $articlee->Code . ' ' . $articlee->Dsignation ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="pull-right" style="margin-right:44%;margin-top: 20px;">
                        <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
                        <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'indexm'], ['class' => 'btn btn-primary btn-sm']) ?>
                        <!--          <a onclick="openWindow(1000, 1000, 'http://localhost:8765/commandes/imprimerrecherche?commercial_id=<?= $commercial_id ?>&client_id=<?= $client_id ?>&numero=<?= $numero ?>');"><button class="btn btn-primary btn-sm">Imprimer Recherche</button></a>-->
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="example1" class="table-fixed table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th width="10%" align="center"><?= ('Date') ?></th>
                                <th width="10%" align="center"><?= ('N°') ?></th>
                                <th width="15%" align="center"><?= ('Client') ?></th>
                                <th width="10%" align="center"><?= ('Commercial') ?></th>
                                <th width="15%" align="center"><?= ('Total HT') ?></th>
                                <th width="15%" align="center"><?= ('Total HT livrés') ?></th>
                                <th width="15%" align="center"><?= ('BL March') ?></th>
                                <th width="10%" align="center"><?= ('Actions') ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($commandes as $i => $commande) :
                        

                            
                            ?>
                                <tr>
                                    <td width="15.4%" hidden><?= h($commande->id) ?> </td>
                                    <td width="15.3%"><?=
                                                        $this->Time->format(
                                                            $commande->date,
                                                            'dd/MM/y'
                                                        );
                                                        ?></td>
                                    <td width="15.4%"><?= h($commande->numero) ?> </td>
                                    <td width="20.5%"><?= h($commande->client->Code . ' ' . $commande->client->Raison_Sociale) ?></td>

                                    <td width="20.7%"><?= h($commande->commercial->name) ?></td>
                                    <td width="10%"><?= h($commande->total) ?></td>
                                    <td width="10%"><?= h($commande->totalliv) ?></td>

                                    <td width="5%" align="center">
                                        <div <?php if ($commande->etatliv == 1) { ?> style="display:none" <?php } ?> >
                                            <input type="checkbox" id="check<?php echo $i; ?>" value="<?php echo $commande['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" class="bnlivmarch" />
                                            <input id="poids<?= $i ?>" ligne="<?php echo $i; ?>" class="poidhidden" type="hidden" value="<?= $commande->Poids ?>">
                                            <input id="client_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $commande->client_id ?>">
                                            <input id="bl_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $commande->bl ?>">


                                        </div>

                                    </td>


                                



                                    <td class="actions text" align="center">
                                        <div style="display: flex;" align="center">
                                            <div>
                                                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'viewm', $commande->id), array('escape' => false)); ?>

                                            </div>


                                            <?php if ($edit == 1) { ?>
                                                <div <?php if ($commande->etatliv == 2) { ?> style="display:none" <?php } ?>>
                                                    <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'editm', $commande->id), array('escape' => false)); ?>
                                                </div>
                                            <?php }
                                            if ($imp == 1) { ?>
                                                <div style="display: flex; " align="center">
                                                    <?php //echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimeviewbor', $commande->id), array('escape' => false)); ?>

                                                    <?php //echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview', $commande->id), array('escape' => false)); ?>
                                                </div>
                                            <?php }
                                            if ($delete == 1) { ?>

                                                <div <?php if ($commande->etatliv == 1 || $commande->etatliv == 2) { ?> style="display:none" <?php } ?>>
                                                    <?php echo $this->Form->postLink("<button class='deleteConfirm btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'deletem', $commande->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $commande->id)); ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                    </td>
                                </tr>




                            <?php endforeach; ?>

                        </tbody>
                        <!-- <tfoot >

                            <tr >
                                <th   colspan="6"></th>
                                <td  style=" border: 2px solid #fff;"> <b > Poids total</b>  </td>
                                <td  style=" border: 2px solid #fff;" >
                                    <input  class="form-control" id="poids-id"  value="0" >
                                </td>
                            </tr>
                            </tfoot> -->

                    </table>

                    <input type="hidden" value="<?php echo $i; ?>" id="index" />



                    <table>

                        <tr>
                            <td align="center">

                                <div class="col-md-12  testcheck" style="display:none;">
                                    <input type="hidden" name="tes" value="0" class="tespv" />
                                    <input type="hidden" name="tes" value="0" class="tes" />
                                    <input type="hidden" name="tes" value="99" class="testbl" />
                                    <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />
                                    <a class="btn btn btn-danger " id="bonlivmarch"> <i class="fa fa-plus-circle"></i> Créer un bon de livraison marchandise </a>
                                </div>

                            </td>



                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>

<!-- DataTables -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {
        $('#example2').DataTable()
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': false
        })
    })
    $('.select2').select2()
</script>
<?php $this->end(); ?>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<script type="text/javascript">
    $(function() {

        $("#bonlivmarch").on("click", function() {
            /// alert("hello");
            var tab = new Array();

            conteur = $(".nombre").val();
            // alert(conteur);
            for (var i = 0; i <= conteur; i++) {
                val = $("#check" + i).attr("checked");
                //var x = ($('#check'+(i)).checked;
                v = $("#check" + i).val();

                //alert(cl)
                if ($("#check" + i).is(":checked")) {
                    //alert(v);
                    tab[i] = v;

                }
            }
            var removeItem = undefined;
            tab = jQuery.grep(tab, function(value) {
                return value != removeItem;
            });



            client = $(".tes").val();
            //$(this).attr("href", "Bonlivraisons/addbonliv/" + tab);
            window.open("https://codifaerp.isofterp.com/demo/Bonlivraisons/addbonliv/"+ tab, "_self");
        });



        tabe = [];
        tabeminus = [];
        $('#poids-id').val(0);


        $('.getpoids').on('click', function(event) {

            event.stopPropagation();


            p = $('#poids-id').val();
            //alert(p);

            ligne = $(this).attr('ligne'); // alert(ligne);
            index = $('#index').val(); //alert(index)

            if ($('#checkbox' + ligne).is(':checked')) {

                //alert(index) ;
                test = 0;

                for (i = 0; i <= Number(index); i++) {
                    if ($('#checkbox' + i).is(':checked')) {

                        test = test + 1;


                    }
                    if (test >= 1) {
                        $('.preparatif').show();


                    }
                }
                commande_id = $('#checkbox' + ligne).val();
                /*  if (tabe[ligne])
                    {
                        console.log(tabe[ligne]) ;

                             s = (Number(tabe[ligne]) + Number(p));
                             $('#poids-id').val(Number(s));
                             nb=Number(s)/450;
                             $('#nb-id').val(Number(nb).toFixed(3)); 

                                
                            }
                        else
                        {
                    //alert()    ;  
                    //alert(commande_id) ;
                    $.ajax({

                        method: "GET",
                        url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'receiveLignesCommandes']) ?>",
                        dataType: "json",
                        data: {
                            idCommande: commande_id,
                        },
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                        },
                        success: function (data, status, settings) {
                            //alert(data);
                            val = data;
                            tabe[ligne]=val
                                console.log(tabe) ;

                            //alert(val)
                            s = (Number(val) + Number(p));
                            nb=Number(s)/450;
                            //alert(s)
                            $('#poids-id').val(Number(s));
                           $('#nb-id').val(Number(nb).toFixed(3)); 
                        }


                    
                             })
                     

                            }
           
                       
        }
            else if (!$('#checkbox' + ligne).is(':checked')) {
                //alert() ; 
                commande_id = $('#checkbox' + ligne).val();
                //alert(commande_id) ; 

                if (tabeminus[ligne])
                    {
                        console.log(tabeminus[ligne]) ;
                        s = (Number(p) - Number(tabe[ligne]));
                             $('#poids-id').val(Number(s));
                             nb=Number(s)/450;
                             $('#nb-id').val(Number(nb).toFixed(3)); 
                              
                                
                            }
                        else
                        {
                $.ajax({

                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'receiveLignesCommandes']) ?>",
                    dataType: "json",
                    data: {
                        idCommande: commande_id,
                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function (data, status, settings) {
                        //alert(data);
                        val = data;
                        tabeminus[ligne]=val ;
                        console.log(tabeminus) ;
                        //alert(val)
                        s = (Number(p) - Number(val));

                              nb=Number(s)/450;
                            //alert(s)
                            $('#poids-id').val(Number(s));
                           $('#nb-id').val(Number(nb).toFixed(3)); 

                    }


                })
                        return ;
            } */

                valpoid = $('#poids' + ligne).val() || 0;
                somme = Number($('#poids-id').val()) + Number(valpoid);

                $('#poids-id').val(somme.toFixed(2));
                $('#nb-id').val(Math.ceil($('#poids-id').val() / 450));


            } else {
                poidtotal = $('#poids-id').val();

                valpoid = $('#poids' + ligne).val() || 0;
                spoids = Number(poidtotal) - Number(valpoid);

                $('#poids-id').val(spoids.toFixed(2));
                $('#nb-id').val(Math.ceil($('#poids-id').val() / 450));



            }



            if (test == 0) {
                $('.preparatif').hide();
            }









        });


        $('.prep').on('click', function() {

            var tab = new Array;
            conteur = $('.nombre').val();
            //alert(conteur) ;

            for (var i = 0; i <= conteur; i++) {
                val = ($('#checkbox' + i).attr('checked'));

                v = $('#checkbox' + i).val();
                if ($('#checkbox' + i).is(':checked')) {

                    tab[i] = v;




                }
            }
            var removeItem = undefined;
            tab = jQuery.grep(tab, function(value) {
                return value != removeItem;
            });
            //alert(tab);

            $(this).attr("href", "Bonlivraisons/addpreparatif/" + tab)
        });









    });
</script>