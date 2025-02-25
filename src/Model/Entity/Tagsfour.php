<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tagsfour Entity
 *
 * @property int $id
 * @property int|null $pay_id
 * @property int|null $fournisseurs_id
 *
 * @property \App\Model\Entity\Fournisseur $fournisseur
 */
class Tagsfour extends Entity
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
        'pay_id' => true,
        'fournisseurs_id' => true,
        'fournisseur' => true,
        'listetag_id' => true,
        'categorie_id' => true,

    ];
}
