<?php

use Acacha\Forge\Models\Server;
use Acacha\Forge\Notifications\ServerPermissionRequested;
use App\User;
use NotificationChannels\Telegram\Telegram;
use NotificationChannels\Telegram\TelegramMessage;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Themsaid\Forge\Forge;
use GuzzleHttp\Client as HttpClient;

if (! function_exists('initialize_groups_management_permissions')) {

    /**
     * Initialize staff management permissions and roles.
     */
    function initialize_groups_management_permissions()
    {
        //ROLES
//        $manageForge = role_first_or_create('manage-forge');

        //MANAGE FORGE ROLE
//        permission_first_or_create('list-user-servers');

//        give_permission_to_role($manageForge, 'list-user-servers');

//        app(PermissionRegistrar::class)->registerPermissions();
    }
}
