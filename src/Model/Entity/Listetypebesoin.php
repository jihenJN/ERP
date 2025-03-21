<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Listetypebesoin Entity
 *
 * @property int $id
 * @property int|null $typebesoin_id
 * @property int|null $visite_id
 *
 * @property \App\Model\Entity\Typebesoin $typebesoin
 */
class Listetypebesoin extends Entity
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
        'typebesoin_id' => true,
        'visite_id' => true,
        'typebesoin' => true,
    ];
}
