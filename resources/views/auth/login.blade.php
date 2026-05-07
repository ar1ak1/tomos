<x-layouts.guest>
    <h1 class="text-xl font-semibold mb-4">Login</h1>
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <input class="w-full border rounded p-2" name="email" type="email" placeholder="Email" required autofocus>
        <input class="w-full border rounded p-2" name="password" type="password" placeholder="Password" required>
        <button class="w-full bg-black text-white rounded p-2">Login</button>
    </form>
</x-layouts.guest>
