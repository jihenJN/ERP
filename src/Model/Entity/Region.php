<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Region Entity
 *
 * @property int $id
 * @property string $name
 * @property int $ville_id
 *
 * @property \App\Model\Entity\Ville $ville
 * @property \App\Model\Entity\Client[] $clients
 * @property \App\Model\Entity\Fournisseur[] $fournisseurs
 */
class Region extends Entity
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
        'name' => true,
        'ville_id' => true,
        'ville' => true,
        'clients' => true,
        'fournisseurs' => true,
    ];
}
