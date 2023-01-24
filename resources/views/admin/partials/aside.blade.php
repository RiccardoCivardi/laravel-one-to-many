<nav class="navbar navbar-dark bg-dark mt-4 ps-1 d-flex justify-content-center">
    <ul class="navbar-nav">

        <li class="nav-item">
            <a  class="nav-link" href="{{route('admin.home')}}">
                <i class="fa-solid fa-chart-line fs-5 me-1"></i>
                <span class="d-none d-xl-inline">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a  class="nav-link" href="{{route('admin.projects.index')}}">
                <i class="fa-solid fa-diagram-project fs-5 me-1"></i>
                <span class="d-none d-xl-inline">Progetti</span>
            </a>
        </li>

        <li class="nav-item">
            <a  class="nav-link" href="{{route('admin.types_project')}}">
                <i class="fa-brands fa-font-awesome fs-5 me-1"></i>
                <span class="d-none d-xl-inline">Tipo/Progetti</span>
            </a>
        </li>

        <li class="nav-item">
            <a  class="nav-link" href="{{route('admin.types.index')}}">
                <i class="fa-solid fa-folder-open fs-5 me-1"></i>
                <span class="d-none d-xl-inline">Tipologie</span>
            </a>
        </li>

        <li class="nav-item">
            <a  class="nav-link" href="{{route('admin.projects.create')}}">
                <i class="fa-solid fa-calendar-plus fs-5 me-1"></i>
                <span class="d-none d-xl-inline">Nuovo Progetto</span>
            </a>
        </li>

        <li class="nav-item">
            <a  class="nav-link" href="https://github.com/RiccardoCivardi" target="blank">
                <i class="fa-brands fa-github fs-5 me-1"></i>
                <span class="d-none d-xl-inline">GitHub</span>
            </a>
        </li>

    </ul>
</nav>
