<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypecartecarburantsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypecartecarburantsTable Test Case
 */
class TypecartecarburantsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypecartecarburantsTable
     */
    protected $Typecartecarburants;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Typecartecarburants',
        'app.Cartecarburants',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Typecartecarburants') ? [] : ['className' => TypecartecarburantsTable::class];
        $this->Typecartecarburants = $this->getTableLocator()->get('Typecartecarburants', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Typecartecarburants);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TypecartecarburantsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
