<?php

/**
 * @copyright (c) 2019, Kontent GmbH
 * 
 * @author Michelle Mederake <mmederake@kon.de>
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

namespace OCA\UserSettings\Settings;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\Settings\ISettings;

use OCA\UserSettings\Controller\SettingsController;

/**
 * Set section and position of the settings panel
 *
 * @author Michelle Mederake
 */
class UserSettingsSettings implements ISettings
{
	public function getForm() : TemplateResponse {
		$controller = \OC::$server->query(SettingsController::class);
		return $controller->displayPanel();
	}

	public function getSection() : String {
		return 'security';
	}

	public function getPriority() : int {
		return 10;
	}
}
