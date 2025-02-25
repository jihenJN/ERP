<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BonreceptionstocksTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BonreceptionstocksTable Test Case
 */
class BonreceptionstocksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BonreceptionstocksTable
     */
    protected $Bonreceptionstocks;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Bonreceptionstocks',
        'app.Pointdeventes',
        'app.Depots',
        'app.Materieltransports',
        'app.Cartecarburants',
        'app.Personnels',
        'app.Conffaieurs',
        'app.Chauffeurs',
        'app.Bondetransferts',
        'app.Lignebonreceptionstocks',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Bonreceptionstocks') ? [] : ['className' => BonreceptionstocksTable::class];
        $this->Bonreceptionstocks = $this->getTableLocator()->get('Bonreceptionstocks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Bonreceptionstocks);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BonreceptionstocksTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\BonreceptionstocksTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
