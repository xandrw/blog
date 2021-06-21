@component('Auth::layout')
    <div class="container">
        <form action="{{ route('auth.register.store') }}" method="POST" style="width: 400px; margin: 0 auto;">
            @csrf
            <h2 class="text-center">Register</h2>

            <div class="form-group @error('name') has-error @enderror">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" required
                    autofocus>
                @error('name')
                <span class="help-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group @error('email') has-error @enderror">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required autofocus>
                @error('email')
                <span class="help-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Password confirmation</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>


            <button class="btn btn-md btn-primary btn-block" type="submit">Register</button>
            <a href="{{ route('auth.login.show') }}" class="btn btn-md btn-default btn-block">Login</a>
        </form>
    </div>
@endcomponent
