<?php
namespace Windwalker\DataMapper\Tests;

use Windwalker\Compare\GteCompare;

use Windwalker\Data\DataSet;
use Windwalker\DataMapper\RelationDataMapper;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-02-19 at 14:06:40.
 */
class RelationDataMapperTest extends DatabaseTest
{
	/**
	 * @var RelationDataMapper
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->db = static::$dbo;

		$this->object = new RelationDataMapper('cont', 'ww_content');

		$this->object
			->addTable('cat',  'ww_categories', 'cont.catid = cat.id',       'LEFT')
			->addTable('user', 'ww_users',      'cont.created_by = user.id', 'LEFT');
	}

	/**
	 * @covers Windwalker\DataMapper\RelationDataMapper::find
	 * @todo   Implement testFind().
	 */
	public function testFind()
	{
		$dataset = $this->object->find(
			array(
				'cont.access' => 1,
				new GteCompare('cat.id', 25)
			),
			'cont.title DESC',
			1,
			3
		);

		$sql = <<<SQL
SELECT `cont`.`id` AS `id`,
	`cont`.`title` AS `title`,
	`cont`.`catid` AS `catid`,
	`cont`.`created` AS `created`,
	`cont`.`created_by` AS `created_by`,
	`cont`.`access` AS `access`,
	`cat`.`id` AS `cat_id`,
	`cat`.`parent_id` AS `cat_parent_id`,
	`cat`.`title` AS `cat_title`,
	`user`.`id` AS `user_id`,
	`user`.`name` AS `user_name`,
	`user`.`username` AS `user_username`
FROM `ww_content` AS `cont`
	LEFT JOIN `ww_categories` AS `cat` ON cont.catid = cat.id
	LEFT JOIN `ww_users` AS `user` ON cont.created_by = user.id
WHERE cont.access = 1
	AND cat.id >= 25
ORDER BY cont.title DESC
LIMIT 1, 3
SQL;

		$items = $this->db->setQuery($sql)->loadObjectList(null, 'Windwalker\\Data\\Data');

		$items = new DataSet($items);

		$this->assertEquals($dataset, $items);
	}

	/**
	 * @covers Windwalker\DataMapper\RelationDataMapper::findAll
	 * @todo   Implement testFindAll().
	 */
	public function testFindAll()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers Windwalker\DataMapper\RelationDataMapper::findOne
	 * @todo   Implement testFindOne().
	 */
	public function testFindOne()
	{
		$data = $this->object->findOne(
			array(
				'cont.access' => 1,
				new GteCompare('cat.id', 25)
			),
			'cont.title DESC'
		);

		$sql = <<<SQL
SELECT `cont`.`id` AS `id`,
	`cont`.`title` AS `title`,
	`cont`.`catid` AS `catid`,
	`cont`.`created` AS `created`,
	`cont`.`created_by` AS `created_by`,
	`cont`.`access` AS `access`,
	`cat`.`id` AS `cat_id`,
	`cat`.`parent_id` AS `cat_parent_id`,
	`cat`.`title` AS `cat_title`,
	`user`.`id` AS `user_id`,
	`user`.`name` AS `user_name`,
	`user`.`username` AS `user_username`
FROM `ww_content` AS `cont`
	LEFT JOIN `ww_categories` AS `cat` ON cont.catid = cat.id
	LEFT JOIN `ww_users` AS `user` ON cont.created_by = user.id
WHERE cont.access = 1
	AND cat.id >= 25
ORDER BY cont.title DESC
SQL;

		$item = $this->db->setQuery($sql)->loadObject('Windwalker\\Data\\Data');

		$this->assertEquals($data, $item);
	}
}
