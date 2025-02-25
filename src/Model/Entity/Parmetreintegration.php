<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Parmetreintegration Entity
 *
 * @property int $id
 * @property int $journal_id
 * @property int $auto
 *
 * @property \App\Model\Entity\Journal $journal
 */
class Parmetreintegration extends Entity
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
        'journal_id' => true,
        'auto' => true,
        'journal' => true,
        'integration_id' => true,
    ];
}
