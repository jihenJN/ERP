<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reglementcommercial Entity
 *
 * @property int $id
 * @property string $numero
 * @property int $commercial_id
 * @property int $paiement_id
 * @property \Cake\I18n\FrozenTime $date
 * @property string $montant
 * @property string $montantpaye
 * @property int $numero_cheque
 * @property \Cake\I18n\FrozenDate|null $date_echeance
 * @property int $banque_id
 *
 * @property \App\Model\Entity\Commercial $commercial
 * @property \App\Model\Entity\Paiement $paiement
 * @property \App\Model\Entity\Lignereglementcommercial[] $lignereglementcommercials
 * @property \App\Model\Entity\Lignereglementcommercials[] $lignereglementcommercialss
 */
class Reglementcommercial extends Entity
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
        'numero' => true,
        'commercial_id' => true,
        'paiement_id' => true,
        'date' => true,
        'montant' => true,
        'montantpaye' => true,
        'numero_cheque' => true,
        'date_echeance' => true,
        'banque_id' => true,
        'banque'=>true,
        'commercial' => true,
        'paiement' => true,
        'lignereglementcommercials' => true,
    //    'lignereglementcommercialss' => true,
    ];
}
