<?php
error_reporting(E_ERROR | E_PARSE); ?>
<?php echo $this->Html->css('select2'); ?>
<section class="content-header">
    <header>
        <h1 style="text-align:center;"> Recherche historique article</h1>
    </header>
</section>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <?php echo $this->Form->create($historiquearticles, ['type' => 'get']);
                ?>

                <div class="row">
                    <div class="col-xs-6">
                        <?php

                        echo $this->Form->control('date1', array('value' => @$date1, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly ', 'type' => 'date', 'label' => 'Date de'));
                        ?>

                    </div>


                    <div class="col-xs-6">

                        <?php
                        echo $this->Form->control('date2', array('value' => @$date2, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly', 'type' => 'date', 'label' => "Jusqu'à "));

                        ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('depot_id', array('id' => 'depot_id', 'div' => 'form-group', 'label' => 'Dépot', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control select2', 'options' => $depots, 'value' => $this->request->getQuery('depot_id'),));
                        ?>
                    </div>

                    <div class="col-xs-6">
                        <label>Code</label>
                        <select class="form-control select2" name="article_id" id="article_id" value='<?php $this->request->getQuery('article_id') ?>'>
                            <option value="" selected="selected">Veuillez choisir !!</option>
                            <?php foreach ($articles as $j => $art) {
                            ?>
                                <option <?php if ($art->id == $articleid) { ?> selected="selected" <?php } ?> value="<?php echo $art->id; ?>"><?php echo $art->Code ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="col-xs-6">
                        <label>Désignation</label>
                        <select class="form-control select2" name="article_id1" id="article_id1" value='<?php $this->request->getQuery('article_id') ?>'>
                            <option value="" selected="selected">Veuillez choisir !!</option>
                            <?php foreach ($articles as $j => $art) {
                            ?>
                                <option <?php if ($art->id == $articleid) { ?> selected="selected" <?php } ?> value="<?php echo $art->id; ?>"><?php echo $art->Dsignation ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="col-xs-6">
                        <label>Client</label>
                        <select name="client_id" id="client" class="form-control select2 control-label ">
                            <option value="" selected="selected">Veuillez choisir !!</option>
                            <?php foreach ($clients as $client) {
                            ?>
                                <option <?php if ($clientID == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                            <?php } ?>
                        </select>

                    </div>
                    <!-- <div class="col-xs-6">
                        <label>Article</label>
                        <select class="form-control select2" name="article_id" id="article_id" value='<?php $this->request->getQuery('article_id') ?>'>
                            <option value="" selected="selected">Veuillez choisir !!</option>
                            <?php foreach ($articles as $j => $art) {
                            ?>
                                <option <?php if ($art->id == $articleid) { ?> selected="selected" <?php } ?> value="<?php echo $art->id; ?>"><?php echo $art->Code . ' ' . $art->Dsignation ?></option>
                            <?php } ?>

                        </select>
                    </div> -->
                </div>





                <div class="form-group">
                    <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
                        <button type="submit" class="btn btn-primary  alertHisto" id="">Afficher</button>

                        <?php
                        //debug($count);
                        if ($count != 0) { ?>
                            <a onclick="openWindow(1000, 1000, wr+'Articles/imphisto?solde=<?php echo @$solde; ?>&date1=<?php echo @$date1; ?>&date2=<?php echo @$date2; ?>&depot_id=<?php echo @$depotid; ?>&article_id=<?php echo @$articleid; ?>&client_id=<?php echo @$clientID;  ?>')"><button class="btn btn-primary ">Imprimer</button></a>
                        <?php } ?>
                        <?php echo $this->Html->link(__('Actualiser'), ['action' => '/indexspec'], ['class' => 'btn btn-primary']) ?>

                    </div>
                </div>

                <?php echo $this->Form->end(); ?>

            </div>
        </div>
        <br>


        <h2 style="margin-left: 5px ;">
            État historique article
        </h2>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered">
                            <tr style="background-color:#367FA9;color:#ffffff;">
                                <td width="12%" class="actions text-center"> <?php echo ('Date '); ?></td>
                                <td width="15%" class="actions text-center "><?php echo ('Action'); ?></td>
                                <td width="9%" class="actions text-center "><?php echo ('Dépot'); ?></td>
                                <td width="7%" class="actions text-center "><?php echo ('Numéro'); ?></td>
                                <td width="10%" class="actions text-center "><?php echo ('Client'); ?></td>
                                <td width="15%" class="actions text-center "><?php echo ('Entrée'); ?> </td>

                                <td width="15%" class="actions text-center "><?php echo ('Sortie'); ?> </td>

                                <td width="9%" class="actions text-center "><?php echo ('PU HT'); ?></td>
                                <td width="9%" class="actions text-center "><?php echo ('TOT HT'); ?></td>

                            </tr>
                            <tr>
                                <td align="center" colspan="5" style="color:#367FA9;"> <strong>Solde </strong></td>

                                <td align="center" colspan="2"> <strong><?php echo $solde ?> </strong></td>
                                <td align="center" colspan="2"></td>

                            </tr>
                            <?php
                            $nb = 0;
                            $qte_ent = $solde;
                            $qte_ent1 = 0;
                            $qte_sor = 0;

                            $qte_final = 0;

                            foreach ($historiquearticles as $historiquearticle) {
                                // debug($historiquearticle);
                                $nb = $nb + 1;
                                ///     debug($historiquearticle);
                                if (!empty($historiquearticle['date'])) {
                                } else {
                                    $date = "";
                                }



                                if ($historiquearticle['indice'] == 4) {
                                    $qte_sor = 0;

                                    $qte_ent = $historiquearticle['qte'];
                                    $qte_sor = $qte_sor;
                                }

                                //debug($qte_ent);

                                if (($historiquearticle['mode'] == "Entreé") && ($historiquearticle['indice'] != 4)) {
                                    $qte_ent = $qte_ent + sprintf("%.3f", $historiquearticle['qte']);
                                }




                                if ($historiquearticle['mode'] == "Sortie") {
                                    $qte_sor = $qte_sor + sprintf("%.3f", $historiquearticle['qte']);
                                }
                                $qte_final = sprintf("%.3f", $qte_ent) - sprintf("%.3f", $qte_sor);

                            ?>

                                <tr>

                                    <?php
                                    // $date = date("Y-m-d H:i:s", strtotime(str_replace('-', '/',  $historiquearticle['date'])));
                                    $date = $this->Time->format($historiquearticle['date'], 'dd/MM/y HH:mm:ss');
                                    ?>
                                    <td align="center"><?php echo $date ?></td>
                                    <td align="center"><?php echo $historiquearticle['type']; ?></td>
                                    <td align="center"><?php echo $historiquearticle['depot']; ?></td>
                                    <td align="center"><?php echo $historiquearticle['numero']; ?></td>
                                    <td align="center">
                                        <?php if ($historiquearticle['type'] != 'Inventaire' && $historiquearticle['type'] != 'Lancer Ordre fabrication' && $historiquearticle['type'] != 'Validation Ordre fabrication') {
                                            echo $clientcod;
                                        } else {
                                            echo '';
                                        } ?>

                                    </td>


                                    <?php if ($historiquearticle['indice'] == 4) { ?>
                                        <td align="center">
                                            <?php
                                            if ($historiquearticle['qte'] == null) {
                                                echo '0';
                                            } else {
                                                echo $historiquearticle['qte'];
                                            }

                                            ?>
                                        </td>


                                    <?php } else {  ?>

                                        <td align="center"> <?php
                                                            if ($historiquearticle['mode'] == "Entreé") {
                                                                echo $historiquearticle['qte'];
                                                            }
                                                            ?>&nbsp;

                                        </td>


                                        <td align="center"> <?php
                                                            if ($historiquearticle['mode'] == "Sortie") {
                                                                echo $historiquearticle['qte'];
                                                            }
                                                            ?>&nbsp;
                                        </td>





                                    <?php }  ?>
                                    <td align="center"><?php echo $historiquearticle['pu']; ?></td>
                                    <td align="center"><?php echo $historiquearticle['ptot']; ?></td>
                                </tr>

                            <?php } ?>
                            <tr>
                                <td colspan="5"></td>

                                <td align="center" style="color: #008000;"> <strong><?php echo $qte_ent ?> </strong></td>


                                <td align="center" style="color: #4f86f7;"> <strong><?php echo  $qte_sor ?> </strong></td>

                                <td colspan="2"></td>

                            </tr>
                            <tr>
                                <td colspan="5"></td>
                                <td colspan="2" style="background-color:#367FA9" align="center"> <strong>
                                        <?php echo @$qte_final  ?>
                                    </strong>



                                <td colspan="2"></td>
                            </tr>
                        </table>
                    </div>

                    <br><br>

                </div>
            </div>
        </div>
    </div>

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
    <script>
        $(document).ready(function() {

            $('#article_id').change(function() {
                var selectedcodename = $(this).val();
                // alert(article_id);
                $("#article_id1").select2('destroy');
                $("#article_id1").val(selectedcodename);
                $("#article_id1").select2();

            });
            $('#article_id1').change(function() {
                var selectedcodename = $(this).val();
                $("#article_id").select2('destroy');
                $("#article_id").val(selectedcodename);
                $("#article_id").select2();

            });
        });
    </script>
    <script>
        $(function() {



            $('.alertHisto').on('click', function() {

                d1 = $('#date1').val();
                d2 = $('#date2').val();
                depot = $('#depot_id').val();
                article = $('#article_id').val();
                ///  client = $('#client_id').val();


                if (d1 == '') {
                    alert("Veuillez choisir le date de début SVP !!")
                    return false;

                } else if (d2 == '') {
                    alert("Veuillez choisir le date du fin SVP !!")
                    return false;

                } else if (depot == '') {
                    alert("Veuillez choisir un dépot SVP  !!")
                    return false;

                } else if (article == '') {
                    alert("Veuillez choisir un article SVP  !!")
                    return false;

                }
                //else if (client == '') {
                //     alert("Veuillez choisir un client SVP  !!")
                // }

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
    <?php $this->end(); ?>