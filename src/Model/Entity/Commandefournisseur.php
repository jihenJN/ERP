<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Commandefournisseur Entity
 *
 * @property int $id
 * @property int|null $demandeoffredeprix_id
 * @property string|null $numero
 * @property \Cake\I18n\FrozenDate|null $date
 * @property int|null $fournisseur_id
 * @property int|null $pointdevente_id
 * @property int|null $depot_id
 * @property int|null $cartecarburant_id
 * @property int|null $materieltransport_id
 * @property int|null $chauffeur
 * @property int|null $convoyeur
 * @property int $valide
 * @property string|null $remise
 * @property string|null $tva
 * @property string|null $fodec
 * @property string|null $ttc
 * @property string|null $ht
 * @property int $livraison_id
 * @property int $etatliv
 *
 * @property \App\Model\Entity\Demandeoffredeprix $demandeoffredeprix
 * @property \App\Model\Entity\Fournisseur $fournisseur
 * @property \App\Model\Entity\Pointdevente $pointdevente
 * @property \App\Model\Entity\Depot $depot
 * @property \App\Model\Entity\Cartecarburant $cartecarburant
 * @property \App\Model\Entity\Materieltransport $materieltransport
 * @property \App\Model\Entity\Livraison $livraison
 */
class Commandefournisseur extends Entity
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
        '*' => true,
    ];
}
