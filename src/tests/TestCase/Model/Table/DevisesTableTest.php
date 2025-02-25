<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DevisesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DevisesTable Test Case
 */
class DevisesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DevisesTable
     */
    protected $Devises;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Devises',
        'app.Fournisseurs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Devises') ? [] : ['className' => DevisesTable::class];
        $this->Devises = $this->getTableLocator()->get('Devises', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Devises);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DevisesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
