<?php

namespace App\Imports;

use App\Models\UserData;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;
class UsersImport implements ToModel, WithHeadingRow
{
    protected $customHeadings;

    public function __construct(array $customHeadings = [])
    {
        $this->customHeadings = $customHeadings;
    }

    public function model(array $row)
    {
       $this->validateData($row);

        try {
            return UserData::create([
                'full_name' => $row[$this->customHeadings['full_name']],
                'phone_number' => $row[$this->customHeadings['phone_number']],
                'email' => $row[$this->customHeadings['email']],
            ]);
        } catch (\Exception $e) {
            \Log::error('Error importing row:', ['row' => $row, 'error' => $e->getMessage()]);
            return redirect()->route('home')->with('error', $e->getMessage());
        }

    }

    protected function validateData(array $data)
    {
        $validator = Validator::make($data, [
            $this->customHeadings['full_name'] => 'required',
            $this->customHeadings['phone_number'] => [
                'required',
                Rule::unique('user_data', 'phone_number'),
            ],
            $this->customHeadings['email'] => [
                'required',
                'email',
                Rule::unique('user_data', 'email'),
            ],
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed for data:', ['data' => $data, 'errors' => $validator->errors()->all()]);
           // dd('Debugging message 3');
          
           abort(302, 'Invalid Data in Excel Sheet. There are Duplicated or Missing Data');
        
        }
    
        
    }
    
}