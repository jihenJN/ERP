<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Clientpromoarticle Entity
 *
 * @property int $id
 * @property int $client_id
 * @property int $promoarticle_id
 * @property int $checkk
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Promoarticle $promoarticle
 */
class Clientpromoarticle extends Entity
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
        'client_id' => true,
        'promoarticle_id' => true,
        'checkk' => true,
        'client' => true,
        'promoarticle' => true,
    ];
}
