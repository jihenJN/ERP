<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Personnel Entity
 *
 * @property int $id
 * @property int|null $fonction_id
 * @property string|null $nom
 * @property string|null $prenom
 * @property string|null $code
 * @property int|null $sexe_id
 * @property \Cake\I18n\FrozenDate|null $dateentre
 * @property int|null $situationfamiliale_id
 * @property float|null $nombreenfant
 * @property string|null $matriculecnss
 * @property float|null $age
 * @property string|null $chefdefamille
 * @property int|null $typecontrat_id
 * @property int|null $pointdevente_id
 *
 * @property \App\Model\Entity\Fonction $fonction
 * @property \App\Model\Entity\Sex $sex
 * @property \App\Model\Entity\Situationfamiliale $situationfamiliale
 * @property \App\Model\Entity\Typecontrat $typecontrat
 * @property \App\Model\Entity\Pointdevente $pointdevente
 * @property \App\Model\Entity\Bonreceptionstock[] $bonreceptionstocks
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Utilisateur[] $utilisateurs
 */
class Personnel extends Entity
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
        'fonction_id' => true,
        'nom' => true,
        'prenom' => true,
        'code' => true,
        'sexe_id' => true,
        'dateentre' => true,
        'situationfamiliale_id' => true,
        'nombreenfant' => true,
        'matriculecnss' => true,
        'age' => true,
        'chefdefamille' => true,
        'typecontrat_id' => true,
        'pointdevente_id' => true,
        'fonction' => true,
        'sex' => true,
        'situationfamiliale' => true,
        'typecontrat' => true,
        'pointdevente' => true,
        'bonreceptionstocks' => true,
        'users' => true,
        'utilisateurs' => true,
        'image' =>true,
    ];
}
