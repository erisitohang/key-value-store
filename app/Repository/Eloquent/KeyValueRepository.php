<?php

namespace App\Repository\Eloquent;

use App\Models\KeyValue;
use App\Repository\KeyValueRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Collection\Collection;

class KeyValueRepository extends BaseRepository implements KeyValueRepositoryInterface
{
    /**
     * KeyValueRepository constructor.
     *
     * @param KeyValue $model
     */
    public function __construct(KeyValue $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $key
     * @param int $timestamp
     * @return Model
     */
    public function findKeyWithTime(string $key, int $timestamp): ?Model
    {
        return  $this->model
            ->where('key', $key)
            ->where('timestamp', '<=', $timestamp)
            ->orderBy('timestamp', 'DESC')
            ->first();;
    }

    public function all(): Collection
    {
        return new Collection('');
    }
}
