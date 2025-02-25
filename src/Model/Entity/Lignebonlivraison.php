<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignebonlivraison Entity
 *
 * @property int $id
 * @property int|null $bonlivraison_id
 * @property int|null $article_id
 * @property int|null $qte
 * @property string|null $prixht
 * @property string|null $remise
 * @property string|null $punht
 * @property string|null $tva
 * @property string|null $fodec
 * @property string|null $ttc
 * @property int|null $quantiteliv
 * @property float|null $qtestock
 * @property string|null $totaltva
 * @property string $montantht
 * @property string|null $totalttc
 * @property int|null $commandeclient_id
 * @property string|null $commission
 * @property float|null $montantcommission
 * @property string $montantregle
 * @property string|null $nouv_client
 * @property string|null $nouv_article
 *
 * @property \App\Model\Entity\Bonlivraison $bonlivraison
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\Commandeclient $commandeclient
 */
class Lignebonlivraison extends Entity
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
        'bonlivraison_id' => true,
        'article_id' => true,
        'qte' => true,
        'prixht' => true,
        'remise' => true,
        'punht' => true,
        'tva' => true,
        'fodec' => true,
        'ttc' => true,
        'quantiteliv' => true,
        'qtestock' => true,
        'totaltva' => true,
        'montantht' => true,
        'totalttc' => true,
        'commandeclient_id' => true,
        'commission' => true,
        'montantcommission' => true,
        'montantregle' => true,
        'nouv_client' => true,
        'nouv_article' => true,
        'bonlivraison' => true,
        'article' => true,
        'commandeclient' => true,
         'remiseclient' => true,
         'totremiseclient' => true,
        'escompte' => true,
        'pourcentageescompte'=> true,
        'lignecommande_id' => true , 
        'lignecommande_id' => true , 
        'idlignebonlivraison' => true , 
        'puttc'=> true ,
        'ml' => true,
        'puttcapr' => true,
        'ttchidden'=> true,
    ];
}
