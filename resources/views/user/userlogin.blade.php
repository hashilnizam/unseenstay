<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>login</title>
	<link rel="stylesheet" href="{{asset ('login/css/login.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
	a {
	  text-decoration: none;
	  display: inline-block;
	  padding: 8px 16px;
	}

	a:hover {
	  background-color: #ddd;
	  color: black;
	}

	.previous {
	  background-color: #f1f1f1;
	  color: black;
	}

	.next {
	  background-color: white;
	  color: white;
	}

	.round {
	  border-radius: 50%;
	}
	</style>
</head>
<body>


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif




<form class="user" method="post" action="{{ route('user_signin') }}">
    @csrf
    <div class="login-wrap">
        <div class="login-html">
            <a href="{{ route('unseen.index') }}" class="previous round">&#8249;</a>
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
            <label for="tab-1" class="tab">Sign In</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up">
            <label for="tab-2" class="tab">Sign Up</label>

            <div class="login-form">
                <div class="sign-in-htm">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input id="user" type="text" class="input" placeholder="username" name="username">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="pass" type="password" class="input" data-type="password" name="password">
                    </div>
                    <div class="group">
                        <input id="check" type="checkbox" class="check" checked>
                        <label for="check"><span class="icon"></span> Keep me Signed in</label>
                    </div>
                    <div class="group">
                        <button type="submit" class="button">Sign In</button>
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="#forgot">Forgot Password?</a>
                    </div>
                </div>
            </form>

			<form class="user" method="post" action="{{ route('user_signup') }}">
    		@csrf
                <div class="sign-up-htm">
                    @if ($errors->has('username') || $errors->has('email') || $errors->has('mobile') || $errors->has('password') || $errors->has('cpassword'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->getMessages() as $field => $messages)
                                    @foreach ($messages as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input id="user" type="text" class="input" placeholder="username" name="username">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Email Address</label>
                        <input id="pass" type="text" class="input" placeholder="email id" name="email">
                    </div>
                    <div class="group">
                        <label for="mobile" class="label">Mobile</label>
                        <input id="mobile" type="text" class="input" placeholder="mobile number" name="mobile">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="pass" type="password" class="input" data-type="password" name="password">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Repeat Password</label>
                        <input id="pass" type="password" class="input" data-type="password" name="cpassword">
                    </div>

                    <div class="group">
                       <button type="submit" class="button">Sign Up</button>
                    </div>
                </form>

</body>
</html>

