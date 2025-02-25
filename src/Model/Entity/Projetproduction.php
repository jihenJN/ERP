<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Projetproduction Entity
 *
 * @property int $id
 * @property int|null $projet_id
 * @property int|null $parametrageproduction_id
 * @property int $planifier
 * @property string|null $numero_of
 * @property int $reel
 * @property \Cake\I18n\FrozenTime|null $dateproduction
 *
 * @property \App\Model\Entity\Projet $projet
 * @property \App\Model\Entity\Parametrageproduction $parametrageproduction
 */
class Projetproduction extends Entity
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
        'projet_id' => true,
        'parametrageproduction_id' => true,
        'planifier' => true,
        'numero_of' => true,
        'reel' => true,
        'dateproduction' => true,
        'projet' => true,
        'parametrageproduction' => true,
    ];
}
