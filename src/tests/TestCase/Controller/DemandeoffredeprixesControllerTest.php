<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\DemandeoffredeprixesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\DemandeoffredeprixesController Test Case
 *
 * @uses \App\Controller\DemandeoffredeprixesController
 */
class DemandeoffredeprixesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Demandeoffredeprixes',
        'app.Bandeconsultations',
        'app.Commandes',
        'app.Lignebandeconsultations',
        'app.Lignedemandeoffredeprixes',
        'app.Lignelignebandeconsultations',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\DemandeoffredeprixesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\DemandeoffredeprixesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\DemandeoffredeprixesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\DemandeoffredeprixesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\DemandeoffredeprixesController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
