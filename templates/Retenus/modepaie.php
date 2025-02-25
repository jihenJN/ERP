<!-- Assuming this is your modepaie.ctp file in CakePHP 4 -->

<br><input type="hidden" id="page" value="1" />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= __('Liste Retenu'); ?></h3>
            </div>
            <div class="panel-body">
                <div class="">
                    <table class="table table-bordered table-striped table-bottomless">
                        <thead>
                            <tr>
                                <th><?= __('Montant'); ?></th>
                                <th class="actions" align="center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pieces as $l => $piece) : $k = $l + 1; ?>
                                <tr>
                                    <td><?= $piece->montant; ?></td>
                                    <td align="center">

                                        <a href="<?= $this->Url->build(['controller' => 'Retenus', 'action' => 'imprimret',  $piece->id]); ?>"><i class='fa fa-print'></i></a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>