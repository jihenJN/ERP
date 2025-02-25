<?php $this->layout = 'def'; ?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
</head>
<body>
    <!-- Votre contenu HTML pour le PDF -->
    <div style="position: relative; top: 0;">
        <div style="background-color: black; height: 60px;width:110%;margin-top:-30px"></div>
        <div style="position: absolute; top: 20px; left: 10%; transform: translateX(-50%); z-index: 1;">
            <?= $this->Html->image('logoggb.png', ['alt' => 'CakePHP', 'height' => '125px', 'width' => '140px']) ?>
        </div>
    </div>
    <div style="margin:30px">
        <div style="width: 87%;height: 20px;margin-left:10%;margin-right:5%;margin-top: 30px;">
            <div style=" display: flex; position: relative; justify-content: flex-end; color: #103458; font-size: 1.5em; ">
                <strong>Proposition commerciale</strong><br>
            </div>
            <div style="display: flex; position: relative; justify-content: flex-end; color: #103458; font-size: 1.5em;">
                <strong>Réf. :</strong>
                (<strong><?= h($commandeclient->code) ?></strong>)
            </div>
            <div style="display: flex; position: relative; justify-content: flex-end; font-size:1em; color: #103458;">
                Date : <?= h($commandeclient->date) ?>
            </div>
            <div style="display: flex; position: relative; justify-content: flex-end; font-size:1em; color: #103458;">
                Validité de l'offre : <?= h($commandeclient->duree_validite) ?> Jours
            </div>
            <div style="display: flex; position: relative; justify-content: flex-end; font-size:1em; color: #103458;">
                Code client : <?= h($commandeclient->client->codeclient) ?>
            </div>
        </div>
        <!-- Ajoutez le reste de votre contenu HTML ici -->
    </div>
</body>
</html>
