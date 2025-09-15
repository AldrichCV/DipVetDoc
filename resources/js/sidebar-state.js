document.addEventListener("alpine:init", () => {
    Alpine.store("sidebar", {
        expanded: localStorage.getItem("sidebarExpanded") !== "false",
        toggle() {
            this.expanded = !this.expanded;
            localStorage.setItem("sidebarExpanded", this.expanded);
        },
        init() {
            localStorage.setItem("sidebarExpanded", this.expanded);
        },
    });
});

function sidebar() {
    return {
        sidebarExpanded: true,
        activeRoute: window.location.pathname,

        links: [
            {
                name: "dashboard",
                label: "Dashboard",
                url: "/dashboard",
                icon: "fa-solid fa-home text-lg",
                roles: ["admin", "vet", "user"],
            },
            {
                name: "appointments",
                label: "Appointments",
                url: "/appointments",
                icon: "fa-solid fa-calendar text-lg",
                roles: ["admin", "vet", "user"],
            },
            {
                name: "users",
                label: "Users",
                url: "/users",
                icon: "fa-solid fa-users text-lg",
                roles: ["admin"],
            },
            {
                name: "consultations",
                label: "Consultations",
                url: "/consultations",
                icon: "fa-solid fa-clipboard-list text-lg",
                roles: ["admin", "vet"],
            },
        ],

        canAccess(roles) {
            const userRole = document
                .querySelector('meta[name="user-role"]')
                .getAttribute("content");
            return roles.includes(userRole);
        },

        init() {
            window.addEventListener("popstate", () => {
                this.activeRoute = window.location.pathname;
            });
        },
    };
}
