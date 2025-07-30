@extends('layouts.front')
@section('title')
    @lang('site.home')

@endsection
@section('content')
    <!-----start  --->
    <div class="container-fluid pad-0 m-3">
        <h1 class="title text-center">@lang('site.my_account')
        </h1>
    </div>

    <!-----  ----->
    <div class="container ">
        <br>
        <div class="row">
            <div class="col-md-6">
                <h2> sign in</h2>
                <form class="account " style="text-transform: capitalize">
                    <div class="form-group">
                        <label for="exampleInputEmail1">user name or email *</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">password *</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1" style="padding-right: 20px"> Remember me
                        </label>
                    </div>
                    <a class="float-right active" href="" data-target="#password"  data-toggle="modal">Forgot your password?</a>
                    <br><br>
                    <button type="submit" class="btn btn-dark">sign in</button>
                </form>


            </div>
            <div class="col-md-6">
                <h2>sign up</h2>
                <form class="account " style="text-transform: capitalize">
                    <div class="form-group">
                        <label for="exampleInputEmail1">   country *</label>
                        <select  class="form-control" name="Clients[country_id]" id="Clients_country_id">
                            <option value="1">الكويت</option>
                            <option value="2">الامارات العربية المتحدة</option>
                            <option value="3">المملكة العربية السعودية</option>
                            <option value="4">قطر</option>
                            <option value="5">عمان</option>
                            <option value="6">البحرين</option>
                            <option value="7">امريكا</option>
                            <option value="8">أستراليا</option>
                            <option value="9">السويد</option>
                            <option value="10">انجلترا</option>
                            <option value="11">مصر</option>
                            <option value="12">هولندا</option>
                            <option value="13">الاردن</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">   user name *</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">  email *</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">password *</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                    </div>

                    <button type="submit" class="btn btn-dark">Sign Up</button>
                </form>


            </div>
        </div>
    </div>
    <!-----  ----->
    <!--- end  --->

@endsection
