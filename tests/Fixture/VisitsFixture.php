<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VisitsFixture
 */
class VisitsFixture extends TestFixture
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
                'numero' => 1,
                'date_demande' => '2025-02-25',
                'type_contact_id' => 1,
                'client_id' => 1,
                'lieu' => 'Lorem ipsum dolor sit amet',
                'localisation' => 'Lorem ipsum dolor sit amet',
                'date_prevu' => '2025-02-25',
                'visiteur_id' => 1,
                'date_visite' => '2025-02-25',
                'commentaire' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
