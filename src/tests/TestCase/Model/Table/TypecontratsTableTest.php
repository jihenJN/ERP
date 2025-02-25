<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypecontratsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypecontratsTable Test Case
 */
class TypecontratsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypecontratsTable
     */
    protected $Typecontrats;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Typecontrats',
        'app.Personnels',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Typecontrats') ? [] : ['className' => TypecontratsTable::class];
        $this->Typecontrats = $this->getTableLocator()->get('Typecontrats', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Typecontrats);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TypecontratsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
