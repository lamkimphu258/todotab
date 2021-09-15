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

    protected ServiceInterface $service;

    protected RestApiDtoMapperInterface $dtoMapper;

    protected RestApiResponderInterface $responder;

    /**
     * @param FilterInterface $filter
     * @param ServiceEntityRepositoryInterface $repository
     * @param ServiceInterface $service
     * @param RestApiDtoMapperInterface $dtoMapper
     * @param RestApiResponderInterface $responder
     */
    public function __construct(
        FilterInterface $filter,
        ServiceEntityRepositoryInterface $repository,
        ServiceInterface $service,
        RestApiDtoMapperInterface $dtoMapper,
        RestApiResponderInterface $responder
    ) {
        $this->filter = $filter;
        $this->repository = $repository;
        $this->service = $service;
        $this->dtoMapper = $dtoMapper;
        $this->responder = $responder;
    }
}