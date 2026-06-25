<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculadoraController extends Controller
{
    public function index()
    {
        return view('calculadora', $this->getState());
    }

    public function calcular(Request $request)
    {
        $state = $this->getState();

        $action = $request->input('action');

        match ($action) {
            'digit' => $this->digito($state, $request->input('value')),
            'operation' => $this->operacao($state, $request->input('value')),
            'calculate' => $this->calcularConta($state),
            'clear' => $this->limpar($state),
            'backspace' => $this->backspace($state),
            default => null,
        };

        session(['calculator' => $state]);

        return redirect()->route('calculadora');
    }

    private function getState(): array
    {
        return session('calculator', [
            'display' => '0',
            'num1' => '',
            'num2' => '',
            'op' => '',
            'step' => 'num1',
        ]);
    }

    private function digito(array &$state, string $d): void
    {
        if ($state['step'] === 'num1') {
            if ($d === '.') {
                if (!str_contains($state['num1'], '.'))
                    $state['num1'] .= '.';
            } else {
                $state['num1'] = ($state['num1'] === '' || $state['num1'] === '0') ? $d : $state['num1'] . $d;
            }
        } else {
            if ($d === '.') {
                if (!str_contains($state['num2'], '.'))
                    $state['num2'] .= '.';
            } else {
                $state['num2'] = ($state['num2'] === '' || $state['num2'] === '0') ? $d : $state['num2'] . $d;
            }
        }
        $this->atualizarDisplay($state);
    }

    private function operacao(array &$state, string $o): void
    {
        if ($state['num1'] === '') $state['num1'] = '0';
        $state['op'] = $o;
        $state['step'] = 'num2';
        $this->atualizarDisplay($state);
    }

    private function limpar(array &$state): void
    {
        $state['num1'] = '';
        $state['num2'] = '';
        $state['op'] = '';
        $state['step'] = 'num1';
        $state['display'] = '0';
    }

    private function backspace(array &$state): void
    {
        if ($state['step'] === 'num1' && $state['num1']) {
            $state['num1'] = substr($state['num1'], 0, -1);
        } elseif ($state['step'] === 'num2' && $state['num2']) {
            $state['num2'] = substr($state['num2'], 0, -1);
        }
        $this->atualizarDisplay($state);
    }

    private function calcularConta(array &$state): void
    {
        if ($state['num1'] === '' || $state['op'] === '' || $state['num2'] === '') return;

        $a = (float) $state['num1'];
        $b = (float) $state['num2'];

        if ($state['op'] === '÷' && $b == 0) {
            $state['display'] = 'Erro: div/0';
            $state['num1'] = '';
            $state['num2'] = '';
            $state['op'] = '';
            $state['step'] = 'num1';
            return;
        }

        $resultado = match ($state['op']) {
            '+' => $a + $b,
            '-' => $a - $b,
            '×' => $a * $b,
            '÷' => $a / $b,
            default => null,
        };

        if ($resultado === null) return;

        if (is_float($resultado) && $resultado == (int) $resultado) {
            $resultado = (int) $resultado;
        }

        $state['display'] = (string) $resultado;
        $state['num1'] = (string) $resultado;
        $state['num2'] = '';
        $state['op'] = '';
        $state['step'] = 'num1';
    }

    private function atualizarDisplay(array &$state): void
    {
        if ($state['step'] === 'num1') {
            $state['display'] = $state['num1'] ?: '0';
        } else {
            $state['display'] = ($state['num1'] ?: '0') . ' ' . $state['op'] . ($state['num2'] ? ' ' . $state['num2'] : '');
        }
    }
}
