<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\FacturesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\FacturesController Test Case
 *
 * @uses \App\Controller\FacturesController
 */
class FacturesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Factures',
        'app.Livraisons',
        'app.Fournisseurs',
        'app.Pointdeventes',
        'app.Depots',
        'app.Cartecarburants',
        'app.Materieltransports',
        'app.Adresselivraisonfournisseurs',
        'app.Lignefactures',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\FacturesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\FacturesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\FacturesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\FacturesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\FacturesController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
