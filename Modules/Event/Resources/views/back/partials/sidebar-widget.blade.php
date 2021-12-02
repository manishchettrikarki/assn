@canany(['view events','add events'])
  <li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
      <i class="ti-write"></i>
      <span>Events</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
      @can('view events')
        <li><a href="{{ route('events.index') }}"><i class="mdi mdi-page-layout-header-footer"></i>Events</a></li>
      @endcan

    </ul>
  </li>
@endcanany
