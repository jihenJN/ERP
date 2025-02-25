<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tracemisejour Entity
 *
 * @property int $id
 * @property string|null $model
 * @property string|null $id_piece
 * @property string|null $operation
 * @property string|null $numero
 * @property int|null $user_id
 * @property \Cake\I18n\FrozenDate|null $date
 * @property string|null $heure
 * @property string|null $poste
 *
 * @property \App\Model\Entity\Utilisateur $utilisateur
 */
class Tracemisejour extends Entity
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
        'model' => true,
        'id_piece' => true,
        'operation' => true,
        'numero' => true,
        'user_id' => true,
        'date' => true,
        'heure' => true,
        'poste' => true,
        'utilisateur' => true,
    ];
}
