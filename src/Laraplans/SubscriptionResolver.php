<?php

namespace Parfumux\Laraplans;

use Illuminate\Database\Eloquent\Model;
use Parfumux\Laraplans\Contracts\SubscriptionResolverInterface;

class SubscriptionResolver implements SubscriptionResolverInterface
{
    /**
     * @inherit
     */
    public function resolve(Model $subscribable, $name)
    {
        $subscriptions = $subscribable->subscriptions->sortByDesc(function ($value) {
            return $value->created_at->getTimestamp();
        });

        foreach ($subscriptions as $key => $subscription) {
            if ($subscription->name === $name) {
                return $subscription;
            }
        }
    }
}
