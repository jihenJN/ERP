<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LignebondetransfertsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LignebondetransfertsTable Test Case
 */
class LignebondetransfertsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LignebondetransfertsTable
     */
    protected $Lignebondetransferts;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Lignebondetransferts',
        'app.Bondetransferts',
        'app.Articles',
        'app.Bondechargements',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Lignebondetransferts') ? [] : ['className' => LignebondetransfertsTable::class];
        $this->Lignebondetransferts = $this->getTableLocator()->get('Lignebondetransferts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Lignebondetransferts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LignebondetransfertsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LignebondetransfertsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
