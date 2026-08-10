<form method="POST" action="{{ url('/register') }}">
    @csrf

    <input type="text" name="name" placeholder="Nama" value="{{ old('name') }}">
    @error('name') <p>{{ $message }}</p> @enderror

    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
    @error('email') <p>{{ $message }}</p> @enderror

    <input type="password" name="password" placeholder="Password">
    @error('password') <p>{{ $message }}</p> @enderror

    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password">

    <button type="submit">Daftar</button>
</form>
