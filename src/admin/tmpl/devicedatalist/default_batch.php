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
use Joomla\CMS\Layout\LayoutHelper;

$published = $this->state->get('filter.published');
$noUser = true;
?>
<div class="modal hide fade" id="collapseModal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&#215;</button>
		<h3><?php echo Text::_('COM_IOT_BATCH_OPTIONS'); ?></h3>
	</div>
	<div class="modal-body modal-batch">
		<p><?php echo Text::_('COM_IOT_BATCH_TIP'); ?></p>
		<div class="row">
			<div class="form-group col-md-6">
				<div class="controls">
					<?php echo LayoutHelper::render('joomla.html.batch.language', []); ?>
				</div>
			</div>
			<div class="form-group col-md-6">
				<div class="controls">
					<?php echo LayoutHelper::render('joomla.html.batch.access', []); ?>
				</div>
			</div>
		</div>
		<div class="row">
		<?php if ($published >= 0) : ?>
			<div class="form-group col-md-6">
				<div class="controls">
					<?php echo LayoutHelper::render('joomla.html.batch.item', ['extension' => 'com_iot']); ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="form-group col-md-6">
			<div class="controls">
				<?php echo LayoutHelper::render('joomla.html.batch.tag', []); ?>
			</div>
		</div>
		<div class="row">
			<div class="control-group">
				<div class="controls">
					<?php echo LayoutHelper::render('joomla.html.batch.user', ['noUser' => $noUser]); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-secondary" type="button" onclick="document.getElementById('batch-category-id').value='';document.getElementById('batch-access').value='';document.getElementById('batch-language-id').value='';document.getElementById('batch-user-id').value='';document.getElementById('batch-tag-id').value=''" data-dismiss="modal">
			<?php echo Text::_('JCANCEL'); ?>
		</button>
		<button class="btn btn-primary" type="submit" onclick="Joomla.submitbutton('device.batch');">
			<?php echo Text::_('JGLOBAL_BATCH_PROCESS'); ?>
		</button>
	</div>
</div>
