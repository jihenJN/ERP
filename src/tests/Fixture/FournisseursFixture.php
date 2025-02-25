<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FournisseursFixture
 */
class FournisseursFixture extends TestFixture
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
                'typeutilisateur_id' => 1,
                'typelocalisation_id' => 1,
                'compte_comptable' => 'Lorem ipsum dolor sit amet',
                'ville_id' => 1,
                'codepostal' => 'Lorem ipsum dolor sit amet',
                'region_id' => 1,
                'pay_id' => 1,
                'activite' => 'Lorem ipsum dolor sit amet',
                'secteur' => 'Lorem ipsum dolor sit amet',
                'tel' => 1,
                'fax' => 1,
                'mail' => 'Lorem ipsum dolor sit amet',
                'site' => 'Lorem ipsum dolor sit amet',
                'paiement_id' => 1,
                'devise_id' => 1,
            ],
        ];
        parent::init();
    }
}
