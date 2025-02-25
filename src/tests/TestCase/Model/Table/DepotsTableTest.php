<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DepotsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DepotsTable Test Case
 */
class DepotsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DepotsTable
     */
    protected $Depots;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Depots',
        'app.Pointdeventes',
        'app.Bondechargements',
        'app.Bondereservations',
        'app.Bonlivraisons',
        'app.Bonreceptionstocks',
        'app.Commandeclients',
        'app.Commandes',
        'app.Factureclients',
        'app.Factures',
        'app.Inventaires',
        'app.Ligneinventaires',
        'app.Livraisons',
        'app.Livraisonsanc',
        'app.Users',
        'app.Utilisateurs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Depots') ? [] : ['className' => DepotsTable::class];
        $this->Depots = $this->getTableLocator()->get('Depots', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Depots);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DepotsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DepotsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
