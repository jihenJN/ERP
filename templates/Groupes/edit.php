<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Groupe $groupe
 */
echo $this->Html->script('tar1');

?>
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Groupe
      <small><?php echo __('Edit'); ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Home'); ?></a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo __('Form'); ?></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo $this->Form->create($groupe, ['role' => 'form']); ?>
            <div class="box-body">
              <?php
                echo $this->Form->control('client_id', ['options' => $clients]);
              ?>
                 <div style="width:100% ; text-align:right" class="col-xs-6">   <a class="btn btn-primary ajouterligne_man" table="addtable" index="index" style="
                                       margin-bottom: 5px;
                                       ">
                                        <i class="fa fa-plus-circle "></i>Ajouter_ligne</a></div>
                                        <table class="table table-bordered table-striped table-bottomless" id="addtable">



                                            <thead>
                                           <tr width:20px>
                                           <td align="center" style="width: 25%; font: size 20px;"><strong>Clients</strong></td>






                                                    <td align="center" style="width: 25%;"></td>
                                                </tr>
                                            </thead>
                                            <tbody>

                    <?php if (!empty($lignegroupes)) :  ?>
                                                            <?php
                                     $j=0;
                                                            foreach ($lignegroupes as $i => $res) : $j++;// debug($lignebonchargements->id);
                                                            //  foreach ($lignebonchargements as $i => $ligne) :  debug($ligne->article->Dsignation);
                                                        ?>
                                                            <tr>



                                                                <td align="center">
                                                              <?php echo $this->Form->input('sup', array('name' => "data[ligner][" . $i . "][supp]", 'id' => 'supp' . $i, 'champ' => 'supp', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => '', 'class' => 'form-control', 'type' => 'hidden')); ?>
                                                              <div class="form-group input select" >

                                                              <select table="ligner" champ="personnel_id" name="data[ligner][<?php echo $i ;?>][personnel_id]" id="personnel_id<?php echo $i ;?>" class="form-control checkclient" index=<?= $i ?>>
                                                                    <option value="">Please choose !!</option>

                                                                    <?php  foreach($clientsl as $perf ) :
                                                                        ?>

                                                                    <option <?php if ($res->client_id ==$perf->id) { echo "selected" ;} ?> value="<?php echo $perf->id ?>"><?php echo $perf->Raison_Sociale?></option>

                                                                    <?php endforeach   ?>

                                                                </select>
                                                                </div>


                                                                </td>

                                                                <td align="center" >
                                                                    <i id="" class="fa fa-times supLigne0tar" style="color: #c9302c;font-size: 22px;" index="<?php echo $i ?>"
                                                                    ></i>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    <tr class="tr" style="display: none ">




<td align="center" table="ligner">

    <input type="hidden" id="" champ="supp" name="" table="ligner" index="" class="form-control">

    <div class="form-group input select" >

<select table="ligner" champ="personnel_id" name="" id="personnel" class="form-control checkclient" index>
      <option value="">Please choose !!</option>

      <?php  foreach($clientsl as $perf ) :
          ?>

      <option  value="<?php echo $perf->id ?>"><?php echo $perf->Raison_Sociale?></option>

      <?php endforeach   ?>

  </select>
  </div>

</td>


<td align="center" >
    <i index id="" class="fa fa-times supLigne0tar" style="color: #c9302c;font-size: 22px;"></i>
</td>
</tr>

<input type="" value="<?php echo @$i ?>" id="index" hidden>
</tbody>
</table><br>
            </div>
            <!-- /.box-body -->

          <?php echo $this->Form->submit(__('Submit')); ?>

          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
  </div>
  <!-- /.row -->
</section>

<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>

<script>
    $(document).ready(function() {
        $('.select2').select2()
    $('#client-id').select2({
        width: "100%"
    });
    index = $('#index').val() ;

for (i=0 ; i<=index ; i++)
{
    $('#personnel_id'+i).select2({
    width: "100%"
});

}
});


</script>
