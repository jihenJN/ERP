<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fournisseurbanque Entity
 *
 * @property int $id
 * @property int|null $banque_id
 * @property string $agence
 * @property string $code_banque
 * @property string|null $swift
 * @property string $compte
 * @property string $rib
 * @property string $document
 * @property int $fournisseur_id
 *
 * @property \App\Model\Entity\Banque $banque
 * @property \App\Model\Entity\Fournisseur $fournisseur
 */
class Fournisseurbanque extends Entity
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
        'banque_id' => true,
        'agence' => true,
        'code_banque' => true,
        'swift' => true,
        'compte' => true,
        'rib' => true,
        'document' => true,
        'fournisseur_id' => true,
        'banque' => true,
        'fournisseur' => true,
    ];
}
