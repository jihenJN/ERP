<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Besionachat Entity
 *
 * @property int $id
 * @property string|null $numero
 * @property \Cake\I18n\FrozenTime|null $date
 * @property int|null $personel_id
 * @property string|null $remarque
 */
class Besionachat extends Entity
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
        'personnel_id' => true,
        'remarque' => true,
        'echeance' => true,
        'service_id' => true,
        'demandeoffredeprixe_id' => true,
        'machine_id' => true,



    ];
}