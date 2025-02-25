<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Demandeoffredeprix Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate|null $date
 * @property string|null $numero
 * @property int $consultation
 * @property int $commande
 *
 * @property \App\Model\Entity\Bandeconsultation[] $bandeconsultations
 * @property \App\Model\Entity\Commande[] $commandes
 * @property \App\Model\Entity\Lignebandeconsultation[] $lignebandeconsultations
 * @property \App\Model\Entity\Lignedemandeoffredeprix[] $lignedemandeoffredeprixes
 * @property \App\Model\Entity\Lignelignebandeconsultation[] $lignelignebandeconsultations
 */
class Demandeoffredeprix extends Entity
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
        'date' => true,
        'numero' => true,
        'consultation' => true,
        'commande' => true,
        'bandeconsultations' => true,
        'commandes' => true,
        'lignebandeconsultations' => true,
        'lignedemandeoffredeprixes' => true,
        'lignelignebandeconsultations' => true,
    ];
}
