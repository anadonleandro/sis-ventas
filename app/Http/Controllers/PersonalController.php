<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use DB;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function consulta(Request $request )
    {
        switch($request->input('valor')){
 
        case 1:
            //numero de Expediente
            $personal=DB::table('personal')
            ->select('apeynom_personal','dni_personal','grado_personal','cpoesc_personal',
                'ud_personal','subud_personal','sitrev_personal','estado_sitrev_personal')
            ->where('ni_personal', 'like', ''. $request->input('dato').'%')
            ->get();

            $a=(count($personal));
            if ($a > 0) {
                return view("resultado",["personal"=>$personal]);
            }else {
                return view("datospersonal");
            }     
            break;
        }
    }
