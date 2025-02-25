<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClientsFixture
 */
class ClientsFixture extends TestFixture
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
                'comptecomptable' => 'Lorem ipsum dolor sit amet',
                'typeutilisateur_id' => 1,
                'tel' => 'Lorem ipsum dolor sit amet',
                'CIN' => 1,
                'datenaissance' => '2022-07-20',
                'adresse' => 'Lorem ipsum dolor sit amet',
                'matriculefiscale' => 'Lorem ipsum dolor sit amet',
                'passeport' => 'Lorem ipsum dolor sit amet',
                'cartesejour' => 'Lorem ipsum dolor sit amet',
                'ville_id' => 1,
                'codepostal' => 'Lorem ipsum dolor sit amet',
                'region_id' => 1,
                'pay_id' => 1,
                'activite_id' => 1,
                'fax' => 'Lorem ipsum dolor sit amet',
                'mail' => 'Lorem ipsum dolor sit amet',
                'numregistre' => 'Lorem ipsum dolor sit amet',
                'plafonttheorique' => 1.5,
                'box' => 1,
                'paiement_id' => 1,
                'exoneration' => 1,
                'typeR' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
