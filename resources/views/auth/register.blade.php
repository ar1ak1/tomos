<x-layouts.guest>
    <h1 class="text-xl font-semibold mb-4">Register</h1>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <input class="w-full border rounded p-2" name="name" placeholder="Name" required>
        <input class="w-full border rounded p-2" name="email" type="email" placeholder="Email" required>
        <input class="w-full border rounded p-2" name="password" type="password" placeholder="Password" required>
        <input class="w-full border rounded p-2" name="password_confirmation" type="password" placeholder="Confirm password" required>
        <button class="w-full bg-black text-white rounded p-2">Create account</button>
    </form>
</x-layouts.guest>
