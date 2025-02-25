<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArticlesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArticlesTable Test Case
 */
class ArticlesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ArticlesTable
     */
    protected $Articles;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Articles',
        'app.Pointdeventes',
        'app.Familles',
        'app.Categories',
        'app.Sousfamille1s',
        'app.Sousfamille2s',
        'app.Sousfamille3s',
        'app.Unites',
        'app.Articlefournisseurs',
        'app.Articleunites',
        'app.Bandeconsultations',
        'app.Fourchettes',
        'app.Lignebandeconsultations',
        'app.Lignebonchargements',
        'app.Lignebondereservations',
        'app.Lignebondetransferts',
        'app.Lignebonlivraisons',
        'app.Lignebonreceptionstocks',
        'app.Lignebonsortiestocks',
        'app.Lignecommandeclients',
        'app.Lignecommandes',
        'app.Lignedemandeoffredeprixes',
        'app.Lignefactureclients',
        'app.Lignefactures',
        'app.Ligneinventaires',
        'app.Lignelivraisons',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Articles') ? [] : ['className' => ArticlesTable::class];
        $this->Articles = $this->getTableLocator()->get('Articles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Articles);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ArticlesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ArticlesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
