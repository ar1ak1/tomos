<x-layouts.guest>
    <h1 class="text-xl font-semibold mb-4">Reset password</h1>
    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <input class="w-full border rounded p-2" name="email" type="email" value="{{ old('email', $request->email) }}" required>
        <input class="w-full border rounded p-2" name="password" type="password" placeholder="Password" required>
        <input class="w-full border rounded p-2" name="password_confirmation" type="password" placeholder="Confirm password" required>
        <button class="w-full bg-black text-white rounded p-2">Reset</button>
    </form>
</x-layouts.guest>
