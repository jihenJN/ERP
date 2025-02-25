<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bonlivraison Entity
 *
 * @property int $id
 * @property string $numero
 * @property \Cake\I18n\FrozenTime $date
 * @property int $client_id
 * @property int $pointdevente_id
 * @property int $depot_id
 * @property int $materieltransport_id
 * @property int $cartecarburant_id
 * @property int $chauffeur_id
 * @property int $convoyeur_id
 * @property string $totalht
 * @property string $totalttc
 * @property string $totalfodec
 * @property string $totalremise
 * @property string $totaltva
 * @property int $factureclient_id
 * @property float|null $kilometragedepart
 * @property float|null $kilometragearrive
 * @property int|null $adresselivraisonclient_id
 * @property string|null $payementcomptant
 * @property int $poste
 * @property string $tpe
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Pointdevente $pointdevente
 * @property \App\Model\Entity\Depot $depot
 * @property \App\Model\Entity\Materieltransport $materieltransport
 * @property \App\Model\Entity\Cartecarburant $cartecarburant
 * @property \App\Model\Entity\Factureclient $factureclient
 * @property \App\Model\Entity\Adresselivraisonclient $adresselivraisonclient
 * @property \App\Model\Entity\Commande[] $commandes
 * @property \App\Model\Entity\Commandeclient[] $commandeclients
 * @property \App\Model\Entity\Lignebonlivraison[] $lignebonlivraisons
 */
class Bonlivraison extends Entity
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
        'commande_id' => true,
        'numero' => true,
        'date' => true,
        'client_id' => true,
        'pointdevente_id' => true,
        'depot_id' => true,
        'materieltransport_id' => true,
        'cartecarburant_id' => true,
        'chauffeur_id' => true,
        'convoyeur_id' => true,
        'totalht' => true,
        'totalttc' => true,
        'totalfodec' => true,
        'totalremise' => true,
        'totaltva' => true,
        'factureclient_id' => true,
        'kilometragedepart' => true,
        'kilometragearrive' => true,
        'adresselivraisonclient_id' => true,
        'payementcomptant' => true,
        'poste' => true,
        'tpe' => true,
        'client' => true,
        'pointdevente' => true,
        'depot' => true,
        'materieltransport' => true,
        'cartecarburant' => true,
        'factureclient' => true,
        'adresselivraisonclient' => true,
        'commandes' => true,
        'commandeclients' => true,
        'lignebonlivraisons' => true,
        'escompte' => true,
        'montantht' => true,
        'poidstotal'=> true ,
        'nbcartons' => true , 
        'preparatif_id' => true , 
        'commission' => true , 
        'montantcommission' => true , 
        'commercial_id' => true , 
    ];
}
