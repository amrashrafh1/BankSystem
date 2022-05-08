<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use FrittenKeeZ\Vouchers\Facades\Vouchers;

class AddCouponsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $validated;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($validated)
    {
        $this->validated = $validated;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Vouchers::withMetadata(['point' => $this->validated['points']])
            ->withStartDate(Carbon::create($this->validated['starts_at']))
            ->withExpireDate(Carbon::create($this->validated['expires_at']))
            ->create($this->validated['count']);
    }
}
