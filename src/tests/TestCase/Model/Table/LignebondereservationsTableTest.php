<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LignebondereservationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LignebondereservationsTable Test Case
 */
class LignebondereservationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LignebondereservationsTable
     */
    protected $Lignebondereservations;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Lignebondereservations',
        'app.Articles',
        'app.Bondereservations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Lignebondereservations') ? [] : ['className' => LignebondereservationsTable::class];
        $this->Lignebondereservations = $this->getTableLocator()->get('Lignebondereservations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Lignebondereservations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LignebondereservationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LignebondereservationsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
