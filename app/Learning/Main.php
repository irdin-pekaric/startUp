<?php

namespace App\Learning;

use App\Helpers\Database;

class Main
{
    public static function execute()
    {
        $db = new Database('localhost', 'root', '', 'irhad');

        $values = [
            'title' => 'naslov',
            'content' => null
        ];

        $db->insert('articles', $values);
    }
}