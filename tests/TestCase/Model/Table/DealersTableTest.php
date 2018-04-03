<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DealersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DealersTable Test Case
 */
class DealersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DealersTable
     */
    public $Dealers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dealers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Dealers') ? [] : ['className' => DealersTable::class];
        $this->Dealers = TableRegistry::get('Dealers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Dealers);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
