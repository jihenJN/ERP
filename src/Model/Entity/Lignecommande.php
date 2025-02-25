<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignecommande Entity
 *
 * @property int $id
 * @property int|null $commande_id
 * @property int $article_id
 * @property float $qte
 * @property string $prix
 * @property float|null $tva
 * @property string $total
 * @property string|null $totalttc
 * @property float $ttc
 * @property int $qtestock
 * @property string $montantht
 * @property string $remise
 * @property string $fodec
 * @property int $totaltva
 * @property string $tpe
 *
 * @property \App\Model\Entity\Commande $commande
 * @property \App\Model\Entity\Article $article
 */
class Lignecommande extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'commande_id' => true,
        'article_id' => true,
        'qte' => true,
        'prix' => true,
        'tva' => true,
        'total' => true,
        'totalttc' => true,
        'ttc' => true,
        'qtestock' => true,
        'montantht' => true,
        'remise' => true,
        'fodec' => true,
        'totaltva' => true,
        'tpe' => true,
        'commande' => true,
        'article' => true,
        'quantiteliv' => true,
        'montantht' => true,
        'categorieclient' => true,
        'prixEntre' => true,
        'totremiseclient' => true,
        'remiseclient'=> true,
        //'remisearticle'=> true,
         'escompte' => true,
        'pourcentageescompte'=> true,
        'lignebonreceptionstock_id' => true ,
        'prixht' => true ,
        'ml' => true,
        'puttc' => true,
        'puttcapr'=> true,
        'ttchidden'=> true,
         ];
}
