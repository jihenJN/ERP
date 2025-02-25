<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>


<div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
</div>
<br> <br><br>



<section class="content-header">
    <h1>
        Recherche
    </h1>
</section>
<section class="content" style="width: 99%">
    <div class="box">
        <div class="box-header">
        </div>

        <div class="box-body">

            <?php echo $this->Form->create($articles, ['type' => 'get']); ?>
            <div class="row">


                <div class="col-xs-6">
                    <?php echo $this->Form->control('Code', ['label' => 'Code', 'value' => $this->request->getQuery('Code'), 'name', 'required' => 'off']); ?>
                </div>


                <div class="col-xs-6">
                    <?php echo $this->Form->control('Dsignation', ['label' => 'Designation', 'required' => 'off', 'value' => $this->request->getQuery('Dsignation')]); ?>
                </div>
                <div class="col-xs-6">
                    <div class="form-group input text required">
                        <label class="control-label" for="name">Familles</label>
                        <select class="form-control select2" name="famille_id" value='<?php $this->request->getQuery('famille_id') ?>'>
                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                            <?php foreach ($familles as $id => $famille) { ?>
                                <option value="<?php echo $id; ?>"><?php echo $famille ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group input text required">
                        <label class="control-label" for="name">Sous Familles</label>
                        <select class="form-control select2" name="sousfamille1_id" value='<?php $this->request->getQuery('sousfamille1_id') ?>'>
                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                            <?php foreach ($sousfamille1s as $id => $sousfamille) { ?>
                                <option value="<?php echo $id; ?>"><?php echo $sousfamille ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group input text required">
                        <label class="control-label" for="name">Sous sous Familles</label>
                        <select class="form-control select2" name="sousfamille2_id" value='<?php $this->request->getQuery('sousfamille2_id') ?>'>
                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                            <?php foreach ($sousfamille2s as $id => $ssousfamille) { ?>
                                <option value="<?php echo $id; ?>"><?php echo $ssousfamille ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
                    <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
                    <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>

</section>

<section class="content-header">
    <h1>
        Articles
    </h1>
</section>








<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col"><?= ('Code') ?></th>
                                <th scope="col"><?= ('Designiation') ?></th>
                                <th scope="col"><?= ('Famille') ?></th>
                                <th scope="col"><?= ('Sous famille') ?></th>
                                <th scope="col"><?= ('Sous sous famille') ?></th>
                                <th scope="col"><?= ('Etat') ?></th>
                                <th scope="col"><?= ('Prix') ?></th>
                                <th scope="col"><?= ('Image') ?></th>

                                <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($articles as $i => $article) : ?>
                                <tr>

                                    <td>
                                        <?php echo $this->Form->control('id', ['type' => 'hidden', 'index' => $i, 'id' => 'id' . $i, 'value' => $article->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control']); ?>

                                        <?= h($article->Code) ?></td>
                                    <td><?= h($article->Dsignation) ?></td>
                                    <td><?= ($article->famille->Nom) ?></td>
                                    <td><?= ($article->sousfamille1->name) ?></td>
                                    <?php //debug($article->sousfamille1->name);die; 
                                    ?>
                                    <td><?= ($article->sousfamille2->name) ?></td>

                                    <?php if ($article->etat == 0) { ?>
                                        <td align="center"> Activé </td>
                                    <?php } ?>
                                    <?php if ($article->etat == 1) { ?>
                                        <td  align="center"> Désactivé </td>
                                    <?php } ?>
                                    <td><?= h($article->Prix_LastInput) ?></td>
                                    <td>
                                        <?php echo $this->Html->image('imgart/' . $article->image, ['style' => 'max-width:80px;height:80px;']); ?>
                                    </td>
                                    <td class="actions text" style="text-align:center">
                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $article->id), array('escape' => false)); ?>
                                        <!-- <?= $this->Html->link(__(''), ['action' => 'view', $article->id], ['class' => 'fa fa-search ']) ?> -->
                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $article->id), array('escape' => false)); ?>
                                        <!-- <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id], ['class' => 'btn btn-warning btn-xs']) ?> -->

                                        <button index='<?php echo $i ?>' class='verifier btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>


                                    </td>




                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <table>

                        <tr>
                            <td align="center">

                                <div class="col-md-12  testcheck" style="display:none;">
                                    <input type="hidden" name="tes" value="0" class="tespv" />
                                    <input type="hidden" name="tes" value="0" class="tes" />
                                    <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />
                                    <a class="btn btn btn-danger btnbl" id="bonliv"> <i class="fa fa-plus-circle"></i> Créer un bon de transferts </a>
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




<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
    $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
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
        format: 'MM/DD/YYYY h:mm A'
    })
</script>
<?php $this->end(); ?>
<script>
    $(function() {
        $('.verifier').on('click', function() {
            // alert('hello');
            ind = $(this).attr('index');
            //  alert(ind);
            id = $('#id' + ind).val();
            //      alert(id);
            //  alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'verif']) ?>",
                dataType: "json",
                data: {
                    idfam: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    // alert(data.articles)
                    //   $('#pays').html(data.pays);
                    //  alert(data.pays);
                    if (data.articlecmds != 0) {
                        cmd = 'Oui';
                    } else {
                        cmd = 'Non';
                    }

                    if (data.articlelivs != 0) {
                        liv = 'Oui';
                    } else {
                        liv = 'Non';
                    }


                    if (data.articlefacts != 0) {
                        fact = 'Oui';
                    } else {
                        fact = 'Non';
                    }



                    if (data.articlecmds != 0) {
                        alert('Vous ne pouvez pas supprimer cet enregistrement ! \n Commande : ' + cmd + '\n Bon livraisons : ' + liv + '\n Facture clients : ' + fact);
                    } else {
                        if (confirm('Voulez-vous vraiment supprimer cet enregistrement?')) {
                            //   alert('ok supp');
                            document.location = "https://codifaerp.isofterp.com/demo/articles/delete/" + id;
                        }
                    }
                }
            })
        });
    });
</script>