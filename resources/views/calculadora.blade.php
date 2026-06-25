<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-black min-h-screen flex items-center justify-center font-sans">

    <div class="bg-white w-[320px] rounded-2xl p-6 shadow-[0_20px_60px_rgba(255,255,255,0.15)]">

        <div class="flex justify-between items-baseline px-1 pb-3">
            <span class="font-bold tracking-widest text-sm text-black">CALCULADORA</span>
            <span class="text-[10px] tracking-wider text-black/50"></span>
        </div>

        <div id="display" class="bg-black/5 text-black px-3 py-4 rounded-lg mb-4 text-right text-4xl min-h-[72px] break-all leading-tight tracking-wider font-mono">
            {{ $display }}
        </div>

        <form method="POST" action="{{ route('calcular') }}">
            @csrf
            <input type="hidden" name="action" id="action" value="">
            <input type="hidden" name="value" id="value" value="">

            <div class="grid grid-cols-4 gap-2">
                <button type="submit" class="clear col-span-1 bg-black text-white py-3.5 rounded-lg text-lg font-semibold cursor-pointer shadow-[0_3px_0_rgba(0,0,0,0.3)] active:translate-y-[2px] active:shadow-[0_1px_0_rgba(0,0,0,0.3)] transition-all duration-75" onclick="setAction('clear')">C</button>
                <button type="submit" class="back col-span-1 bg-neutral-700 text-white py-3.5 rounded-lg text-base font-semibold cursor-pointer shadow-[0_3px_0_rgba(0,0,0,0.3)] active:translate-y-[2px] active:shadow-[0_1px_0_rgba(0,0,0,0.3)] transition-all duration-75" onclick="setAction('backspace')">⌫</button>
                <button type="submit" class="op col-span-1 bg-black text-white py-3.5 rounded-lg text-xl font-semibold cursor-pointer shadow-[0_3px_0_rgba(0,0,0,0.3)] active:translate-y-[2px] active:shadow-[0_1px_0_rgba(0,0,0,0.3)] transition-all duration-75" onclick="setAction('operation', '÷')">÷</button>
                <button type="submit" class="op col-span-1 bg-black text-white py-3.5 rounded-lg text-xl font-semibold cursor-pointer shadow-[0_3px_0_rgba(0,0,0,0.3)] active:translate-y-[2px] active:shadow-[0_1px_0_rgba(0,0,0,0.3)] transition-all duration-75" onclick="setAction('operation', '×')">×</button>

                <button type="submit" class="num col-span-1 bg-white text-black py-3.5 rounded-lg text-xl font-semibold cursor-pointer shadow-[0_3px_0_rgba(0,0,0,0.15)] border border-black/20 active:translate-y-[2px] active:shadow-[0_1px_0_rgba(0,0,0,0.15)] transition-all duration-75" onclick="setAction('digit', '7')">7</button>
                <button type="submit" class="num col-span-1 bg-white text-black py-3.5 rounded-lg text-xl font-semibold cursor-pointer shadow-[0_3px_0_rgba(0,0,0,0.15)] border border-black/20 active:translate-y-[2px] active:shadow-[0_1px_0_rgba(0,0,0,0.15)] transition-all duration-75" onclick="setAction('digit', '8')">8</button>
                <button type="submit" class="num col-span-1 bg-white text-black py-3.5 rounded-lg text-xl font-semibold cursor-pointer shadow-[0_3px_0_rgba(0,0,0,0.15)] border border-black/20 active:translate-y-[2px] active:shadow-[0_1px_0_rgba(0,0,0,0.15)] transition-all duration-75" onclick="setAction('digit', '9')">9</button>
                <button type="submit" class="op col-span-1 bg-black text-white py-3.5 rounded-lg text-xl font-semibold cursor-pointer shadow-[0_3px_0_rgba(0,0,0,0.3)] active:translate-y-[2px] active:shadow-[0_1px_0_rgba(0,0,0,0.3)] transition-all duration-75" onclick="setAction('operation', '-')">−</button>

                <button type="submit" class="num col-span-1 bg-white text-black py-3.5 rounded-lg text-xl font-semibold cursor-pointer shadow-[0_3px_0_rgba(0,0,0,0.15)] border border-black/20 active:translate-y-[2px] active:shadow-[0_1px_0_rgba(0,0,0,0.15)] transition-all duration-75" onclick="setAction('digit', '4')">4</button>
                <button type="submit" class="num col-span-1 bg-white text-black py-3.5 rounded-lg text-xl font-semibold cursor-pointer shadow-[0_3px_0_rgba(0,0,0,0.15)] border border-black/20 active:translate-y-[2px] active:shadow-[0_1px_0_rgba(0,0,0,0.15)] transition-all duration-75" onclick="setAction('digit', '5')">5</button>
                <button type="submit" class="num col-span-1 bg-white text-black py-3.5 rounded-lg text-xl font-semibold cursor-pointer shadow-[0_3px_0_rgba(0,0,0,0.15)] border border-black/20 active:translate-y-[2px] active:shadow-[0_1px_0_rgba(0,0,0,0.15)] transition-all duration-75" onclick="setAction('digit', '6')">6</button>
                <button type="submit" class="op col-span-1 bg-black text-white py-3.5 rounded-lg text-xl font-semibold cursor-pointer shadow-[0_3px_0_rgba(0,0,0,0.3)] active:translate-y-[2px] active:shadow-[0_1px_0_rgba(0,0,0,0.3)] transition-all duration-75" onclick="setAction('operation', '+')">+</button>

                <button type="submit" class="num col-span-2 bg-white text-black py-3.5 rounded-lg text-xl font-semibold cursor-pointer shadow-[0_3px_0_rgba(0,0,0,0.15)] border border-black/20 active:translate-y-[2px] active:shadow-[0_1px_0_rgba(0,0,0,0.15)] transition-all duration-75" onclick="setAction('digit', '0')">0</button>
                <button type="submit" class="num col-span-1 bg-white text-black py-3.5 rounded-lg text-xl font-semibold cursor-pointer shadow-[0_3px_0_rgba(0,0,0,0.15)] border border-black/20 active:translate-y-[2px] active:shadow-[0_1px_0_rgba(0,0,0,0.15)] transition-all duration-75" onclick="setAction('digit', '.')">,</button>
                <button type="submit" class="eq col-span-1 bg-black text-white py-3.5 rounded-lg text-2xl font-bold cursor-pointer shadow-[0_3px_0_rgba(0,0,0,0.3)] active:translate-y-[2px] active:shadow-[0_1px_0_rgba(0,0,0,0.3)] transition-all duration-75" onclick="setAction('calculate')">=</button>
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
