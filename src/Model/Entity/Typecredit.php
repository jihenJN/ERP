<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Typecredit Entity
 *
 * @property int $id
 * @property string|null $name
 * @property float|null $montant
 * @property float|null $mesuel
 * @property float|null $annuel
 * @property float|null $sertype
 * @property float|null $tuestrie
 * @property float|null $montantcredit
 * @property float|null $taux
 * @property float|null $montantremb
 * @property float|null $frequence_id
 */
class Typecredit extends Entity
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
        'name' => true,
        'montant' => true,
        'mesuel' => true,
        'annuel' => true,
        'sertype' => true,
        'tuestrie' => true,
        'montantcredit' => true,
        'taux' => true,
        'montantremb' => true,
        'frequence_id' => true,
    ];
}
