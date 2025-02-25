<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FournisseurbanquesFixture
 */
class FournisseurbanquesFixture extends TestFixture
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
                'banque_id' => 1,
                'agence' => 'Lorem ipsum dolor sit amet',
                'code_banque' => 'Lorem ipsum dolor sit amet',
                'swift' => 'Lorem ipsum dolor sit amet',
                'compte' => 'Lorem ipsum dolor sit amet',
                'rib' => 'Lorem ipsum dolor sit amet',
                'document' => 'Lorem ipsum dolor sit amet',
                'fournisseur_id' => 1,
            ],
        ];
        parent::init();
    }
}
