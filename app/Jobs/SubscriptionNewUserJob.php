<?php
namespace App\Jobs;

use App\Repositories\SubscriptionRepository;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscriptionNewUserJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $request;
    protected $user_id;

    public function __construct(array $request, $user_id)
    {
        $this->user_id = (int) $user_id;
        $this->request = $request;
    }

    public function handle()
    {
        try {
            (new SubscriptionRepository())
                ->subscriptionByRequest($this->request, $this->user_id);
        } catch (\Exception $e) {
            error_log($e);
            throw $e;
        }
    }
}
