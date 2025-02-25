<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignecommandeclient Entity
 *
 * @property int $id
 * @property int|null $commandeclient_id
 * @property int|null $article_id
 * @property int|null $qtestock
 * @property int|null $qte
 * @property string|null $prixht
 * @property string|null $remise
 * @property string|null $punht
 * @property string|null $tva
 * @property string|null $fodec
 * @property string|null $ttc
 *
 * @property \App\Model\Entity\Commandeclient $commandeclient
 * @property \App\Model\Entity\Article $article
 */
class Lignecommandeclient extends Entity
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
        'commandeclient_id' => true,
        'article_id' => true,
        'qtestock' => true,
        'qte' => true,
        'prixht' => true,
        'remise' => true,
        'punht' => true,
        'tva' => true,
        'fodec' => true,
        'ttc' => true,
        'commandeclient' => true,
        'article' => true,
    ];
}
