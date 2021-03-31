<?php
/**
 *
 * Plugin Name:       ConvertFlow
 * Plugin URI:        https://convertflow.com
 * Description:       Connect your WordPress site with your ConvertFlow account.
 * Version:           0.4.3
 * Author:            BizBudding Inc.
 * Author URI:        https://bizbudding.com/
 * Text Domain:       convertflow
 * License:           GPL-2.0-or-later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /assets/lang
 */

namespace ConvertFlow\Plugin;

require_once __DIR__ . '/lib/helpers.php';
require_once __DIR__ . '/lib/api.php';
require_once __DIR__ . '/lib/setup.php';
require_once __DIR__ . '/lib/admin.php';
require_once __DIR__ . '/lib/ajax.php';
require_once __DIR__ . '/lib/shortcodes.php';
require_once __DIR__ . '/lib/blocks.php';
require_once __DIR__ . '/lib/public.php';
