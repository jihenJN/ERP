<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ligneremiseclient Entity
 *
 * @property int $id
 * @property int $remiseclient_id
 * @property float $min
 * @property float $max
 *
 * @property \App\Model\Entity\Remiseclient $remiseclient
 */
class Ligneremiseclient extends Entity
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
        'remiseclient_id' => true,
        'min' => true,
        'max' => true,
        'remise' => true,
        'remiseclient' => true,
        'remiseescomptes' => true,
    ];
}
