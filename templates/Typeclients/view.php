
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
  <h1> 
  Consultation type Clients
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
        <?php echo $this->Form->create($typeclient, ['role' => 'form']); ?>
        <div class="box-body">
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('type',['readonly']);
            ?>
          </div>
          <div class="col-xs-6" style="margin-top: 2.5%;">
          <?php if($typeclient->grandsurface == 1){ ?>
                <label class="control-label" style="margin-right: 20px">grandsurface</label>
                oui <input disabled type="radio" name="radio" value="1" id="active" class="choix1" style="margin-right: 20px  " checked="checked">
                non <input disabled type="radio" name="radio" value="0" id="desactive" class="choix2">
               <?php } ?>
          <?php if($typeclient->grandsurface == 0){ ?>
                <label class="control-label" style="margin-right: 20px">grandsurface</label>
                oui <input disabled type="radio" name="radio" value="0" id="active" class="choix1" style="margin-right: 20px ">
                non <input disabled type="radio" name="radio" value="1" id="desactive" class="choix2" checked="checked">
                <?php } ?>
                </div>
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
</section>

