<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Client Entity
 *
 * @property int $id
 * @property float|null $Code_Socit
 * @property string|null $Code
 * @property string|null $compte_comptable
 * @property string|null $Raison_Sociale
 * @property string|null $Contact
 * @property float|null $commercial_id
 * @property string|null $Code_Ville
 * @property string|null $Adresse
 * @property float|null $Code_Pays
 * @property string|null $Code_VilleL
 * @property string|null $AdresseL
 * @property float|null $CpL
 * @property float|null $Code_PaysL
 * @property string|null $Tel
 * @property string|null $Tel1
 * @property string|null $Tel2
 * @property string|null $Fax
 * @property string|null $Email
 * @property string|null $Code_Monnaie
 * @property string|null $Code_ModePayement
 * @property string|null $Code_DelaiPayement
 * @property float|null $Mode_Facturation
 * @property float|null $Priode
 * @property float|null $Montant_Facturation
 * @property float|null $Quota
 * @property string|null $Autorisation_Livraison
 * @property string|null $BL_Tarifi
 * @property string|null $Majoration
 * @property string|null $Matricule_Fiscale
 * @property string|null $R_TVA
 * @property string|null $Timbre
 * @property string|null $Fodec
 * @property float|null $Taux_Escompte
 * @property string|null $Resident
 * @property string|null $Facture
 * @property string|null $Rib
 * @property string|null $Rib1
 * @property string|null $Code_Secteur
 * @property string|null $piece
 * @property string|null $promotion
 * @property string|null $promotion1
 * @property string|null $Descadf
 * @property string|null $Descadl
 * @property float|null $txMaj
 * @property string|null $promotion2
 * @property string|null $code_gouv
 * @property int $gouvernorat_id
 * @property string|null $pr
 * @property float|null $Edit
 * @property string|null $BLC
 * @property string|null $ECOLEF
 * @property string|null $TPE
 * @property string|null $UserAdd
 * @property string|null $DateAdd
 * @property string|null $UserUpdate
 * @property string|null $DateUpdate
 * @property int|null $inserted
 * @property int|null $updated
 * @property int|null $typeutilisateur_id
 * @property int $typeexoneration_id
 * @property int $paiement_id
 * @property int|null $nbr_jours
 * @property int $typeclient_id
 * @property int $pointdevente_id
 * @property string $remise
 * @property string $observation
 * @property string $etat
 * @property float $Cp
 * @property int $delegation_id
 * @property int $localite_id
 * @property int $codepostale
 *
 * @property \App\Model\Entity\Commercial $commercial
 * @property \App\Model\Entity\Gouvernorat $gouvernorat
 * @property \App\Model\Entity\Typeutilisateur $typeutilisateur
 * @property \App\Model\Entity\Typeexoneration $typeexoneration
 * @property \App\Model\Entity\Paiement $paiement
 * @property \App\Model\Entity\Typeclient $typeclient
 * @property \App\Model\Entity\Pointdevente $pointdevente
 * @property \App\Model\Entity\Delegation $delegation
 * @property \App\Model\Entity\Localite $localite
 * @property \App\Model\Entity\Adresselivraisonclient[] $adresselivraisonclients
 * @property \App\Model\Entity\ArticleClient[] $article_client
 * @property \App\Model\Entity\Bondereservation[] $bondereservations
 * @property \App\Model\Entity\Bonlivraison[] $bonlivraisons
 * @property \App\Model\Entity\Clientarticle[] $clientarticles
 * @property \App\Model\Entity\Clientbanque[] $clientbanques
 * @property \App\Model\Entity\Clientexoneration[] $clientexonerations
 * @property \App\Model\Entity\Clientfourchette[] $clientfourchettes
 * @property \App\Model\Entity\Clientresponsable[] $clientresponsables
 * @property \App\Model\Entity\Commandeclient[] $commandeclients
 * @property \App\Model\Entity\Factureclient[] $factureclients
 * @property \App\Model\Entity\Fourchette[] $fourchettes
 */
class Client extends Entity
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
        'Code_Socit' => true,
        'Code' => true,
        'compte_comptable' => true,
        'Raison_Sociale' => true,
        'Contact' => true,
        'commercial_id' => true,
        'Code_Ville' => true,
        'Adresse' => true,
        'Code_Pays' => true,
        'Code_VilleL' => true,
        'AdresseL' => true,
        'CpL' => true,
        'Code_PaysL' => true,
        'Tel' => true,
        'Tel1' => true,
        'Tel2' => true,
        'Fax' => true,
        'Email' => true,
        'Code_Monnaie' => true,
        'Code_ModePayement' => true,
        'Code_DelaiPayement' => true,
        'Mode_Facturation' => true,
        'Priode' => true,
        'Montant_Facturation' => true,
        'Quota' => true,
        'Autorisation_Livraison' => true,
        'BL_Tarifi' => true,
        'Majoration' => true,
        'Matricule_Fiscale' => true,
        'R_TVA' => true,
        'Timbre' => true,
        'Fodec' => true,
        'Taux_Escompte' => true,
        'Resident' => true,
        'Facture' => true,
        'Rib' => true,
        'Rib1' => true,
        'Code_Secteur' => true,
        'piece' => true,
        'promotion' => true,
        'promotion1' => true,
        'Descadf' => true,
        'Descadl' => true,
        'txMaj' => true,
        'promotion2' => true,
        'code_gouv' => true,
        'gouvernorat_id' => true,
        'pr' => true,
        'Edit' => true,
        'BLC' => true,
        'ECOLEF' => true,
        'TPE' => true,
        'UserAdd' => true,
        'DateAdd' => true,
        'UserUpdate' => true,
        'DateUpdate' => true,
        'inserted' => true,
        'updated' => true,
        'typeutilisateur_id' => true,
        'typeexoneration_id' => true,
        'paiement_id' => true,
        'nbr_jours' => true,
        'typeclient_id' => true,
        'pointdevente_id' => true,
        'remise' => true,
        'observation' => true,
        'etat' => true,
        'Cp' => true,
        'delegation_id' => true,
        'localite_id' => true,
        'codepostale' => true,
        'commercial' => true,
        'gouvernorat' => true,
        'typeutilisateur' => true,
        'typeexoneration' => true,
        'paiement' => true,
        'typeclient' => true,
        'pointdevente' => true,
        'delegation' => true,
        'localite' => true,
        'adresselivraisonclients' => true,
        'article_client' => true,
        'bondereservations' => true,
        'bonlivraisons' => true,
        'clientarticles' => true,
        'clientbanques' => true,
        'clientexonerations' => true,
        'clientfourchettes' => true,
        'clientresponsables' => true,
        'commandeclients' => true,
        'factureclients' => true,
        'fourchettes' => true,
    ];
}
