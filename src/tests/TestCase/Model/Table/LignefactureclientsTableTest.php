<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LignefactureclientsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LignefactureclientsTable Test Case
 */
class LignefactureclientsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LignefactureclientsTable
     */
    protected $Lignefactureclients;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Lignefactureclients',
        'app.Factureclients',
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
        $config = $this->getTableLocator()->exists('Lignefactureclients') ? [] : ['className' => LignefactureclientsTable::class];
        $this->Lignefactureclients = $this->getTableLocator()->get('Lignefactureclients', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Lignefactureclients);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LignefactureclientsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LignefactureclientsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
