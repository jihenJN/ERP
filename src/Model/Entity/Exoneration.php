<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Exoneration Entity
 *
 * @property int $id
 * @property int $typeexon_id
 * @property int $num_att_taxes
 * @property \Cake\I18n\FrozenDate $date_debut
 * @property \Cake\I18n\FrozenDate $date_fin
 * @property string $document
 * @property int $fournisseur_id
 *
 * @property \App\Model\Entity\Typeexon $typeexon
 * @property \App\Model\Entity\Fournisseur $fournisseur
 */
class Exoneration extends Entity
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
        'typeexon_id' => true,
        'num_att_taxes' => true,
        'date_debut' => true,
        'date_fin' => true,
        'document' => true,
        'fournisseur_id' => true,
        'typeexon' => true,
        'fournisseur' => true,
    ];
}
