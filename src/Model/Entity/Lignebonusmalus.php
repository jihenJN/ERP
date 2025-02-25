<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignebonusmalus Entity
 *
 * @property int $id
 * @property int $moi_id
 * @property float $qtelivre
 * @property float $objectif
 * @property float $montant
 * @property int $bonusmaluscommercial_id
 * @property int $article_id
 * @property int|null $paye
 * @property float $ecart
 *
 * @property \App\Model\Entity\Mois $mois
 * @property \App\Model\Entity\Bonusmaluscommercial $bonusmaluscommercial
 */
class Lignebonusmalus extends Entity
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
        'moi_id' => true,
        'qtelivre' => true,
        'objectif' => true,
        'montant' => true,
        'montantregle' => true,
        'bonusmaluscommercial_id' => true,
        'article_id' => true,
        'paye' => true,
        'ecart' => true,
        'mois' => true,
        'bonusmaluscommercial' => true,
    ];
}
