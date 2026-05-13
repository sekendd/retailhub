<?php

namespace Config;

use Tatter\Assets\Config\Assets as TatterAssets;

class Assets extends TatterAssets
{
    // Where your assets are stored relative to the 'public' folder
    public $directory = 'assets';

    // Routes to ignore (optional)
    public $ignoredRoutes = [
        'debugbar',
    ];
}