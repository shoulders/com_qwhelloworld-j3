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
use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Uri\Uri;

/**
 * Project Controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_qwhelloworld
 * @since       0.0.9
 */
class QwhelloworldControllerProject extends FormController
{
	/**
	* Implement to allowAdd or not
	*
	* Not used at this time (but you can look at how other components use it....)
	* Overwrites: FormController::allowAdd
	*
	* @param array $data
	* @return bool
	*/
	protected function allowAdd($data = array())
	{
		return parent::allowAdd($data);
	}
	/**
	* Implement to allow edit or not
	* Overwrites: FormController::allowEdit
	*
	* @param array $data
	* @param string $key
	* @return bool
	*/
	protected function allowEdit($data = array(), $key = 'id')
	{
		$id = isset( $data[ $key ] ) ? $data[ $key ] : 0;
		if( !empty( $id ) )
		{
			return Factory::getUser()->authorise( "core.edit", "com_qwhelloworld.project." . $id );
		}
	}

	public function batch($model = null)
	{
		$model = $this->getModel('project');
		$this->setRedirect((string)Uri::getInstance());
		return parent::batch($model);
	}
}