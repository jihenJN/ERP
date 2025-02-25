<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SocietesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SocietesTable Test Case
 */
class SocietesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SocietesTable
     */
    protected $Societes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Societes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Societes') ? [] : ['className' => SocietesTable::class];
        $this->Societes = $this->getTableLocator()->get('Societes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Societes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SocietesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
