<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tach Entity
 *
 * @property int $id
 * @property string|null $ref
 * @property string|null $libelle
 * @property int|null $projet_id
 * @property \Cake\I18n\FrozenTime|null $dated
 * @property \Cake\I18n\FrozenTime|null $datefin
 * @property string|null $duree
 * @property string|null $dureem
 * @property int|null $progression_id
 * @property string|null $description
 * @property string|null $contact
 *
 * @property \App\Model\Entity\Projet $projet
 * @property \App\Model\Entity\Progression $progression
 */
class Tach extends Entity
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
        'ref' => true,
        'libelle' => true,
        'projet_id' => true,
        'dated' => true,
        'datefin' => true,
        'duree' => true,
        'dureem' => true,
        'progression_id' => true,
        'description' => true,
        'contact' => true,
        'projet' => true,
        'progression' => true,
        'personnel_id' => true,

    ];
}
