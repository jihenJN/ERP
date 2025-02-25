<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Clientfourchette Entity
 *
 * @property int $id
 * @property int|null $client_id
 * @property int|null $horst
 * @property float|null $valeur
 *
 * @property \App\Model\Entity\Client $client
 */
class Clientfourchette extends Entity
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
        'horst' => true,
        'valeur' => true,
        'client' => true,
    ];
}
