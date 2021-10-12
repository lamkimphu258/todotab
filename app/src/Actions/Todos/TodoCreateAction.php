<?php

namespace App\Actions\Todos;

use App\Actions\AbstractRestApiAction;
use App\Actions\DtoMappers\Todos\TodoObjectDtoMapper;
use App\Actions\Traits\IsAuthenticatedAction;
use App\Domain\Commands\Todos\TodoCreateCommand;
use App\Domain\Repositories\Todos\TodoRepository;
use App\Domain\Services\Todos\TodoCreateService;
use App\Filters\Todos\TodoCreateFilter;
use App\Responders\Todos\TodoCreateResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TodoCreateAction extends AbstractRestApiAction
{
    use IsAuthenticatedAction;

    private TodoCreateService $service;

    public function __construct(
        TodoCreateFilter $filter,
        TodoRepository $repository,
        TodoCreateService $service,
        TodoObjectDtoMapper $dtoMapper,
        TodoCreateResponder $responder
    ) {
        parent::__construct($filter, $repository, $dtoMapper, $responder);
        $this->service = $service;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->isAuthenticatedOrFail();
        $this->filter->filter($request);

        $requestBody = json_decode($request->getContent(), true);
        $todoCreateCommand = new TodoCreateCommand($requestBody['name'], $this->getUser());
        $this->service->handle($todoCreateCommand);

        $newTodo = $this->repository->findLatestTodo();
        $todoObjectDto = $this->dtoMapper->toDto($newTodo);

        return $this->responder->respond($todoObjectDto);
    }
}
