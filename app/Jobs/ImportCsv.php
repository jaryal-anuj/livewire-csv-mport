<?php

namespace App\Jobs;

use App\Models\Import;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ImportCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use Batchable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Import $import, public string $model, public array $chunk, public array $columns)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $affectedRows = $this->model::upsert(
            $this->chunk, ['id'], collect($this->columns)->diff('id')->keys()->toArray()
        );

        $this->import->increment('processed_rows', $affectedRows);
        sleep(2);
    }
}
