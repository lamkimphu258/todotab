<?php

namespace App\Actions;

use App\Actions\DtoMappers\RestApiDtoMapperInterface;
use App\Domain\Repositories\RepositoryInterface;
use App\Domain\Services\ServiceInterface;
use App\Filters\FilterInterface;
use App\Responders\RestApiResponderInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class AbstractRestApiAction extends AbstractController implements ActionInterface
{
    protected FilterInterface $filter;

    protected ServiceEntityRepositoryInterface $repository;

    protected RestApiDtoMapperInterface $dtoMapper;

    protected RestApiResponderInterface $responder;

    /**
     * @param FilterInterface $filter
     * @param ServiceEntityRepositoryInterface $repository
     * @param RestApiDtoMapperInterface $dtoMapper
     * @param RestApiResponderInterface $responder
     */
    public function __construct(
        FilterInterface $filter,
        ServiceEntityRepositoryInterface $repository,
        RestApiDtoMapperInterface $dtoMapper,
        RestApiResponderInterface $responder
    ) {
        $this->filter = $filter;
        $this->repository = $repository;
        $this->dtoMapper = $dtoMapper;
        $this->responder = $responder;
    }
}
