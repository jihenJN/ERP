<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ville Entity
 *
 * @property int $id
 * @property string $name
 * @property int $pay_id
 *
 * @property \App\Model\Entity\Pay $pay
 * @property \App\Model\Entity\Client[] $clients
 * @property \App\Model\Entity\Fournisseur[] $fournisseurs
 * @property \App\Model\Entity\Pointdevente[] $pointdeventes
 * @property \App\Model\Entity\Region[] $regions
 */
class Ville extends Entity
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
        'pay_id' => true,
        'pay' => true,
        'clients' => true,
        'fournisseurs' => true,
        'pointdeventes' => true,
        'regions' => true,
    ];
}
