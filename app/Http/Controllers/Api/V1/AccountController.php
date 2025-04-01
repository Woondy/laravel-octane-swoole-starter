<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\Account\AccountCreateDTO;
use App\DTOs\Account\AccountRetrieveDTO;
use App\DTOs\Account\AccountBalanceDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Account\CreateAccountRequest;
use App\Http\Resources\Api\V1\Account\AccountResource;
use App\Http\Resources\Api\V1\Account\AccountBalanceResource;
use App\Http\Resources\Api\V1\ApiResource;
use App\Services\AccountService;
use Illuminate\Http\JsonResponse;

class AccountController extends Controller
{
    public function __construct(
        private AccountService $accountService
    ) {}

    public function store(CreateAccountRequest $request): JsonResponse
    {
        $accountDTO = AccountCreateDTO::fromRequest($request->validated());
        $account = $this->accountService->create($accountDTO);

        return ApiResource::resource(
            new AccountResource($account),
            201
        );
    }

    public function show(string $id): JsonResponse
    {
        $accountDTO = AccountRetrieveDTO::fromRequest(['user_id' => $id]);
        $account = $this->accountService->get($accountDTO);

        return ApiResource::resource(
            new AccountResource($account)
        );
    }

    public function getBalance(string $id): JsonResponse
    {
        $accountDTO = AccountBalanceDTO::fromRequest(['user_id' => $id]);
        $balance = $this->accountService->getBalance($accountDTO);
        
        return ApiResource::resource(
            new AccountBalanceResource($balance)
        );
    }
}