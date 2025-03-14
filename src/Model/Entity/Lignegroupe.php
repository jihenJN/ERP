<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignegroupe Entity
 *
 * @property int $id
 * @property int|null $groupe_id
 * @property int|null $client_id
 *
 * @property \App\Model\Entity\Groupe $groupe
 * @property \App\Model\Entity\Client $client
 */
class Lignegroupe extends Entity
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
        'groupe_id' => true,
        'client_id' => true,
        'groupe' => true,
        'client' => true,
    ];
}
