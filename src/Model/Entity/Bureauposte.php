<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bureauposte Entity
 *
 * @property int $id
 * @property int $gouvernorat_id
 * @property string $name
 * @property string $codepostal
 *
 * @property \App\Model\Entity\Gouvernorat $gouvernorat
 * @property \App\Model\Entity\Client[] $clients
 */
class Bureauposte extends Entity
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
        'gouvernorat_id' => true,
        'name' => true,
        'codepostal' => true,
        'gouvernorat' => true,
        'clients' => true,
    ];
}
