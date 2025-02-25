<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Compte Entity
 *
 * @property int $id
 * @property string|null $numero
 * @property int $agence_id
 * @property \Cake\I18n\FrozenTime|null $date
 * @property float|null $montant
 * @property \App\Model\Entity\Agence $agence
 */
class Compte extends Entity
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
        'agence_id' => true,
        'agence' => true,
        'date' => true,
        'montant' => true,
        'rib' => true,
        'banque_id' => true,

    ];
}
