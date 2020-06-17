

<main class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-9 col-md-7 col-lg-5">
            <div class="card mt-5">
                <div class="card-body">
                    <h3 class="card-title"> Sign Up </h3>
                
                    <form  method="post" id="signup-form">
                        <div class="form-group">
                            
                            <label for="inputEmail" class="col-lg-6 control-label">Email</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
                            </div>
                            </div>
                            <div class="form-group">
                                <label for="inputUser" class="col-lg-6 control-label">Username</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputUser" name="inputUser" placeholder="Username"  autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-6 control-label">Password</label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" autocomplete="off">
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-6 control-label">Confirm Password</label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" id="inputPassword2" name="inputPassword2" placeholder="Password" autocomplete="off">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="showpassword" id="showpassword"> Show Password
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="reset" class="btn btn-default">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                            </form>
                </div>
            </div>
        </div>
    </div>
</main>

