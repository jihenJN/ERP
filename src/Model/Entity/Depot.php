<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Depot Entity
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $adresse
 * @property string $matriclefiscale
 * @property int $pointdevente_id
 *
 * @property \App\Model\Entity\Pointdevente $pointdevente
 * @property \App\Model\Entity\Bondechargement[] $bondechargements
 * @property \App\Model\Entity\Bondereservation[] $bondereservations
 * @property \App\Model\Entity\Bonlivraison[] $bonlivraisons
 * @property \App\Model\Entity\Bonreceptionstock[] $bonreceptionstocks
 * @property \App\Model\Entity\Commandeclient[] $commandeclients
 * @property \App\Model\Entity\Commande[] $commandes
 * @property \App\Model\Entity\Factureclient[] $factureclients
 * @property \App\Model\Entity\Facture[] $factures
 * @property \App\Model\Entity\Inventaire[] $inventaires
 * @property \App\Model\Entity\Ligneinventaire[] $ligneinventaires
 * @property \App\Model\Entity\Livraison[] $livraisons
 * @property \App\Model\Entity\Livraisonsanc[] $livraisonsanc
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Utilisateur[] $utilisateurs
 */
class Depot extends Entity
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
        'name' => true,
        'adresse' => true,
        // 'matriclefiscale' => true,
        'pointdevente_id' => true,
        'pointdevente' => true,
        'bondechargements' => true,
        'bondereservations' => true,
        'bonlivraisons' => true,
        'bonreceptionstocks' => true,
        'commandeclients' => true,
        'commandes' => true,
        'factureclients' => true,
        'factures' => true,
        'inventaires' => true,
        'ligneinventaires' => true,
        'livraisons' => true,
        'livraisonsanc' => true,
        'users' => true,
        'utilisateurs' => true,
    ];
}
