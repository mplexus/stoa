<?php

declare(strict_types = 1);

namespace Stoa\Core;

use Twig_Environment;
use Stoa\Core\TemplateEngine;

class TwigTemplateEngine implements TemplateEngine
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @inheritdoc
     */
    public function render(string $templatePath, array $params = []): string
    {
        return $this->twig->render($templatePath, $params);
    }
}
