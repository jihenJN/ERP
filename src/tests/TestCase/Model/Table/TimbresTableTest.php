<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TimbresTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TimbresTable Test Case
 */
class TimbresTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TimbresTable
     */
    protected $Timbres;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Timbres',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Timbres') ? [] : ['className' => TimbresTable::class];
        $this->Timbres = $this->getTableLocator()->get('Timbres', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Timbres);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TimbresTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
