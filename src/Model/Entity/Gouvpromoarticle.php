<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Gouvpromoarticle Entity
 *
 * @property int $id
 * @property int $promoarticle_id
 * @property int $delegation_id
 * @property int $gouvernorat_id
 * @property int $toutgouv
 *
 * @property \App\Model\Entity\Promoarticle $promoarticle
 * @property \App\Model\Entity\Delegation $delegation
 * @property \App\Model\Entity\Gouvernorat $gouvernorat
 */
class Gouvpromoarticle extends Entity
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
        'promoarticle_id' => true,
        'delegation_id' => true,
        'gouvernorat_id' => true,
        'toutgouv' => true,
        'promoarticle' => true,
        'delegation' => true,
        'gouvernorat' => true,
    ];
}
