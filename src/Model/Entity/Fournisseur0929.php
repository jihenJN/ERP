<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fournisseur Entity
 *
 * @property int $id
 * @property string $name
 * @property int|null $typeutilisateur_id
 * @property int|null $typelocalisation_id
 * @property string $compte_comptable
 * @property int|null $ville_id
 * @property string|null $codepostal
 * @property int|null $region_id
 * @property int|null $pay_id
 * @property string|null $activite
 * @property string|null $secteur
 * @property int|null $tel
 * @property int|null $fax
 * @property string|null $mail
 * @property string|null $site
 * @property int|null $paiement_id
 * @property int|null $devise_id
 *
 * @property \App\Model\Entity\Typeutilisateur $typeutilisateur
 * @property \App\Model\Entity\Typelocalisation $typelocalisation
 * @property \App\Model\Entity\Ville $ville
 * @property \App\Model\Entity\Region $region
 * @property \App\Model\Entity\Pay $pay
 * @property \App\Model\Entity\Paiement $paiement
 * @property \App\Model\Entity\Devise $devise
 * @property \App\Model\Entity\Adresselivraisonfournisseur[] $adresselivraisonfournisseurs
 * @property \App\Model\Entity\Articlefournisseur[] $articlefournisseurs
 * @property \App\Model\Entity\Bandeconsultation[] $bandeconsultations
 * @property \App\Model\Entity\Commande[] $commandes
 * @property \App\Model\Entity\Exoneration[] $exonerations
 * @property \App\Model\Entity\Facture[] $factures
 * @property \App\Model\Entity\Fournisseurbanque[] $fournisseurbanques
 * @property \App\Model\Entity\Fournisseurresponsable[] $fournisseurresponsables
 * @property \App\Model\Entity\Lignebandeconsultation[] $lignebandeconsultations
 * @property \App\Model\Entity\Lignecommande[] $lignecommandes
 * @property \App\Model\Entity\Lignedemandeoffredeprix[] $lignedemandeoffredeprixes
 * @property \App\Model\Entity\Lignefacture[] $lignefactures
 * @property \App\Model\Entity\Lignelignebandeconsultation[] $lignelignebandeconsultations
 * @property \App\Model\Entity\Lignelivraison[] $lignelivraisons
 * @property \App\Model\Entity\Livraison[] $livraisons
 * @property \App\Model\Entity\Livraisonsanc[] $livraisonsanc
 */
class Fournisseur extends Entity
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
        'typeutilisateur_id' => true,
        'typelocalisation_id' => true,
        'compte_comptable' => true,
        'ville_id' => true,
        'codepostal' => true,
        'region_id' => true,
        'pay_id' => true,
        'activite' => true,
        'secteur' => true,
        'tel' => true,
        'fax' => true,
        'mail' => true,
        'site' => true,
        'paiement_id' => true,
        'devise_id' => true,
        'typeutilisateur' => true,
        'typelocalisation' => true,
        'ville' => true,
        'region' => true,
        'pay' => true,
        'paiement' => true,
        'devise' => true,
        'adresselivraisonfournisseurs' => true,
        'articlefournisseurs' => true,
        'bandeconsultations' => true,
        'commandes' => true,
        'exonerations' => true,
        'factures' => true,
        'fournisseurbanques' => true,
        'fournisseurresponsables' => true,
        'lignebandeconsultations' => true,
        'lignecommandes' => true,
        'lignedemandeoffredeprixes' => true,
        'lignefactures' => true,
        'lignelignebandeconsultations' => true,
        'lignelivraisons' => true,
        'livraisons' => true,
        'livraisonsanc' => true,
    ];
}
