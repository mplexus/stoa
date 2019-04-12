<?php

declare(strict_types = 1);

namespace Stoa\Query;

class StatsTransformer
{
    /**
     * @inheritdoc
     */
    public function transform(array $data) : array
    {
        $stats = [];
        $stats["dates"] = [];
        $stats["customers"] = [];
        $stats["quantity"] = [];

        for ($i=0; $i<count($data); $i++) {
            $stats["dates"][] = $data[$i]["date"];
            $stats["customers"][] = $data[$i]["customers"];
            $stats["quantity"][] = $data[$i]["quantity"];
        }

        return $stats;
    }
}
