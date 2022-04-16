<div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3 form-outline">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control form-control-lg" name="username" wire:model="username"
                value="{{ old('username') }}" placeholder="john.martin" autofocus>
                @error('username')
                <small class="text-danger mt-2" >
                    {{ $message }}
                </small>
            @enderror
        </div>
        <div class="mb-3 form-outline">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control form-control-lg" name="password" wire:model="password"
                value="{{ old('password') }}" placeholder="*********" autofocus>
                @error('password')
                <small class="text-danger mt-2" >
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="mb-3 form-outline">
            <input id="remember_me" type="checkbox"
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                name="remember">
            <label for="remember_me" class="form-label">Ingat saya.</label>
        </div>

        <button class="btn btn-lg px-5 w-100 text-light " style="background-color: #333C83" type="submit">
            <b>Simpan</b></button>
    </form>
    <div>
        <p class="mb-0 mt-3">Belum punya akun.? <a href="{{ url('/register') }}"
                class="text-white-50 fw-bold">Daftar</a>
        </p>
    </div>
</div>
