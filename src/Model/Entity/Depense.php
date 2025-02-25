<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Depense Entity
 *
 * @property int $id
 * @property string|null $date
 * @property float|null $montant
 * @property string|null $observation
 * @property int|null $paiement_id
 * @property int|null $typedepense_id
 * @property int|null $caisse_id
 * @property float|null $solde
 * @property int|null $numero
 *
 * @property \App\Model\Entity\Paiement $paiement
 * @property \App\Model\Entity\Typedepense $typedepense
 * @property \App\Model\Entity\Caiss $caiss
 */
class Depense extends Entity
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
        'date' => true,
        'montant' => true,
        'observation' => true,
        'paiement_id' => true,
        'typedepense_id' => true,
        'caisse_id' => true,
        'solde' => true,
        'numero' => true,
        'paiement' => true,
        'typedepense' => true,
        'caiss' => true,
        'fournisseur_id' => true,
        'porteur' => true,
        'rib' => true,
        'numeropiece' => true,
        'compte_id' => true,
        'type'=>true,
        'commandefournisseur_id'=>true,
        'echeance'=>true,




    ];
}
