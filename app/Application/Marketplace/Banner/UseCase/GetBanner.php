<?php

namespace App\Application\Marketplace\Banner\UseCase;

use App\Infrastructure\Marketplace\Banner\Contracts\BannerInterface;
use Illuminate\Support\Facades\Log;

class GetBanner
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private BannerInterface $banner,
    )
    {}

    public function execute()
    {
        $banners = $this->banner->getAll();
        Log::channel('discord-system')->info('Get banner success', ['user' => auth()->user()]);
        return (object) ['banners' => (object) $banners];
    }
}
