@canany(['view pages','create pages'])
<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="ti-write"></i>
        <span>CMS</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        @can('view pages')
            <li><a href="{{ route('cms.pages') }}"><i class="mdi mdi-page-layout-header-footer"></i>Pages</a></li>
        @endcan
        @can('create pages')
            <li><a href="{{ route('cms.pages.create') }}"><i class="dripicons-document-edit"></i>Create Page</a></li>
        @endcan
        @can('view sliders')
        <li><a href="{{ route('cms.sliders') }}"><i class="mdi mdi-image"></i>Sliders</a></li>
        @endcan
        @can('view library')
        <li><a href="{{ route('cms.library') }}"> <i class="ti-gallery"></i> Library</a></li>
        @endcan
    </ul>
</li>
@endcanany
