<?php

namespace AMGPortal\Http\Controllers\Web\Authorization;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use AMGPortal\Events\Role\PermissionsUpdated;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\Repositories\Role\RoleRepository;

/**
 * Class RolePermissionsController
 * @package AMGPortal\Http\Controllers
 */
class RolePermissionsController extends Controller
{
    public function __construct(private RoleRepository $roles)
    {
    }

    /**
     * Update permissions for each role.
     *
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        $roles = $request->get('roles');

        $allRoles = $this->roles->lists('id');

        foreach ($allRoles as $roleId) {
            $permissions = Arr::get($roles, $roleId, []);
            $this->roles->updatePermissions($roleId, $permissions);
        }

        event(new PermissionsUpdated);

        return redirect()->route('permissions.index')
            ->withSuccess(__('Permissions saved successfully.'));
    }
}
