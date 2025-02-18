<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeContactsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeContactsTable Test Case
 */
class TypeContactsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeContactsTable
     */
    protected $TypeContacts;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.TypeContacts',
        'app.Visites',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TypeContacts') ? [] : ['className' => TypeContactsTable::class];
        $this->TypeContacts = $this->getTableLocator()->get('TypeContacts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TypeContacts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TypeContactsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
