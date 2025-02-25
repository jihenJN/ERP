<section class="content-header">
  <h1>
    Groupe
    <small><?php echo __('View'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Home'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-info"></i>
          <h3 class="box-title"><?php echo __('Information'); ?></h3>
        </div>
        <!-- /.box-header -->
        <?php echo $this->Form->create($groupe, ['role' => 'form']); ?>

        <div class="box-body">
        <?php
                echo $this->Form->control('client_id', ['options' => $clients]);
              ?>
                 <div style="width:100% ; text-align:right" class="col-xs-6">   <!-- <a class="btn btn-primary ajouterligne_man" table="addtable" index="index" style="
                                       margin-bottom: 5px;
                                       ">
                                        <i class="fa fa-plus-circle "></i>Ajouter_ligne</a> --></div>
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

                                                              <select table="ligner" champ="personnel_id" name="data[ligner][<?php echo $i ;?>][personnel_id]" id="personnel_id<?php echo $i ;?>" class="form-control getsref" index>
                                                                    <option value="">Please choose !!</option>

                                                                    <?php  foreach($clientsl as $perf ) :
                                                                        ?>

                                                                    <option <?php if ($res->client_id ==$perf->id) { echo "selected" ;} ?> value="<?php echo $perf->id ?>"><?php echo $perf->Raison_Sociale?></option>

                                                                    <?php endforeach   ?>

                                                                </select>
                                                                </div>


                                                                </td>

                                                               <!--  <td align="center" >
                                                                    <i id="" class="fa fa-times supLigne0tar" style="color: #c9302c;font-size: 22px;" index="<?php echo $i ?>"
                                                                    ></i>
                                                                </td> -->
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    <input type="" value="<?php echo @$i ?>" id="index" hidden>
</tbody>
</table><br>
        </div>
      </div>
    </div>
  </div>

</section>

<script>
    $('select,input').attr('disabled','disabled')
</script>
