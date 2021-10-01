<?php

namespace App\Factory;

use App\Domain\Entities\Todos\Todo;
use App\Domain\Repositories\Todos\TodoRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Todo>
 *
 * @method static Todo|Proxy createOne(array $attributes = [])
 * @method static Todo[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Todo|Proxy find(object|array|mixed $criteria)
 * @method static Todo|Proxy findOrCreate(array $attributes)
 * @method static Todo|Proxy first(string $sortedField = 'id')
 * @method static Todo|Proxy last(string $sortedField = 'id')
 * @method static Todo|Proxy random(array $attributes = [])
 * @method static Todo|Proxy randomOrCreate(array $attributes = [])
 * @method static Todo[]|Proxy[] all()
 * @method static Todo[]|Proxy[] findBy(array $attributes)
 * @method static Todo[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Todo[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TodoRepository|RepositoryProxy repository()
 * @method Todo|Proxy create(array|callable $attributes = [])
 */
final class TodoFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected static function getClass(): string
    {
        return Todo::class;
    }

    protected function getDefaults(): array
    {
        return [
            'name' => 'todo',
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this// ->afterInstantiate(function(Todo $todo) {})
            ;
    }
}
