@component('Auth::layout')
    <div class="container">
        <form action="{{ route('auth.login.store') }}" method="POST" style="width: 300px; margin: 0 auto;">
            @csrf
            <h2 class="text-center">Login</h2>

            <div class="form-group @error('email') has-error @enderror">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required
                    autofocus>
                @error('email')
                    <span class="help-block">{{ $message }}</span>
                @enderror
            </div>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
            </div>

            <button class="btn btn-md btn-primary btn-block" type="submit">Login</button>
            <a href="{{ route('auth.register.show') }}" class="btn btn-md btn-default btn-block">Register</a>
        </form>
    </div>
@endcomponent
