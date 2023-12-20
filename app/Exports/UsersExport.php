<?php

namespace App\Exports;
use App\Models\UserData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $selectedColumns;
    protected $customHeading;

    public function __construct(array $selectedColumns)
    {
        $this->selectedColumns = $selectedColumns;

    }

    public function collection()
    {
        return UserData::select($this->selectedColumns)->get();
    }

    public function headings(): array
    {
        $columnNames = UserData::getTableColumns($this->selectedColumns);
        return  $columnNames;
    }
}
