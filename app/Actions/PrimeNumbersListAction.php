<?php

namespace App\Actions;

use App\Services\PrimeNumbersService;
use App\Validators\PrimeNumbersRangeValidator;
use Illuminate\Console\Command;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class PrimeNumbersListAction
{
    use AsAction;

    public string $commandSignature = 'app:prime-numbers {initialValue?} {finalValue?}';

    public string $commandDescription = 'Displays the list of numbers in the input range along with their possible divisors';

    public function handle(?int $initialValue, ?int $finalValue): array
    {
        return (new PrimeNumbersService())->listPrimeNumbers($initialValue, $finalValue);
    }


    /**
     * @OA\Get(
     *     tags={"Prime numbers"},
     *     path="/api/prime-numbers",
     *     summary="Gets all numbers and their divisors, if prime, the word `[PRIME]` appears",
     *     @OA\Parameter(
     *         name="initialValue",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="finalValue",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(type="string", example="10 [1, 2, 5, 10]")
     *          )
     *      )
     * )
     */
    public function asController(Request $request): JsonResponse
    {
        $initial = $request->get('initialValue');
        $final = $request->get('finalValue');

        $validator = PrimeNumbersRangeValidator::validate($initial, $final);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        return response()->json($this->handle($initial, $final));
    }

    public function asCommand(Command $command): int
    {
        $initial = $command->argument('initialValue');
        $final = $command->argument('finalValue');

        $validator = PrimeNumbersRangeValidator::validate($initial, $final);

        if ($validator->fails()) {
            $command->error($validator->errors());
            return 1;
        }

        $numbers = $this->handle($initial, $final);

        foreach ($numbers as $number) {
            $command->line($number);
        }

        return 0;
    }
}
