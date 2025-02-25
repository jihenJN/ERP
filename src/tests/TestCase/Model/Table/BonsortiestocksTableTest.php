<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BonsortiestocksTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BonsortiestocksTable Test Case
 */
class BonsortiestocksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BonsortiestocksTable
     */
    protected $Bonsortiestocks;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Bonsortiestocks',
        'app.Pointdeventes',
        'app.Depotarrives',
        'app.Depotdeparts',
        'app.Materieltransports',
        'app.Cartecarburants',
        'app.Conffaieurs',
        'app.Chauffeurs',
        'app.Lignebonsortiestocks',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Bonsortiestocks') ? [] : ['className' => BonsortiestocksTable::class];
        $this->Bonsortiestocks = $this->getTableLocator()->get('Bonsortiestocks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Bonsortiestocks);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BonsortiestocksTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\BonsortiestocksTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
