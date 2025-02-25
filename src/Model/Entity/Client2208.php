<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Client Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $comptecomptable
 * @property int|null $typeutilisateur_id
 * @property string|null $tel
 * @property int|null $CIN
 * @property \Cake\I18n\FrozenDate|null $datenaissance
 * @property string|null $adresse
 * @property string|null $matriculefiscale
 * @property string|null $passeport
 * @property string|null $cartesejour
 * @property int|null $ville_id
 * @property string|null $codepostal
 * @property int|null $region_id
 * @property int|null $pay_id
 * @property int|null $activite_id
 * @property string|null $fax
 * @property string|null $mail
 * @property string|null $numregistre
 * @property string|null $plafonttheorique
 * @property int|null $box
 * @property int|null $paiement_id
 * @property int|null $exoneration
 * @property string|null $typeR
 *
 * @property \App\Model\Entity\Typeutilisateur $typeutilisateur
 * @property \App\Model\Entity\Ville $ville
 * @property \App\Model\Entity\Region $region
 * @property \App\Model\Entity\Pay $pay
 * @property \App\Model\Entity\Activite $activite
 * @property \App\Model\Entity\Paiement $paiement
 * @property \App\Model\Entity\Adresselivraisonclient[] $adresselivraisonclients
 * @property \App\Model\Entity\Bondereservation[] $bondereservations
 * @property \App\Model\Entity\Bonlivraison[] $bonlivraisons
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
        'name' => true,
        'comptecomptable' => true,
        'typeutilisateur_id' => true,
        'tel' => true,
        'CIN' => true,
        'datenaissance' => true,
        'adresse' => true,
        'matriculefiscale' => true,
        'passeport' => true,
        'cartesejour' => true,
        'ville_id' => true,
        'codepostal' => true,
        'region_id' => true,
        'pay_id' => true,
        'activite_id' => true,
        'fax' => true,
        'mail' => true,
        'numregistre' => true,
        'plafonttheorique' => true,
        'box' => true,
        'paiement_id' => true,
        'exoneration' => true,
        'typeR' => true,
        'typeutilisateur' => true,
        'ville' => true,
        'region' => true,
        'pay' => true,
        'activite' => true,
        'paiement' => true,
        'adresselivraisonclients' => true,
        'bondereservations' => true,
        'bonlivraisons' => true,
        'clientbanques' => true,
        'clientexonerations' => true,
        'clientfourchettes' => true,
        'clientresponsables' => true,
        'commandeclients' => true,
        'factureclients' => true,
        'fourchettes' => true,
    ];
}
