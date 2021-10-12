<?php

namespace App\Actions\Todos;

use App\Actions\AbstractRestApiAction;
use App\Actions\DtoMappers\Todos\TodoListDtoMapper;
use App\Domain\Repositories\Todos\TodoRepository;
use App\Domain\Repositories\Users\UserRepository;
use App\Filters\Todos\TodoIndexFilter;
use App\Responders\Todos\TodoIndexResponder;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TodoIndexAction extends AbstractRestApiAction
{
    private UserRepository $userRepository;

    /**
     * @param  TodoIndexFilter  $filter
     * @param  TodoRepository  $repository
     * @param  TodoListDtoMapper  $dtoMapper
     * @param  TodoIndexResponder  $responder
     */
    #[Pure] public function __construct(
        TodoIndexFilter $filter,
        TodoRepository $repository,
        TodoListDtoMapper $dtoMapper,
        TodoIndexResponder $responder,
        UserRepository $userRepository
    ) {
        parent::__construct($filter, $repository, $dtoMapper, $responder);
        $this->userRepository = $userRepository;
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->filter->filter($request);
        $user = $this->userRepository->findOneByUsername($request->get('username'));
        $todos = $this->repository->findByOwner($user);
        $todoListDtos = $this->dtoMapper->toDtos($todos);
        return $this->responder->respond($todoListDtos);
    }
}
