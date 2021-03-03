<?php

namespace App\Jobs;

use App\Services\QiitaServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ImportQiita implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * @var QiitaServiceInterface
	 */
	private $qiitaService;

	/**
	 * @var
	 */
    private $data;

    /**
     * Create a new job instance.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
	}

    /**
     * Execute the job.
     *
     * @param QiitaServiceInterface $qiitaService
     * @return array
     */
    public function handle(QiitaServiceInterface $qiitaService) :array
    {
        return $qiitaService->import($this->data);
    }
}
