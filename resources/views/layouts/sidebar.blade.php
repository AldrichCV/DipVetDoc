<div class="flex flex-col h-full w-full"
     x-data="sidebar()"
     x-init="init()"
     x-cloak
>
    <nav class="flex-1 overflow-y-auto overflow-x-hidden px-1 sm:px-2 py-4 space-y-1">

        <!-- Dashboard -->
        <template x-for="link in links" :key="link.name">
            <a :href="link.url"
               @click.prevent="loadPage(link.url)"
               :class="activeRoute === link.url ? 'bg-blue-100 text-blue-800' : 'text-gray-700 hover:bg-blue-100'"
               class="flex items-center px-3 py-2 rounded-lg transition-colors animate-nav-item"
               :aria-current="activeRoute === link.url ? 'page' : undefined"
               x-show="canAccess(link.roles)"
            >
                <div class="flex items-center w-full">
                    <div class="w-6 text-center flex-shrink-0">
                        <i :class="link.icon"></i>
                    </div>
                    <template x-if="sidebarExpanded">
                        <span class="truncate ml-3" x-text="link.label"></span>
                    </template>
                </div>
            </a>
        </template>

    </nav>

    <div class="p-4 border-t border-gray-200">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="flex items-center w-full px-3 py-2 rounded-lg text-gray-700 hover:bg-red-100 hover:text-red-600 focus:bg-red-200 transition-colors animate-nav-item"
            >
                <div class="flex items-center w-full">
                    <div class="w-6 text-center flex-shrink-0">
                        <i class="fa-solid fa-sign-out-alt text-lg"></i>
                    </div>
                    <template x-if="sidebarExpanded">
                        <span class="truncate ml-3">Logout</span>
                    </template>
                </div>
            </button>
        </form>
    </div>

    <script>
        function sidebar() {
            return {
                sidebarExpanded: true,
                activeRoute: window.location.pathname,

                links: [
                    { name: 'dashboard', label: 'Dashboard', url: '/dashboard', icon: 'fa-solid fa-home text-lg', roles: ['admin','vet','user'] },
                    { name: 'appointments', label: 'Appointments', url: '/appointments', icon: 'fa-solid fa-calendar text-lg', roles: ['admin','vet','user'] },
                    { name: 'users', label: 'Users', url: '/users', icon: 'fa-solid fa-users text-lg', roles: ['admin'] },
                    { name: 'consultations', label: 'Consultations', url: '/consultations', icon: 'fa-solid fa-clipboard-list text-lg', roles: ['admin','vet'] },
                ],

                canAccess(roles) {
                    const userRole = "{{ Auth::user()->role }}";
                    return roles.includes(userRole);
                },

                init() {
                    window.addEventListener('popstate', () => {
                        this.activeRoute = window.location.pathname;
                    });
                },

                loadPage(url) {
                    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                        .then(res => res.text())
                        .then(html => {
                            document.getElementById('main-content').innerHTML = html;
                            this.activeRoute = new URL(url, window.location.origin).pathname;
                            history.pushState(null, '', url);
                            document.getElementById('main-content').scrollTop = 0;
                        });
                }
            }
        }
    </script>
</div>
