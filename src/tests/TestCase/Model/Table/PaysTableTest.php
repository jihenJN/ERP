<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaysTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaysTable Test Case
 */
class PaysTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PaysTable
     */
    protected $Pays;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Pays',
        'app.Clients',
        'app.Fournisseurs',
        'app.Villes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Pays') ? [] : ['className' => PaysTable::class];
        $this->Pays = $this->getTableLocator()->get('Pays', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Pays);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PaysTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
