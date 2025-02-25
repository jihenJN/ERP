<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\FournisseursController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\FournisseursController Test Case
 *
 * @uses \App\Controller\FournisseursController
 */
class FournisseursControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Fournisseurs',
        'app.Typeutilisateurs',
        'app.Typelocalisations',
        'app.Villes',
        'app.Regions',
        'app.Pays',
        'app.Paiements',
        'app.Devises',
        'app.Adresselivraisonfournisseurs',
        'app.Articlefournisseurs',
        'app.Bandeconsultations',
        'app.Commandes',
        'app.Exonerations',
        'app.Factures',
        'app.Fournisseurbanques',
        'app.Fournisseurresponsables',
        'app.Lignebandeconsultations',
        'app.Lignecommandes',
        'app.Lignedemandeoffredeprixes',
        'app.Lignefactures',
        'app.Lignelignebandeconsultations',
        'app.Lignelivraisons',
        'app.Livraisons',
        'app.Livraisonsanc',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\FournisseursController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\FournisseursController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\FournisseursController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\FournisseursController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\FournisseursController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
