// resources/js/ajax-navigation.js

/**
 * Bind AJAX links with `data-ajax` attribute
 */

function bindAjaxLinks() {
    console.log("Binding AJAX links...");
    document.querySelectorAll("a[data-ajax]").forEach((link) => {
        link.removeEventListener("click", handleAjaxClick);
        link.addEventListener("click", handleAjaxClick);
    });
}

/**
 * Update sidebar highlight based on current URL
 */
function updateSidebarActive() {
    const currentPath = window.location.pathname;

    document.querySelectorAll("nav a[data-route]").forEach((link) => {
        const route = link.getAttribute("data-route");
        link.classList.remove("bg-blue-100", "text-blue-600");
        link.classList.add("text-gray-700");

        if (currentPath.includes(route)) {
            link.classList.add("bg-blue-100", "text-blue-600");
            link.classList.remove("text-gray-700");
        }
    });
}

/**
 * Swap new content and re-initialize Vue + Alpine
 */
function swapContent(newContent, url = null) {
    const container = document.querySelector("#main-content");
    if (!container) {
        console.error("❌ No #main-content container found!");
        return;
    }

    container.innerHTML = newContent;

    if (url) {
        window.history.pushState({}, "", url);
    }

    // Re-bind AJAX links inside the new content
    bindAjaxLinks();

    // Re-mount Vue app
    if (typeof window.mountVueApp === "function") {
        window.mountVueApp();
    }

    // Re-initialize Alpine for new DOM
    if (window.Alpine) {
        Alpine.initTree(container);
    }

    // Update sidebar active state
    updateSidebarActive();
}

/**
 * Handle AJAX navigation click
 */
function handleAjaxClick(e) {
    e.preventDefault();
    const url = this.getAttribute("href");
    console.log("AJAX navigation to:", url);

    fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } })
        .then((res) => res.text())
        .then((html) => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, "text/html");
            const newContent = doc.querySelector("#main-content")?.innerHTML;

            if (newContent) {
                swapContent(newContent, url);
            } else {
                console.error("❌ No #main-content found in response!");
            }
        })
        .catch((err) => console.error("Navigation failed:", err));
}

/**
 * Handle Back / Forward browser buttons
 */
window.addEventListener("popstate", () => {
    fetch(window.location.href, {
        headers: { "X-Requested-With": "XMLHttpRequest" },
    })
        .then((res) => res.text())
        .then((html) => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, "text/html");
            const newContent = doc.querySelector("#main-content")?.innerHTML;

            if (newContent) {
                swapContent(newContent);
            } else {
                console.error("❌ No #main-content found in response!");
            }
        })
        .catch((err) => console.error("Popstate fetch failed:", err));
});

// Initial setup on page load
document.addEventListener("DOMContentLoaded", () => {
    bindAjaxLinks();
    updateSidebarActive();
});
