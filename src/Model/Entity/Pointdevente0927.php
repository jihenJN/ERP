<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pointdevente Entity
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property string|null $adresse
 * @property int|null $ville_id
 * @property string|null $matriclefiscale
 *
 * @property \App\Model\Entity\Ville $ville
 * @property \App\Model\Entity\Article[] $articles
 * @property \App\Model\Entity\Bondechargement[] $bondechargements
 * @property \App\Model\Entity\Bondereservation[] $bondereservations
 * @property \App\Model\Entity\Bondetransfert[] $bondetransferts
 * @property \App\Model\Entity\Bonlivraison[] $bonlivraisons
 * @property \App\Model\Entity\Bonreceptionstock[] $bonreceptionstocks
 * @property \App\Model\Entity\Bonsortiestock[] $bonsortiestocks
 * @property \App\Model\Entity\Commandeclient[] $commandeclients
 * @property \App\Model\Entity\Commande[] $commandes
 * @property \App\Model\Entity\Depot[] $depots
 * @property \App\Model\Entity\Factureclient[] $factureclients
 * @property \App\Model\Entity\Facture[] $factures
 * @property \App\Model\Entity\Livraison[] $livraisons
 * @property \App\Model\Entity\Livraisonsanc[] $livraisonsanc
 * @property \App\Model\Entity\Personnel[] $personnels
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Utilisateur[] $utilisateurs
 */
class Pointdevente extends Entity
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
        'ville_id' => true,
        'matriclefiscale' => true,
        'ville' => true,
        'articles' => true,
        'bondechargements' => true,
        'bondereservations' => true,
        'bondetransferts' => true,
        'bonlivraisons' => true,
        'bonreceptionstocks' => true,
        'bonsortiestocks' => true,
        'commandeclients' => true,
        'commandes' => true,
        'depots' => true,
        'factureclients' => true,
        'factures' => true,
        'livraisons' => true,
        'livraisonsanc' => true,
        'personnels' => true,
        'users' => true,
        'utilisateurs' => true,
    ];
}
