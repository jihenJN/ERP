<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LignefacturesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LignefacturesTable Test Case
 */
class LignefacturesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LignefacturesTable
     */
    protected $Lignefactures;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Lignefactures',
        'app.Factures',
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
        $config = $this->getTableLocator()->exists('Lignefactures') ? [] : ['className' => LignefacturesTable::class];
        $this->Lignefactures = $this->getTableLocator()->get('Lignefactures', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Lignefactures);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LignefacturesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LignefacturesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
