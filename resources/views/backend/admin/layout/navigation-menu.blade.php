  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link @if(Request::route()->getName() != 'admin.dashboard')) collapsed  @endif" href="../../access">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link @if (Request::route()->getName() != 'admin.category' && Request::route()->getName() != 'admin.newcategory') collapsed @endif" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Categories</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content @if (Request::route()->getName() != 'admin.category' && Request::route()->getName() != 'admin.newcategory') collapse @endif" data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(Request::route()->getName() == 'admin.category')) active  @endif" href="../../admin/categories">
              <i class="bi bi-circle"></i><span>Categories</span>
            </a>
          </li>
          <li>
            <a class="@if(Request::route()->getName() == 'admin.newcategory')) active  @endif" href="../../admin/add-category">
            <i class="bi bi-circle"></i><span>Add category</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link @if (Request::route()->getName() != 'admin.posts' && Request::route()->getName() != 'admin.newpost') collapsed @endif" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Posts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content @if (Request::route()->getName() != 'admin.posts' && Request::route()->getName() != 'admin.newpost') collapse @endif" data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(Request::route()->getName() == 'admin.posts')) active  @endif" href="../../admin/posts">
              <i class="bi bi-circle"></i><span>Posts</span>
            </a>
          </li>
          <li>
            <a class="@if(Request::route()->getName() == 'admin.newpost')) active  @endif" href="../../admin/add-post">
              <i class="bi bi-circle"></i><span>Add Post</span>
            </a>
          </li>

        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link @if (Request::route()->getName() != 'admin.users' && Request::route()->getName() != 'admin.newuser') collapsed @endif" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="users-nav" class="nav-content @if (Request::route()->getName() != 'admin.users' && Request::route()->getName() != 'admin.newuser') collapse @endif" data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(Request::route()->getName() == 'admin.users')) active  @endif" href="../../admin/users">
              <i class="bi bi-circle"></i><span>Users</span>
            </a>
          </li>
          <li>
            <a class="@if(Request::route()->getName() == 'admin.newuser')) active  @endif" href="../../admin/new-user">
            <i class="bi bi-circle"></i><span>New User</span>
            </a>
          </li>
        </ul>
      </li><!-- End Users -->



      <li class="nav-item">
        <a class="nav-link collapsed" href="../user/profile">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->


      <li class="nav-item">
        <a class="nav-link @if(Request::route()->getName() != 'admin.faq')) collapsed  @endif" href="../admin/faq">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link @if(Request::route()->getName() != 'admin.contact')) collapsed  @endif" href="../admin/contact">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->
