  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link @if(Request::route()->getName() != 'author.dashboard')) collapsed  @endif" href="../../access">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link @if (Request::route()->getName() != 'author.category' && Request::route()->getName() != 'author.newcategory') collapsed @endif" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Categories</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content @if (Request::route()->getName() != 'author.category' && Request::route()->getName() != 'author.newcategory') collapse @endif" data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(Request::route()->getName() == 'author.category') active  @endif" href="{{ route('author.category') }}">
              <i class="bi bi-circle"></i><span>Categories</span>
            </a>
          </li>
          <li>
            <a class="@if(Request::route()->getName() == 'author.newcategory') active  @endif" href="{{ route('author.newcategory') }}">
            <i class="bi bi-circle"></i><span>Add category</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link @if (Request::route()->getName() != 'author.post' && Request::route()->getName() != 'author.newpost') collapsed @endif" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Posts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content @if (Request::route()->getName() != 'author.post' && Request::route()->getName() != 'author.newpost') collapse @endif" data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(Request::route()->getName() == 'author.post') active  @endif" href="{{ route(author.post) }}">
              <i class="bi bi-circle"></i><span>Posts</span>
            </a>
          </li>
          <li>
            <a class="@if(Request::route()->getName() == 'author.newpost') active  @endif" href="{{ route('author.newpost') }}">
              <i class="bi bi-circle"></i><span>Add Post</span>
            </a>
          </li>

        </ul>
      </li><!-- End Forms Nav -->





      <li class="nav-item">
        <a class="nav-link collapsed" href="../user/profile">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->


      <li class="nav-item">
        <a class="nav-link @if(Request::route()->getName() != 'author.faq') collapsed  @endif" href="{{ route('author.faq') }}">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link @if(Request::route()->getName() != 'author.contact') collapsed  @endif" href="{{ route('author.contact') }}">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->
