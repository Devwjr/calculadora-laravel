<?php

namespace App\Http\Controllers;

use App\Models\CalculadoraModel;
use Illuminate\Http\Request;

class CalculadoraController extends Controller
{
    public function index()
    {
        $calc = CalculadoraModel::fromSession();
        return view('calculadora', $calc->toArray());
    }

    public function calcular(Request $request)
    {
        $calc = CalculadoraModel::fromSession();

        match ($request->input('action')) {
            'digit' => $calc->digito($request->input('value')),
            'operation' => $calc->operacao($request->input('value')),
            'calculate' => $calc->calcularConta(),
            'clear' => $calc->limpar(),
            'backspace' => $calc->backspace(),
            default => null,
        };

        session(['calculator' => $calc->toArray()]);

        return redirect()->route('calculadora');
    }
}
