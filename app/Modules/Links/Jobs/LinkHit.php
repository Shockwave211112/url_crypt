<?php

namespace App\Modules\Links\Jobs;

use App\Modules\Links\Models\Link;
use App\Modules\Links\Models\LinksStatistic;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LinkHit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Link
     */
    protected $link;

    /**
     * @param Link $link
     */
    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $nowDate = now()->toDateString();
        $linkStat = LinksStatistic::where('link_id', $this->link->id)->where('date', $nowDate)->first();
        if (!isset($linkStat)) {
            $linkStat = LinksStatistic::create([
                'link_id' => $this->link->id,
                'date' => $nowDate,
                'hits' => 1
            ]);
        } else {
            $linkStat->hits++;
            $linkStat->update();
        }
    }
}
