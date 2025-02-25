<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LignelignebandeconsultationsFixture
 */
class LignelignebandeconsultationsFixture extends TestFixture
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
                'fournisseur_id' => 1,
                'nameF' => 'Lorem ipsum dolor sit amet',
                't' => 1.5,
            ],
        ];
        parent::init();
    }
}
