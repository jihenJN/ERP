<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypevaleursTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypevaleursTable Test Case
 */
class TypevaleursTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypevaleursTable
     */
    protected $Typevaleurs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Typevaleurs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Typevaleurs') ? [] : ['className' => TypevaleursTable::class];
        $this->Typevaleurs = $this->getTableLocator()->get('Typevaleurs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Typevaleurs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TypevaleursTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
