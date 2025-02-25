<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LignecommandesFixture
 */
class LignecommandesFixture extends TestFixture
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
                'commande_id' => 1,
                'fournisseur_id' => 1,
                'codefrs' => 'Lorem ipsum dolor sit amet',
                'article_id' => 1,
                'qte' => 1,
                'prix' => 1.5,
                'ht' => 1.5,
                'remise' => 1,
                'fodec' => 1,
                'tva' => 1,
                'ttc' => 1.5,
            ],
        ];
        parent::init();
    }
}
