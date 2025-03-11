<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->css('select2'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Modifier fournisseur
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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo __(''); ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($fournisseur, ['role' => 'form', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"]);
                ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('code', ['label' => 'Code', 'readonly', 'required' => 'off']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('name'); ?>
                        </div>

                        <div class="col-xs-6">
                            <?php echo $this->Form->control('pay_id', ['label' => 'Pays', 'id' => 'pay_id', 'value' => $fournisseur->pay_id, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 pays']); ?>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group input text ">
                                <?php echo $this->Form->control('typeutilisateur_id', ['empty' => 'Veuillez choisir !!', 'label' => 'Type utilisateur', 'class' => 'form-control select2 control-label', 'id' => 'typeutilisateur_id', '' => 'off']); ?>
                            </div>
                        </div>

                    </div>

                    <div class="row">



                        <div class="col-xs-6" id="divgouv" hidden>
                            <?php echo $this->Form->control('gouvernorat_id', ['value' => $fournisseur->gouvernorat_id, 'empty' => 'Veuillez choisir !!', 'id' => 'gouvernorat', 'class' => 'form-control select2 control-label gouv', 'Onchange' => 'gouv(this.value)']); ?>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-xs-6" hidden>
                            <?php echo $this->Form->control('delegation_id', ['label' => 'Delegations', 'id' => 'delegation_id', 'value' => $fournisseur->delegation_id, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2']); ?>
                        </div>

                        <div class="col-xs-6" id="divgouv" hidden>
                            <?php echo $this->Form->control('localite_id', ['label' => 'Localites', 'value' => $fournisseur->localite_id, 'empty' => 'Veuillez choisir !!', 'id' => 'localite', 'class' => 'form-control select2 control-label ']); ?>
                        </div>

                    </div>










                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('secteur'); ?>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group input text ">
                                <?php echo $this->Form->control('devise_id', ['empty' => 'Veuillez choisir !!', 'options' => $devises, 'label' => 'Devise', 'class' => 'form-control select2 control-label', 'id' => 'devise_id', '' => 'off']); ?>
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('codepostal', ['label' => 'Code postal']);
                            ?>
                        </div>
                        <!-- <div class="col-xs-6">
                            <?php echo $this->Form->control('tel'); ?>
                        </div> -->
                        <div class="col-xs-3"><?php echo $this->Form->control('tel', ['label' => 'Télèphone 1']); ?></div>
                        <div class="col-xs-3"><?php echo $this->Form->control('tel1', ['label' => 'Télèphone 2']); ?></div>

                        <div class="col-xs-6">
                            <div class="form-group input text ">
                                <?php echo $this->Form->control('typelocalisation_id', ['empty' => 'Veuillez choisir !!', 'options' => $typelocalisations, 'label' => 'Type localisation', 'class' => 'form-control select2 control-label', 'id' => 'typelocalisation_id', '' => 'off']); ?>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('fax', ['class' => 'form-control control-label']); ?>
                        </div>

                    </div>








                    <div class="row">
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('compte_comptable', ['class' => 'form-control control-label']);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('mail'); ?>
                        </div>

                        <div class="col-xs-6">
                            <?php echo $this->Form->control('site'); ?>
                        </div>
                        <div class="col-xs-6">

                            <?php echo $this->Form->control('paiement_id', ['label' => 'Mode paiement', 'empty' => 'Veuillez choisir !!', 'options' => $paiements, 'class' => 'form-control select2 control-label', 'id' => 'paiement_id', '' => 'off']); ?>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('activite');
                            ?>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group input text ">
                                <?php echo $this->Form->control('exo', ['empty' => 'Veuillez choisir !!', 'options' => $exonerations, 'label' => 'Exonerations', 'class' => 'form-control select2 control-label exo', 'id' => 'exo', '' => 'off']);  ?>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('soldedebut', ['label' => 'Solde Debut']); ?>
                        </div>
                    </div>






                </div>














                <section class="content-header" hidden>
                    <h1 class="box-title"><?php echo __('Adresse de livraison'); ?></h1>
                </section>



                <section class="content" style="width: 99%" hidden>

                    <div class="box box">
                        <div class="box-header with-border">
                            <a class="btn btn-primary al " data-toggle="modal" data-target="#modal-default" table='addtable' index='index' id='ajouter_ligne' style="
                                            float: right;
                                            margin-bottom: 5px;
                                            ">
                                <i class="fa fa-plus-circle "></i> Ajouter adresse de livraison</a>
                            <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                                <tbody>




                                    <?php
                                    $ii = -1;
                                    foreach ($adressees as $ii => $res) :
                                    ?>
                                        <tr>
                                            <td style="width: 8%;" align="center" background-color="white">

                                                <?php echo $this->Form->input('sup', array('name' => 'data[lignead][' . $ii . '][sup]', 'id' => 'sup' . $ii, 'champ' => 'sup', 'table' => 'ligne', 'index' => $ii, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                ?>
                                                <strong>Adresse</strong>
                                            </td>
                                            <?php echo $this->Form->input('id', array('label' => '', 'value' => $res->id, 'name' => 'data[lignead][' . $ii . '][id]', 'type' => 'hidden', 'id' => 'id' . $ii, 'table' => 'ligne', 'index' => $ii, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                            <td align="center">


                                                <?php echo $this->Form->input('adresse', array('label' => '', 'value' => $res->adresse, 'name' => 'data[lignead][' . $ii . '][adresse]', 'type' => 'text', 'id' => 'adresse' . $ii, 'table' => 'ligne', 'index' => $ii, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                            </td>

                                            <td align="center" background-color="white"><i index="<?php echo $ii ?>" class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;"></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr class="tr" style="display: none !important">


                                        <td style="width: 8%;" align="center">
                                            <?php echo $this->Form->input('sup', array('name' => '', 'id' => '', 'champ' => 'sup', 'table' => 'lignead', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                            ?> <strong>Adresse</strong>
                                        </td>




                                        <td align="center">

                                            <input table="lignead" type="text" class="form-control" table="lignead" name="" id="" champ="adresse">
                                        </td>

                                        <td align="center">
                                            <i index="" id="" class="fa fa-times supLigne" style="color: #c9302c;font-size: 22px;"></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table><br />
                            <input type="hidden" value="<?php echo $ii ?>" id="index">
                        </div>
                    </div>
                </section>



                <section class="content-header">
                    <h1 class="box-title"><?php echo __('Les responsables'); ?></h1>
                </section>


                <section class="content" style="width: 99%">
                    <div class="row">
                        <div class="box">
                            <div class="box-header with-border">
                                <a class="btn btn-primary  " table='addtable' index='index0' id='ajouter_ligne0' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                    <i class="fa fa-plus-circle "></i> Ajouter responsable</a>

                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne0">

                                        <thead>
                                            <tr width:20px>
                                                <td align="center" style="width: 25%;"><strong>Nom du responsable</strong></td>
                                                <td align="center" style="width: 25%;"><strong>Email</strong></td>
                                                <td align="center" style="width: 25%;"><strong>Téléphone</strong></td>
                                                <td align="center" style="width: 25%;"><strong>Poste</strong></td>
                                                <td align="center" style="width: 25%;"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class='tr' style="display: none !important">
                                                <td style="width: 8%;" align="center">



                                                    <?php echo $this->Form->input('sup1', array('name' => '', 'id' => '', 'champ' => 'sup1', 'table' => 'ligne', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                    ?>


                                                    <?php echo $this->Form->input('id', array('champ' => 'id', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'ligne', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    <?php echo $this->Form->input('aaa', array('champ' => 'aaa', 'label' => '', 'name' => '', 'type' => 'text', 'id' => 'aaa', 'table' => 'ligne', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>


                                                </td>
                                                <td align="center">

                                                    <?php echo $this->Form->input('mail', array('champ' => 'mail', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'ligne', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                </td>
                                                <td align="center">

                                                    <?php echo $this->Form->input('tel', array('label' => '', 'champ' => 'tel', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'ligne', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control four1')); ?>
                                                </td>
                                                <td align="center">

                                                    <?php echo $this->Form->input('poste', array('champ' => 'poste', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'ligne', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                </td>
                                                <td align="center"><i index="" id="" class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;"></td>
                                            </tr>






                                            <?php
                                            $i = -1;
                                            foreach ($responsable as $i => $res) :
                                            ?>
                                                <tr>
                                                    <td style="width: 8%;" align="center" background-color="white">

                                                        <?php echo $this->Form->input('sup1', array('name' => 'data[ligne][' . $i . '][sup1]', 'id' => 'sup1' . $i, 'champ' => 'sup1', 'table' => 'ligne', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                        ?>
                                                        <?php echo $this->Form->input('id', array('label' => '', 'value' => $res->id, 'name' => 'data[ligne][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'ligne', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                        <?php echo $this->Form->input('aaa', array('label' => '', 'value' => $res->name, 'name' => 'data[ligne][' . $i . '][aaa]', 'type' => 'text', 'id' => 'aaa' . $i, 'table' => 'ligne', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>
                                                    <td align="center" background-color="white">
                                                        <?php echo $this->Form->input('mail', array('label' => '', 'value' => $res->mail, 'name' => 'data[ligne][' . $i . '][mail]', 'type' => 'text', 'id' => 'mail' . $i, 'table' => 'ligne', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>

                                                    </td>
                                                    <td align="center" background-color="white">
                                                        <?php echo $this->Form->input('tel', array('label' => '', 'value' => $res->tel, 'name' => 'data[ligne][' . $i . '][tel]', 'type' => 'text', 'id' => 'tel' . $i, 'table' => 'ligne', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control four1')); ?>
                                                    </td>
                                                    <td align="center" align="center" background-color="white">
                                                        <?php echo $this->Form->input('poste', array('label' => '', 'value' => $res->poste, 'name' => 'data[ligne][' . $i . '][poste]', 'type' => 'text', 'id' => 'poste' . $i, 'table' => 'ligne', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>
                                                    <td align="center" background-color="white"><i index="<?php echo $i ?>" class="fa fa-times supLigne1" style="color: #C9302C;font-size: 22px;"></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table><br />
                                    <input type="hidden" value="<?php echo $i ?>" id="index0">
                                </div>
                            </div>
                        </div>
                    </div>


                </section>

                <section class="content-header">
                    <h1 class="box-title"><?php echo __('Les comptes bancaires'); ?></h1>
                </section>
                <section class="content" style="width: 99%">
                    <div class="row">
                        <div class="box">
                            <div class="box-header with-border">
                                <a class="btn btn-primary al" table='addtable' index='index1' id='ajouter_ligne1' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                    <i class="fa fa-plus-circle "></i> Ajouter compte bancaire</a>

                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne1">
                                        <thead>
                                            <tr width:20px>
                                                <td align="center" style="width: 10%;"><strong>Banque</strong></td>
                                                <td align="center" style="width: 20%;"><strong>Code agence</strong></td>
                                                <td align="center" style="width: 10%;"><strong>Code banque</strong></td>
                                                <td align="center" style="width: 10%;"><strong>Code SWIFT</strong></td>
                                                <td align="center" style="width: 10%;"><strong>Compte</strong></td>
                                                <td align="center" style="width: 10%;"><strong>RIB</strong></td>
                                                <td align="center" style="width: 15%;"><strong>Document</strong></td>
                                                <td align="center" style="width: 25%;"></td>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class='tr' style="display: none !important">
                                                <td style="width: 8%;" align="center">
                                                    <?php echo $this->Form->input('sup4', array('name' => 'sup4', 'id' => '', 'champ' => 'sup4', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                    ?>

                                                    <select name="" id="banque_id" table="ligner" champ="banque_id" class="form-control select selectized">
                                                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                                        <?php foreach ($ban as $id => $b) {
                                                        ?>
                                                            <option value="<?php echo $id; ?>"><?php echo $b ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php echo $this->Form->input('id', array('champ' => 'id', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                </td>
                                                <td align="center">
                                                    <?php echo $this->Form->input('code agence', array('champ' => 'agence', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                </td>
                                                <td align="center">

                                                    <?php echo $this->Form->input('code banque', array('champ' => 'code_banque', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                </td>
                                                <td align="center">

                                                    <?php echo $this->Form->input('code swift', array('champ' => 'swift', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                </td>
                                                <td align="center">

                                                    <?php echo $this->Form->input('compte', array('champ' => 'compte', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                </td>
                                                <td align="center">

                                                    <?php echo $this->Form->input('rib', array('champ' => 'rib', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                </td>
                                                <td align="center">
                                                    <!-- <?php echo $this->Form->input('documenttt', array('champ' => 'documenttt', 'label' => '', 'name' => 'documenttt', 'type' => 'file', 'id' => '', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    -->
                                                    <input type="file" table="ligner" champ="documenttt" name="documenttt" class="form-control" id="documenttt">
                                                </td>







                                                <td align="center"><i index="" id="" class="fa fa-times supLigne0" style="color: #C9302C;font-size: 22px;"></td>
                                            </tr>
                                            <?php
                                            $i = -1;
                                            foreach ($banquess as $i => $banque) :
                                                //debug($banque);die;
                                            ?>
                                                <tr>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('sup4', array('name' => 'data[ligner][' . $i . '][sup4]', 'id' => 'sup4' . $i, 'champ' => 'sup4', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                        ?>
                                                        <?php echo $this->Form->input('id', array('label' => '', 'value' => $banque->id, 'name' => 'data[ligner][' . $i . '][id]', 'type' => 'hidden', 'id' => '' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                        <?php echo $this->Form->control('banque_id', array('label' => false, 'options' => $ban, 'value' => $banque->banque_id, 'name' => 'data[ligner][' . $i . '][banque_id]', 'id' => 'banque_id' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control select2')); ?>
                                                    </td>

                                                    <td align="center">
                                                        <?php echo $this->Form->input('agence', array('label' => '', 'value' => $banque->agence, 'name' => 'data[ligner][' . $i . '][agence]', 'type' => 'text', 'id' => 'agence' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('code banque', array('label' => '', 'value' => $banque->code_banque, 'name' => 'data[ligner][' . $i . '][code_banque]', 'type' => 'text', 'id' => 'code_banque' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('swift', array('label' => '', 'value' => $banque->swift, 'name' => 'data[ligner][' . $i . '][swift]', 'type' => 'text', 'id' => 'swift' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>

                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('compte', array('label' => '', 'value' => $banque->compte, 'name' => 'data[ligner][' . $i . '][compte]', 'type' => 'text', 'id' => 'compte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('rib', array('label' => '', 'value' => $banque->rib, 'name' => 'data[ligner][' . $i . '][rib]', 'type' => 'text', 'id' => 'rib' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <input type="file" table="ligner" champ="documenttt" name="data[ligner][<?php echo $i; ?>][documenttt]" class="form-control" id="">
                                                        <?php //echo $this->Html->link('' .  $banque->document, ['style' => 'max-width:200px;height:200px;']); 
                                                        ?>
                                                        <?php echo $this->Html->link(
                                                            $banque->document, // Le texte ou le nom du lien
                                                            '/img/' . $banque->document, // L'URL du lien
                                                            ['target' => '_blank', 'style' => 'max-width:200px;height:200px;'] // Options supplémentaires
                                                        ); ?>

                                                    </td>
                                                    <td align="center"><i index="<?php echo $i ?>" class="fa fa-times supLigne0" style="color: #C9302C;font-size: 22px;"></td>
                                                </tr>
                                            <?php endforeach; ?>



                                        </tbody>
                                    </table><br />
                                    <input type="hidden" value="<?php echo $i ?>" id="index1">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>





                <div align="center">
                    <button type="submit" class="pull-right btn btn-success btn-sm " id="testfour" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

                </div>

                <?php echo $this->Form->end(); ?>

                <!-- /.box -->
            </div>
        </div>
    </div>


    <!-- /.ro<w -->
</section>




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
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()
        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: 'MM/DD/YYYY h:mm A'
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })
        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()
        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    })
</script>
<?php $this->end(); ?>


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
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-d    a        t              epicker.min', ['block' => 'script']); ?>
<!-- bootstrap color picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
<!-- bootstrap time picker -->
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {

        $('#typelocalisation_id').on('change', function() {
            // alert('hello');
            id = $('#typelocalisation_id').val();
            /// alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Fournisseurs', 'action' => 'getdevise']) ?>",
                dataType: "json",
                data: {
                    id: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    //alert(data.select);
                    $('#devise_id').html(data.select);
                    // $('#gouvernorat').select2();
                    // uniform_select('sousfamille1_id');


                }

            })

        });
    });
</script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()
        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: ' MM/DD/YYYY h:mm A'
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })
        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()
        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    })
</script>
<?php $this->end(); ?>