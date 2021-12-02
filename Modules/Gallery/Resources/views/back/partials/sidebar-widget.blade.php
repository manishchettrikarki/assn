@canany(['view albums'])
    <li>
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-write"></i>
            <span>Gallery</span>
        </a>
        <ul class="sub-menu" aria-expanded="false">
            @can('view albums')
                <li>
                    <a href="{{ route('albums.index') }}">
                        <i class="mdi mdi-page-layout-header-footer"></i>Albums
                    </a>
                </li>
            @endcan
            @can('view gallery images')
                <li>
                    <a href="#">
                        <i class="mdi mdi-page-layout-header-footer"></i> All Images
                    </a>
                </li>
            @endcan


        </ul>
    </li>
@endcanany
