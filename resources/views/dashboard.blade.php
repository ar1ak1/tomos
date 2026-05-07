<!doctype html><html><head>@vite(['resources/css/app.css', 'resources/js/app.js'])</head>
<body class="p-8"><h1 class="text-2xl">Dashboard</h1>
<form method="POST" action="{{ route('logout') }}">@csrf <button class="mt-4 bg-black text-white px-4 py-2 rounded">Logout</button></form>
</body></html>
