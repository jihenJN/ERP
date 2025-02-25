<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LignefactureclientsFixture
 */
class LignefactureclientsFixture extends TestFixture
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
                'factureclient_id' => 1,
                'article_id' => 1,
                'qte' => 1,
                'prixht' => 1.5,
                'remise' => 1.5,
                'punht' => 1.5,
                'tva' => 1.5,
                'fodec' => 1.5,
                'ttc' => 1.5,
            ],
        ];
        parent::init();
    }
}
