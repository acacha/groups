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
     * Initialize groups management permissions and roles.
     */
    function initialize_groups_management_permissions()
    {
        //ROLES
        $manageGroups = role_first_or_create('groups-manager');

        permission_first_or_create('store-group');
        permission_first_or_create('assign-user-to-group');

        give_permission_to_role($manageGroups, 'store-group');
        give_permission_to_role($manageGroups, 'assign-user-to-group');

        app(PermissionRegistrar::class)->registerPermissions();
    }
}
