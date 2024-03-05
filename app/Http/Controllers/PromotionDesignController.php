<?php

namespace App\Http\Controllers;

use App\Promotions\PromotionDesignFactory;
use Exads\ABTestException;
use Illuminate\Http\JsonResponse;
use Mockery\Exception;

class PromotionDesignController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/promotions/design/redirect/{promotionId}",
     *     summary="Get Redirect URL",
     *     description="Returns a redirect URL based on the promotion ID",
     *     operationId="getRedirectUrl",
     *     tags={"Promotion Design"},
     *     @OA\Parameter(
     *         name="promotionId",
     *         in="path",
     *         description="ID of the promotion",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="redirect_url",
     *                 type="string",
     *                 description="The URL to which the user should be redirected"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Promotion Not Found"
     *     )
     * )
     */
    public function getRedirectUrl(int $promotionId): JsonResponse
    {
        $redirect = PromotionDesignFactory::create('percent');

        try {
            return response()->json(['redirect_url' => $redirect->getRedirectUrl($promotionId)]);
        }catch (ABTestException $exception){
            return response()->json(['error' => $exception->getMessage()], 422);
        }
    }
}
