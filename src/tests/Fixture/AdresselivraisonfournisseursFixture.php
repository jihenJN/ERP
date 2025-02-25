<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AdresselivraisonfournisseursFixture
 */
class AdresselivraisonfournisseursFixture extends TestFixture
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
                'adresse' => 'Lorem ipsum dolor sit amet',
                'fournisseur_id' => 1,
            ],
        ];
        parent::init();
    }
}
