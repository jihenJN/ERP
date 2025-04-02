<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignedevi Entity
 *
 * @property int $id
 * @property string $prix
 * @property float $remise
 * @property string $ht
 * @property int $article_id
 * @property int $devis_id
 * @property float $qte
 *
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\Devi $devi
 */
class Lignedevi extends Entity
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
        'prix' => true,
        'remise' => true,
        'ht' => true,
        'ttc' => true,
        'tva' => true,
        'article_id' => true,
        'devis_id' => true,
        'qte' => true,
        'article' => true,
        'devi' => true,
    ];
}
