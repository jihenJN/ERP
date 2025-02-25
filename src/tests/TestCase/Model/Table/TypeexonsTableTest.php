<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeexonsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeexonsTable Test Case
 */
class TypeexonsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeexonsTable
     */
    protected $Typeexons;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Typeexons',
        'app.Clientexonerations',
        'app.Exonerations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Typeexons') ? [] : ['className' => TypeexonsTable::class];
        $this->Typeexons = $this->getTableLocator()->get('Typeexons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Typeexons);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TypeexonsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
