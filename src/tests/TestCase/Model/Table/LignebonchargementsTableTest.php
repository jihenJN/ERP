<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LignebonchargementsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LignebonchargementsTable Test Case
 */
class LignebonchargementsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LignebonchargementsTable
     */
    protected $Lignebonchargements;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Lignebonchargements',
        'app.Bondechargements',
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
        $config = $this->getTableLocator()->exists('Lignebonchargements') ? [] : ['className' => LignebonchargementsTable::class];
        $this->Lignebonchargements = $this->getTableLocator()->get('Lignebonchargements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Lignebonchargements);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LignebonchargementsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LignebonchargementsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
