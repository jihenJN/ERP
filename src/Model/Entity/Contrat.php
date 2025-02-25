<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contrat Entity
 *
 * @property int $id
 * @property string|null $numero
 * @property string|null $ref_client
 * @property string|null $ref_fournisseur
 * @property int|null $client_id
 * @property int|null $remise
 * @property int|null $commercial_suivi_id
 * @property int|null $commercial_signataire_contrat_id
 * @property string|null $date
 * @property int|null $projet_id
 * @property string|null $note_publique
 * @property string|null $note_prive
 */
class Contrat extends Entity
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
        'ref_client' => true,
        'ref_fournisseur' => true,
        'client_id' => true,
        'remise' => true,
        'commercial_suivi_id' => true,
        'commercial_signataire_contrat_id' => true,
        'date' => true,
        'projet_id' => true,
        'note_publique' => true,
        'note_prive' => true,
    ];
}
