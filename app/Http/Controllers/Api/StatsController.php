<?php

namespace AMGPortal\Http\Controllers\Api;

use Carbon\Carbon;
use AMGPortal\Http\Resources\UserResource;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Support\Enum\UserStatus;

/**
 * @package AMGPortal\Http\Controllers\Api
 */
class StatsController extends ApiController
{
    public function __construct(private UserRepository $users)
    {
        $this->middleware('role:Admin');
    }

    /**
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function index()
    {
        $usersPerMonth = $this->users->countOfNewUsersPerMonth(
            Carbon::now()->subYear()->startOfMonth(),
            Carbon::now()->endOfMonth()
        );

        $usersPerStatus = [
            'total' => $this->users->count(),
            'new' => $this->users->newUsersCount(),
            'banned' => $this->users->countByStatus(UserStatus::BANNED),
            'unconfirmed' => $this->users->countByStatus(UserStatus::UNCONFIRMED)
        ];

        $users = UserResource::collection($this->users->latest(7));

        return $this->respondWithArray([
            'users_per_month' => $usersPerMonth,
            'users_per_status' => $usersPerStatus,
            'latest_registrations' => $users->resolve()
        ]);
    }
}
