<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ScoresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ScoresTable Test Case
 */
class ScoresTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ScoresTable
     */
    protected $Scores;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Scores',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Scores') ? [] : ['className' => ScoresTable::class];
        $this->Scores = TableRegistry::getTableLocator()->get('Scores', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Scores);

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
}
