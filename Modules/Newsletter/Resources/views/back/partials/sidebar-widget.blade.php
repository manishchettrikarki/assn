@canany(['view subscribers','send newsletter'])
    <li>
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="mdi mdi-email-newsletter"></i>
            <span>Newsletter</span>
        </a>
        <ul class="sub-menu" aria-expanded="false">
            @can('view subscribers')
                <li><a href="{{ route('newsletter.subscribers') }}"> <i class="mdi mdi-email-plus"></i> Subscribers</a></li>
            @endcan
            @can('create email templates')
                    <li><a href="{{ route('newsletter.templates') }}"><i class="mdi mdi-email-minus-outline"></i> Templates</a></li>
            @endcan
            @can('send newsletter')
                <li><a href="{{ route('newsletter.create') }}"><i class="mdi mdi-email-send"></i> Send Newsletter</a></li>
            @endcan

        </ul>
    </li>
@endcanany
