<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
    
class ExistsInExcel implements Rule
{
        protected $file;
        protected $heading;
    
        public function __construct($file, $heading)
        {
            $this->file = $file;
            $this->heading = $heading;
        }
    
        public function passes($attribute, $value)
        {
            $headings = Excel::toArray(null, $this->file)[0][0] ?? [];
    
            return in_array($this->heading, $headings);
        }
    
        public function message()
        {
            return 'The selected heading does not exist in the imported Excel file.';
        }
    
}
