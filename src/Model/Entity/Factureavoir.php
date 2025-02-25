<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Factureavoir Entity
 *
 * @property int $id
 * @property int|null $client_id
 * @property int|null $utilisateur_id
 * @property int|null $factureclient_id
 * @property \Cake\I18n\FrozenTime|null $date
 * @property string|null $remise
 * @property string|null $tva
 * @property string|null $fodec
 * @property string|null $tauxtva
 * @property string|null $tauxfodec
 * @property string|null $totalht
 * @property string|null $totalttc
 * @property string|null $totalttc_anc
 * @property string $montant_regle
 * @property string|null $numero
 * @property string|null $numeroconca
 * @property int|null $typefacture_id
 * @property int|null $etat
 * @property int|null $pointdevente_id
 * @property int|null $exercice_id
 * @property string|null $des
 * @property string|null $source
 * @property string|null $timbre_id
 * @property string|null $name
 * @property string|null $adressclient
 * @property string|null $matriculefiscaleclient
 * @property string|null $telclient
 * @property int|null $typeclient_id
 * @property string|null $numeropieceintegre
 * @property int|null $depot_id
 * @property int|null $ttc1
 * @property int|null $tva1
 * @property int|null $fodec1
 * @property int|null $rem
 * @property int|null $totalht1
 * @property int|null $totaltva1
 * @property int|null $totalttc1
 * @property int|null $totalrem
 * @property int|null $adressecl
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Typefacture $typefacture
 * @property \App\Model\Entity\Lignefactureavoir[] $lignefactureavoirs
 */
class Factureavoir extends Entity
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
        'client_id' => true,
        'utilisateur_id' => true,
        'factureclient_id' => true,
        'date' => true,
        'remise' => true,
        'tva' => true,
        'fodec' => true,
        'tauxtva' => true,
        'tauxfodec' => true,
        'totalht' => true,
        'totalttc' => true,
        'totalttc_anc' => true,
        'montant_regle' => true,
        'numero' => true,
        'numeroconca' => true,
        'typefacture_id' => true,
        'etat' => true,
        'pointdevente_id' => true,
        'exercice_id' => true,
        'des' => true,
        'source' => true,
        'timbre_id' => true,
        'name' => true,
        'adressclient' => true,
        'matriculefiscaleclient' => true,
        'telclient' => true,
        'typeclient_id' => true,
        'numeropieceintegre' => true,
        'depot_id' => true,
        'ttc1' => true,
        'tva1' => true,
        'fodec1' => true,
        'rem' => true,
        'totalht1' => true,
        'totaltva1' => true,
        'totalttc1' => true,
        'totalrem' => true,
        'adressecl' => true,
        'client' => true,
        'typefacture' => true,
        'lignefactureavoirs' => true,
        'commmentaire'=> true ,
        'commercial_id' => true , 
        'brut'=> true ,
        'typef'=>true ,
        'total'=> true ,
        'tpe'=> true ,
        'Montant_Regler'=> true ,
        'totalputtc'=> true ,
        'timbre_id'=> true ,

        'adressediv'=> true ,
        'numeroidentite'=> true ,
        'nomprenom'=> true ,

    ];
}
