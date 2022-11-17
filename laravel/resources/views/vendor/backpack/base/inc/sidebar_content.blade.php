{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}

<b style="color:black";>
@hasanyrole('admin|editor')
   {{ __("Secció d'administradors i editors") }}
@else
   {{ __("Només els administradors i editors poden veure aquesta secció") }}
@endhasanyrole
 
@can('admin users')
   {{ __("Podeu administrar usuaris!") }}
@endcan

</b>


<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('comment') }}"><i class="las la-comment"></i>Comments</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('file') }}"><i class="las la-file"></i> Files</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('like') }}"><i class="las la-thumbs-up"></i></i> Likes</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('tag') }}"><i class="las la-tags"></i> Tags</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('place') }}"><i class="las la-map-marked"></i> Places</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('visibility') }}"><i class="las la-eye"></i>Visibilities</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('posts') }}"><i class="las la-address-card"></i> Posts</a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>

    <ul class="nav-dropdown-items">
       
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    </ul>

</li>


 
