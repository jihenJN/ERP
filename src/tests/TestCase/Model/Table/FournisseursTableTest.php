<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FournisseursTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FournisseursTable Test Case
 */
class FournisseursTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FournisseursTable
     */
    protected $Fournisseurs;

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
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Fournisseurs') ? [] : ['className' => FournisseursTable::class];
        $this->Fournisseurs = $this->getTableLocator()->get('Fournisseurs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Fournisseurs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FournisseursTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FournisseursTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
