<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Etatchequeexcel Entity
 *
 * @property int $id
 * @property string|null $fournisseur_name
 * @property string|null $numpiece
 * @property \Cake\I18n\FrozenDate|null $echeance
 * @property float|null $montant
 * @property string|null $compte_numero
 */
class Etatchequeexcel extends Entity
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
        'fournisseur_name' => true,
        'numpiece' => true,
        'echeance' => true,
        'montant' => true,
        'compte_numero' => true,
        'etat' => true,
    ];
}
