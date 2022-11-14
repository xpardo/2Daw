{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}


<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="las la-user-circle"></i>Users</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('comment') }}"><i class="nav-icon la la-question"></i> Comments</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('file') }}"><i class="nav-icon la la-question"></i> Files</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('like') }}"><i class="nav-icon la la-question"></i> Likes</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-question"></i> Roles</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('tag') }}"><i class="nav-icon la la-question"></i> Tags</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('place') }}"><i class="nav-icon la la-question"></i> Places</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('visibility') }}"><i class="nav-icon la la-question"></i> Visibilities</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('posts') }}"><i class="nav-icon la la-question"></i> Posts</a></li>