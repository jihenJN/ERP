<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FamillesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FamillesTable Test Case
 */
class FamillesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FamillesTable
     */
    protected $Familles;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Familles',
        'app.Articles',
        'app.Sousfamille1s',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Familles') ? [] : ['className' => FamillesTable::class];
        $this->Familles = $this->getTableLocator()->get('Familles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Familles);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FamillesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
