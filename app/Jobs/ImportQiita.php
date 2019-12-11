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
	 *
	 * @param QiitaServiceInterface $qiitaService
	 * @param array $data
	 */
    public function __construct(QiitaServiceInterface $qiitaService, array $data)
    {
    	$this->qiitaService = $qiitaService;
		$this->data = $data;
	}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		$this->qiitaService->import($this->data);
    }
}
