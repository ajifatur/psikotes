<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ajifatur\Helpers\DateTimeExt;
use App\Models\Result;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);

        // Get results
        if(Auth::user()->role_id == role('super-admin'))
            $results = Result::all();
        elseif(Auth::user()->role_id == role('hrd'))
            $results = Result::all();

        // View
        return view('admin/result/index', [
            'results' => $results
        ]);
    }

    /**
     * Show the detail of the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);

        // Get result
        if(Auth::user()->role_id == role('super-admin'))
            $result = Result::findOrFail($id);
        elseif(Auth::user()->role_id == role('hrd'))
            $result = Result::findOrFail($id);

        // Decode
        $result->result = json_decode($result->result, true);
        
        // View
        if($result->test->code == 'disc-24')
            return \App\Http\Controllers\Test\DISC24Controller::detail($result);
        elseif($result->test->code == 'disc-40')
            return \App\Http\Controllers\Test\DISC40Controller::detail($result);
        elseif($result->test->code == 'msdt')
            return \App\Http\Controllers\Test\MSDTController::detail($result);
        elseif($result->test->code == 'papikostick')
            return \App\Http\Controllers\Test\PapikostickController::detail($result);
        elseif($result->test->code == 'rmib')
            return \App\Http\Controllers\Test\RMIBController::detail($result);
        elseif($result->test->code == 'sdi')
            return \App\Http\Controllers\Test\SDIController::detail($result);
        elseif($result->test->code == 'ist')
            return \App\Http\Controllers\Test\ISTController::detail($result);
        else
            abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);
        
        // Delete the result
        $result = Result::find($request->id);
        $result->delete();

        // Redirect
        return redirect()->route('admin.result.index')->with(['message' => 'Berhasil menghapus data.']);
    }

    /**
     * Print to PDF.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function print(Request $request)
    {
        // Check the access
        // has_access(method(__METHOD__), Auth::user()->role_id);
		
        ini_set('max_execution_time', '300');
		
        // DISC 1.0
        if($request->path == 'disc-24')
            return \App\Http\Controllers\Test\DISC24Controller::print($request);
        // DISC 2.0
        elseif($request->path == 'disc-40')
            return \App\Http\Controllers\Test\DISC40Controller::print($request);
        // IST
        elseif($request->path == 'ist')
            abort(404);
        // MSDT
        elseif($request->path == 'msdt')
            return \App\Http\Controllers\Test\MSDtController::print($request);
        // Papikostick
        elseif($request->path == 'papikostick')
            return \App\Http\Controllers\Test\PapikostickController::print($request);
        // SDI
        elseif($request->path == 'sdi')
            return \App\Http\Controllers\Test\SDIController::print($request);
        // RMIB
        elseif($request->path == 'rmib')
            return \App\Http\Controllers\Test\RMIBController::print($request);
    }
}