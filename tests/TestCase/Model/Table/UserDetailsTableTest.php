<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserDetailsTable Test Case
 */
class UserDetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserDetailsTable
     */
    protected $UserDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.UserDetails',
        'app.Iidxes',
        'app.Twitters',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserDetails') ? [] : ['className' => UserDetailsTable::class];
        $this->UserDetails = TableRegistry::getTableLocator()->get('UserDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UserDetails);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
