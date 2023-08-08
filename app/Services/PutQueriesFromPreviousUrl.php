<?php

namespace App\Services;


use Illuminate\Support\Str;

class PutQueriesFromPreviousUrl
{

    public static function put(string $name): array | null
    {
        $parsedUrl = parse_url(url()->previous());
        parse_str($parsedUrl['query'] ?? null, $queries);

        return session(["{$name}.queries" => $queries]);
    }

}
