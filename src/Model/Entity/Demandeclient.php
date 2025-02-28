<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Demandeclient Entity
 *
 * @property int $id
 * @property int|null $client_id
 * @property \Cake\I18n\FrozenTime|null $dateconsulation
 * @property \Cake\I18n\FrozenTime|null $delaireponse
 * @property \Cake\I18n\FrozenTime|null $delaivoulu
 * @property \Cake\I18n\FrozenTime|null $delaiapprov
 * @property int|null $typedemande_id
 * @property int|null $type_contact_id
 * @property int|null $commercial_id
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Typedemande $typedemande
 * @property \App\Model\Entity\Lignedemandeclient[] $lignedemandeclients
 * @property \App\Model\Entity\TypeContacts[] $typeContacts
 * @property \App\Model\Entity\Commercials[] $commercials
 */
class Demandeclient extends Entity
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
        'dateconsulation' => true,
        'delaireponse' => true,
        'delaivoulu' => true,
        'delaiapprov' => true,
        'typedemande_id' => true,
        'client' => true,
        'typedemande' => true,
        'lignedemandeclients' => true,
        'type_contact_id' => true,
        'commercial_id' => true,
    ];
}
