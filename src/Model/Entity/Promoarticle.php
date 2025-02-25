<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Promoarticle Entity
 *
 * @property int $id
 * @property int $typeclient_id
 * @property int|null $gouv
 * @property int|null $type
 * @property \Cake\I18n\FrozenDate $datedebut
 * @property \Cake\I18n\FrozenDate $datefin
 *
 * @property \App\Model\Entity\Typeclient $typeclient
 * @property \App\Model\Entity\Clientpromoarticle[] $clientpromoarticles
 * @property \App\Model\Entity\Gouvpromoarticle[] $gouvpromoarticles
 * @property \App\Model\Entity\Lignepromoarticle[] $lignepromoarticles
 */
class Promoarticle extends Entity
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
        'typeclient_id' => true,
        'gouv' => true,
        'type' => true,
        'datedebut' => true,
        'datefin' => true,
        'typeclient' => true,
        'clientpromoarticles' => true,
        'gouvpromoarticles' => true,
        'lignepromoarticles' => true,
    ];
}
