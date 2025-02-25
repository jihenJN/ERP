<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Listetypedemande Entity
 *
 * @property int $id
 * @property int|null $typedemande_id
 * @property int|null $demandeclient_id
 *
 * @property \App\Model\Entity\Typedemande $typedemande
 * @property \App\Model\Entity\Demandeclient $demandeclient
 */
class Listetypedemande extends Entity
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
        'typedemande_id' => true,
        'demandeclient_id' => true,
        'typedemande' => true,
        'demandeclient' => true,
    ];
}
