<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bandeconsultation Entity
 *
 * @property int $id
 * @property int|null $demandeoffredeprix_id
 * @property int|null $fournisseur_id
 * @property string|null $nameF
 * @property string|null $codefrs
 * @property int|null $article_id
 * @property string|null $designiationA
 * @property int|null $qte
 * @property string|null $prix
 * @property string|null $totalprix
 *
 * @property \App\Model\Entity\Demandeoffredeprix $demandeoffredeprix
 * @property \App\Model\Entity\Fournisseur $fournisseur
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\Lignebandeconsultation[] $lignebandeconsultations
 */
class Bandeconsultation extends Entity
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
        'demandeoffredeprix_id' => true,
        'fournisseur_id' => true,
        'nameF' => true,
        'codefrs' => true,
        'article_id' => true,
        'designiationA' => true,
        'qte' => true,
        'prix' => true,
        'totalprix' => true,
        'demandeoffredeprix' => true,
        'fournisseur' => true,
        'article' => true,
        'lignebandeconsultations' => true,
    ];
}
