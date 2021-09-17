<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Collection\Collection;

interface KeyValueRepositoryInterface
{

    /**
     * @param string $key
     * @return Model
     */
    public function findKeyWithTime(string $key, int $timestamp): ?Model;

    /**
     * @return Collection
     */
    public function all(): Collection;
}
