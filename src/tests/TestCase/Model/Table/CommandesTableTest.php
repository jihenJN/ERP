<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommandesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommandesTable Test Case
 */
class CommandesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CommandesTable
     */
    protected $Commandes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Commandes',
        'app.Demandeoffredeprixes',
        'app.Fournisseurs',
        'app.Pointdeventes',
        'app.Depots',
        'app.Cartecarburants',
        'app.Materieltransports',
        'app.Livraisons',
        'app.Lignecommandes',
        'app.Lignelivraisons',
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
        $config = $this->getTableLocator()->exists('Commandes') ? [] : ['className' => CommandesTable::class];
        $this->Commandes = $this->getTableLocator()->get('Commandes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Commandes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CommandesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CommandesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
