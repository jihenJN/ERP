<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ArticlesFixture
 */
class ArticlesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'pointdevente_id' => 1,
                'famille_id' => 1,
                'categorie_id' => 1,
                'sousfamille1_id' => 1,
                'sousfamille2_id' => 1,
                'sousfamille3_id' => 1,
                'codefrs' => 'Lorem ipsum dolor sit amet',
                'reference' => 'Lorem ipsum dolor sit amet',
                'designiation' => 'Lorem ipsum dolor sit amet',
                'dimension' => 1,
                'etat' => 'Lorem ipsum dolor sit amet',
                'unite_id' => 1,
                'codeabarre' => 'Lorem ipsum dolor sit amet',
                'durevie' => 1,
                'puht' => 1.5,
                'fodec' => 1,
                'tva' => 1,
                'ttc' => 1.5,
                'prixachat' => 1.5,
                'prixafodec' => 1.5,
                'commantaire' => 'Lorem ipsum dolor sit amet',
                'poste' => 1,
                'colisage' => 1.5,
            ],
        ];
        parent::init();
    }
}
