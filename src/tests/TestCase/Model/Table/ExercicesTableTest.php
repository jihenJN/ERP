<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExercicesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExercicesTable Test Case
 */
class ExercicesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ExercicesTable
     */
    protected $Exercices;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Exercices',
        'app.Inventaires',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Exercices') ? [] : ['className' => ExercicesTable::class];
        $this->Exercices = $this->getTableLocator()->get('Exercices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Exercices);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ExercicesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
