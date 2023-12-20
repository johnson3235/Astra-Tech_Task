<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use App\Models\User;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\ExistsInExcel;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
class UserDataController extends Controller
{

    public function createalbum()
    {
    
        return view('dashboard.users.create');
    }


    public function view_User_data($id)
    {
        $user = UserData::Find($id);

        return view('dashboard.users.view', compact('user'));
    }


    public function editUserPage($id)
    {
        $user = UserData::Find($id);
        $parts = explode(' ', $user->full_name);
        $user->names = $parts;
        return view('dashboard.users.edit', compact('user'));
    }


    public function storeInformationUser(StoreUserRequest $request)
    {
   
        $data = $request->safe()->except(['_token', 'image', 'submit']);
      //  dd($data['first_name']);
        $user = new UserData();
        $user->full_name = $data['first_name'].' '.$data['last_name'];
        $user->email = $data['email'];
        $user->phone_number = $data['phone'];
        if($user->save())
        {
            return redirect()->route('home')->with('success', 'Created Successfull');
        }

        return redirect()->route('home')->with('error', 'Some Thing Error');
    }

    public function updateInformationUser(UpdateUserRequest $request, $id)
    {

        $user = UserData::Find($id);
        $data = $request->except('_token', '_method', 'submit');
        $user->full_name = $data['first_name'].' '.$data['last_name'];
        $user->email = $data['email'];
        $user->phone_number = $data['phone_number'];
        if($user->update())
        {
            return redirect()->route('home')->with('success', 'Updated Successfull');
        }

        return redirect()->route('home')->with('error', 'Some Thing Error');

    }

    public function DeleteUser($id)
    {
        $user = UserData::find($id);
        if($user->delete())
        {
            return redirect()->route('home')->with('success', 'User Removed Successfull');
        }
        return redirect()->route('home')->with('success', 'Operation Successfull');
    }


    public function exportView()
    {
        return view('dashboard.users.export');
    }

    public function importView()
    {
        return view('dashboard.users.import');
    }

    public function export(Request $request)
    {
        $selectedColumns = $request->input('selected_columns', []);
        
        return Excel::download(new UsersExport($selectedColumns), 'users.xlsx');;
    }

    public static function getTableColumns(array $selectedColumns)
    {
        $tableColumns = Schema::getColumnListing((new self())->getTable());

        if (empty($selectedColumns)) {
            return $tableColumns;
        }

        // Filter only the selected columns that exist in the table
        $selectedColumns = array_intersect($selectedColumns, $tableColumns);

        return $selectedColumns;
    }

    public function import(Request $request)
    {
        // validate on File First 
      
        $request->validate([
                'file' => 'required|mimes:xlsx',
        ]);

        // Then Validate On Headers Columns
       
        $request->validate([
            'full_name_heading' => ['required', new ExistsInExcel($request->file('file'), $request->input('full_name_heading'))],
            'email_heading' => ['required', new ExistsInExcel($request->file('file'), $request->input('email_heading'))],
            'phone_number_heading' => ['required', new ExistsInExcel($request->file('file'), $request->input('phone_number_heading'))],
        ]);

        $customHeadings = [
            'full_name' => $request->input('full_name_heading'),
            'email' => $request->input('email_heading'),
            'phone_number' => $request->input('phone_number_heading'),
        ];
        $file = $request->file('file');

        try {
        Excel::import(new UsersImport($customHeadings), $file);
        }catch (\Exception $e) {
            return redirect()->route('home')->with('danger', 'Invalid Data in Excel Sheet. There are Duplicated or Missing Data');
        }
        return redirect()->route('home')->with('success', 'Users Imported Successfull');
    }



}
