<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fournisseurresponsable Entity
 *
 * @property int $id
 * @property string $name
 * @property string $mail
 * @property int $tel
 * @property string $poste
 * @property int $fournisseur_id
 *
 * @property \App\Model\Entity\Fournisseur $fournisseur
 */
class Fournisseurresponsable extends Entity
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
        'name' => true,
        'mail' => true,
        'tel' => true,
        'poste' => true,
        'fournisseur_id' => true,
        'fournisseur' => true,
    ];
}
