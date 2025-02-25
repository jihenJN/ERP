<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php
echo $this->Html->script('salma');
?>
<section class="content-header">
    <h1>
    Agences

    </h1><br>
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_finance' . $abrv);

foreach ($lien as $k => $liens) 
//debug($liens['lien']);
{
  if (@$liens['lien'] == 'agences') {
   
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  //debug($liens);die;
}

//if ($add == 1) { ?>

    <div class="pull-left"><?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>
  </section>
<?php  //} ?>
<br>




<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="10%" align="center"><?= ('Nom') ?></th>
                <th width="10%" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($agences as $i => $agence): ?>
                <tr>
                <td><?= h($agence->name) ?>
                    <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id'.$i, 'value' => $agence->id, 'label' => '', 'type'=>'hidden','champ' => 'id', 'class' => 'form-control']); ?>

                </td>
                  <td class="actions text" align="center">
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $agence->id), array('escape' => false)); ?>
                    <?php //if ($edit == 1) {
                       echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $agence->id), array('escape' => false));
                       // }?>
                    <?php //if ($delete == 1) { 
                       echo $this->Form->postLink("<button class='btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $agence->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $agence->id)); ?>
                    <!-- <button index='<?php echo $i?>' class='btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button> -->
                    <?php //} ?>
                  </td>
                  
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>




<script type="text/javascript">
    $(function () {
        $('.verifierbanque').on('click', function () {
     //   alert("gg");
            ind = $(this).attr('index');
           // alert(ind);
            id = $('#id'+ind).val();
          //alert(id);
          
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Banques','action' => 'getbanque']) ?>",
                dataType: "json",
                data: {
                    idbanque: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data, status, settings) {
                   if (data.query !=0)
                   {
                        alert("Vous ne pouvez pas supprimer cet enregistrement");
                      
                   }
                   else {
                       if(confirm('Voulez vous vraiment supprimer cet enregistrement'))
                        {
                            document.location="/Banques/delete/"+id;
                        }
                   }
                   // $('#bureauposte').val(response.query);
                    // uniform_select('delegation');



                    //$('#adresses').val((id));

                }
         
        });
         });
    });
</script>






























