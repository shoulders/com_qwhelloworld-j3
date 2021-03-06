<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_qwhelloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\MVC\Model\ItemModel;
use Joomla\Registry\Registry;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Table\Table;

JLoader::register('QwhelloworldHelperRoute', JPATH_ROOT . '/components/com_qwhelloworld/helpers/route.php');

/**
 * Project Model
 *
 * @since  0.0.1
 */
class QwhelloworldModelProject extends ItemModel
{
	/**
	 * @var object item
	 */
	protected $item;

	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return	void
	 * @since	2.5
	 */
	protected function populateState()
	{
		// Get the message id
		$jinput = Factory::getApplication()->input;
		$id     = $jinput->get('id', 1, 'INT');
		$this->setState('message.id', $id);

		// Load the parameters.
		$this->setState('params', Factory::getApplication()->getParams());
		parent::populateState();
	}

	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  Table  A Table object
	 *
	 * @since   1.6
	 */
	public function getTable($type = 'Project', $prefix = 'QwhelloworldTable', $config = array())
	{
		return Table::getInstance($type, $prefix, $config);
	}

	/**
	 * Get the project
	 * @return object The project to be displayed to the user
	 */
	public function getItem($id = null)
	{
		if (!isset($this->item) || !is_null($id)) 
		{
			$id    = is_null($id) ? $this->getState('message.id') : $id;
			$db    = Factory::getDbo();
			$query = $db->getQuery(true);
			$query->select('h.title, h.params, h.image as image, c.title as category, c.access as catAccess, 
						h.latitude as latitude, h.longitude as longitude, h.access as access,
						h.id as id, h.alias as alias, h.catid as catid, h.parent_id as parent_id, h.level as level, h.description as description')
				  ->from('#__com_qwhelloworld_projects as h')
				  ->leftJoin('#__categories as c ON h.catid=c.id')
				  ->where('h.id=' . (int)$id);

			if (Multilanguage::isEnabled())
			{
				$lang = Factory::getLanguage()->getTag();
				$query->where('h.language IN ("*","' . $lang . '")');
			}

			$db->setQuery((string)$query);
		
			if ($this->item = $db->loadObject()) 
			{
				// Load the JSON string
				$params = new Registry;
				$params->loadString($this->item->params, 'JSON');
				$this->item->params = $params;

				// Merge global params with item params
				$params = clone $this->getState('params');
				$params->merge($this->item->params);
				$this->item->params = $params;

				// Convert the JSON-encoded image info into an array
				$image = new Registry;
				$image->loadString($this->item->image, 'JSON');
				$this->item->imageDetails = $image;

				// Check if the user can access this record (and category)
				$user = Factory::getUser();
				$userAccessLevels = $user->getAuthorisedViewLevels();
				if ($user->authorise('core.admin')) // ie superuser
				{
					$this->item->canAccess = true;
				}
				else
				{
					if ($this->item->catid == 0)
					{
						$this->item->canAccess = in_array($this->item->access, $userAccessLevels);
					}
					else
					{
						$this->item->canAccess = in_array($this->item->access, $userAccessLevels) && in_array($this->item->catAccess, $userAccessLevels);
					}
				}
			}
			else
			{
				throw new Exception('Project id not found', 404);
			}
		}
		return $this->item;
	}

	public function getMapParams()
	{
		if ($this->item) 
		{
			$url = QwhelloworldHelperRoute::getAjaxURL();
			$this->mapParams = array(
				'latitude' => $this->item->latitude,
				'longitude' => $this->item->longitude,
				'zoom' => 10,
				'title' => $this->item->title,
				'ajaxurl' => $url
			);
			return $this->mapParams; 
		}
		else
		{
			throw new Exception('No project details available for map', 500);
		}
	}

	public function getMapSearchResults($mapbounds)
	{
		if (Factory::getConfig()->get('caching') >= 1)
		{
			// Build a cache ID based on the conditions for the SQL where clause
			$groups = implode(',', Factory::getUser()->getAuthorisedViewLevels());
			$cacheId = $groups . '.' . $mapbounds['minlat'] . '.' . $mapbounds['maxlat'] . '.' . 
										$mapbounds['minlng'] . '.' . $mapbounds['maxlng'];
			if (Multilanguage::isEnabled())
			{
				$lang = Factory::getLanguage()->getTag();
				$cacheId .= $lang;
			}
			$cache = Factory::getCache('com_qwhelloworld', 'callback');
			$results = $cache->get(array($this, '_getMapSearchResults'), array($mapbounds), md5($cacheId), false);
			return $results;
		}
		else
		{
			return $this->_getMapSearchResults($mapbounds);
		}
	}

	public function _getMapSearchResults($mapbounds)
	{
		try 
		{
			$db    = Factory::getDbo();
			$query = $db->getQuery(true);
			$query->select('h.id, h.alias, h.catid, h.title, h.latitude, h.longitude, h.access')
			   ->from('#__com_qwhelloworld_projects as h')
			   ->where('h.latitude > ' . $mapbounds['minlat'] . 
				' AND h.latitude < ' . $mapbounds['maxlat'] .
				' AND h.longitude > ' . $mapbounds['minlng'] .
				' AND h.longitude < ' . $mapbounds['maxlng']);

			if (Multilanguage::isEnabled())
			{
				$lang = Factory::getLanguage()->getTag();
				$query->where('h.language IN ("*","' . $lang . '")');
			}

			$user = Factory::getUser();
			$loggedIn = $user->get('guest') != 1;
			if ($loggedIn && !$user->authorise('core.admin'))
			{
				$userAccessLevels = $user->getAuthorisedViewLevels();
				$query->where('h.access IN (' . implode(",", $userAccessLevels) . ')');
				$query->join('LEFT', $db->quoteName('#__categories', 'c') . ' ON c.id = h.catid');
				$query->where('(c.access IN (' . implode(",", $userAccessLevels) . ') OR h.catid = 0)');
			}

			$db->setQuery($query);
			$results = $db->loadObjectList(); 
		}
		catch (Exception $e)
		{
			$msg = $e->getMessage();
			Factory::getApplication()->enqueueMessage($msg, 'error'); 
			$results = null;
		}

		if (Multilanguage::isEnabled())
		{
			$query_lang = "&lang={$lang}";
		}
		else
		{
			$query_lang = "";
		}

		for ($i = 0; $i < count($results); $i++) 
		{
			$results[$i]->url = Route::_('index.php?option=com_qwhelloworld&view=project&id=' . $results[$i]->id . 
				":" . $results[$i]->alias . '&catid=' . $results[$i]->catid . $query_lang);
		}

		return $results; 
	}

	public function getChildren($id)
	{
		$table = $this->getTable();
		$children = $table->getTree($id);
		return $children;
	}
}