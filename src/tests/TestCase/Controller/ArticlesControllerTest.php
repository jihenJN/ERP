<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ArticlesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ArticlesController Test Case
 *
 * @uses \App\Controller\ArticlesController
 */
class ArticlesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Articles',
        'app.Pointdeventes',
        'app.Familles',
        'app.Categories',
        'app.Sousfamille1s',
        'app.Sousfamille2s',
        'app.Sousfamille3s',
        'app.Unites',
        'app.Articlefournisseurs',
        'app.Articleunites',
        'app.Bandeconsultations',
        'app.Fourchettes',
        'app.Lignebandeconsultations',
        'app.Lignebonchargements',
        'app.Lignebondereservations',
        'app.Lignebondetransferts',
        'app.Lignebonlivraisons',
        'app.Lignebonreceptionstocks',
        'app.Lignebonsortiestocks',
        'app.Lignecommandeclients',
        'app.Lignecommandes',
        'app.Lignedemandeoffredeprixes',
        'app.Lignefactureclients',
        'app.Lignefactures',
        'app.Ligneinventaires',
        'app.Lignelivraisons',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\ArticlesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\ArticlesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\ArticlesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\ArticlesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\ArticlesController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
