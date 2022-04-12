<div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3 form-outline">
            <label for="nama" class="form-label">Nama</label>
            <input type="text"
                class="form-control form-control-lg @if ($errors->has('nama')) is-invalid @elseif ($nama == null)  @else is-valid @endif"
                name="nama" wire:model="nama" value="{{ old('nama') }}" placeholder="John Martin" autofocus>
            @error('nama')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror

        </div>
        <div class="mb-3 form-outline">
            <label for="username" class="form-label">Username</label>
            <input type="text"
                class="form-control form-control-lg @if ($errors->has('username')) is-invalid @elseif ($username == null)  @else is-valid @endif"
                name="username" wire:model="username" value="{{ old('username') }}" placeholder="john.martin"
                autofocus>

            @error('username')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror

        </div>
        <div class="mb-3 form-outline">
            <label for="password" class="form-label">Password</label>
            <input type="password"
                class="form-control form-control-lg @if ($errors->has('password')) is-invalid @elseif ($password == null)  @else is-valid @endif"
                name="password" wire:model="password" value="{{ old('password') }}" placeholder="*********" autofocus>
            @error('password')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
        </div>
        <div class="mb-3 form-outline">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password"
                class="form-control form-control-lg @if ($errors->has('password_confirmation')) is-invalid @elseif ($password_confirmation == null)  @else is-valid @endif"
                name="password_confirmation" wire:model="password_confirmation"
                value="{{ old('password_confirmation') }}" placeholder="*********" autofocus>
            @error('password_confirmation')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
        </div>


        <button class="btn btn-lg px-5 w-100 text-light " style="background-color: #333C83" type="submit">
            <b>Simpan</b></button>
    </form>
    <div>
        <p class="mb-0 mt-3">Sudah punya akun.? <a href="{{ url('/login') }}" class="text-white-50 fw-bold">Login</a>
        </p>
    </div>
</div>
