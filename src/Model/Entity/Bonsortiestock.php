<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BonSortieStock Entity
 *
 * @property int $id
 * @property string $numero
 * @property \Cake\I18n\FrozenTime|null $date
 * @property int|null $pointdevente_id
 * @property int|null $depot_id
 * @property int|null $materieltransport_id
 * @property int|null $cartecarburant_id
 * @property int|null $conffaieur_id
 * @property int|null $chauffeur_id
 * @property float $kilometragedepart
 * @property float $kilometragearrive
 *
 * @property \App\Model\Entity\Pointdevente $pointdevente
 * @property \App\Model\Entity\Materieltransport $materieltransport
 * @property \App\Model\Entity\Cartecarburant $cartecarburant
 * @property \App\Model\Entity\Lignebonsortiestock[] $lignebonsortiestocks
 * @property \App\Model\Entity\Depot $depot
 * @property \App\Model\Entity\Personnel $personnel
 */
class BonSortieStock extends Entity
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
        'date' => true,
        'pointdevente_id' => true,
        'depot_id' => true,
        'materieltransport_id' => true,
        'cartecarburant_id' => true,
        'conffaieur_id' => true,
        'chauffeur_id' => true,
        'kilometragedepart' => true,
        'kilometragearrive' => true,
        'pointdevente' => true,
        'materieltransport' => true,
        'cartecarburant' => true,
        'lignebonsortiestocks' => true,
        'depot' => true,
        'personnel' => true,
        'typesortie_id'=> true ,
        'typesortiee'=> true ,

        'remarque'=> true , 
        'machine_id'=> true ,

    ];
}
