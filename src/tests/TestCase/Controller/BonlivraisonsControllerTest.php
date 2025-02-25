<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\BonlivraisonsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\BonlivraisonsController Test Case
 *
 * @uses \App\Controller\BonlivraisonsController
 */
class BonlivraisonsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Bonlivraisons',
        'app.Clients',
        'app.Pointdeventes',
        'app.Depots',
        'app.Materieltransports',
        'app.Cartecarburants',
        'app.Factureclients',
        'app.Adresselivraisonclients',
        'app.Commandeclients',
        'app.Lignebonlivraisons',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\BonlivraisonsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\BonlivraisonsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\BonlivraisonsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\BonlivraisonsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\BonlivraisonsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
