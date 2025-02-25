<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Societe Entity
 *
 * @property int $id
 * @property string|null $nom
 * @property string|null $capital
 * @property string|null $adresse
 * @property string|null $tel
 * @property string|null $mail
 * @property string|null $site
 * @property string|null $rc
 * @property string|null $codetva
 * @property string|null $fax
 * @property string|null $rib
 * @property string|null $logo
 * @property string|null $codepostale
 */
class Societe extends Entity
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
        'nom' => true,
        'capital' => true,
        'adresse' => true,
        'tel' => true,
        'mail' => true,
        'site' => true,
        'rc' => true,
        'codetva' => true,
        'fax' => true,
        'rib' => true,
        'logo' => true,
        'codepostale' => true,
    ];
}
