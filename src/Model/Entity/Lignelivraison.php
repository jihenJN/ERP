<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignelivraison Entity
 *
 * @property int $id
 * @property int|null $livraison_id
 * @property int|null $commande_id
 * @property string|null $codefrs
 * @property int|null $article_id
 * @property int|null $qte
 * @property int|null $qteliv
 * @property string|null $prix
 * @property string|null $ht
 * @property float|null $remise
 * @property float|null $fodec
 * @property float|null $tva
 * @property string|null $ttc
 *
 * @property \App\Model\Entity\Livraison $livraison
 * @property \App\Model\Entity\Commande $commande
 * @property \App\Model\Entity\Fournisseur $fournisseur
 * @property \App\Model\Entity\Article $article
 */
class Lignelivraison extends Entity
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
        'livraison_id' => true,
        'commandefournisseur_id' => true,
        'codefrs' => true,
        'article_id' => true,
        'qte' => true,
        'qteliv' => true,
        'prix' => true,
        'punht' => true,
        'ht' => true,
        'remise' => true,
        'fodec' => true,
        'tva' => true,
        'ttc' => true,
        'livraison' => true,
        'commande' => true,
        'fournisseur' => true,
        'article' => true,
        'lignecommandefournisseur_id' => true,
    ];
}
