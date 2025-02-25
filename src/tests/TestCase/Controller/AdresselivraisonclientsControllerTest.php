<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\AdresselivraisonclientsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\AdresselivraisonclientsController Test Case
 *
 * @uses \App\Controller\AdresselivraisonclientsController
 */
class AdresselivraisonclientsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Adresselivraisonclients',
        'app.Clients',
        'app.Bonlivraisons',
        'app.Factureclients',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\AdresselivraisonclientsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\AdresselivraisonclientsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\AdresselivraisonclientsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\AdresselivraisonclientsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\AdresselivraisonclientsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
