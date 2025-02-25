<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lien Entity
 *
 * @property int $id
 * @property int|null $utilisateurmenu_id
 * @property string|null $lien
 * @property string|null $ajout
 * @property string|null $modif
 * @property string|null $supp
 * @property string|null $imprimer
 * @property int|null $valide
 *
 * @property \App\Model\Entity\Utilisateurmenu $utilisateurmenu
 */
class Lien extends Entity
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
        'utilisateurmenu_id' => true,
        'lien' => true,
        'ajout' => true,
        'modif' => true,
        'supp' => true,
        'imprimer' => true,
        'valide' => true,
        'utilisateurmenu' => true,
    ];
}
