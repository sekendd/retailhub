<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LoginRateLimit implements FilterInterface
{
    private const MAX_ATTEMPTS = 5;
    private const DECAY_SECONDS = 300; // 5 minutes

    public function before(RequestInterface $request, $arguments = null)
    {
        $cache = cache();
        $ip    = $request->getIPAddress();
        $key   = 'login_attempts_' . md5($ip);

        $attempts = (int) ($cache->get($key) ?? 0);

        if ($attempts >= self::MAX_ATTEMPTS) {
            return service('response')
                ->setStatusCode(429)
                ->setBody('Too many login attempts. Please try again later.');
        }

        $cache->save($key, $attempts + 1, self::DECAY_SECONDS);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
