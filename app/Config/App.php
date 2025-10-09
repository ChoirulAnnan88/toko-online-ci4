<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    public string $baseURL = 'http://localhost:8081/';

    public array $allowedHostnames = [];

    public string $indexPage = '';

    public string $uriProtocol = 'REQUEST_URI';

    public string $permittedURIChars = 'a-z 0-9~%.:_\-';

    public string $defaultLocale = 'en';

    public bool $negotiateLocale = false;

    public array $supportedLocales = ['en'];

    public string $appTimezone = 'UTC';

    public string $charset = 'UTF-8';

    public bool $forceGlobalSecureRequests = false;

    public array $proxyIPs = [];

    public bool $CSPEnabled = false;

    public int $sessionExpiration = 7200;

    public string $sessionSavePath = WRITEPATH . 'session';

    public string $sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler';

    public string $sessionCookieName = 'ci_session';

    public int $sessionTimeToUpdate = 300;

    public bool $sessionRegenerateDestroy = false;

    public bool $cookieSecure = false;

    public bool $cookieHTTPOnly = true;

    public string $cookieSameSite = 'Lax';

    public function __construct()
{
    parent::__construct();

    $this->environment = 'production';
}
}