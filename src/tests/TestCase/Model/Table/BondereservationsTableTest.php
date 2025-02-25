<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BondereservationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BondereservationsTable Test Case
 */
class BondereservationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BondereservationsTable
     */
    protected $Bondereservations;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Bondereservations',
        'app.Clients',
        'app.Pointdeventes',
        'app.Depots',
        'app.Commandeclients',
        'app.Lignebondereservations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Bondereservations') ? [] : ['className' => BondereservationsTable::class];
        $this->Bondereservations = $this->getTableLocator()->get('Bondereservations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Bondereservations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BondereservationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\BondereservationsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
