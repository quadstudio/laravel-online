<?php

namespace QuadStudio\Online;
use Illuminate\Support\Facades\Cache;

trait OnlineChecker
{
    /**
     * Check user online status
     *
     * @return bool
     */
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->getAuthIdentifier());
    }
}