<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LignecommandesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LignecommandesTable Test Case
 */
class LignecommandesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LignecommandesTable
     */
    protected $Lignecommandes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Lignecommandes',
        'app.Commandes',
        'app.Fournisseurs',
        'app.Articles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Lignecommandes') ? [] : ['className' => LignecommandesTable::class];
        $this->Lignecommandes = $this->getTableLocator()->get('Lignecommandes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Lignecommandes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LignecommandesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LignecommandesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
