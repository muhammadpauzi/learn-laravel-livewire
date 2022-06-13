<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles
    @livewireScripts

    <title>Learn Laravel Livewire</title>
</head>

<body>

    <div class="max-w-4xl mx-auto py-10">
        @yield('content')
    </div>
</body>

</html>