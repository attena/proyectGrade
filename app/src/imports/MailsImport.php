<?php

namespace App\src\imports;

use Maatwebsite\Excel\Concerns\ToArray;

class MailsImport implements ToArray
{
    public function array(array $array)
    {
        return $array[0];
    }
}
