<?php
/*
 * View file for the view which displays a list of projects in a given category
 */
 
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\CategoryView;

class QwhelloworldViewCategory extends CategoryView
{
	public function display($tpl = null)
	{
		$this->categoryName = $this->get("CategoryName");

		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->state = $this->get('State');
		$this->filterForm    	= $this->get('FilterForm');
		$this->activeFilters 	= $this->get('ActiveFilters');

		$this->subcategories = $this->get('Subcategories');

		$this->params = Factory::getApplication()->getParams();

		parent::display($tpl);
	}

	protected function prepareDocument()
	{
		parent::prepareDocument();
		parent::addFeed();
	}
}