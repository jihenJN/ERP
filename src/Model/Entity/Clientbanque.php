<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Clientbanque Entity
 *
 * @property int $id
 * @property int|null $banque_id
 * @property string|null $agence
 * @property string|null $code_banque
 * @property string|null $swift
 * @property string|null $compte
 * @property string|null $rib
 * @property string|null $document
 * @property int|null $client_id
 *
 * @property \App\Model\Entity\Banque $banque
 * @property \App\Model\Entity\Client $client
 */
class Clientbanque extends Entity
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
        'banque_id' => true,
        'agence' => true,
        'code_banque' => true,
        'swift' => true,
        'compte' => true,
        'rib' => true,
        'document' => true,
        'client_id' => true,
        'banque' => true,
        'client' => true,
    ];
}
