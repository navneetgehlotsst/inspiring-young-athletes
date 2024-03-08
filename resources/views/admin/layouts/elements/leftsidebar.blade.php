
<ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item">
        <a href="{{ route('admin.dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Email">Dashboard</div>
        </a>
    </li>

    <li class="menu-item">
        <a href="{{ route('admin.user.list') }}" class="menu-link">
            <i class='bx bx-user'></i>
            <div data-i18n="Email">Viewers</div>
        </a>
    </li>


    <li class="menu-item">
        <a href="{{ route('admin.athelitics.list') }}" class="menu-link">
            <i class='bx bx-user'></i>
            <div data-i18n="Email">Athletes & Coaches</div>
        </a>
    </li>


    <li class="menu-item">
        <a href="{{ route('admin.pages.ask.question.list') }}" class="menu-link">
            <i class='bx bx-user'></i>
            <div data-i18n="Email">Ask Question</div>
        </a>
    </li>

    <li class="menu-item">
        <a href="{{ route('admin.pages.newsletter.list') }}" class="menu-link">
            <i class='bx bx-user'></i>
            <div data-i18n="Email">News Letters</div>
        </a>
    </li>

    <li class="menu-item">
        <a href="{{ route('admin.faq.list') }}" class="menu-link">
            <i class='bx bx-user'></i>
            <div data-i18n="Email">FAQ</div>
        </a>
    </li>


    <li class="menu-item">
        <a href="{{ route('admin.pages.contactus.list') }}" class="menu-link">
            <i class='bx bx-user'></i>
            <div data-i18n="Email">Contact Us</div>
        </a>
    </li>
    
</ul>