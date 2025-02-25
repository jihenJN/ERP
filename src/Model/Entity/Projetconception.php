<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Projetconception Entity
 *
 * @property int $id
 * @property int|null $personnel_id
 * @property int|null $projet_id
 * @property string|null $refconception
 * @property int|null $typeconception_id
 * @property string|null $numeroreservation
 * @property \Cake\I18n\FrozenTime|null $dateconception
 *
 * @property \App\Model\Entity\Personnel $personnel
 * @property \App\Model\Entity\Projet $projet
 * @property \App\Model\Entity\Typeconception $typeconception
 */
class Projetconception extends Entity
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
        'personnel_id' => true,
        'projet_id' => true,
        'refconception' => true,
        'typeconception_id' => true,
        'numeroreservation' => true,
        'dateconception' => true,
        'personnel' => true,
        'projet' => true,
        'typeconception' => true,
    ];
}
