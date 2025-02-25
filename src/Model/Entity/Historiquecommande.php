<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Historiquecommande Entity
 *
 * @property int $id
 * @property int $commande_id
 * @property \Cake\I18n\FrozenTime $date
 * @property int $num_tab
 *
 * @property \App\Model\Entity\Commande $commande
 */
class Historiquecommande extends Entity
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
        'date' => true,
        'num_tab' => true,
        'commande' => true,
        'numero'=> true ,
    ];
}
