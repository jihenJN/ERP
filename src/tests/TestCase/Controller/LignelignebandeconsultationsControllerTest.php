<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\LignelignebandeconsultationsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\LignelignebandeconsultationsController Test Case
 *
 * @uses \App\Controller\LignelignebandeconsultationsController
 */
class LignelignebandeconsultationsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Lignelignebandeconsultations',
        'app.Demandeoffredeprixes',
        'app.Fournisseurs',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\LignelignebandeconsultationsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\LignelignebandeconsultationsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\LignelignebandeconsultationsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\LignelignebandeconsultationsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\LignelignebandeconsultationsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
