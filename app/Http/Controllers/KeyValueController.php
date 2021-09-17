<?php

namespace App\Http\Controllers;


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
     * Get value from key
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

        ['key' => $key, 'value' => $value]  = $this->keyValueRepository->findKeyWithTime($key, $timestamp);

        if (!$key || !$value) {
            return response()->json(['error' => 'Key not found'], 422);
        }

        return response()->json([
            $key => $value,
        ]);
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
        ['key' => $key, 'value' => $value] = $this->keyValueRepository->create([
            'key' => $firstKey,
            'value' => $input[$firstKey],
            'timestamp' => Carbon::now()->timestamp
        ]);
        return response()->json([
            $key => $value,
        ], 201);
    }
}
