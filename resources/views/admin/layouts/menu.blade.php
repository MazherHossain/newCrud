<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
<div id="sidebar-menu" class="sidebar-menu">
<ul>
<li class="menu-title"> 
  <span>Main</span>
</li>
<li class="active"> 
  <a href="{{route('dash')}}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
</li>



<li class="submenu">
  <a href="#"><i class="fe fe-document"></i> <span> Staff</span> <span class="menu-arrow"></span></a>
  <ul style="display: none;">
    <li><a href="{{route('staff.index')}}">All Staff</a></li>
    <li><a href="{{route('staff.create')}}">Add new Staff</a></li>
  </ul>
</li>




</div>
  </div>
</div>
<!-- /Sidebar -->