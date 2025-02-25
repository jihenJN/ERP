<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ligneplancommercial Entity
 *
 * @property int $id
 * @property int|null $plancommercialindustriel_id
 * @property int|null $article_id
 * @property int|null $qtedisp
 * @property int|null $qtenonliv
 * @property int|null $qtetheo
 * @property int|null $stockminart
 * @property int|null $qtevendu
 * @property int|null $qtelivper
 * @property int|null $besoin
 *
 * @property \App\Model\Entity\Plancommercialindustriel $plancommercialindustriel
 * @property \App\Model\Entity\Article $article
 */
class Ligneplancommercial extends Entity
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
        'plancommercialindustriel_id' => true,
        'article_id' => true,
        'qtedisp' => true,
        'qtenonliv' => true,
        'qtetheo' => true,
        'stockminart' => true,
        'qtevendu' => true,
        'qtelivper' => true,
        'besoin' => true,
        'qtenoncloture' => true,
         'plancommercialindustriel' => true,
        'besoinprodtheoperiode' => true,
        'lancerpdp' => true,
        'qtprodpratique' => true,
        'ventem1' => true,
        'ventem2' => true,
        'ventem3' => true,
        'qtem1' => true,
        'qtem2' => true,
        'qtem3' => true,
        
        'article' => true,
    ];
}
