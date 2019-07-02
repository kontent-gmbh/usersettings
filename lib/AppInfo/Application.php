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

namespace OCA\UserSettings\AppInfo;

use OCP\AppFramework\App;
use OCP\IConfig;
use OCP\IUser;
use OCP\Accounts\IAccountManager;
use OCP\Accounts\IAccount;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Description of Application
 *
 * @author michelle
 */
class Application extends App
{

    /** @var IConfig */
    private $config;

    /** @var IAccountManager */
    private $accountManager;

    public function __construct()
    {
        parent::__construct('usersettings');
        $this->config = $this->getContainer()->query(IConfig::class);
        $this->accountManager = $this->getContainer()->query(IAccountManager::class);
    }

    /**
     * resiter user hook
     */
    public function register()
    {
        /** @var EventDispatcherInterface $dispatcher */
        $dispatcher = $this->getContainer()->query(EventDispatcherInterface::class);
        $dispatcher->addListener(IUser::class . '::firstLogin', function ($event)
        {
            if ($event instanceof GenericEvent)
            {
                $this->applySettings($event->getSubject());
            }
        });
    }

    /**
     * apply the settings for the new user
     * 
     * @param IUser/Null $user the new user
     */
    protected function applySettings(IUser $user = null)
    {
        if (!is_null($user))
        {
            // load app settings
            $name = $this->config->getAppValue('usersettings', 'name_scope', 'contacts');
            $address = $this->config->getAppValue('usersettings', 'address_scope', 'private');
            $site = $this->config->getAppValue('usersettings', 'site_scope', 'private');
            $email = $this->config->getAppValue('usersettings', 'email_scope', 'private');
            $avatar = $this->config->getAppValue('usersettings', 'avatar_scope', 'contacts');
            $phone = $this->config->getAppValue('usersettings', 'phone_scope', 'private');
            $twitter = $this->config->getAppValue('usersettings', 'twitter_scope', 'private');

            /** @var IAccount $userData */
            $userData = $this->accountManager->getUser($user);

            // set new default values
            $userData[IAccountManager::PROPERTY_DISPLAYNAME]['scope'] = $name;
            $userData[IAccountManager::PROPERTY_ADDRESS]['scope'] = $address;
            $userData[IAccountManager::PROPERTY_WEBSITE]['scope'] = $site;
            $userData[IAccountManager::PROPERTY_EMAIL]['scope'] = $email;
            $userData[IAccountManager::PROPERTY_AVATAR]['scope'] = $avatar;
            $userData[IAccountManager::PROPERTY_PHONE]['scope'] = $phone;
            $userData[IAccountManager::PROPERTY_TWITTER]['scope'] = $twitter;

            // update user account
            $this->accountManager->updateUser($user, $userData);
        }
    }

}
