<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LignedemandeoffredeprixesFixture
 */
class LignedemandeoffredeprixesFixture extends TestFixture
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
                'demandeoffredeprix_id' => 1,
                'article_id' => 1,
                'designiationA' => 'Lorem ipsum dolor sit amet',
                'fournisseur_id' => 1,
                'nameF' => 'Lorem ipsum dolor sit amet',
                'qte' => 1,
            ],
        ];
        parent::init();
    }
}
