<?php
declare(strict_types=1);
/**
 * Device
 *
 * @package    Device
 *
 * @author     Martin KOPP "MacJoom" <martin.kopp@infotech.ch>
 * @copyright  Copyright(c) 2009 - 2021 Martin KOPP "MacJoom". All rights reserved
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://infotech.ch
 */
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

?>
<button type="button" class="btn btn-secondary" onclick="document.getElementById('batch-category-id').value='';document.getElementById('batch-access').value='';document.getElementById('batch-language-id').value='';document.getElementById('batch-user-id').value='';document.getElementById('batch-tag-id').value=''" data-dismiss="modal">
	<?php echo Text::_('JCANCEL'); ?>
</button>
<button type="submit" class="btn btn-success" onclick="Joomla.submitbutton('device.batch');">
	<?php echo Text::_('JGLOBAL_BATCH_PROCESS'); ?>
</button>
