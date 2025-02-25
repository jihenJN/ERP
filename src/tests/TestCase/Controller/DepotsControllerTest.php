<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\DepotsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\DepotsController Test Case
 *
 * @uses \App\Controller\DepotsController
 */
class DepotsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Depots',
        'app.Pointdeventes',
        'app.Bondechargements',
        'app.Bondereservations',
        'app.Bonlivraisons',
        'app.Bonreceptionstocks',
        'app.Commandeclients',
        'app.Commandes',
        'app.Factureclients',
        'app.Factures',
        'app.Inventaires',
        'app.Ligneinventaires',
        'app.Livraisons',
        'app.Livraisonsanc',
        'app.Users',
        'app.Utilisateurs',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\DepotsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\DepotsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\DepotsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\DepotsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\DepotsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
