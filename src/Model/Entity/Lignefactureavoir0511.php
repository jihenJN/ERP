<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignefactureavoir Entity
 *
 * @property int $id
 * @property int|null $factureavoir_id
 * @property int|null $lignefactureclient_id
 * @property int|null $depot_id
 * @property int|null $article_id
 * @property float|null $quantite
 * @property string|null $prix
 * @property string|null $prixnet
 * @property string|null $puttc
 * @property string|null $totalhtans
 * @property int|null $remise
 * @property int|null $fodec
 * @property int|null $tva_id
 * @property string|null $totalht
 * @property string|null $totalttc
 * @property string|null $pmp
 * @property int|null $qte
 * @property int|null $valide
 * @property int|null $couleur_id
 * @property int|null $dimension_id
 * @property int|null $categorie_id
 * @property int|null $famille_id
 * @property int|null $sousfamille1_id
 * @property int|null $sousfamille2_id
 * @property int|null $unite_id
 *
 * @property \App\Model\Entity\Factureavoir $factureavoir
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\Category $category
 */
class Lignefactureavoir extends Entity
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
        'id' => true,
        'factureavoir_id' => true,
        'lignefactureclient_id' => true,
        'depot_id' => true,
        'article_id' => true,
        'quantite' => true,
        'prix' => true,
        'prixnet' => true,
        'puttc' => true,
        'totalhtans' => true,                           
        'remise' => true,
        'fodec' => true,
        'tva_id' => true,
        'tva' => true,
        'totalht' => true,
        'totalttc' => true,
        'pmp' => true,
        'qte' => true,
        'valide' => true,
        'couleur_id' => true,
        'dimension_id' => true,
        'categorie_id' => true,
        'famille_id' => true,
        'sousfamille1_id' => true,  
        'sousfamille2_id' => true,
        'unite_id' => true,
        'factureavoir' => true,
        'article' => true,
        'category' => true,
        'designation'=> true , 
        'ttc'=>true ,


        
        'qtestock'=> true ,
        'montantht'=> true ,
        'tpe'=>true ,
        'totremiseclient'=>true ,
        'remiseclient'=> true , 
        'totaltva' => true ,
        'prixEntre'=> true , 
        'escompte'=> true ,
        'pourcentageescompte'=> true ,

    ];
}
