<?php

declare(strict_types = 1);

namespace Stoa\Query;

class OrderTransformer implements Transformer
{
    /**
     * @inheritdoc
     */
    public function transform(array $data) : array
    {
        return array_merge(
            $data,
            [
                'purchaseDate' => (!empty($data['purchaseDate']) ? date('c', strtotime($data['purchase_date'])) : null)
            ]
        );
    }
}
