<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypecontactsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypecontactsTable Test Case
 */
class TypecontactsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypecontactsTable
     */
    protected $Typecontacts;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Typecontacts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Typecontacts') ? [] : ['className' => TypecontactsTable::class];
        $this->Typecontacts = $this->getTableLocator()->get('Typecontacts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Typecontacts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TypecontactsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
