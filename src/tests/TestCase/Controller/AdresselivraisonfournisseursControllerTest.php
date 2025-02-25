<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\AdresselivraisonfournisseursController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\AdresselivraisonfournisseursController Test Case
 *
 * @uses \App\Controller\AdresselivraisonfournisseursController
 */
class AdresselivraisonfournisseursControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Adresselivraisonfournisseurs',
        'app.Fournisseurs',
        'app.Factures',
        'app.Livraisons',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\AdresselivraisonfournisseursController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\AdresselivraisonfournisseursController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\AdresselivraisonfournisseursController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\AdresselivraisonfournisseursController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\AdresselivraisonfournisseursController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
