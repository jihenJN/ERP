<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ligneretenus Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $date

 * @property int|null $retenu_id
 * @property int|null $factureclient_id
 * @property int|null $to_id
 * @property float|null $totalttc
 * @property float|null $montant
 *
 * @property \App\Model\Entity\Retenus $retenus
 * @property \App\Model\Entity\Factureclient $factureclient
 * @property \App\Model\Entity\To $to
 */
class Ligneretenus extends Entity
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
        'retenu_id' => true,
        'factureclient_id' => true,
        'to_id' => true,
        'totalttc' => true,
        'montant' => true,
        'retenus' => true,
        'factureclient' => true,
        'date' => true,
        'to' => true,
        'montant_net' => true,
        'timbre_id' => true,

    ];
}
