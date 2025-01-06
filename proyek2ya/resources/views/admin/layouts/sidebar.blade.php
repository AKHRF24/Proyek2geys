<style>
.sidebar .nav-link {
    color: white;
    background-color: transparent;
    transition: all 0.3s ease;
}

.sidebar .nav-link:hover {
    background-color: #495057;
    color: #f8f9fa;
}

.sidebar .nav-link.active {
    background-color: #0d6efd;
    color: white;
    font-weight: bold;
}

</style>
<aside class="sidebar navbar navbar-expand-lg bg-dark d-flex flex-column mt-2 rounded" style="height: 600px;padding: 40px;">
    <h5 class="navbar-brand text-primary">Market Point</h5>
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarNav" aria-controls="sidebarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="sidebarNav">
        <ul class="navbar-nav flex-column gap-3">
            <li class="nav-item">
                <a href="" class="nav-link text-white">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.page.market') }}" class="nav-link text-white {{ Request::path() === '/admin/page/market' ? 'bg-warning' : '' }}">
                    <i class="bi bi-box-seam me-2"></i>
                    Product
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.page.question.index') }}" class="nav-link text-white">
                    <i class="bi bi-credit-card me-2"></i>
                    Quest
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link text-white">
                    <i class="bi bi-credit-card me-2"></i>
                    Transactions
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link text-white"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</aside>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const sidebar = document.querySelector(".sidebar");
        const toggleButton = document.querySelector(".sidebar-toggler");

        toggleButton.addEventListener("click", () => {
            sidebar.classList.toggle("hide");
        });
    });
</script>
