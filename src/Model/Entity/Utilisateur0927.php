<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Utilisateur Entity
 *
 * @property int $id
 * @property int|null $personnel_id
 * @property string|null $name
 * @property string|null $login
 * @property string|null $password
 * @property int|null $pointdevente_id
 * @property int|null $depot_id
 * @property int|null $stocknegatif
 * @property int|null $notifdevis
 * @property int|null $notifcaisse
 * @property int|null $notifbsstock
 * @property int|null $notifaffaire
 * @property int|null $notifvisite
 * @property int|null $modifpmp
 * @property int|null $notifartdevis
 * @property int|null $imp_val_inventaire
 * @property int|null $imp_val_bonecart
 * @property int|null $trans_vers_prod
 * @property int|null $factureclient
 * @property int|null $notifcommandeclient
 * @property int|null $MajNumero
 *
 * @property \App\Model\Entity\Personnel $personnel
 * @property \App\Model\Entity\Pointdevente $pointdevente
 * @property \App\Model\Entity\Depot $depot
 * @property \App\Model\Entity\Tracemisejour[] $tracemisejours
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Utilisateurmenu[] $utilisateurmenus
 */
class Utilisateur extends Entity
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
        'personnel_id' => true,
        'name' => true,
        'login' => true,
        'password' => true,
        'pointdevente_id' => true,
        'depot_id' => true,
        'stocknegatif' => true,
        'notifdevis' => true,
        'notifcaisse' => true,
        'notifbsstock' => true,
        'notifaffaire' => true,
        'notifvisite' => true,
        'modifpmp' => true,
        'notifartdevis' => true,
        'imp_val_inventaire' => true,
        'imp_val_bonecart' => true,
        'trans_vers_prod' => true,
        'factureclient' => true,
        'notifcommandeclient' => true,
        'MajNumero' => true,
        'personnel' => true,
        'pointdevente' => true,
        'depot' => true,
        'tracemisejours' => true,
        'users' => true,
        'utilisateurmenus' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];
}
