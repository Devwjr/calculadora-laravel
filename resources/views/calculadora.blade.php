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
                <x-button variant="clear" action="clear">C</x-button>
                <x-button variant="back" action="backspace">⌫</x-button>
                <x-button variant="op" action="operation" value="÷">÷</x-button>
                <x-button variant="op" action="operation" value="×">×</x-button>

                <x-button variant="num" action="digit" value="1">1</x-button>
                <x-button variant="num" action="digit" value="2">2</x-button>
                <x-button variant="num" action="digit" value="3">3pode tirar a clase do models </x-button>
                <x-button variant="op" action="operation" value="-">−</x-button>


                <x-button variant="num" action="digit" value="7">7</x-button>
                <x-button variant="num" action="digit" value="8">8</x-button>
                <x-button variant="num" action="digit" value="9">9</x-button>
                <x-button variant="op" action="operation" value="-">−</x-button>

                <x-button variant="num" action="digit" value="4">4</x-button>
                <x-button variant="num" action="digit" value="5">5</x-button>
                <x-button variant="num" action="digit" value="6">6</x-button>
                <x-button variant="op" action="operation" value="+">+</x-button>

                <x-button variant="num" action="digit" value="0" wide>0</x-button>
                <x-button variant="num" action="digit" value=".">,</x-button>
                <x-button variant="eq" action="calculate">=</x-button>
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
