<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transferecaiss Entity
 *
 * @property int $id
 * @property int|null $caisse_id
 * @property int|null $id_caisse
 * @property float|null $montant
 * @property string|null $observation
 * @property int|null $numero
 * @property string|null $date
 *
 * @property \App\Model\Entity\Caiss $caiss
 */
class Transferecaiss extends Entity
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
        'caisse_id' => true,
        'id_caisse' => true,
        'montant' => true,
        'observation' => true,
        'numero' => true,
        'date' => true,
        'caiss' => true,
        'commandefournisseur_id' => true,
        'livraison_id' => true,
        'valide' => true,
        'datevalidation' => true,
        'user_id' => true,
        'paiement_id' => true,
        'compte_id' => true,




        

    ];
}
