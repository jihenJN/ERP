<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypelocalisationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypelocalisationsTable Test Case
 */
class TypelocalisationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypelocalisationsTable
     */
    protected $Typelocalisations;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Typelocalisations',
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
        $config = $this->getTableLocator()->exists('Typelocalisations') ? [] : ['className' => TypelocalisationsTable::class];
        $this->Typelocalisations = $this->getTableLocator()->get('Typelocalisations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Typelocalisations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TypelocalisationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
