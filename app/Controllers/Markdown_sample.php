<?php

declare(strict_types=1);

namespace App\Controllers;

use Kenjis\CI4Twig\Twig;
use Twig\Extra\Markdown\DefaultMarkdown;
use Twig\Extra\Markdown\MarkdownExtension;
use Twig\Extra\Markdown\MarkdownRuntime;
use Twig\RuntimeLoader\RuntimeLoaderInterface;

class Markdown_sample extends BaseController
{
    private Twig $twig;

    public function __construct()
    {
        $this->twig = $this->loadTwig();
    }

    private function loadTwig(): Twig
    {
        $ci4twig = new \Kenjis\CI4Twig\Twig();

        $twig = $ci4twig->getTwig();
        $twig->addExtension(new MarkdownExtension());
        $twig->addRuntimeLoader(new class () implements RuntimeLoaderInterface {
            public function load($class)
            {
                if (MarkdownRuntime::class === $class) {
                    return new MarkdownRuntime(new DefaultMarkdown());
                }
            }
        });

        return $ci4twig;
    }

    public function getIndex(): void
    {
        $this->twig->display('markdown_sample/index.html', []);
    }
}
