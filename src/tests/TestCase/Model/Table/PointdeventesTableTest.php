<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PointdeventesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PointdeventesTable Test Case
 */
class PointdeventesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PointdeventesTable
     */
    protected $Pointdeventes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Pointdeventes',
        'app.Villes',
        'app.Articles',
        'app.Bondechargements',
        'app.Bondereservations',
        'app.Bondetransferts',
        'app.Bonlivraisons',
        'app.Bonreceptionstocks',
        'app.Bonsortiestocks',
        'app.Commandeclients',
        'app.Commandes',
        'app.Depots',
        'app.Factureclients',
        'app.Factures',
        'app.Livraisons',
        'app.Livraisonsanc',
        'app.Personnels',
        'app.Users',
        'app.Utilisateurs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Pointdeventes') ? [] : ['className' => PointdeventesTable::class];
        $this->Pointdeventes = $this->getTableLocator()->get('Pointdeventes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Pointdeventes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PointdeventesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PointdeventesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
