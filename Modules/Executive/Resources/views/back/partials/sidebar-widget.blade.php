@canany(['view executive members','view members','view regional coordinators'])
  <li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
      <i class="ti-write"></i>
      <span>ASON Members</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
      @can('view executive members')
        <li>
            <a href="{{ route('executives.index') }}">
                <i class="mdi mdi-page-layout-header-footer"></i>Executive Members
            </a>
        </li>
      @endcan
        @can('view members')
            <li>
                <a href="{{ route('members.index') }}">
                    <i class="mdi mdi-page-layout-header-footer"></i> Members
                </a>
            </li>
            @endcan
          @can('view regional coordinators')
              <li>
                  <a href="{{ route('coordinators.index') }}">
                      <i class="mdi mdi-page-layout-header-footer"></i> Regional Coordinators
                  </a>
              </li>
          @endcan
        @can('update executive message')
          <li>
            <a href="{{ route('executive.message') }}">
              <i class="mdi mdi-page-layout-header-footer"></i>Executive Messages
            </a>
          </li>
        @endcan
          @can('update past presidents')
              <li>
                  <a href="{{ route('past.president.index') }}">
                      <i class="mdi mdi-page-layout-header-footer"></i>Past Presidents
                  </a>
              </li>
          @endcan
          @can('update executive bodies')
              <li>
                  <a href="{{ route('executive.bodies.index') }}">
                      <i class="mdi mdi-page-layout-header-footer"></i>Executive Body
                  </a>
              </li>
          @endcan
          @can('update past general secretary')
              <li>
                  <a href="{{ route('past.general.secretary.index') }}">
                      <i class="mdi mdi-page-layout-header-footer"></i>Past General Secretary
                  </a>
              </li>
          @endcan
          @can('update scientific committee')
              <li>
                  <a href="{{ route('scientific.committee.index') }}">
                      <i class="mdi mdi-page-layout-header-footer"></i>Scientific Committee
                  </a>
              </li>
          @endcan
          @can('update provincial representative')
              <li>
                  <a href="{{ route('provincial.representative.index') }}">
                      <i class="mdi mdi-page-layout-header-footer"></i>Provincial Representative
                  </a>
              </li>
          @endcan
    </ul>
  </li>
@endcanany
