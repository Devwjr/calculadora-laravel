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

    <div class="calc">
        <div class="brand">
            <strong>CALCULADORA</strong>
            <small></small>
        </div>

        <div id="display">{{ $display }}</div>

        <form method="POST" action="{{ route('calcular') }}">
            @csrf
            <input type="hidden" name="action" id="action" value="">
            <input type="hidden" name="value" id="value" value="">

            <div class="grid">
                <button type="submit" class="clear" onclick="setAction('clear')">C</button>
                <button type="submit" class="back" onclick="setAction('backspace')">⌫</button>
                <button type="submit" class="op" onclick="setAction('operation', '÷')">÷</button>
                <button type="submit" class="op" onclick="setAction('operation', '×')">×</button>

                <button type="submit" class="num" onclick="setAction('digit', '7')">7</button>
                <button type="submit" class="num" onclick="setAction('digit', '8')">8</button>
                <button type="submit" class="num" onclick="setAction('digit', '9')">9</button>
                <button type="submit" class="op" onclick="setAction('operation', '-')">−</button>

                <button type="submit" class="num" onclick="setAction('digit', '4')">4</button>
                <button type="submit" class="num" onclick="setAction('digit', '5')">5</button>
                <button type="submit" class="num" onclick="setAction('digit', '6')">6</button>
                <button type="submit" class="op" onclick="setAction('operation', '+')">+</button>

                <button type="submit" class="num span2" onclick="setAction('digit', '0')">0</button>
                <button type="submit" class="num" onclick="setAction('digit', '.')">,</button>
                <button type="submit" class="eq" onclick="setAction('calculate')">=</button>
            </div>
        </form>
    </div>

    <script>
        function setAction(action, value) {
            document.getElementById('action').value = action;
            document.getElementById('value').value = value || '';
        }
    </script>

</body>
</html>
