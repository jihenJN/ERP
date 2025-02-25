<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypepaiementsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypepaiementsTable Test Case
 */
class TypepaiementsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypepaiementsTable
     */
    protected $Typepaiements;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Typepaiements',
        'app.Paiements',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Typepaiements') ? [] : ['className' => TypepaiementsTable::class];
        $this->Typepaiements = $this->getTableLocator()->get('Typepaiements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Typepaiements);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TypepaiementsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
