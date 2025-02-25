<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FournisseurresponsablesFixture
 */
class FournisseurresponsablesFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'mail' => 'Lorem ipsum dolor sit amet',
                'tel' => 1,
                'poste' => 'Lorem ipsum dolor sit amet',
                'fournisseur_id' => 1,
            ],
        ];
        parent::init();
    }
}
