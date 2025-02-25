<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\LignedemandeoffredeprixesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\LignedemandeoffredeprixesController Test Case
 *
 * @uses \App\Controller\LignedemandeoffredeprixesController
 */
class LignedemandeoffredeprixesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Lignedemandeoffredeprixes',
        'app.Demandeoffredeprixes',
        'app.Articles',
        'app.Fournisseurs',
        'app.Lignebandeconsultations',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\LignedemandeoffredeprixesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\LignedemandeoffredeprixesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\LignedemandeoffredeprixesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\LignedemandeoffredeprixesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\LignedemandeoffredeprixesController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
