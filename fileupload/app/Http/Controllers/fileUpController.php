<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class fileUpController extends Controller
{
    function fileUp(Request $request){

        try{
            $file = $request->file('FileKey');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('/upload_file');
            $file->move($destinationPath, $file_name);

            DB::table('myfile')->insert(['file_path'=>'upload_file/'.$file_name]);

        }catch(\Exception $e){
           // dd($e);
            return 0;
        }
        return 1;
    }
}
