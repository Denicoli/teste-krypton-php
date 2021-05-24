<?php

namespace App\TratamentoDados;

use Illuminate\Support\Facades\Http;

class Krypton {
    private $pagina;
    private $quantidadeItems;
    private $pathArquivo;
    private $totalItems;
    private $start;
    private $resultados;
    private $dadosRetorno;

    public function buscaDadosApiKrypton() {
        $response = Http::get('http://apiintranet.kryptonbpo.com.br/test-dev/exercise-1');
        return $this->trataDadosApiKrypton($response);
    }

    private function trataDadosApiKrypton($response) {
        $dadosRetorno = json_decode($response->body());
        $motores = collect($dadosRetorno->motores);
        $carros = collect($dadosRetorno->carros);

        $carros->each(function($carro) use ($motores){
            $motor = $motores->where('id', '=', $carro->motor_id)->first();
            if ($motor)
            {
                $carro->posicionamento_cilindros = "Posicionamento cilindros: " . $motor->posicionamento_cilindros;
                $carro->cilindros = "quantidade cilindros: " . $motor->cilindros;
                $carro->litragem = "litragem: " . $motor->litragem;
                $carro->observacao = "observação: " . ($motor->observacao ? $motor->observacao : "-");
                $carro->motor = $carro->posicionamento_cilindros . ", " . $carro->cilindros . ", " . $carro->litragem . ", " . $carro->observacao;
            }
        });

        $arrayRetorno = [
            "motores" => $motores->toArray(),
            "carros" => $carros->toArray(),
            "totalCarros" => count($carros->toArray()),
        ];

        return $arrayRetorno;
    }

    public function trataDadosAtividades($request) {
        $this->getPagina($request)
             ->definirConstantes()
             ->definirArrayResultados()
             ->definirArrayRetorno()
             ;

        return $this->dadosRetorno;
    }

    private function definirArrayRetorno() {
        $this->dadosRetorno = new \stdClass();
        $this->dadosRetorno->total        = $this->totalItems;
        $this->dadosRetorno->per_page     = $this->quantidadeItems;
        $this->dadosRetorno->current_page = $this->pagina;
        $this->dadosRetorno->from         = $this->start;
        $this->dadosRetorno->to           = $this->start + 5;
        $this->dadosRetorno->last_page    = ceil($this->totalItems / 5);
        $this->dadosRetorno->data         = $this->resultados;
        return $this;
    }

    private function definirArrayResultados() {
        $json = json_decode(file_get_contents($this->pathArquivo), true);

        $keys = array_column($json, 'hora');
        array_multisort($keys, SORT_ASC, $json);

        $this->resultados = array_slice($json, $this->start, 5);
        $this->totalItems = count($json);
        return $this;
    }

    private function definirConstantes() {
        $this->quantidadeItems = 5;
        $this->pathArquivo = storage_path() . "/app/public/json/atividades.json";
        $this->start = $this->quantidadeItems * ($this->pagina - 1);
        return $this;
    }

    private function getPagina($request) {
        $this->pagina = $request->has("pagina") ? $request->get("pagina") : 1;
        return $this;
    }
}