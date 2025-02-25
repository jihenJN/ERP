<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Importation Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $numero
 * @property \Cake\I18n\FrozenDate|null $date
 * @property \Cake\I18n\FrozenDate|null $dateliv
 * @property int|null $fournisseur_id
 * @property int|null $devise_id
 * @property string|null $montantachat
 * @property float|null $tauxderechenge
 * @property string|null $prixachat
 * @property string|null $avis
 * @property string|null $transitaire
 * @property string|null $ddttva
 * @property string|null $assurence
 * @property string|null $divers
 * @property string|null $fraisfinancie
 * @property string|null $magasinage
 * @property int|null $fournisseuravis
 * @property int|null $fournisseurtransitaire
 * @property int|null $fournisseurddttva
 * @property int|null $fournisseurassurence
 * @property int|null $fournisseurdivers
 * @property int|null $fournisseurfraisfinancie
 * @property int|null $fournisseurmagasinage
 * @property float|null $totale
 * @property float|null $coefficien
 * @property float|null $coeff
 * @property int $etat
 * @property int|null $situation_id
 * @property float|null $Coefficientchoisi
 * @property int|null $regler
 * @property int|null $facturer
 *
 * @property \App\Model\Entity\Fournisseur $fournisseur
 * @property \App\Model\Entity\Devise $devise
 * @property \App\Model\Entity\Situation $situation
 * @property \App\Model\Entity\Piecereglement[] $piecereglements
 * @property \App\Model\Entity\Reglement[] $reglements
 */
class Importation extends Entity
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
        'name' => true,
        'numero' => true,
        'date' => true,
        'dateliv' => true,
        'fournisseur_id' => true,
        'devise_id' => true,
        'montantachat' => true,
        'tauxderechenge' => true,
        'prixachat' => true,
        'avis' => true,
        'transitaire' => true,
        'ddttva' => true,
        'assurence' => true,
        'divers' => true,
        'fraisfinancie' => true,
        'magasinage' => true,
        'fournisseuravis' => true,
        'fournisseurtransitaire' => true,
        'fournisseurddttva' => true,
        'fournisseurassurence' => true,
        'fournisseurdivers' => true,
        'fournisseurfraisfinancie' => true,
        'fournisseurmagasinage' => true,
        'totale' => true,
        'coefficien' => true,
        'coeff' => true,
        'etat' => true,
        'situation_id' => true,
        'Coefficientchoisi' => true,
        'regler' => true,
        'facturer' => true,
        'fournisseur' => true,
        'devise' => true,
        'situation' => true,
        'piecereglements' => true,
        'reglements' => true,
    ];
}
