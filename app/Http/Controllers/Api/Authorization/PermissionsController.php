<?php

namespace AMGPortal\Http\Controllers\Api\Authorization;

use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Permission\CreatePermissionRequest;
use AMGPortal\Http\Requests\Permission\RemovePermissionRequest;
use AMGPortal\Http\Requests\Permission\UpdatePermissionRequest;
use AMGPortal\Http\Resources\PermissionResource;
use AMGPortal\Permission;
use AMGPortal\Repositories\Permission\PermissionRepository;

/**
 * @package AMGPortal\Http\Controllers\Api\Users
 */
class PermissionsController extends ApiController
{
    public function __construct(private PermissionRepository $permissions)
    {
        $this->middleware('permission:permissions.manage');
    }

    /**
     * Get all system permissions.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $permissions = QueryBuilder::for(Permission::class)
            ->allowedFilters([
                AllowedFilter::partial('name'),
                AllowedFilter::partial('display_name'),
                AllowedFilter::exact('role', 'role_id'),
            ])
            ->allowedSorts(['name', 'created_at'])
            ->defaultSort('created_at')
            ->paginate();

        return PermissionResource::collection($permissions);
    }

    /**
     * Create new permission from request.
     * @param CreatePermissionRequest $request
     * @return PermissionResource
     */
    public function store(CreatePermissionRequest $request)
    {
        $permission = $this->permissions->create(
            $request->only(['name', 'display_name', 'description'])
        );

        return new PermissionResource($permission);
    }

    /**
     * Get info about specified permission.
     * @param Permission $permission
     * @return PermissionResource
     */
    public function show(Permission $permission)
    {
        return new PermissionResource($permission);
    }

    /**
     * Update specified permission.
     * @param Permission $permission
     * @param UpdatePermissionRequest $request
     * @return PermissionResource
     */
    public function update(Permission $permission, UpdatePermissionRequest $request)
    {
        $input = collect($request->all());

        $permission = $this->permissions->update(
            $permission->id,
            $input->only(['name', 'display_name', 'description'])->toArray()
        );

        return new PermissionResource($permission);
    }

    /**
     * Remove specified permission from storage.
     * @param Permission $permission
     * @param RemovePermissionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Permission $permission, RemovePermissionRequest $request)
    {
        $this->permissions->delete($permission->id);

        return $this->respondWithSuccess();
    }
}
