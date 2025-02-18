<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VisitesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VisitesTable Test Case
 */
class VisitesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VisitesTable
     */
    protected $Visites;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Visites',
        'app.Clients',
        'app.Visiteurs',
        'app.TypeContacts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Visites') ? [] : ['className' => VisitesTable::class];
        $this->Visites = $this->getTableLocator()->get('Visites', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Visites);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\VisitesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\VisitesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
