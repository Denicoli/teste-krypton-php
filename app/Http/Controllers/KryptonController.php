<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TratamentoDados\Krypton;

class KryptonController extends Controller {
    public function atividadesPaginadas(Request $request) {
        $dadosRetorno = (new Krypton())->trataDadosAtividades($request);
        return response()->json($dadosRetorno);
    }

    public function getDadosApi() {
        $dadosRetornados = (new Krypton())->buscaDadosApiKrypton();
        return view('dados_krypton', $dadosRetornados);
    }
}