<?php

namespace App\Actions\Users;

use App\Actions\AbstractRestApiAction;
use App\Actions\DtoMappers\Users\UserObjectDtoMapper;
use App\Domain\Commands\Users\UserRegisterCommand;
use App\Domain\Repositories\Users\UserRepository;
use App\Domain\Services\Users\UserRegisterService;
use App\Filters\Users\UserRegisterFilter;
use App\Responders\Users\UserRegisterResponder;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserRegisterAction extends AbstractRestApiAction
{
    private UserRegisterService $service;

    /**
     * @param UserRegisterFilter $filter
     * @param UserRepository $repository
     * @param UserRegisterService $service
     * @param UserObjectDtoMapper $dtoMapper
     * @param UserRegisterResponder $responder
     */
    #[Pure] public function __construct(
        UserRegisterFilter $filter,
        UserRepository $repository,
        UserRegisterService $service,
        UserObjectDtoMapper $dtoMapper,
        UserRegisterResponder $responder
    ) {
        parent::__construct($filter, $repository, $dtoMapper, $responder);
        $this->service = $service;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->filter->filter($request);

        $requestBody = json_decode($request->getContent(), true);
        $command = new UserRegisterCommand(
            $requestBody['email'],
            $requestBody['password'],
            $requestBody['username']
        );
        $this->service->handle($command);

        $user = $this->repository->findOneByEmail($command->getEmail());
        $userObjectDto = $this->dtoMapper->toDto($user);

        return $this->responder->respond($userObjectDto);
    }
}
