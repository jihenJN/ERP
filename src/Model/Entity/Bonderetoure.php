<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bonderetoure Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime|null $date
 * @property int|null $pointdevente_id
 * @property int|null $depot_id
 * @property string|null $numero
 * @property int|null $materieltransport_id
 * @property int|null $cartecarburant_id
 * @property int|null $conffaieur_id
 * @property int|null $chauffeur_id
 * @property int|null $kilometragedepart
 * @property int|null $kilometragearrive
 * @property int|null $poste
 * @property string|null $marque
 * @property string|null $serie
 * @property string|null $cin
 * @property string|null $chauffeur
 * @property int|null $fournisseur_id
 *
 * @property \App\Model\Entity\Lignebonderetoure[] $lignebonderetoures
 */
class Bonderetoure extends Entity
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
        'pointdevente_id' => true,
        'depot_id' => true,
        'numero' => true,
        'materieltransport_id' => true,
        'cartecarburant_id' => true,
        'conffaieur_id' => true,
        'chauffeur_id' => true,
        'kilometragedepart' => true,
        'kilometragearrive' => true,
        'poste' => true,
        'marque' => true,
        'serie' => true,
        'cin' => true,
        'chauffeur' => true,
        'fournisseur_id' => true,
        'lignebonderetoures' => true,
    ];
}
