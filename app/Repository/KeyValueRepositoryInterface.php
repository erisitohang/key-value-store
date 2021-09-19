<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

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
    public function all(): ?Collection;
}
