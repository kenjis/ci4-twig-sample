<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Session\Session;
use Kenjis\CI4Twig\Twig;

class Session_sample extends BaseController
{
    private Session $session;
    private Twig $twig;

    public function __construct()
    {
        $this->session = session();
        $this->twig    = new \Kenjis\CI4Twig\Twig();
    }

    public function getIndex(): void
    {
        $data = [
            'nick'     => 'Mike',
            'login_ok' => true,
        ];
        $this->session->set($data);
        $this->twig->addGlobal('session', $this->session);

        $this->twig->display('session_sample/index.html', []);
    }

    public function getFlash(): RedirectResponse
    {
        $this->session->setFlashdata('test_sess', 'Hello Session');

        return redirect()->to('session_sample/flash_test');
    }

    public function getFlash_test(): void
    {
        $this->twig->addGlobal('session', $this->session);
        $this->twig->display('session_sample/flash.html');
    }
}
