@canany(['view access control','view users'])
    <li>
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="fas fa-user-tag"></i>
            <span>Users</span>
        </a>
        <ul class="sub-menu" aria-expanded="false">
            @can('view access control')
                <li><a href="{{ route('user.roles') }}"><i class="fas fa-user-shield"></i> Access Control</a></li>
            @endcan
            @can('view users')
                <li><a href="{{ route('users') }}"> <i class="fas fa-user-check"></i> Registered Users</a></li>
            @endcan
            @can('view suspended users')
                <li><a href="{{ route('users.suspended') }}"> <i class="fas fa-user-slash"></i> Suspended Users</a></li>
            @endcan
            @can('view deleted users')
                <li><a href="{{ route('users.deleted') }}"> <i class="fas fa-user-times"></i> Deleted Users</a></li>
            @endcan
        </ul>
    </li>
@endcanany
