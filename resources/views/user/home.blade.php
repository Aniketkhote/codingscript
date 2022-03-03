@extends('user/layouts/app')

@section('content')

<div class="banner col-md-12">
    <div class="container">
        <div class="row">
            <div class="text my-auto pt-5 col-md-6">
                <h1>Learn Together, Grow Together</h1>
                <p>Your world of web development starts here. Learn with a most innovative way to enhance your knowledge
                    and show it to the world, what is your real potential.</p>
                <a class="btn btn-outline-light pr-3 pl-3" href="/course">View Courses</a>
            </div>

            <img src="{{ asset('user/img/code.svg') }}" alt="course" class="img col-md-6">
        </div>
    </div>
</div>

<div class="discussion col-md-12">
  <div class="container">
      <div class="row">
        <img src="{{ asset('user/img/discussion.svg') }}" alt="discussion" class="img mt-5 col-md-6">

          <div class="text my-auto text-center col-md-6">
              <h1>Join The Discussions</h1>
              <p>Asking question is the key to a productive learning. Best way to learn is to help others. Reply to the questions asked and get marks to help others.</p>
              <a class="btn btn-outline-dark pr-3 pl-3" href="{{ route('chatter.home') }}">Join Forum</a>
          </div>
      </div>
  </div>
</div>

<div class="blog col-md-12">
  <div class="container">
      <div class="row">
          <div class="text my-auto text-center col-md-6">
              <h1>Read Latest Blogs Posts</h1>
              <p>Blogging is a communications mechanism handed to us by the long tail of the Internet.</p>
              <a class="btn btn-outline-light pr-3 pl-3" href="/blog">Read Now</a>
            </div>

          <img src="{{ asset('user/img/blog.svg') }}" alt="blog" class="img mt-5 col-md-6">
      </div>
  </div>
</div>

<div class="empty"></div>

@endsection
