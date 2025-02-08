<?php
/**
 * Created by PhpStorm.
 * User: mluhanjo
 * Date: 11/18/19
 * Time: 9:23 AM
 */

namespace App\Services\ExcelExport;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GeneralExport implements FromArray, WithHeadings
{
    protected $search_results;
    protected  $headings;

    public function __construct(array $search_results, array $headings = null)
    {
        $this->search_results = $search_results;
        $this->headings = $headings;
    }

    public function array(): array
    {
        return $this->search_results;
    }



    public function headings(): array
    {
        return $this->headings;
    }
}