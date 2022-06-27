<a href="{{ route('member.auth.profile',[app()->getLocale()]) }}" class="btn btn-hover btn-mng-prfl btn-block"><i class="ri-file-user-line text-primary"></i> Manage Profile</a>

<a href="{{ route('member.auth.settings',[app()->getLocale()]) }}" class="btn btn-hover btn-mng-prfl btn-block"><i class="ri-settings-4-line text-primary"></i> Settings</a>

<a href="{{ route('member.auth.library',[app()->getLocale()]) }}" class="btn btn-hover btn-mng-prfl btn-block"><i class="ri-store-line text-primary"></i> My Library</a>

<a href="{{ route('member.auth.bucket',[app()->getLocale()]) }}" class="btn btn-hover btn-mng-prfl btn-block"><i class="ri-shopping-cart-2-line text-primary"></i> My Purchase</a>

<a href="{{ route('member.auth.change_password',[app()->getLocale()]) }}" class="btn btn-hover btn-mng-prfl btn-block"><i class="ri-lock-unlock-line text-primary"></i>  Change Password</a>

<a href="{{ route('member.auth.logout',[app()->getLocale()]) }}" class="btn btn-hover btn-mng-prfl btn-block"><i class="ri-logout-circle-line text-primary"></i> Logout</a>
