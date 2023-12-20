<?php 
namespace App\Traits;
use Illuminate\Support\Facades\Schema;

trait GetTableColumnsTrait
{
    public static function getTableColumns(array $selectedColumns = [])
    {
        $tableColumns = Schema::getColumnListing((new self())->getTable());

        if (empty($selectedColumns)) {
            return $tableColumns;
        }

        // Filter only the selected columns that exist in the table
        $selectedColumns = array_intersect($selectedColumns, $tableColumns);

        return $selectedColumns;
    }
}