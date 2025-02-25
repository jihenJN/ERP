<?php
echo $this->Html->css('select2');

use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<section class="content-header">
    <header>
        <h1 style="text-align:center;">Solde Clients</h1>
    </header>
</section>
<br>
<section class="content-header">
    <h1>Recherche</h1>
</section>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <?= $this->Form->create(null, ['type' => 'get']); ?>
                <div class="row">
                    <div class="col-xs-6">
                        <?= $this->Form->control('date1', [
                            'value' => $date1 ?? null,
                            'div' => 'form-group',
                            'between' => '<div class="col-sm-10">',
                            'after' => '</div>',
                            'class' => 'form-control datePickerOnly',
                            'type' => 'date',
                            'label' => 'Date de'
                        ]); ?>
                    </div>
                    <div class="col-xs-6">
                        <?= $this->Form->control('date2', [
                            'value' => $date2 ?? null,
                            'div' => 'form-group',
                            'between' => '<div class="col-sm-10">',
                            'after' => '</div>',
                            'class' => 'form-control datePickerOnly',
                            'type' => 'date',
                            'label' => "Jusqu'à"
                        ]); ?>
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-3">
                        <button type="submit" class="btn btn-primary" style="background-color: #acbf60; border: #acbf60;">Afficher</button>
                        <?php if ($this->request->getQuery()) : ?>
                            <a onclick="openWindow(1000, 1000, wr+'Factureclients/impetatsolde?date1=<?= $date1 ?>&date2=<?= $date2 ?>')">
                                <button class="btn btn-primary" style="background-color: #acbf60; border: #acbf60;">Imprimer</button>
                            </a>
                        <?php else : ?>
                            <a onclick="openWindow(1000, 1000, wr+'Factureclients/impetatsolde')">
                                <button class="btn btn-primary" style="background-color: #acbf60; border: #acbf60;">Imprimer</button>
                            </a>
                        <?php endif; ?>
                        <?= $this->Html->link(__('Actualiser'), ['action' => 'etatsoldeclient'], ['class' => 'btn btn-primary', 'style' => 'background-color: #acbf60; border: #acbf60;']) ?>
                    </div>
                </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
<br>
<input type="hidden" id="page" value="1" />
<h3 style="margin-left: 5px;">Tous Les Clients</h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="ls-editable-table table-responsive ls-table" style="width:98%;">
                    <table id="example1" class="table table-bordered table-striped table-bottomless">
                        <thead>
                            <tr>
                                <th width="7%" align="center" style="text-align: center; background-color: #acbf60;">
                                    <span style="color: #000000; font-style: italic; font-weight: bold;"><strong>Code</strong></span>
                                </th>
                                <th width="15%" align="center" style="text-align: center; background-color: #acbf60;">
                                    <span style="color: #000000; font-style: italic; font-weight: bold;"><strong>Client</strong></span>
                                </th>
                                <th width="10%" align="center" style="text-align: center; background-color: #acbf60;">
                                    <span style="color: #000000; font-style: italic; font-weight: bold;"><strong>Solde départ</strong></span>
                                </th>
                                <th width="5%" align="center" style="text-align: center; background-color: #acbf60;">
                                    <span style="color: #000000; font-style: italic; font-weight: bold;"><strong>Débit</strong></span>
                                </th>
                                <th width="10%" align="center" style="text-align: center; background-color: #acbf60;">
                                    <span style="color: #000000; font-style: italic; font-weight: bold;"><strong>Crédit</strong></span>
                                </th>
                                <th width="8%" align="center" style="text-align: center; background-color: #acbf60;">
                                    <span style="color: #000000; font-style: italic; font-weight: bold;"><strong>Solde</strong></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $generel = 0;
                            $soldef = 0;
                            foreach ($data as $client_data) :

                                $soldef = ($client_data['soldedepart'] + $client_data['Debit']) -  $client_data['Credit'];
                                $generel +=  $soldef; ?>
                                <tr>
                                    <td><?= h($client_data['code']) ?></td>
                                    <td><?= h($client_data['client']) ?></td>
                                    <td><?php echo sprintf("%01.3f", abs($client_data['soldedepart'])); ?></td>
                                    <td><?php echo sprintf("%01.3f", abs($client_data['Debit'])); ?></td>
                                    <td><?php echo sprintf("%01.3f", abs($client_data['Credit'])); ?></td>
                                    <td><?php echo sprintf("%01.3f", abs($soldef)); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tr>
                            <td align="center" colspan="5" style="background-color: #acbf60;"><strong>Total</strong></td>
                            <td align="center"><strong><?php echo number_format(abs($generel), 3, ',', ' '); ?></strong></td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'css']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min', ['block' => 'css']); ?>
<!-- iCheck for checkboxes and radio inputs -->
<?php echo $this->Html->css('AdminLTE./plugins/iCheck/all', ['block' => 'css']); ?>
<!-- Bootstrap Color Picker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min', ['block' => 'css']); ?>
<!-- Bootstrap time Picker -->
<?php echo $this->Html->css('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<!-- InputMask -->
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.extensions', ['block' => 'script']); ?>
<!-- date-range-picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/moment/min/moment.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'script']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min', ['block' => 'script']); ?>
<!-- bootstrap color picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
<!-- bootstrap time picker -->
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>
<script>

    $(document).ready(function() {
        $('#example1').DataTable()


        // Ajuster l'ordre de tri initial
    });

    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<?php $this->end(); ?>

