<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VisiteursTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VisiteursTable Test Case
 */
class VisiteursTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VisiteursTable
     */
    protected $Visiteurs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Visiteurs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Visiteurs') ? [] : ['className' => VisiteursTable::class];
        $this->Visiteurs = $this->getTableLocator()->get('Visiteurs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Visiteurs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\VisiteursTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
