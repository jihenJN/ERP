<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 * @var \Cake\Collection\CollectionInterface|string[] $familles
 * @var \Cake\Collection\CollectionInterface|string[] $sousfamille1s
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Articles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="articles form content">
            <?= $this->Form->create($article) ?>
            <fieldset>
                <legend><?= __('Add Article') ?></legend>
                <?php
                    echo $this->Form->control('Code_Socit');
                    echo $this->Form->control('Code');
                    echo $this->Form->control('Dsignation');
                    echo $this->Form->control('Description');
                    echo $this->Form->control('famille_id', ['options' => $familles, 'empty' => true]);
                    echo $this->Form->control('sousfamille1_id', ['options' => $sousfamille1s, 'empty' => true]);
                    echo $this->Form->control('tva_id');
                    echo $this->Form->control('Quantit_Minimale');
                    echo $this->Form->control('Quantit_Maximale');
                    echo $this->Form->control('Quantit_Opt_Commande');
                    echo $this->Form->control('Prix_Moyen_Pondr');
                    echo $this->Form->control('Quantit_Command');
                    echo $this->Form->control('Quantit_Reserv');
                    echo $this->Form->control('Quantit_Disponible');
                    echo $this->Form->control('Quantit_Inventaire');
                    echo $this->Form->control('Date_Inventaire');
                    echo $this->Form->control('Quantit_LastInput');
                    echo $this->Form->control('Prix_LastInput');
                    echo $this->Form->control('Date_LastInput');
                    echo $this->Form->control('Stockage');
                    echo $this->Form->control('artM');
                    echo $this->Form->control('PrixGamme');
                    echo $this->Form->control('AtGamme');
                    echo $this->Form->control('PrixNom');
                    echo $this->Form->control('QTR');
                    echo $this->Form->control('QTRSRT');
                    echo $this->Form->control('PXNOM2008');
                    echo $this->Form->control('PXGAMME2008');
                    echo $this->Form->control('QT2');
                    echo $this->Form->control('QTLN');
                    echo $this->Form->control('QTLR');
                    echo $this->Form->control('NBPC');
                    echo $this->Form->control('MD1');
                    echo $this->Form->control('MD2');
                    echo $this->Form->control('MD3');
                    echo $this->Form->control('MD4');
                    echo $this->Form->control('MD5');
                    echo $this->Form->control('MD6');
                    echo $this->Form->control('MD7');
                    echo $this->Form->control('MD8');
                    echo $this->Form->control('MD9');
                    echo $this->Form->control('MD10');
                    echo $this->Form->control('MD11');
                    echo $this->Form->control('MD12');
                    echo $this->Form->control('MA1');
                    echo $this->Form->control('MA2');
                    echo $this->Form->control('MA3');
                    echo $this->Form->control('MA4');
                    echo $this->Form->control('MA5');
                    echo $this->Form->control('MA6');
                    echo $this->Form->control('MA7');
                    echo $this->Form->control('MA8');
                    echo $this->Form->control('MA9');
                    echo $this->Form->control('MA10');
                    echo $this->Form->control('MA11');
                    echo $this->Form->control('MA12');
                    echo $this->Form->control('QT1');
                    echo $this->Form->control('QT2M');
                    echo $this->Form->control('QT3');
                    echo $this->Form->control('QT4');
                    echo $this->Form->control('QT5');
                    echo $this->Form->control('QT6');
                    echo $this->Form->control('QT7');
                    echo $this->Form->control('QT8');
                    echo $this->Form->control('QT9');
                    echo $this->Form->control('QT10');
                    echo $this->Form->control('QT11');
                    echo $this->Form->control('QT12');
                    echo $this->Form->control('cptt');
                    echo $this->Form->control('Poid');
                    echo $this->Form->control('Unite');
                    echo $this->Form->control('Barre');
                    echo $this->Form->control('PHT');
                    echo $this->Form->control('Poids');
                    echo $this->Form->control('LG');
                    echo $this->Form->control('LR');
                    echo $this->Form->control('LZ');
                    echo $this->Form->control('GRM');
                    echo $this->Form->control('TPP');
                    echo $this->Form->control('FRM');
                    echo $this->Form->control('CodeM');
                    echo $this->Form->control('ST');
                    echo $this->Form->control('QTMAG');
                    echo $this->Form->control('PTTC');
                    echo $this->Form->control('Quantit_Disponible02');
                    echo $this->Form->control('Quantit_Disponible03');
                    echo $this->Form->control('CodeEcolef');
                    echo $this->Form->control('PRIXEcolef');
                    echo $this->Form->control('POIDSECOLEF');
                    echo $this->Form->control('CodeTPE');
                    echo $this->Form->control('TXTPE');
                    echo $this->Form->control('CTGPOINT');
                    echo $this->Form->control('UserAdd');
                    echo $this->Form->control('DateAdd');
                    echo $this->Form->control('UserUpdate');
                    echo $this->Form->control('DateUpdate');
                    echo $this->Form->control('QTDISP');
                    echo $this->Form->control('QTMAGSV');
                    echo $this->Form->control('QTINV');
                    echo $this->Form->control('DTINV');
                    echo $this->Form->control('PrixMP');
                    echo $this->Form->control('PrixMO');
                    echo $this->Form->control('PrixMA');
                    echo $this->Form->control('PrixEN');
                    echo $this->Form->control('TauxCharge');
                    echo $this->Form->control('CoutRevient');
                    echo $this->Form->control('image');
                    echo $this->Form->control('etat');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
