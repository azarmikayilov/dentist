<ul class="list-unstyled components">
    {{--    <li>--}}
    {{--        <a href="{{ route('admin.index') }}">Dashboard</a>--}}
    {{--    </li>--}}
    <li>
        <a href="{{ route('admin.slider.index') }}">Slider Images</a>
    </li>
    <li>
        <a href="{{ route('admin.quotes.index') }}">Quotes</a>
    </li>
    <li>
        <a href="{{ route('admin.sponsor.index') }}">Sponsor</a>
    </li>
    <li>
        <a href="{{ route('admin.youtube.index') }}">Youtube</a>
    </li>
    <li>
        <a href="{{ route('admin.teams.index') }}">Team</a>
    </li>
    <li>
        <a href="{{ route('admin.blogs.index') }}">Blog</a>
    </li>
    <li>
        <a href="{{ route('admin.category.index') }}">Category</a>
    </li>
    <li>
        <a href="{{ route('admin.menu.index') }}">About Menu</a>
    </li>
    <li>
        <a href="{{ route('admin.about-us.index') }}">About Us</a>
    </li>
    <li>
        <a href="{{ route('admin.tv-program.index') }}">Tv Program</a>
    </li>
    <li>
        <a href="{{ route('admin.doctor.index') }}">Head Doctor</a>
    </li>
    <li>
        <a href="{{ route('admin.settings.index') }}">Setting</a>
    </li>
    <li>
        <a href="{{ route('admin.icon.index') }}">Social Icon</a>
    </li>
    <li>
        <a href="{{ route('admin.d_image.index') }}">Doctor Image</a>
    </li>
    <li>
        <a href="{{ route('admin.language.index') }}">Language</a>
    </li>


    @if(Auth::guard('admin')->check())
        <li>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-light mt-5 ml-2">Logout</button>
            </form>
        </li>
    @endif
</ul>
