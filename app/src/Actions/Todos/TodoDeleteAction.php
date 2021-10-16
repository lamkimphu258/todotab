<?php

namespace App\Actions\Todos;

use App\Actions\AbstractRestApiAction;
use App\Actions\DtoMappers\RestApiDtoMapperInterface;
use App\Actions\DtoMappers\Todos\TodoObjectDtoMapper;
use App\Actions\Traits\IsAuthenticatedAction;
use App\Domain\Repositories\Todos\TodoRepository;
use App\Filters\FilterInterface;
use App\Filters\Todos\TodoDeleteFilter;
use App\Responders\RestApiResponderInterface;
use App\Responders\Todos\TodoDeleteResponder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class TodoDeleteAction extends AbstractRestApiAction
{
    use IsAuthenticatedAction;

    public function __construct(
        TodoDeleteFilter $filter,
        TodoRepository $repository,
        TodoObjectDtoMapper $dtoMapper,
        TodoDeleteResponder $responder
    ) {
        parent::__construct($filter, $repository, $dtoMapper, $responder);
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->isAuthenticatedOrFail();

        $todo = $this->repository->findOneBySlug($request->get('slug'));
        if (is_null($todo)) {
            throw new NotFoundHttpException();
        }
        if ($todo->getOwner()->getUsername() !== $this->getUser()->getUsername()) {
            throw new AccessDeniedHttpException();
        }
        if ($todo) {
            $this->repository->delete($todo);
        }
        $todoDto = $this->dtoMapper->toDto($todo);
        return $this->responder->respond($todoDto);
    }
}
