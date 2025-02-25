<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignecompte Entity
 *
 * @property int $id
 * @property int|null $typecredit_id
 * @property int|null $compte_id
 *
 * @property \App\Model\Entity\Typecredit $typecredit
 * @property \App\Model\Entity\Compte $compte
 */
class Lignecompte extends Entity
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
        'typecredit_id' => true,
        'compte_id' => true,
        'typecredit' => true,
        'compte' => true,
    ];
}
