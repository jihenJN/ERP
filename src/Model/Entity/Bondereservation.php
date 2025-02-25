<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bondereservation Entity
 *
 * @property int $id
 * @property string $numero
 * @property \Cake\I18n\FrozenTime|null $date
 * @property int $client_id
 * @property int $pointdevente_id
 * @property int $depot_id
 * @property \Cake\I18n\FrozenTime $datecreation
 * @property int $commandeclient_id
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Pointdevente $pointdevente
 * @property \App\Model\Entity\Depot $depot
 * @property \App\Model\Entity\Commandeclient $commandeclient
 * @property \App\Model\Entity\Lignebondereservation[] $lignebondereservations
 */
class Bondereservation extends Entity
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
        'numero' => true,
        'date' => true,
        'client_id' => true,
        'pointdevente_id' => true,
        'depot_id' => true,
        'datecreation' => true,
        'commandeclient_id' => true,
        'client' => true,
        'pointdevente' => true,
        'depot' => true,
        'commandeclient' => true,
        'lignebondereservations' => true,
    ];
}
