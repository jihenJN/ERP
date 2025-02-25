<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignezonedelegation Entity
 *
 * @property int $id
 * @property int $zone_id
 * @property int $delegation_id
 * @property int $gouvernorat_id
 *
 * @property \App\Model\Entity\Zone $zone
 */
class Lignezonedelegation extends Entity
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
        'delegation_id' => true,
        'gouvernorat_id' => true,
        'zonedelegation_id' => true,
    ];
}
