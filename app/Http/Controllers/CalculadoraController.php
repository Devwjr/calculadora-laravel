<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculadoraController extends Controller
{
    public function index()
    {
        return view('calculadora');
    }

    public function calcular(Request $request)
    {
        $num1 = $request->input('num1');
        $num2 = $request->input('num2');
        $operacao = $request->input('operacao');

        if (!is_numeric($num1) || !is_numeric($num2)) {
            return response()->json(['erro' => 'Número inválido']);
        }

        $a = (float) $num1;
        $b = (float) $num2;

        if ($operacao === '÷' && $b == 0) {
            return response()->json(['erro' => 'Divisão por 0']);
        }

        $resultado = match ($operacao) {
            '+' => $a + $b,
            '-' => $a - $b,
            '×' => $a * $b,
            '÷' => $a / $b,
            default => null,
        };

        if ($resultado === null) {
            return response()->json(['erro' => 'Operação inválida']);
        }

        if (is_float($resultado) && $resultado == (int) $resultado) {
            $resultado = (int) $resultado;
        }

        return response()->json(['resultado' => $resultado]);
    }
}
