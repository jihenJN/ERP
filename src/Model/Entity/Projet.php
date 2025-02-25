<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Projet Entity
 *
 * @property int $id
 * @property int|null $client_id
 * @property int|null $opportunite_id
 * @property int|null $commercial_id
 * @property int|null $valide
 *  @property string $name
 *  @property string $visibilite
 * @property string $probabilite
 * @property string $montant
 * @property string $description
 * @property string $budget
 * @property \Cake\I18n\FrozenDate|null $date
 * @property \Cake\I18n\FrozenDate|null $datefin
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Commercial $commercial
 * @property int|null $suivre_opportunite
 * @property int|null $suivre_tache
 * @property int|null $facturer_temps_passe
 */
class Projet extends Entity
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
        'date' => true,
        'name' => true,
        'valide' => true,
        'client' => true,
        'libelle' => true,
        'datefin' => true,
        'visibilite' => true,
        'projet_id' => true,
        'probabilite' => true,
        'montant' => true,
        'budget' => true,
        'description' => true,
        'opportunite_id' => true,
        'commercial_id' => true,
        'personnel_id' => true,
        'devise_id' => true,
        'banque_id' => true,
        'comptesBank_id' => true,
       /*  'montant' => true,
        'budget' => true, */
        'suivre_opportunite' => true,
        'suivre_tache' => true,
        'facturer_temps_passe' => true,
        'tagcategorie_id' => true,
        'lien' => true,
        'lienetude' => true,
        'lienexport' => true,

    ];
}
