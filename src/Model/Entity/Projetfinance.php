<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Projetfinance Entity
 *
 * @property int $id
 * @property int|null $projet_id
 * @property int $verificationdevis
 * @property int $verificationpaiement
 * @property \Cake\I18n\FrozenTime|null $datefinance
 *
 * @property \App\Model\Entity\Projet $projet
 */
class Projetfinance extends Entity
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
        'verificationdevis' => true,
        'verificationpaiement' => true,
        'datefinance' => true,
        'projet' => true,
    ];
}
