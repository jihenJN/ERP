<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Article Entity
 *
 * @property int $id
 * @property int|null $pointdevente_id
 * @property int|null $famille_id
 * @property int|null $categorie_id
 * @property int|null $sousfamille1_id
 * @property int|null $sousfamille2_id
 * @property int|null $sousfamille3_id
 * @property string|null $codefrs
 * @property string|null $reference
 * @property string|null $designiation
 * @property int|null $dimension
 * @property string|null $etat
 * @property int|null $unite_id
 * @property string|null $codeabarre
 * @property float $durevie
 * @property string|null $puht
 * @property float|null $fodec
 * @property float|null $tva
 * @property string|null $ttc
 * @property string|null $prixachat
 * @property string|null $prixafodec
 * @property string|null $commantaire
 * @property int|null $poste
 * @property string|null $colisage
 *
 * @property \App\Model\Entity\Pointdevente $pointdevente
 * @property \App\Model\Entity\Famille $famille
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Sousfamille1 $sousfamille1
 * @property \App\Model\Entity\Sousfamille2 $sousfamille2
 * @property \App\Model\Entity\Sousfamille3 $sousfamille3
 * @property \App\Model\Entity\Unite $unite
 * @property \App\Model\Entity\Articlefournisseur[] $articlefournisseurs
 * @property \App\Model\Entity\Articleunite[] $articleunites
 * @property \App\Model\Entity\Bandeconsultation[] $bandeconsultations
 * @property \App\Model\Entity\Fourchette[] $fourchettes
 * @property \App\Model\Entity\Lignebandeconsultation[] $lignebandeconsultations
 * @property \App\Model\Entity\Lignebonchargement[] $lignebonchargements
 * @property \App\Model\Entity\Lignebondereservation[] $lignebondereservations
 * @property \App\Model\Entity\Lignebondetransfert[] $lignebondetransferts
 * @property \App\Model\Entity\Lignebonlivraison[] $lignebonlivraisons
 * @property \App\Model\Entity\Lignebonreceptionstock[] $lignebonreceptionstocks
 * @property \App\Model\Entity\Lignebonsortiestock[] $lignebonsortiestocks
 * @property \App\Model\Entity\Lignecommandeclient[] $lignecommandeclients
 * @property \App\Model\Entity\Lignecommande[] $lignecommandes
 * @property \App\Model\Entity\Lignedemandeoffredeprix[] $lignedemandeoffredeprixes
 * @property \App\Model\Entity\Lignefactureclient[] $lignefactureclients
 * @property \App\Model\Entity\Lignefacture[] $lignefactures
 * @property \App\Model\Entity\Ligneinventaire[] $ligneinventaires
 * @property \App\Model\Entity\Lignelivraison[] $lignelivraisons
 */
class Article extends Entity
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
        'pointdevente_id' => true,
        'famille_id' => true,
        'categorie_id' => true,
        'sousfamille1_id' => true,
        'sousfamille2_id' => true,
        'sousfamille3_id' => true,
        'codefrs' => true,
        'reference' => true,
        'designiation' => true,
        'dimension' => true,
        'etat' => true,
        'unite_id' => true,
        'codeabarre' => true,
        'durevie' => true,
        'puht' => true,
        'fodec' => true,
        'tva' => true,
        'ttc' => true,
        'prixachat' => true,
        'prixafodec' => true,
        'commantaire' => true,
        'poste' => true,
        'colisage' => true,
        'pointdevente' => true,
        'famille' => true,
        'category' => true,
        'sousfamille1' => true,
        'sousfamille2' => true,
        'sousfamille3' => true,
        'unite' => true,
        'articlefournisseurs' => true,
        'articleunites' => true,
        'bandeconsultations' => true,
        'fourchettes' => true,
        'lignebandeconsultations' => true,
        'lignebonchargements' => true,
        'lignebondereservations' => true,
        'lignebondetransferts' => true,
        'lignebonlivraisons' => true,
        'lignebonreceptionstocks' => true,
        'lignebonsortiestocks' => true,
        'lignecommandeclients' => true,
        'lignecommandes' => true,
        'lignedemandeoffredeprixes' => true,
        'lignefactureclients' => true,
        'lignefactures' => true,
        'ligneinventaires' => true,
        'lignelivraisons' => true,
    ];
}
