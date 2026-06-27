<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Requests\StoreAgencyRequest;
use App\Services\AgencyService;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(
        private readonly AgencyService $agencyService
    ) {
    }

    public function index(): JsonResponse
    {
        return response()->json([

            'data' => AgencyResource::collection(
                $this->agencyService->getAllAgencies()
            )
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgencyRequest $request): JsonResponse
    {
        $agency = $this->agencyService->createAgency(
            $request->validated()
        );

        return response()->json([
            'message' => 'Agency created successfully.',
            'data' => new AgencyResource($agency),
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
