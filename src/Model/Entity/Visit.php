<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Visit Entity
 *
 * @property int $id
 * @property int $numero
 * @property \Cake\I18n\FrozenDate|null $date_demande
 * @property int $type_contact_id
 * @property int $client_id
 * @property string $lieu
 * @property string $localisation
 * @property \Cake\I18n\FrozenDate|null $date_prevu
 * @property int $visiteur_id
 * @property \Cake\I18n\FrozenDate|null $date_visite
 * @property string $commentaire
 *
 * @property \App\Model\Entity\Typecontact $type_contact
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Visiteur $visiteur
 */
class Visit extends Entity
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
        'numero' => true,
        'date_demande' => true,
        'type_contact_id' => true,
        'client_id' => true,
        'lieu' => true,
        'localisation' => true,
        'date_prevu' => true,
        'visiteur_id' => true,
        'date_visite' => true,
        'commentaire' => true,
        'type_contact' => true,
        'client' => true,
        'visiteur' => true,
    ];
}
