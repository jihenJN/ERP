<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BondechargementsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BondechargementsTable Test Case
 */
class BondechargementsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BondechargementsTable
     */
    protected $Bondechargements;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Bondechargements',
        'app.Pointdeventes',
        'app.Depots',
        'app.Bondetransferts',
        'app.Lignebonchargements',
        'app.Lignebondetransferts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Bondechargements') ? [] : ['className' => BondechargementsTable::class];
        $this->Bondechargements = $this->getTableLocator()->get('Bondechargements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Bondechargements);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BondechargementsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\BondechargementsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
