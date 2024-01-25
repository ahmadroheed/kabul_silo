<!DOCTYPE html>
<html lang="en">
<head> 
  <title>@lang('labels.company')</title>
  @include('includes/head')
</head>
<body> 
  @include('includes.header') 
  
 <div class="container" style="height: 500px;">
  <div class="row">
    <div class="col"></div>
    <div class="col" style="background-color: #eee;margin-top:160px;padding: 20px;border-radius:15px;">
        <form method="POST" action="{{ route('authenticate') }}">
            @csrf
			  <div class="form-group">
			    <label for="exampleInputEmail1" style="color: black;">Email:</label>
			    <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="email" aria-describedby="emailHelp"  value="{{ old('email') }}" required autofocus name="email">
			     @error('email')
			    	<small id="emailHelp" class="form-text text-muted" style="color: red !important;">{{ $message }}</small>
					 @enderror
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1" style="color: black;margin-top: 10px;">Password:</label>
			    <input type="password" class="form-control @error('password') is-invalid @enderror" required placeholder="password" id="exampleInputPassword1" name="password">
			     @error('password')
			    	<small id="emailHelp" class="form-text text-muted" style="color: red !important;">{{ $message }}</small>
           @enderror
			  </div>
			  <div class="form-check" style="margin:10px 0;">
			    <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1" {{ old('remember') ? 'checked' : '' }}>
			    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
			  </div>
			  <button type="submit" class="btn btn-success" style="font-size: 
			  16px;margin-left: 130px;">Login</button>
			</form>
    </div>
    <div class="col"></div>
  </div>
</div>


 @include('includes.footer')
 @include('includes.script')
</body>
</html>