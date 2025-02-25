<?php
declare(strict_types=1);
/**
 * DeviceData
 *
 * @package    Iot
 *
 * @author     Martin KOPP "MacJoom" <martin.kopp@infotech.ch>
 * @copyright  Copyright(c) 2009 - 2021 Martin KOPP "MacJoom". All rights reserved
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://infotech.ch
 */

namespace ITC\Component\Iot\Administrator\Table;

defined('_JEXEC') or die;

use ITC\Component\Iot\Administrator\Extension\IotComponent;
use Joomla\CMS\Access\Rules;
use Joomla\CMS\Application\ApplicationHelper;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Tag\TaggableTableInterface;
use Joomla\CMS\Tag\TaggableTableTrait;
use Joomla\CMS\Versioning\VersionableTableInterface;
use Joomla\Database\DatabaseDriver;
use Joomla\Database\ParameterType;
use Joomla\Registry\Registry;
use Joomla\String\StringHelper;
use function explode;
use function implode;
use function is_array;
use function is_null;
use function str_replace;
use function trim;

/**
 * Iot Table class.
 *
 * @since  0.1.0
 */
class DeviceDataTable extends Table implements VersionableTableInterface, TaggableTableInterface
{
	use TaggableTableTrait;

	/**
	 * Indicates that columns fully support the NULL value in the database
	 *
	 * @var    boolean
	 * @since  4.0.0
	 */
	protected $_supportNullValue = false;

	/**
	 * Constructor
	 *
	 * @param   DatabaseDriver  $db  Database connector object
	 *
	 * @since  0.1.0
	 */
	public function __construct(DatabaseDriver $db)
	{
		$this->typeAlias = 'com_iot.device.data';

		// Set the alias since the column is called title
		$this->setColumnAlias('title', 'name');

		// Set the alias since the column is called state
		$this->setColumnAlias('published', 'state');

		parent::__construct('#__iot_data', 'id', $db);
	}

	/**
	 * Method to compute the default name of the asset.
	 * The default name is in the form table_name.id
	 * where id is the value of the primary key of the table.
	 *
	 * @return  string
	 *
	 * @since   1.6
	 */
	protected function _getAssetName()
	{
		$k = $this->_tbl_key;

		return 'com_iot.device.data' . (int) $this->$k;
	}

	/**
	 * Method to return the title to use for the asset table.
	 *
	 * @return  string
	 *
	 * @since   1.6
	 */
	protected function _getAssetTitle()
	{
		return $this->title;
	}


	/**
	 * Overloaded bind function
	 *
	 * @param   array  $array   Named array
	 * @param   mixed  $ignore  An optional array or space separated list of properties
	 *                          to ignore while binding.
	 *
	 * @return  mixed  Null if operation was satisfactory, otherwise returns an error string
	 *
	 * @see     Table::bind()
	 * @since   1.6
	 */
	public function bind($array, $ignore = '')
	{

		return parent::bind($array, $ignore);
	}

	/**
	 * Overloaded check function
	 *
	 * @return  boolean  True on success, false on failure
	 *
	 * @see     Table::check()
	 * @since   1.5
	 */
	public function check()
	{
		try
		{
			parent::check();
		}
		catch (\Exception $e)
		{
			$this->setError($e->getMessage());

			return false;
		}

		if (trim($this->getColumnAlias('title') ?? '') == '')
		{
			$this->setError(Text::_('COM_IOT_WARNING_PROVIDE_VALID_NAME'));

			return false;
		}

		$this->alias = ApplicationHelper::stringURLSafe($this->alias);

		if (trim(str_replace('-', '', $this->alias)) == '')
		{
			$this->alias = Factory::getDate()->format('Y-m-d-H-i-s');
		}

		/**
		 * Ensure any new items have compulsory fields set. This is needed for things like
		 * frontend editing where we don't show all the fields or using some kind of API
		 */
		if (!$this->id)
		{
			// Images can be an empty json string
			if (!isset($this->images))
			{
				$this->images = '{}';
			}

			// URLs can be an empty json string
			if (!isset($this->urls))
			{
				$this->urls = '{}';
			}

			// Attributes (article params) can be an empty json string
			if (!isset($this->attribs))
			{
				$this->attribs = '{}';
			}

			// Attributes (article params) can be an empty json string
			if (!isset($this->params))
			{
				$this->params = '{}';
			}

			// Metadata can be an empty json string
			if (!isset($this->metadata))
			{
				$this->metadata = '{}';
			}

			// Hits must be zero on a new item
			$this->hits = 0;
		}

		return true;
	}

	/**
	 * Overrides Table::store to set modified data and user id.
	 *
	 * @param   boolean  $updateNulls  True to update fields even if they are null.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   1.6
	 */
	public function store($updateNulls = true)
	{
		$date = Factory::getDate()->toSql();
		$user = Factory::getUser();

		// Set created date if not set.
		if (!(int) $this->created)
		{
			$this->created = $date;
		}

		// Verify that the alias is unique
		$app = Factory::getApplication();

		/**
		 * @var IotComponent $component
		 */
		$component = $app->bootComponent('com_iot');
		$table     = $component->getMVCFactory()->createTable('DeviceData', 'Table', ['dbo' => $this->getDbo()]);

		if ($table->load(['alias' => $this->alias]) && ($table->id != $this->id || $this->id == 0))
		{
			$this->setError(Text::_('JLIB_DATABASE_ERROR_ARTICLE_UNIQUE_ALIAS'));

			return false;
		}

		return parent::store($updateNulls);
	}

	/**
	 * Get the type alias for UCM features
	 *
	 * @return  string  The alias as described above
	 *
	 * @since   4.0.0
	 */
	public function getTypeAlias()
	{
		return $this->typeAlias;
	}

}
