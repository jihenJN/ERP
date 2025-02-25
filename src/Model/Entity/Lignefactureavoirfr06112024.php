<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignefactureavoirfr Entity
 *
 * @property int $id
 * @property int|null $factureavoirfr_id
 * @property int|null $lignefacture_id
 * @property int|null $unitearticle_id
 * @property int|null $lignebonreceptionstock_id
 * @property int|null $depot_id
 * @property int|null $article_id
 * @property float|null $quantite
 * @property string|null $prix
 * @property string|null $prixnet
 * @property string|null $prixhtva
 * @property string|null $puttc
 * @property string|null $totalhtans
 * @property int|null $remise
 * @property int|null $fodec
 * @property int|null $tva_id
 * @property string|null $totalht
 * @property string|null $totalttc
 *
 * @property \App\Model\Entity\Factureavoirfr $factureavoirfr
 */
class Lignefactureavoirfr extends Entity
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
        'factureavoirfr_id' => true,
        'lignefacture_id' => true,
        'lignebonreceptionstock_id' => true,
        'depot_id' => true,
        'article_id' => true,
        'quantite' => true,
        'prix' => true,
        'prixnet' => true,
        'prixhtva' => true,
        'puttc' => true,
        'totalhtans' => true,
        'remise' => true,
        'fodec' => true,
        'tva' => true,
        'totalht' => true,
        'totalttc' => true,
        'factureavoirfr' => true,
        'unitearticle_id'=> true,
        'unitearticle'=> true,
    ];
}
