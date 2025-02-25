<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pci Entity
 *
 * @property int $id
 * @property string|null $designation
 * @property int|null $qtedisp
 * @property int|null $qtenonliv
 * @property int|null $qtetheo
 * @property int|null $stockminart
 * @property int|null $qtevendu
 * @property int|null $qteliv
 * @property int|null $besoin
 * @property int|null $qtenoncloture
 * @property int|null $besoinprodtheoperiode
 * @property int|null $qtprodpratique
 * @property string|null $lancerpdp
 * @property int|null $rang
 * @property int|null $ventem1
 * @property int|null $qtem1
 * @property int|null $ventem2
 * @property int|null $qtem2
 * @property int|null $ventem3
 * @property int|null $qtem3
 * @property int|null $article_id
 *
 * @property \App\Model\Entity\Article $article
 */
class Pci extends Entity
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
        'designation' => true,
        'qtedisp' => true,
        'qtenonliv' => true,
        'qtetheo' => true,
        'stockminart' => true,
        'qtevendu' => true,
        'qteliv' => true,
        'besoin' => true,
        'qtenoncloture' => true,
        'besoinprodtheoperiode' => true,
        'qtprodpratique' => true,
        'lancerpdp' => true,
        'rang' => true,
        'ventem1' => true,
        'qtem1' => true,
        'ventem2' => true,
        'qtem2' => true,
        'ventem3' => true,
        'qtem3' => true,
        'article_id' => true,
     
    ];
}
