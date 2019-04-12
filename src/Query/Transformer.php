<?php

declare(strict_types = 1);

namespace Stoa\Query;

interface Transformer
{
    /**
     * Transforms data.
     *
     * @param array $data
     * @return array
     */
    public function transform(array $data);
}
