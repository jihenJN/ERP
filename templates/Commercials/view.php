<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ville $ville
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script> 
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
  <h1>
  Consultation commercial
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box ">
      <?php echo $this->Form->create($commercial, ['role' => 'form']); ?>
        <div class="box-body">
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('name',['readonly' , 'label'=>'Nom']);
            ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('login',['readonly']);
            ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('mp',['readonly']);
            ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('soldedepart',['readonly']);
            ?>
          </div>
             <div class="col-xs-6">
            <?php
            echo $this->Form->control('gouvernorats_id', [ 'value' =>$gg,'data-placeholder' => 'Veuillez choisir !!', 'class' => 'form-control select2', 'multiple' => 'multiple[]']);
            ?>
          </div> 
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('categorie_id', ['readonly']);
            ?>
          </div> 

          <table class="table table-bordered table-striped table-bottomless" id="tabligne6">

<thead>
  <tr width:20px">
    <td align="center" style="width: 15%;"><strong>Gouvernorat</strong></td>
    <td align="center" style="width: 20%;"> <strong>Clients</strong> </td>


  </tr>
</thead>
<tbody>
  <tr>
    <?php foreach ($gouvv as $gv) :
      //debug($gv) ;
    ?>
      <td align="center">




        <input value="<?php echo $gv->gouvernorat->name ?>" readonly class="form-control">


      </td>

      <td>
        <div class="table-responsive ls-table">
          <table style="width:70%" align="center" class="table table-bordered table-striped table-bottomless">
            <thead>

            </thead>
            <tbody>
              <?php
            
              foreach ($tabb[$gv->gouvernorat_id] as $j  => $b) {
              ?>
                <tr>
                  <td>

                    <input readonly value="<?php echo $b['client'] ?>"  class="form-control">

                  </td>


                </tr>
              <?php } ?>
            </tbody>




          </table>


        </div>
      </td>

  </tr>


  <?php endforeach; ?>





</tbody>
</table>




          <table align="center" style="width: 50%;" class="table table-bordered table-striped table-bottomless" id="tab">



<tr>
    <th style="width:10% ;"> </th>
    <?php
    //   $i = 1;
    //debug($i);
    foreach ($mois as $m) : ?>
        <th style="width: 1%;"> <?php echo $m->name  ?> </th>
    <?php endforeach; ?>

</tr>


<?php $i = 1;
foreach ($articles as $s) : ?>

    <tr style="height:20px">

        <td> <?php echo $s->Dsignation ?>
        </td>
        <?php foreach ($mois as $mm) : 
        ?>
            <?php 
            ?>

            <?php
            ?>

            <?php   ?>


                <td style="width: 10px;">
                    <input value="<?php echo $mm->id  ?>" id="<?php echo "mois" . $i ?>" index="<?php echo $i  ?>" name="<?php echo 'data[objectifrep][' . $i . '][mois]' ?>" style="height:30px;width:50px" type="hidden" class="form-control">




                    <input value="<?php echo $s->id  ?>" id="<?php echo "commercial" . $i ?>" index="<?php echo $i  ?>" name="<?php echo 'data[objectifrep][' . $i . '][article]' ?>" style="height:30px;width:50px" type="hidden" class="form-control">


                    <input      readonly     <?php { ?> value="<?php echo @$tab[@$s->id][$mm->id] ?>" <?php } ?> id="<?php echo "objectif" . $i ?>" index="<?php echo $i  ?>" name="<?php echo 'data[objectifrep][' . $i . '][objectif]' ?>" style="height:35px;width:80px" type="text" class="form-control">
                </td>
                <?php // } 
                ?>
                <?php //$i++ 
                ?>
                 <?php $i++ ?>
            <?php endforeach; ?>
           

        <?php //endforeach; ?>


    </tr>
    <?php $i + 1 ?>
<?php endforeach; ?>

</table>
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
</section>