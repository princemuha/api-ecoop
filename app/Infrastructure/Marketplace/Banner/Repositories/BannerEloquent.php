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
        return Banner::select('banner_title', 'banner_desc', 'banner_url', 'banner_image', 'banner_flow')->where('banner_status', 'active')->get();
    }
}
