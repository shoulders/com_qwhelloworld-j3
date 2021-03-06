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
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\BaseController;

// Set some global property
$document = Factory::getDocument();
$document->addStyleDeclaration('.icon-qwhelloworld {background-image: url(../media/com_qwhelloworld/images/tux-16x16.png);}');

// Access check: is this user allowed to access the backend of this component?
if (!Factory::getUser()->authorise('core.manage', 'com_qwhelloworld'))
{
	throw new Exception(Text::_('JERROR_ALERTNOAUTHOR'));
}

// Require helper file
JLoader::register('QwhelloworldHelper', JPATH_COMPONENT . '/helpers/qwhelloworld.php');

// Get an instance of the controller prefixed by Qwhelloworld
$controller = BaseController::getInstance('Qwhelloworld');

// Perform the Request task
$controller->execute(Factory::getApplication()->input->get('task'));

// Redirect if set by the controller
$controller->redirect();