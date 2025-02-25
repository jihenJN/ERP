<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Utilisateurmenu Entity
 *
 * @property int $id
 * @property int|null $utilisateur_id
 * @property int $menu_id
 *
 * @property \App\Model\Entity\Utilisateur $utilisateur
 * @property \App\Model\Entity\Menu $menu
 * @property \App\Model\Entity\Lien[] $liens
 */
class Utilisateurmenu extends Entity
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
        'utilisateur_id' => true,
        'menu_id' => true,
        'utilisateur' => true,
        'menu' => true,
        'liens' => true,
    ];
}
