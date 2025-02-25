<?php
 ?>
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

                        echo $this->Form->input('date1', array('value' => @$date1, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly ', 'type' => 'date', 'label' => 'Date de'));
                        ?>

                    </div>


                    <div class="col-xs-6">

                        <?php
                        echo $this->Form->input('date2', array('value' => @$date2 , 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly', 'type' => 'date', 'label' => "Jusqu'à "));

                        ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->input('depot_id', array('id' => 'depot_id', 'empty' => 'veuillez choisir', 'div' => 'form-group', 'label' => 'Dépot', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control select2', 'options' => $depots, 'value' => $this->request->getQuery('depot_id'),));
                        ?>
                    </div>

                    <div class="col-xs-6">
                        <label>Article</label>
                        <select class="form-control select2" name="article_id" id="article_id" value='<?php $this->request->getQuery('article_id') ?>'>
                            <option value="" selected="selected">Veuillez choisir !!</option>
                            <?php foreach ($articles as $j => $art) {
                            ?>
                                <option <?php if ($art->id == $articleid) { ?> selected="selected" <?php } ?> value="<?php echo $art->id; ?>"><?php echo $art->Code . ' ' . $art->Dsignation ?></option>
                            <?php } ?>

                        </select>
                    </div>
                </div>

                <div class="row">
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
                </div>



                <div class="form-group">
                    <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
                        <button type="submit" class="btn btn-primary  alertHisto" id="">Afficher</button>

                        <?php
                        //debug($count);
                        if ($count != 0) { ?>
                            <a onclick="openWindow(1000, 1000, 'https://sirepprefaprod.isofterp.com/ERP/Articles/imphisto?client_id=<?php echo @$clientID;  ?>')"><button class="btn btn-primary ">Imprimer</button></a>
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
                            <tr>
                                <th width="10%" class="actions text-center"> <?php echo ('Date '); ?></th>
                                <th width="10%" class="actions text-center "><?php echo ('Action'); ?></th>
                                <th width="10%" class="actions text-center "><?php echo ('Dépot'); ?></th>
                                <th width="10%" class="actions text-center "><?php echo ('Numéro'); ?></th>
                                <th width="20%" class="actions text-center "><?php echo ('Client'); ?></th>
                                <th width="10%" class="actions text-center "><?php echo ('Entrée'); ?></th>
                                <th width="10%" class="actions text-center "><?php echo ('Sortie'); ?></th>
                                <th width="10%" class="actions text-center "><?php echo ('PU HT'); ?></th>
                                <th width="10%" class="actions text-center "><?php echo ('TOT HT'); ?></th>

                            </tr>
                            <?php
                            $nb = 0;
                            $qte_ent = 0;
                            $qte_sor = 0;
                            $qte_final = 0;
                            //debug($historiquearticles);die;
                            foreach ($historiquearticles as $historiquearticle) {
                                // debug($historiquearticle);
                                $nb = $nb + 1;
                                ///     debug($historiquearticle);
                                if (!empty($historiquearticle['date'])) {
                                } else {
                                    $date = "";
                                }
                                // if($historiquearticle['indice']==4){
                                //     $qte_ent= $qte_ent + sprintf("%.3f",$historiquearticle['qte']);
                                // }


                                if ($historiquearticle['indice'] == 4) {
                                    $qte_sor = 0;
                                    $qte_ent = $historiquearticle['qte'];
                                    $qte_sor = $qte_sor;
                                }

                                //debug($qte_ent);
                               
                                if (($historiquearticle['mode'] == "Entreé") && ($historiquearticle['indice'] != 4 )) {
                                    $qte_ent = $qte_ent + sprintf("%.3f", $historiquearticle['qte']);
                                    ///debug($qte_ent);
                                }

                                 ///debug($qte_ent);
                                
                                
                                if ($historiquearticle['mode'] == "Sortie") {
                                    $qte_sor = $qte_sor + sprintf("%.3f", $historiquearticle['qte']);
                                }
                                $qte_final = sprintf("%.3f", $qte_ent) - sprintf("%.3f", $qte_sor);
                                //debug($qte_final);
                            ?>
                                <tr>
                                    <?php
                                    $date = date("Y-m-d H:i:s", strtotime(str_replace('-', '/',  $historiquearticle['date'])));

                                    ?>
                                    <td align="center"><?php echo $date ?></td>
                                    <td align="center"><?php echo $historiquearticle['type']; ?></td>
                                    <td align="center"><?php echo $historiquearticle['depot']; ?></td>
                                    <td align="center"><?php echo $historiquearticle['numero']; ?></td>
                                    <td align="center">
                                        <?php if ($historiquearticle['type'] != 'Inventaire')  echo $clientcod;
                                        else {
                                            echo '';
                                        } ?>

                                    </td>


                                    <?php if ($historiquearticle['indice'] == 4) { ?>
                                        <td align="center" colspan="2">
                                            <?php
                                            if ($historiquearticle['qte'] == null) {
                                                echo '0';
                                            } else {
                                                echo $historiquearticle['qte'];
                                            }

                                            ?>
                                        </td>


                                    <?php } else {  ?>
                                        <td align="center">
                                            <?php
                                            if ($historiquearticle['mode'] == "Entreé") {
                                                echo $historiquearticle['qte'];
                                            }
                                            ?>&nbsp;
                                        </td>
                                        <td align="center">
                                            <?php
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
                                <td align="center"><?php echo $qte_ent ?></td>
                                <td align="center"><?php echo  $qte_sor ?></td>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                                <td colspan="2" align="center"> <strong>
                                        <?php echo @$qte_final ?>
                                    </strong> </td>
                                <td colspan="4"></td>
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