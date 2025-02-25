<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArticlefournisseursTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArticlefournisseursTable Test Case
 */
class ArticlefournisseursTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ArticlefournisseursTable
     */
    protected $Articlefournisseurs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Articlefournisseurs',
        'app.Fournisseurs',
        'app.Articles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Articlefournisseurs') ? [] : ['className' => ArticlefournisseursTable::class];
        $this->Articlefournisseurs = $this->getTableLocator()->get('Articlefournisseurs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Articlefournisseurs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ArticlefournisseursTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ArticlefournisseursTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
