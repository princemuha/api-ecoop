<?php

namespace App\Infrastructure\Marketplace\Banner\Repositories;

use App\Infrastructure\Marketplace\Banner\Contracts\BannerInterface;
use App\Infrastructure\Marketplace\Banner\Models\Banner;

class BannerEloquent implements BannerInterface
{
    public function __construct()
    {
    }

    public function getAll()
    {
        return Banner::where('banner_status', 'active')->get()->toArray();
    }
}
