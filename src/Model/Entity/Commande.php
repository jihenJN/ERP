<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Commande Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $date
 * @property string $numero
 * @property string|null $num_tab
 * @property int|null $client_id
 * @property float|null $remise
 * @property string $total
 * @property string|null $totalttc
 * @property int|null $commercial_id
 * @property string|null $payementcomptant
 * @property string|null $observation
 * @property int $pointdevente_id
 * @property int $depot_id
 * @property string $fodec
 * @property string $tpe
 * @property string $escompte
 * @property string $tva
 * @property int $etatliv
 * @property int $quantiteliv
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Commercial $commercial
 * @property \App\Model\Entity\Pointdevente $pointdevente
 * @property \App\Model\Entity\Depot $depot
 * @property \App\Model\Entity\Lignecommande[] $lignecommandes
 * @property \App\Model\Entity\Lignelivraison[] $lignelivraisons
 * @property \App\Model\Entity\Livraisonsanc[] $livraisonsanc
 */
class Commande extends Entity {

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
        'numero' => true,
        'num_tab' => true,
        'client_id' => true,
        'remise' => true,
        'total' => true,
        'totalttc' => true,
        'commercial_id' => true,
        'payementcomptant' => true,
        'observation' => true,
        'pointdevente_id' => true,
        'depot_id' => true,
        'fodec' => true,
        'tpe' => true,
        'escompte' => true,
        'tva' => true,
        'etatliv' => true,
        'quantiteliv' => true,
        'client' => true,
        'commercial' => true,
        'pointdevente' => true,
        'depot' => true,
        'lignecommandes' => true,
        'lignelivraisons' => true,
        'livraisonsanc' => true,
        'dateupdateclient' => true,
        'nouv_client' => true,
        'brut' => true,
        'Poids' =>true,
        'Coeff' => true,
        'pallette' => true,
        'nbligne' => true,
        'bl' => true,
        'bonlivraison_id'=> true ,
        'typecommande'=> true ,
        'totalliv'=> true ,
        'validationTransport'=> true ,
        'autorisationEnlevement'=> true ,
        'confirme'=> true ,
        'etattransport_id'=> true ,
        'user_id'=> true ,
        'totalputtc'=> true ,

        'nomprenom' => true,
        'numeroidentite'=>true,
        'adressediv'=>true,
        

    ];

}
