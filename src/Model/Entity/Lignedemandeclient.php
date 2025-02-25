<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignedemandeclient Entity
 *
 * @property int $id
 * @property int|null $demandeclient_id
 * @property string|null $numboite
 * @property int|null $famille_id
 * @property int|null $sousfamille1_id
 * @property int|null $article_id
 * @property float|null $qte
 * @property int|null $unite_id
 * @property string|null $exigence
 *
 * @property \App\Model\Entity\Demandeclient $demandeclient
 * @property \App\Model\Entity\Famille $famille
 * @property \App\Model\Entity\Sousfamille1 $sousfamille1
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\Unite $unite
 */
class Lignedemandeclient extends Entity
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
        'demandeclient_id' => true,
        'numboite' => true,
        'famille_id' => true,
        'sousfamille1_id' => true,
        'article_id' => true,
        'qte' => true,
        'unite_id' => true,
        'exigence' => true,
        'demandeclient' => true,
        'famille' => true,
        'sousfamille1' => true,
        'article' => true,
        'unite' => true,
    ];
}
