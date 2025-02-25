
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
  <h1> 
 Modification type Clients
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
        <?php echo $this->Form->create($typeclient, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('type');
            ?>
          </div>
          <div class="col-xs-6" style="margin-top: 2.5%;">
          
                <label class="control-label" style="margin-right: 20px">grandsurface</label>
                oui <input type="radio" name="radio"  <?php if ($typeclient->grandsurface == 1) { ?>   checked="checked"    <?php } ?>  id="active" class="choix1" value="1"  style="margin-right: 20px  " >
                non <input type="radio" name="radio" <?php if ($typeclient->grandsurface == 0) { ?>   checked="checked"     <?php } ?> value="0"  id="desactive" class="choix2">
                <?php echo $this->Form->control('grandsurface', ['type'=>'hidden','label' => '', 'id' => 'grandsurface','required'=>'off', 'div' => 'form-group',   'class' => 'form-control ']); ?>
         
                </div>
          <button type="submit" class="pull-right btn btn-success " id="pvr" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
</section>


<script>
    // $(document).ready(function() {


    //     $('input[type=radio][name=radio]').click(function() {

            
    //         if (this.value == '0') {
    //             $('#desactive').val(Number(0));
    //             //alert('0')
               

    //         }
    //         if (this.value == '1') {
    //             $('#active').val(Number(1));
    //            // alert(1);
               

    //         }
    //     });




    // });
</script>