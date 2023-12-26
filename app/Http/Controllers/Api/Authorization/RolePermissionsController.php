<?php

namespace AMGPortal\Http\Controllers\Api\Authorization;

use AMGPortal\Events\Role\PermissionsUpdated;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Role\UpdateRolePermissionsRequest;
use AMGPortal\Http\Resources\PermissionResource;
use AMGPortal\Repositories\Role\RoleRepository;
use AMGPortal\Role;

/**
 * @package AMGPortal\Http\Controllers\Api
 */
class RolePermissionsController extends ApiController
{
    public function __construct(private RoleRepository $roles)
    {
        $this->middleware('permission:permissions.manage');
    }

    public function show(Role $role)
    {
        return PermissionResource::collection($role->cachedPermissions());
    }

    /**
     * Update specified role.
     * @param Role $role
     * @param UpdateRolePermissionsRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function update(Role $role, UpdateRolePermissionsRequest $request)
    {
        $this->roles->updatePermissions(
            $role->id,
            $request->permissions
        );

        event(new PermissionsUpdated);

        return PermissionResource::collection($role->cachedPermissions());
    }
}
