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
