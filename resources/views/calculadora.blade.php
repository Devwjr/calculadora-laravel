<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: linear-gradient(145deg, #2c3e50 0%, #1a252f 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        .calc {
            background: #d4c9b8;
            padding: 28px 24px 32px;
            border-radius: 24px;
            box-shadow:
                0 20px 40px rgba(0,0,0,.5),
                inset 0 1px 3px rgba(255,255,240,.3);
            width: 320px;
            border-bottom: 4px solid #b8a88e;
        }

        .calc .brand {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            padding: 0 4px 12px;
            font-family: 'Courier New', monospace;
            color: #5a4e3c;
            letter-spacing: 1px;
        }

        .calc .brand strong { font-size: 1.1rem; font-weight: 700; }
        .calc .brand small { font-size: .7rem; opacity: .7; }

        .calc #display {
            background: #b3c4a3;
            padding: 16px 14px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-family: 'VT323', 'Courier New', monospace;
            font-size: 2.6rem;
            text-align: right;
            color: #2d3a28;
            min-height: 76px;
            word-break: break-all;
            box-shadow: inset 0 3px 6px rgba(0,0,0,.25), inset 0 -1px 2px rgba(255,255,200,.3);
            line-height: 1.1;
            letter-spacing: 1px;
            text-shadow: 0 0 2px rgba(45,58,40,.15);
            border: 2px solid #9aab8a;
        }

        .calc .grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; }
        .calc .grid .span2 { grid-column: span 2; }

        .calc button {
            padding: 14px 0;
            font-size: 1.3rem;
            font-family: 'Segoe UI', system-ui, sans-serif;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            color: #fff;
            box-shadow: 0 4px 0 rgba(0,0,0,.2), 0 2px 6px rgba(0,0,0,.15);
            transition: all 60ms ease;
            letter-spacing: .5px;
        }

        .calc button:active {
            transform: translateY(3px);
            box-shadow: 0 1px 0 rgba(0,0,0,.2);
        }

        .calc .num { background: #3a4a5a; color: #f0f0f0; font-size: 1.4rem; }
        .calc .num:active { background: #2d3a47; }
        .calc .op { background: #c98a4a; font-size: 1.5rem; }
        .calc .op:active { background: #b07538; }
        .calc .eq { background: #5d8f5d; font-size: 1.6rem; }
        .calc .eq:active { background: #4a754a; }
        .calc .clear { background: #b55a4a; }
        .calc .clear:active { background: #96483a; }
        .calc .back { background: #7a8a8a; font-size: 1.2rem; }
        .calc .back:active { background: #5f6d6d; }

        @import url('https://fonts.googleapis.com/css2?family=VT323&display=swap');
    </style>
</head>
<body>

    <div class="calc" id="app">
        <div class="brand">
            <strong>CALCULADORA</strong>
            <small></small>
        </div>

        <div id="display">0</div>

        <div class="grid">
            <button class="clear" onclick="limpar()">C</button>
            <button class="back" onclick="backspace()">⌫</button>
            <button class="op" onclick="operacao('÷')">÷</button>
            <button class="op" onclick="operacao('×')">×</button>

            <button class="num" onclick="digito('7')">7</button>
            <button class="num" onclick="digito('8')">8</button>
            <button class="num" onclick="digito('9')">9</button>
            <button class="op" onclick="operacao('-')">−</button>

            <button class="num" onclick="digito('4')">4</button>
            <button class="num" onclick="digito('5')">5</button>
            <button class="num" onclick="digito('6')">6</button>
            <button class="op" onclick="operacao('+')">+</button>

            <button class="num span2" onclick="digito('0')">0</button>
            <button class="num" onclick="digito('.')">,</button>
            <button class="eq" onclick="calcular()">=</button>
        </div>
    </div>

    <script>
        let num1 = '', num2 = '', op = '', etapa = 'num1';
        const display = document.getElementById('display');

        function atualizarDisplay() {
            if (etapa === 'num1') {
                display.textContent = num1 || '0';
            } else {
                display.textContent = (num1 || '0') + ' ' + op + (num2 ? ' ' + num2 : '');
            }
        }

        function digito(d) {
            if (etapa === 'num1') {
                if (d === '.') {
                    if (!num1.includes('.')) num1 += '.';
                } else {
                    num1 = (num1 === '' || num1 === '0') ? d : num1 + d;
                }
            } else {
                if (d === '.') {
                    if (!num2.includes('.')) num2 += '.';
                } else {
                    num2 = (num2 === '' || num2 === '0') ? d : num2 + d;
                }
            }
            atualizarDisplay();
        }

        function operacao(o) {
            if (num1 === '') num1 = '0';
            op = o;
            etapa = 'num2';
            atualizarDisplay();
        }

        function limpar() {
            num1 = ''; num2 = ''; op = ''; etapa = 'num1';
            atualizarDisplay();
        }

        function backspace() {
            if (etapa === 'num1' && num1) {
                num1 = num1.slice(0, -1);
            } else if (etapa === 'num2' && num2) {
                num2 = num2.slice(0, -1);
            }
            atualizarDisplay();
        }

        async function calcular() {
            if (num1 === '' || op === '' || num2 === '') return;

            const form = new FormData();
            form.append('_token', '{{ csrf_token() }}');
            form.append('num1', num1);
            form.append('num2', num2);
            form.append('operacao', op);

            const res = await fetch('{{ route('calcular') }}', {
                method: 'POST',
                body: form
            });

            const data = await res.json();

            if (data.erro) {
                display.textContent = data.erro;
                num1 = ''; num2 = ''; op = ''; etapa = 'num1';
                return;
            }

            if (data.resultado != undefined) {
                num1 = String(data.resultado);
                num2 = ''; op = ''; etapa = 'num1';
                display.textContent = num1;
            }
        }
    </script>

</body>
</html>
