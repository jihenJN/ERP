<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LignebonlivraisonsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LignebonlivraisonsTable Test Case
 */
class LignebonlivraisonsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LignebonlivraisonsTable
     */
    protected $Lignebonlivraisons;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Lignebonlivraisons',
        'app.Bonlivraisons',
        'app.Articles',
        'app.Commandeclients',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Lignebonlivraisons') ? [] : ['className' => LignebonlivraisonsTable::class];
        $this->Lignebonlivraisons = $this->getTableLocator()->get('Lignebonlivraisons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Lignebonlivraisons);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LignebonlivraisonsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LignebonlivraisonsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
