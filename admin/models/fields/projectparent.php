<?php
/**
 * Class associated with displaying an input field to capture the parent of a project record
 */

defined('JPATH_BASE') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormHelper;

FormHelper::loadFieldClass('list');

class JFormFieldProjectParent extends JFormFieldList
{
	protected $type = 'projectparent';

	/**
	 * Method to return the field options for the parent
	 *
	 */
	protected function getOptions()
	{
		$options = array();

		$db = Factory::getDbo();
		$query = $db->getQuery(true)
			->select('DISTINCT(a.id) AS value, a.title AS text, a.level, a.lft')
			->from('#__com_qwhelloworld_projects AS a');
		
		// Prevent parenting to children of this record, or to itself
		// If this record has lft = x and rgt = y, then its children have lft > x and rgt < y
		if ($id = $this->form->getValue('id'))
		{
			$query->join('LEFT', $db->quoteName('#__com_qwhelloworld_projects') . ' AS h ON h.id = ' . (int) $id)
				->where('NOT(a.lft >= h.lft AND a.rgt <= h.rgt)');
		}
		
		$query->order('a.lft ASC');
		
		$db->setQuery($query);

		try
		{
			$options = $db->loadObjectList();
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
		
		// Pad the option text with spaces using depth level as a multiplier.
		for ($i = 0; $i < count($options); $i++)
		{
			$options[$i]->text = str_repeat('- ', $options[$i]->level) . $options[$i]->text;
		}

		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;

	}
}