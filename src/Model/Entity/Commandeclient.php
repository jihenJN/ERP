<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Commandeclient Entity
 *
 * @property int $id
 * @property string $code
 * @property int $client_id
 * @property \Cake\I18n\FrozenTime $date
 * @property \Cake\I18n\FrozenTime $datedecreation
 * @property string $commentaire
 * @property int $pointdevente_id
 * @property int $depot_id
 * @property string $totalht
 * @property string $totalttc
 * @property string $totalremise
 * @property string $totaltva
 * @property string $totalfodec
 * @property int|null $cartecarburant_id
 * @property int|null $materieltransport_id
 * @property int $bonlivraison_id
 * @property int $etatliv
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Pointdevente $pointdevente
 * @property \App\Model\Entity\Depot $depot
 * @property \App\Model\Entity\Cartecarburant $cartecarburant
 * @property \App\Model\Entity\Materieltransport $materieltransport
 * @property \App\Model\Entity\Chauffeur $chauffeur
 * @property \App\Model\Entity\Convoyeur $convoyeur
 * @property \App\Model\Entity\Bonlivraison $bonlivraison
 * @property \App\Model\Entity\Bondereservation[] $bondereservations
 * @property \App\Model\Entity\Lignebonlivraison[] $lignebonlivraisons
 * @property \App\Model\Entity\Lignecommandeclient[] $lignecommandeclients
 */
class Commandeclient extends Entity
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
        'code' => true,
        'client_id' => true,
        'date' => true,
        'datedecreation' => true,
        'commentaire' => true,
        'pointdevente_id' => true,
        'depot_id' => true,
        'totalht' => true,
        'totalttc' => true,
        'totalremise' => true,
        'totaltva' => true,
        'totalfodec' => true,
        'cartecarburant_id' => true,
        'materieltransport_id' => true,
        'bonlivraison_id' => true,
        'etatliv' => true,
        'client' => true,
        'pointdevente' => true,
        'depot' => true,
        'cartecarburant' => true,
        'materieltransport' => true,
        'chauffeur' => true,
        'convoyeur' => true,
        'bonlivraison' => true,
        'bondereservations' => true,
        'lignebonlivraisons' => true,
        'lignecommandeclients' => true,
    ];
}
