<?php

namespace App\Actions\Todos;

use App\Actions\AbstractRestApiAction;
use App\Actions\DtoMappers\Todos\TodoListDtoMapper;
use App\Domain\Repositories\Todos\TodoRepository;
use App\Filters\Todos\TodoIndexFilter;
use App\Responders\Todos\TodoIndexResponder;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TodoIndexAction extends AbstractRestApiAction
{
    /**
     * @param TodoIndexFilter $filter
     * @param TodoRepository $repository
     * @param TodoListDtoMapper $dtoMapper
     * @param TodoIndexResponder $responder
     */
    #[Pure] public function __construct(
        TodoIndexFilter $filter,
        TodoRepository $repository,
        TodoListDtoMapper $dtoMapper,
        TodoIndexResponder $responder
    ) {
        parent::__construct($filter, $repository, $dtoMapper, $responder);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $todos = $this->repository->findAll();
        $todoListDtos = $this->dtoMapper->toDtos($todos);
        return $this->responder->respond($todoListDtos);
    }
}
