<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SituationfamilialesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SituationfamilialesTable Test Case
 */
class SituationfamilialesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SituationfamilialesTable
     */
    protected $Situationfamiliales;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Situationfamiliales',
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
        $config = $this->getTableLocator()->exists('Situationfamiliales') ? [] : ['className' => SituationfamilialesTable::class];
        $this->Situationfamiliales = $this->getTableLocator()->get('Situationfamiliales', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Situationfamiliales);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SituationfamilialesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
