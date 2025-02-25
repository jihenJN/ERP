<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Factureclient Entity
 *
 * @property int $id
 * @property string $numero
 * @property \Cake\I18n\FrozenTime $date
 * @property int $client_id
 * @property int $pointdevente_id
 * @property int $depot_id
 * @property int $materieltransport_id
 * @property int $cartecarburant_id
 * @property string $totalht
 * @property string $totalremise
 * @property string $totalfodec
 * @property string $totaltva
 * @property string $totalttc
 * @property float|null $kilometragearrive
 * @property float|null $kilometragedepart
 * @property int|null $adresselivraisonclient_id
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Pointdevente $pointdevente
 * @property \App\Model\Entity\Depot $depot
 * @property \App\Model\Entity\Materieltransport $materieltransport
 * @property \App\Model\Entity\Cartecarburant $cartecarburant
 * @property \App\Model\Entity\Adresselivraisonclient $adresselivraisonclient
 * @property \App\Model\Entity\Bonlivraison[] $bonlivraisons
 * @property \App\Model\Entity\Lignefactureclient[] $lignefactureclients
 */
class Factureclient extends Entity
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
        'date' => true,
        'client_id' => true,
        'pointdevente_id' => true,
        'depot_id' => true,
        'materieltransport_id' => true,
        'cartecarburant_id' => true,
        'totalht' => true,
        'totalremise' => true,
        'totalfodec' => true,
        'totaltva' => true,
        'totalttc' => true,
        'kilometragearrive' => true,
        'kilometragedepart' => true,
        'adresselivraisonclient_id' => true,
        'client' => true,
        'pointdevente' => true,
        'depot' => true,
        'materieltransport' => true,
        'cartecarburant' => true,
        'adresselivraisonclient' => true,
        'bonlivraisons' => true,
        'lignefactureclients' => true,
        'escompte' => true,
        'escompte' => true,
        'bonlivraison_id'=>true,
        'poste'=>true,
        'tpe'=>true,
        'payementcomptant'=>true,
        'Montant_Regler'=>true,
        'timbre'=>true,
        'observation'=>true,
        'user_id'=> true ,
        'totalputtc'=> true ,
        'type'=> true ,
        'montantretenu'=>true,
        'testretenu'=>true,
        
        'nomprenom'=> true ,
        'numeroidentite'=>true,
        'adressediv'=>true,
        'timbre_id'=>true,


    ];
}
