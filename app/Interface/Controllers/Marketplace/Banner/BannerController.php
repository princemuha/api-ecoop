<?php

namespace App\Interface\Controllers\Marketplace\Banner;

use App\Application\Marketplace\Banner\UseCase\GetBanner;
use App\Shared\Handlers\JsonHandler;
use Illuminate\Routing\Controller;

class BannerController extends Controller
{
    public function __construct(
        private GetBanner $banner,
        private JsonHandler $jsonHandler,
    )
    {}
    public function index()
    {
        return $this->jsonHandler->handle('success', $this->banner->execute());
    }
}