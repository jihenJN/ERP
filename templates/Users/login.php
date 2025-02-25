<?php $this->layout = 'def'; ?>
<?php use Cake\Core\Configure; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?php echo $societefirst->nom ?> | <?php echo $this->fetch('title'); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <?php echo $this->Html->css('AdminLTE./bower_components/bootstrap/dist/css/bootstrap.min'); ?>
  <!-- Font Awesome -->
  <?php echo $this->Html->css('AdminLTE./bower_components/font-awesome/css/font-awesome.min'); ?>
  <!-- Ionicons -->
  <?php echo $this->Html->css('AdminLTE./bower_components/Ionicons/css/ionicons.min'); ?>
  <!-- Theme style -->
  <?php echo $this->Html->css('AdminLTE.AdminLTE.min'); ?>
  <!-- iCheck -->
  <?php echo $this->Html->css('AdminLTE./plugins/iCheck/square/blue'); ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <?php echo $this->fetch('css'); ?>

  </head>
  <br>
<body class="hold-transition login-page" style="background-color: #333333;" >
<div class="login-box">
 
  <!-- /.login-logo -->
  <div class="login-box-body"  >
    <?php echo $this->Html->image('logoSMBM.png',array('width'=>'320px','height'=>'200px'));?>
    <div class="login-logo">
    <!-- <a href="<?php echo $this->Url->build(); ?>"><b  style="font-size: 50px">SMBM</b></a> -->
    </div>
    <div style=" margin-bottom:40px;" >
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->control('login', ['class'=>"form-control",'required' => true]) ?>
        <?= $this->Form->control('password', ['class'=>"form-control",'required' => true]) ?>
    </fieldset><br>
    <button type="submit" class="pull-right btn btn-success btn-sm alertuserm" style="width: 100%; height: 40px; background-color: #002E50;">
    <i class="fa fa-key"></i>
</button>
    <?= $this->Form->end() ?>
    </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- dans /templates/Users/login.php -->
<!-- jQuery 3 -->
<?php echo $this->Html->script('AdminLTE./bower_components/jquery/dist/jquery.min'); ?>
<!-- Bootstrap 3.3.7 -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap/dist/js/bootstrap.min'); ?>
<!-- iCheck -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min'); ?>

<?php echo $this->fetch('script'); ?>

<?php echo $this->fetch('scriptBottom'); ?>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
<?php echo $this->Html->script('alert'); ?>