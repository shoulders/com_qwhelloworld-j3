<?php
/**
 * Layout file for displaying project messages belonging to a given category
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

HTMLHelper::_('formbehavior.chosen', 'select');

$listOrder     = $this->escape($this->state->get('list.ordering'));
$listDirn      = $this->escape($this->state->get('list.direction'));
$lang = Factory::getLanguage()->getTag();
if (Multilanguage::isEnabled() && $lang)
{
    $query_lang = "&lang={$lang}";
}
else
{
    $query_lang = "";
}
?>
<form action="#" method="post" id="adminForm" name="adminForm">
<h1><?php echo $this->categoryName; ?></h1>
<div id="j-main-container" class="span10">
    <div class="row-fluid">
        <div class="span10">
            <?php
                echo LayoutHelper::render(
                    'joomla.searchtools.default',
                    array('view' => $this, 'searchButton' => false)
                );
            ?>
        </div>
    </div>
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th width="5%"><?php echo Text::_('JGLOBAL_NUM'); ?></th>
        <th width="20%">
            <?php echo HTMLHelper::_('searchtools.sort', 'COM_QWHELLOWORLD_PROJECT_TITLE_LABEL', 'title', $listDirn, $listOrder); ?>
        </th>
        <th width="20%">
            <?php echo HTMLHelper::_('searchtools.sort', 'COM_QWHELLOWORLD_PROJECT_ALIAS_LABEL', 'alias', $listDirn, $listOrder); ?>
        </th>
        <th width="20%">
            <?php echo Text::_('COM_QWHELLOWORLD_PROJECT_FIELD_URL_LABEL'); ?>
        </th>
        <th width="5%">
            <?php echo HTMLHelper::_('searchtools.sort', 'JGLOBAL_FIELD_ID_LABEL', 'id', $listDirn, $listOrder); ?>
        </th>
    </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="5">
                <?php echo $this->pagination->getListFooter(); ?>
            </td>
        </tr>
    </tfoot>
    <tbody>
        <?php if (!empty($this->items)) : ?>
            <?php foreach ($this->items as $i => $row) : 
                if (isset($row->canAccess) && !$row->canAccess) : ?>
                    <tr>
                        <td align="center" colspan="5"><?php echo $row->title . " - " . Text::_('COM_QWHELLOWORLD_MUST_LOGIN'); ?></td>
                    </tr>
                <?php else :
                    $url = Route::_('index.php?option=com_qwhelloworld&view=project&id=' . $row->id . ':' . $row->alias . '&catid=' . $row->catid . $query_lang);
                    ?>
                    <tr>
                        <td align="center"><?php echo $this->pagination->getRowOffset($i); ?></td>
                        <td align="center"><?php echo $row->title; ?></td>
                        <td align="center"><?php echo $row->alias; ?></td>
                        <td align="center"><a href="<?php echo $url; ?>"><?php echo $url; ?></a></td>
                        <td align="center"><?php echo $row->id; ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<h1><?php echo Text::_('COM_QWHELLOWORLD_HEADER_SUBCATEGORIES'); ?></h1>
<?php foreach ($this->subcategories as $subcategory) : ?>
    <h3><a href="<?php echo $subcategory->url; ?>"> <?php echo $subcategory->title; ?> </a></h3>
    <p><?php echo $subcategory->description; ?></p>
<?php endforeach; ?>
</div>
</form>