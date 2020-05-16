<footer class="container-fluid home-newsletter">
    <div class="container">
       <div class="row">
        
            <div class="col-sm-12">
                <div class="single">
                    <h2>Subscribe to our Newsletter</h2>
                <div class="input-group">
                     <input type="email" class="form-control" placeholder="Enter your email">
                     <span class="input-group-btn">
                     <button class="btn btn-theme" type="submit">Subscribe</button>
                     </span>
                      </div>
                </div>
            </div>

       </div>
    </div>
</footer>
<div class="footer text-center">
    <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://codingscript.in" target="_blank">Coding Script</a></p>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{ asset('user/main.js') }}"></script>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('js')

@section('footer')
    @show
