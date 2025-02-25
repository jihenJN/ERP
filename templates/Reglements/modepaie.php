<!-- Assuming this is your modepaie.ctp file in CakePHP 4 -->

<br><input type="hidden" id="page" value="1"/>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= __('Piéces règlement'); ?></h3>
            </div>
            <div class="panel-body">
                <div class="">
                    <table class="table table-bordered table-striped table-bottomless">
                        <thead>
                            <tr>
                                <th><?= __('Mode paiement'); ?></th>
                                <th><?= __('Montant'); ?></th>
                                <th class="actions" align="center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pieces as $l => $piece) : $k = $l + 1; ?>
                                <tr>
                                    <td><?= $piece->paiement->name; ?>&nbsp;</td>
                                    <td><?= $piece->montant; ?></td>
                                    <td align="center">
                                        <?php if ($piece->paiement_id == 2) : ?>
                                            <a href="<?= $this->Url->build(['controller' => 'Reglements', 'action' => 'imprimstb', $piece->id]); ?>"><i class='fa fa-print'></i></a>
                                        <?php elseif ($piece->paiement_id == 3) : ?>
                                            <a href="<?= $this->Url->build(['controller' => 'Reglements', 'action' => 'imprimtr', $piece->id]); ?>"><i class='fa fa-print'></i></a>
                                        <?php elseif ($piece->paiement_id == 4) : ?>
                                            <a href="<?= $this->Url->build(['controller' => 'Reglements', 'action' => 'imprimvir',  $piece->id]); ?>"><i class='fa fa-print'></i></a>
                                        <?php elseif ($piece->paiement_id == 5) : ?>
                                            <a href="<?= $this->Url->build(['controller' => 'Reglements', 'action' => 'imprimret',  $piece->id]); ?>"><i class='fa fa-print'></i></a>
                                        <?php endif; ?>
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
