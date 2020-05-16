      <div class="navigation-wrap bg-light start-header start-style">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <nav class="navbar navbar-expand-md navbar-light">

                          <a class="navbar-brand" href="{{ url('/') }}"><img
                                  src="{{ asset('user/img/logo.png') }}" alt="Coding Script"></a>

                          <button class="navbar-toggler" type="button" data-toggle="collapse"
                              data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                              aria-expanded="false" aria-label="Toggle navigation">
                              <span class="navbar-toggler-icon"></span>
                          </button>

                          <div class="collapse navbar-collapse" id="navbarSupportedContent">
                              <ul class="navbar-nav py-4 py-md-0">
                                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 {{ Request::path() == '/' ? 'active' : '' }}">
                                      <a class="nav-link" href="{{ url('/') }}">Home</a>
                                  </li>
                                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 {{ Request::path() == 'blog' ? 'active' : '' }}">
                                      <a class="nav-link" href="/blog">Blog</a>
                                  </li>
                                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 {{ Request::path() == 'course' ? 'active' : '' }}">
                                      <a class="nav-link" href="/course">Course</a>
                                  </li>
                                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 {{ Request::path() == 'forums' ? 'active' : '' }}">
                                      <a class="nav-link"
                                          href="{{ route('chatter.home') }}">Discussion</a>
                                  </li>
                              </ul>

                              <ul class="navbar-nav ml-auto py-4 py-md-0">
                                  @guest
                                      <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                          <a class="nav-link" href="{{ route('login') }}">Login</a>
                                      </li>
                                  @else
                                      <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                                              role="button" aria-haspopup="true" aria-expanded="false">
                                              {{ Auth::user()->name }} <span class="caret"></span>
                                          </a>
                                          <div class="dropdown-menu">
                                              <a class="dropdown-item" href="{{ route('logout') }}"
                                                  onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                                  Logout
                                              </a>
                                              <form id="logout-form" action="{{ route('logout') }}"
                                                  method="POST" style="display: none;">
                                                  @csrf
                                              </form>
                                          </div>
                                      </li>
                                  @endif
                              </ul>
                          </div>
                      </nav>
                  </div>
              </div>
          </div>
      </div>
