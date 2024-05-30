<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('bootstrap-5.0.2-dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Document</title>
</head>
<body>
@if(session()->has('success'))
    <div class="alert alert-success">
        {{session()->get('success')}}
    </div>
@endif
@if(session()->has('warning'))
    <div class="alert alert-danger">
        {{session()->get('warning')}}
    </div>
@endif
@error('password')
<div class="alert alert-danger">Mật khẩu cần có ít nhất 8 kí tự</div>
@enderror
<section class="vh-100" style="background-color: #E9EDF9;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-1">
                        <div class="col-md-6 col-lg-6 d-none d-md-block">
                            <img  src="{{asset('IMG/Untitled-1 1.png')}}"
                                  alt="login form" class="p-1 pt-2 img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-6 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <form method="post" action="{{route('registerStudent')}}">
                                    @csrf
                                    <input type="hidden" name="role" value="student">
                                    <div class="form-outline  mb-4">
                                        <label class="form-label" for="form2Example37">Full Name</label>
                                        <input name="name" id="form2Example37" placeholder="Full Name" class="form-control form-control-lg" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example27">Phone Number</label>
                                        <input name="phone" id="form2Example27" placeholder="Phone Number" class="form-control form-control-lg" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example7">Address</label>
                                        <input name="address" id="form2Example7" placeholder="Address" class="form-control form-control-lg" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example1">Email address</label>
                                        <input name="email" type="email" id="form2Example1" placeholder="Email" class="form-control form-control-lg" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label"  for="form2Example27">Password</label>
                                        <input name="password" type="password" placeholder="Password" id="form2Example27" class="form-control form-control-lg" />
                                    </div>

                                    <div class="d-flex justify-content-between mt-4 mb-0">
                                        <a href="/login" class="btn btn-dark w-25 btn-lg btn-block" style="border: none; background: #000"  type="submit">Back</a>
                                        <button class="btn btn-dark w-50 btn-lg btn-block" style="border: none; background: #208CF9"  type="submit" name="register">Register</button>

                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
