<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Gspromoarticle Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $datedebut
 * @property \Cake\I18n\FrozenDate $datefin
 *
 * @property \App\Model\Entity\Clientgspromoarticle[] $clientgspromoarticles
 * @property \App\Model\Entity\Lignegspromoarticle[] $lignegspromoarticles
 */
class Gspromoarticle extends Entity
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
        'datedebut' => true,
        'datefin' => true,
        'remarque' => true,
        'clientgspromoarticles' => true,
        'lignegspromoarticles' => true,
    ];
}
