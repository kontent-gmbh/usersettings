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

namespace OCA\UserSettings\Controller;

use \OCP\IRequest;
use \OCP\AppFramework\Http\TemplateResponse;
use \OCP\AppFramework\Http\DataResponse;
use \OCP\AppFramework\Http;
use \OCP\AppFramework\Controller;
use \OCP\IL10N;
use \OCP\IConfig;

/**
 * Display administrative settings and store it
 *
 * @author Michelle Mederake
 */
class SettingsController extends Controller
{

    /** @var IL10N */
    private $l10n;

    /** @var IConfig */
    private $config;

    /** @var string */
    protected $appName;

    public function __construct($appName, IRequest $request, IL10N $l10n, IConfig $config)
    {
        parent::__construct($appName, $request);
        $this->l10n = $l10n;
        $this->config = $config;
        $this->appName = $appName;
    }

    /**
     * Store selected scopes
     * @AdminRequired
     *
     * @return DataResponse
     */
    public function admin()
    {
        $request = $this->request->getParams();
        
        // store app settings
        if(array_key_exists('name_visibility', $request))
        {
            $this->config->setAppValue($this->appName, 'name_scope', $request['name_visibility']);
        }
        if(array_key_exists('address_visibility', $request))
        {
            $this->config->setAppValue($this->appName, 'address_scope', $request['address_visibility']);
        }
        if(array_key_exists('site_visibility', $request))
        {
            $this->config->setAppValue($this->appName, 'site_scope', $request['site_visibility']);
        }
        if(array_key_exists('email_visibility', $request))
        {
            $this->config->setAppValue($this->appName, 'email_scope', $request['email_visibility']);
        }
        if(array_key_exists('avatar_visibility', $request))
        {
            $this->config->setAppValue($this->appName, 'avatar_scope', $request['avatar_visibility']);
        }
        if(array_key_exists('phone_visibility', $request))
        {
            $this->config->setAppValue($this->appName, 'phone_scope', $request['phone_visibility']);
        }
        if(array_key_exists('twitter_visibility', $request))
        {
            $this->config->setAppValue($this->appName, 'twitter_scope', $request['twitter_visibility']);
        }

        return new DataResponse(array(
            'data' => array(
                'message' => (string) $this->l10n->t('Saved'),
            ),
            'status' => 'success'
        ));
    }

    /**
     * Create settings panel
     * @AdminRequired
     * 
     * @return TemplateResponse
     */
    public function displayPanel()
    {
        // create scope array
        $scopes = array('private' => 'Private', 'contacts' => 'Contacts', 'public' => 'Public');

        // load app settings
        $name = $this->config->getAppValue($this->appName, 'name_scope', 'contacts');
        $address = $this->config->getAppValue($this->appName, 'address_scope', 'private');
        $site = $this->config->getAppValue($this->appName, 'site_scope', 'private');
        $email = $this->config->getAppValue($this->appName, 'email_scope', 'private');
        $avatar = $this->config->getAppValue($this->appName, 'avatar_scope', 'contacts');
        $phone = $this->config->getAppValue($this->appName, 'phone_scope', 'private');
        $twitter = $this->config->getAppValue($this->appName, 'twitter_scope', 'private');

        return new TemplateResponse('usersettings', 'admin', [
            'scopes' => $scopes,
            'name_v' => $name,
            'address_v' => $address,
            'site_v' => $site,
            'email_v' => $email,
            'avatar_v' => $avatar,
            'phone_v' => $phone,
            'twitter_v' => $twitter
        ]);
    }
}
