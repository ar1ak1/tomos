<x-layouts.guest>
    <h1 class="text-xl font-semibold mb-4">Forgot password</h1>
    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf
        <input class="w-full border rounded p-2" name="email" type="email" placeholder="Email" required>
        <button class="w-full bg-black text-white rounded p-2">Send reset link</button>
    </form>
</x-layouts.guest>
