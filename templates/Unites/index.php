


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('salma'); ?>

<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_articles' . $abrv);
//debug($lien);die;
foreach ($lien as $k => $liens) {
    if (@$liens['lien'] == 'unitecontenance') {
        $add = $liens['ajout'];
        $edit = $liens['modif'];
        $delete = $liens['supp'];
    }
    //debug($liens);die;
}

if ($add == 1) {
    ?>
    <div class="pull-left" style="margin-left:25px;margin-top: 20px">
        <?php echo $this->Html->link(__('Ajouter'), ['action' => 'Add'], ['class' => 'btn btn-success btn-sm']) ?>
    </div>
<?php } ?>
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
            <div class="row">

                <?php echo $this->Form->create($unites, ['type' => 'get']); ?>
                <div class="col-xs-6">
                    <?php echo $this->Form->control('name', ['label' => 'Nom', 'value' => $this->request->getQuery('name'), 'name', 'required' => 'off']); ?>
                </div>
                <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
                    <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
                    <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</section>

<section class="content-header">
    <h1>
        Unités
    </h1>
</section>
<section class="content" style="width: 99%">
    <div class="box">
        <div class="box-header">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th  class="actions text-center" scope="col"><?= ('Nom') ?></th>
                        <th  class="actions text-center" scope="col"><?= ('Actions') ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($unites as $i => $unite) : ?>
                        <tr>

                            <td hidden >                            <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $unite->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control']); ?>
                            </td>
                            <td    class="actions text-center"  ><?= h($unite->name) ?></td>
                            <td hidden ><?= h($unite->typeU) ?></td>
                            <td class="actions text" align="center">
                                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $unite->id), array('escape' => false)); ?>
                                <?php
                                if ($edit == 1) {
                                    echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $unite->id), array('escape' => false));
                                }
                                ?>
                                <?php //if ($delete == 1) { ?>
                                    <button index='<?php echo $i ?>' class='verifiercmd btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>
                                  <!--echo $this->Form->postLink("<button class='btn deleteConfirm btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $unite->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $unite->id));-->
                                <?php //} ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</section>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function () {
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
</script>
<?php $this->end(); ?>
<script>
    function flvFPW1() {
        var v1 = arguments,
                v2 = v1[2].split(","),
                v3 = (v1.length > 3) ? v1[3] : false,
                v4 = (v1.length > 4) ? parseInt(v1[4]) : 0,
                v5 = (v1.length > 5) ? parseInt(v1[5]) : 0,
                v6, v7 = 0,
                v8, v9, v10, v11, v12, v13, v14, v15, v16;
        v11 = new Array("width,left," + v4, "height,top," + v5);
        for (i = 0; i < v11.length; i++) {
            v12 = v11[i].split(",");
            l_iTarget = parseInt(v12[2]);
            if (l_iTarget > 1 || v1[2].indexOf("%") > -1) {
                v13 = eval("screen." + v12[0]);
                for (v6 = 0; v6 < v2.length; v6++) {
                    v10 = v2[v6].split("=");
                    if (v10[0] == v12[0]) {
                        v14 = parseInt(v10[1]);
                        if (v10[1].indexOf("%") > -1) {
                            v14 = (v14 / 100) * v13;
                            v2[v6] = v12[0] + "=" + v14;
                        }
                    }
                    if (v10[0] == v12[1]) {
                        v16 = parseInt(v10[1]);
                        v15 = v6;
                    }
                }
                if (l_iTarget == 2) {
                    v7 = (v13 - v14) / 2;
                    v15 = v2.length;
                } else if (l_iTarget == 3) {
                    v7 = v13 - v14 - v16;
                }
                v2[v15] = v12[1] + "=" + v7;
            }
        }
        v8 = v2.join(",");
        v9 = window.open(v1[0], v1[1], v8);
        if (v3) {
            v9.focus();
        }
        document.MM_returnValue = false;
        return v9;
    }


    $(function() {
    $('.verifiercmd').on('click', function() {
      // alert('hello');
      ind = $(this).attr('index');
      // alert(ind);
      id = $('#id' + ind).val();
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'verif05093']) ?>",
        dataType: "json",
        data: {
          id: id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data, status, settings) {
          //alert(data.Articles);
          if (data.Articles != 0) {
            alert('existe dans un document');
          } else {
            if (confirm('Voulez-vous supprimer cet enregistrement')) {
             // alert('ok supp');
              document.location = wr+"Unites/delete/" + id;
            }
          }
        }
      })
    });
  });


    $(function () {
        $('.verifier').on('click', function () {
            // alert('hello');
            ind = $(this).attr('index');
         //   alert(ind);
            id = $('#id' + ind).val();
          //  alert(id);
            //  alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Unites', 'action' => 'verif']) ?>",
                dataType: "json",
                data: {
                    idfam: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    //   $('#pays').html(data.pays);
                    //  alert(data.pays);
                    if (data.articles != 0)
                    {
                        alert('Vous ne pouvez pas supprimer cet enregistrement');
                    } else {
                        if (confirm('Voulez-vous vraiment supprimer cet enregistrement?'))
                        {
                            //   alert('ok supp');
                            document.location = wr+"unites/delete/" + id;
                        }
                    }
                }
            })
        });
    });

</script>