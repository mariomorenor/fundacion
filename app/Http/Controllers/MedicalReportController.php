<?php

namespace App\Http\Controllers;

use App\Models\MedicalReport;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

class MedicalReportController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function store(Request $request)
    {

        $request["code"] = "H-" . str_pad(MedicalReport::max("id") + 1, 4, "0", STR_PAD_LEFT);
        
        return parent::store($request);
    }
}
