<?php

namespace App\Http\Controllers;


use App\Http\Resources\KeyValueResource;
use App\Repository\KeyValueRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class KeyValueController extends Controller
{

    /**
     * The keyValue repository instance.
     */
    protected $keyValueRepository;

    public function __construct(KeyValueRepositoryInterface $keyValueRepository)
    {
        $this->keyValueRepository = $keyValueRepository;
    }

    /**
     * Get all keys
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $all = $this->keyValueRepository->all();

        return  response()->json(KeyValueResource::collection($all));
    }

    /**
     * Get value from key
     *
     * @param string $key
     * @param Request $request
     * @return JsonResponse
     */
    public function show(string $key, Request $request): JsonResponse
    {
        $timestamp = Carbon::now()->timestamp;
        if ($request->has('timestamp')) {
            $timestamp = (int)$request->input('timestamp');
        }

        $result  = $this->keyValueRepository->findKeyWithTime($key, $timestamp);

        if (!$result) {
            return response()->json(['error' => 'Key not found'], 422);
        }

        return response()->json(new KeyValueResource($result));
    }

    /**
     * Store a new key value.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
        $firstKey = array_key_first($input);
        $validator = Validator::make($input, [
            $firstKey => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $result = $this->keyValueRepository->create([
            'key' => $firstKey,
            'value' => $input[$firstKey],
            'timestamp' => Carbon::now()->timestamp
        ]);

        return response()->json(new KeyValueResource($result), 201);
    }
}
