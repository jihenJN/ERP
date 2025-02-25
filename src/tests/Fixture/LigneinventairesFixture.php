<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LigneinventairesFixture
 */
class LigneinventairesFixture extends TestFixture
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
                'inventaire_id' => 1,
                'article_id' => 1,
                'quantite' => 1,
                'numerolot' => 'Lorem ipsum dolor sit amet',
                'coutderevien' => 1.5,
                'date' => '2022-07-20',
                'date_exp' => '2022-07-20',
                'depot_id' => 1,
                'prixvente' => 1.5,
            ],
        ];
        parent::init();
    }
}
