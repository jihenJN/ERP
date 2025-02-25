<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Remiseclient Entity
 *
 * @property int $id
 * @property int $typeclient_id
 *
 * @property \App\Model\Entity\Typeclient $typeclient
 * @property \App\Model\Entity\Ligneremiseclient[] $ligneremiseclients
 */
class Remiseclient extends Entity
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
        'typeclient_id' => true,
        'typeclient' => true,
        'ligneremiseclients' => true,
    ];
}
