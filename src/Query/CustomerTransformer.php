<?php

declare(strict_types = 1);

namespace Stoa\Query;

class CustomerTransformer implements Transformer
{
    /**
     * @inheritdoc
     */
    public function transform(array $data) : array
    {
        return $data;
    }
}
