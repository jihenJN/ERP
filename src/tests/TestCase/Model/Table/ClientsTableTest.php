<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClientsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClientsTable Test Case
 */
class ClientsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClientsTable
     */
    protected $Clients;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Clients',
        'app.Typeutilisateurs',
        'app.Villes',
        'app.Regions',
        'app.Pays',
        'app.Activites',
        'app.Paiements',
        'app.Adresselivraisonclients',
        'app.Bondereservations',
        'app.Bonlivraisons',
        'app.Clientbanques',
        'app.Clientexonerations',
        'app.Clientfourchettes',
        'app.Clientresponsables',
        'app.Commandeclients',
        'app.Factureclients',
        'app.Fourchettes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Clients') ? [] : ['className' => ClientsTable::class];
        $this->Clients = $this->getTableLocator()->get('Clients', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Clients);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ClientsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ClientsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
