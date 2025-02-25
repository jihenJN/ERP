<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tacheprojet Entity
 *
 * @property int $id
 * @property string|null $num
 * @property int|null $projet_id
 * @property int|null $tachedesignation_id
 * @property \Cake\I18n\FrozenTime|null $datedebut
 * @property \Cake\I18n\FrozenTime|null $datefin
 * @property int|null $personnel_id
 * @property int|null $etat
 * @property string|null $findetache
 *
 * @property \App\Model\Entity\Tachedesignation $tachedesignation
 * @property \App\Model\Entity\Personnel $personnel
 */
class Tacheprojet extends Entity
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
        'num' => true,
        'projet_id' => true,
        'tachedesignation_id' => true,
        'datedebut' => true,
        'datefin' => true,
        'personnel_id' => true,
        'etat' => true,
        'findetache' => true,
        'tachedesignation' => true,
        'personnel' => true,
    ];
}
