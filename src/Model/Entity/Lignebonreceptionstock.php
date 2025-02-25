<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignebonreceptionstock Entity
 *
 * @property int $id
 * @property int|null $bonreceptionstock_id
 * @property int|null $article_id
 * @property int|null $qte
 * @property string|null $prix
 * @property string $total
 *
 * @property \App\Model\Entity\Bonreceptionstock $bonreceptionstock
 * @property \App\Model\Entity\Article $article
 */
class Lignebonreceptionstock extends Entity
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
        'bonreceptionstock_id' => true,
        'article_id' => true,
        'qte' => true,
        'prix' => true,
        'total' => true,
        'bonreceptionstock' => true,
        'article' => true,
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










    ];
}
