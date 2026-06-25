<?php

namespace App\Services;

class CalculadoraService
{
    public string $display = '0';
    public string $num1 = '';
    public string $num2 = '';
    public string $op = '';
    public string $step = 'num1';

    public function __construct(?array $state = null)
    {
        if ($state) {
            $this->display = $state['display'] ?? '0';
            $this->num1 = $state['num1'] ?? '';
            $this->num2 = $state['num2'] ?? '';
            $this->op = $state['op'] ?? '';
            $this->step = $state['step'] ?? 'num1';
        }
    }

    public function toArray(): array
    {
        return [
            'display' => $this->display,
            'num1' => $this->num1,
            'num2' => $this->num2,
            'op' => $this->op,
            'step' => $this->step,
        ];
    }

    public static function fromSession(): self
    {
        return new self(session('calculator'));
    }

    public function digito(string $d): void
    {
        if ($this->step === 'num1') {
            if ($d === '.') {
                if (!str_contains($this->num1, '.'))
                    $this->num1 .= '.';
            } else {
                $this->num1 = ($this->num1 === '' || $this->num1 === '0') ? $d : $this->num1 . $d;
            }
        } else {
            if ($d === '.') {
                if (!str_contains($this->num2, '.'))
                    $this->num2 .= '.';
            } else {
                $this->num2 = ($this->num2 === '' || $this->num2 === '0') ? $d : $this->num2 . $d;
            }
        }
        $this->atualizarDisplay();
    }

    public function operacao(string $o): void
    {
        if ($this->num1 === '') $this->num1 = '0';
        $this->op = $o;
        $this->step = 'num2';
        $this->atualizarDisplay();
    }

    public function limpar(): void
    {
        $this->num1 = '';
        $this->num2 = '';
        $this->op = '';
        $this->step = 'num1';
        $this->display = '0';
    }

    public function backspace(): void
    {
        if ($this->step === 'num1' && $this->num1) {
            $this->num1 = substr($this->num1, 0, -1);
        } elseif ($this->step === 'num2' && $this->num2) {
            $this->num2 = substr($this->num2, 0, -1);
        }
        $this->atualizarDisplay();
    }

    public function calcularConta(): void
    {
        if ($this->num1 === '' || $this->op === '' || $this->num2 === '') return;

        $a = (float) $this->num1;
        $b = (float) $this->num2;

        if ($this->op === '÷' && $b == 0) {
            $this->display = 'Erro: div/0';
            $this->num1 = '';
            $this->num2 = '';
            $this->op = '';
            $this->step = 'num1';
            return;
        }

        $resultado = match ($this->op) {
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

        $this->display = (string) $resultado;
        $this->num1 = (string) $resultado;
        $this->num2 = '';
        $this->op = '';
        $this->step = 'num1';
    }

    private function atualizarDisplay(): void
    {
        if ($this->step === 'num1') {
            $this->display = $this->num1 ?: '0';
        } else {
            $this->display = ($this->num1 ?: '0') . ' ' . $this->op . ($this->num2 ? ' ' . $this->num2 : '');
        }
    }
}
