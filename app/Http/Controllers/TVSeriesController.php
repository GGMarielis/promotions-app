<?php

namespace App\Http\Controllers;

use App\Services\TVSeriesScheduleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator as MakerValidator;

/**
 * @OA\Info (
 *     title="Test Application",
 *     version="0.0.1"
 * )
 */
class TVSeriesController extends Controller
{
    const NOT_FOUND_SERIES_MESSAGE = 'There are no series for this date';

    protected TVSeriesScheduleService $scheduleService;

    public function __construct(TVSeriesScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    /**
     * @OA\Get(
     *     tags={"Series"},
     *     path="/api/series/next-air-time",
     *     summary="Get next air time of a TV series",
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="datetime",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             oneOf={
     *                  @OA\Schema(type="string", format="date-time", example="2024-03-04 22:01:01"),
     *                  @OA\Schema(type="string", format="time", example="22:01:01")
     *              }
     *         )
     *     ),
     *    @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(property="tile", type="string", example="Game of Thrones"),
     *                  @OA\Property(property="week_day", type="string", example="MONDAY"),
     *                  @OA\Property(property="show_time", type="string", example="21:00:00")
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string", example="There are no series for this date")
     *          )
     *      )
     * )
     */
    public function nextAirTime(Request $request): JsonResponse | Response
    {
        $title = $request->get('title');
        $dateTime = $request->get('datetime');

        $validation = MakerValidator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'datetime' => 'nullable|date_format:"Y-m-d H:i:s","H:i:s"',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        $nextAirTime = $this->scheduleService->getNextAirTime($title, $dateTime);

        if (!$nextAirTime) {
            return response()->json(['message' => self::NOT_FOUND_SERIES_MESSAGE], 404);
        }

        return response()->json(['data' => $nextAirTime]);
    }
}
