<?php

namespace App\Actions;

use App\Services\ASCIISearcherService;
use Illuminate\Console\Command;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class ASCIISearcherAction
{
    use AsAction;

    public string $commandSignature = 'app:ascii-searcher';

    public string $commandDescription = 'Search missing character between 44 and 124';

    public function handle(): string
    {
        return (new ASCIISearcherService())->search();
    }

    /**
     * @OA\Get(
     *     tags={"ASCII Searcher"},
     *     path="/api/ascii-searcher",
     *     summary="Searches for the missing character between the ASCII character 44(,) and 124(|).",
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function asController(Request $request): JsonResponse
    {
        return response()->json(["missing_character" => $this->handle()]);
    }

    public function asCommand(Command $command): int
    {
        $missingChr = $this->handle();
        $command->line("Missing character is: $missingChr");
        return 0;
    }
}
