<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommandeclientsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommandeclientsTable Test Case
 */
class CommandeclientsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CommandeclientsTable
     */
    protected $Commandeclients;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Commandeclients',
        'app.Clients',
        'app.Pointdeventes',
        'app.Depots',
        'app.Cartecarburants',
        'app.Materieltransports',
        'app.Chauffeurs',
        'app.Convoyeurs',
        'app.Bonlivraisons',
        'app.Bondereservations',
        'app.Lignebonlivraisons',
        'app.Lignecommandeclients',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Commandeclients') ? [] : ['className' => CommandeclientsTable::class];
        $this->Commandeclients = $this->getTableLocator()->get('Commandeclients', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Commandeclients);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CommandeclientsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CommandeclientsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
