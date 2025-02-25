<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bonreceptionstock Entity
 *
 * @property int $id
 * @property string $numero
 * @property \Cake\I18n\FrozenTime $date
 * @property int $pointdevente_id
 * @property int $depot_id
 * @property int $materieltransport_id
 * @property int $cartecarburant_id
 * @property int $personnel_id
 * @property float $kilometragedepart
 * @property float $kilometragearrive
 *
 * @property \App\Model\Entity\Pointdevente $pointdevente
 * @property \App\Model\Entity\Depot $depot
 * @property \App\Model\Entity\Materieltransport $materieltransport
 * @property \App\Model\Entity\Cartecarburant $cartecarburant
 * @property \App\Model\Entity\Personnel $personnel
 * @property \App\Model\Entity\Conffaieur $conffaieur
 * @property \App\Model\Entity\Chauffeur $chauffeur
 * @property \App\Model\Entity\Bondetransfert[] $bondetransferts
 * @property \App\Model\Entity\Lignebonreceptionstock[] $lignebonreceptionstocks
 */
class Bonreceptionstock extends Entity
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
        'personnel_id' => true,
        'kilometragedepart' => true,
        'kilometragearrive' => true,
        'pointdevente' => true,
        'depot' => true,
        'materieltransport' => true,
        'cartecarburant' => true,
        'personnel' => true,
        'conffaieur' => true,
        'chauffeur' => true,
        'bondetransferts' => true,
        'lignebonreceptionstocks' => true,
        'typentree_id'=>true ,
        'typereception_id'=> true , 
        'client_id'=> true ,
        'observation' => true , 
        'commande_id'=>true ,
        'factureavoir_id'=>true ,

    ];
}
