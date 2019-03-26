<?php

declare(strict_types = 1);

namespace Stoa\Core;

interface TemplateEngine
{
    public function render(string $templatePath, array $params = []): string;
}
