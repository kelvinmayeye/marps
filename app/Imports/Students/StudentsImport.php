<?php

namespace App\Imports\Students;

use Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentsImport implements ToCollection
{
    /**
    * @param Collection $collection
     * @throws Exception
    */
    public function collection(Collection $collection)
    {
        //
    }
}
