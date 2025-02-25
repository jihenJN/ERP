<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignefactureclient Entity
 *
 * @property int $id
 * @property int $factureclient_id
 * @property int $article_id
 * @property int $qte
 * @property string $prixht
 * @property string|null $remise
 * @property string $punht
 * @property string $tva
 * @property string|null $fodec
 * @property string|null $ttc
 * @property float|null $qtestock
 * @property string $totaltva
 * @property string|null $totalttc
 * @property string|null $montantht
 *
 * @property \App\Model\Entity\Factureclient $factureclient
 * @property \App\Model\Entity\Article $article
 */
class Lignefactureclient extends Entity
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
        'factureclient_id' => true,
        'article_id' => true,
        'qte' => true,
        'prixht' => true,
        'remise' => true,
        'punht' => true,
        'tva' => true,
        'fodec' => true,
        'ttc' => true,
        'qtestock' => true,
        'totaltva' => true,
        'totalttc' => true,
        'montantht' => true,
        'factureclient' => true,
        'article' => true,
        'ml'=>true,
        'puttc' => true,
        'lignebonlivraison_id' => true,
        'puttcapr'=> true,
        'ttchidden'=> true,

    ];
}
