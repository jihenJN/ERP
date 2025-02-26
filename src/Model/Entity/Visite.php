<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Visite Entity
 *
 * @property int $id
 * @property string|null $numero
 * @property int|null $client_id
 * @property int|null $demandeclient_id
 * @property \Cake\I18n\FrozenTime|null $datecontact
 * @property \Cake\I18n\FrozenTime|null $dateplanifie
 * @property string|null $trdemande
 * @property string|null $description
 * @property string|null $piece 
 * @property string|null $schema
 * @property string|null $descriptif
 * @property \Cake\I18n\FrozenTime|null $datecptrendu
 * @property string|null $responsable
 * @property int|null $tel
 * @property string|null $adresse
 * @property int $type_contact_id
 * @property \Cake\I18n\FrozenTime $date_visite
 * @property string $localisation
 * @property int $commercial_id
 *
 * @property \App\Model\Entity\Visiteur $visiteur
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Demandeclient $demandeclient
 * @property \App\Model\Entity\Typecontact $type_contact
 * @property \App\Model\Entity\Listecompterendus[] $listecompterendus
 * @property \App\Model\Entity\Listetypebesoin[] $listetypebesoins
 */
class Visite extends Entity
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
        'client_id' => true,
        'demandeclient_id' => true,
        'datecontact' => true,
        'dateplanifie' => true,
        'trdemande' => true,
        'description' => true,
        'piece' => true,
        'descriptif' => true,
        'datecptrendu' => true,
        'visiteur' => true,
        'responsable' => true,
        'tel' => true,
        'adresse' => true,
        'type_contact_id' => true,
        'date_visite' => true,
        'localisation' => true,
        'commercial_id' => true,
        'client' => true,
        'demandeclient' => true,
        'type_contact' => true,
        'listecompterendus' => true,
        'listetypebesoins' => true,
    ];
}
