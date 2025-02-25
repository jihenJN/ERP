<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LignecommandeclientsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LignecommandeclientsTable Test Case
 */
class LignecommandeclientsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LignecommandeclientsTable
     */
    protected $Lignecommandeclients;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Lignecommandeclients',
        'app.Commandeclients',
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
        $config = $this->getTableLocator()->exists('Lignecommandeclients') ? [] : ['className' => LignecommandeclientsTable::class];
        $this->Lignecommandeclients = $this->getTableLocator()->get('Lignecommandeclients', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Lignecommandeclients);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LignecommandeclientsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LignecommandeclientsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
