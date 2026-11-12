/**
 * Backend JavaScript for XTIK Programming Admin Panel
 * Features: Responsive Sidebar Toggle (Buka-Tutup Desktop & Mobile), Backdrop Overlay, Flash Alert Auto-dismiss
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Sidebar Elements
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    const menuIcons = document.querySelectorAll('.menu-icon, #sidebarToggleBtn, label[for="sidebar-toggle"]');
    const backdrop = document.querySelector('.sidebar-backdrop');

    // Restore desktop collapsed state from localStorage (only on desktop screen)
    if (window.innerWidth > 992) {
        if (localStorage.getItem('xtik_admin_sidebar_collapsed') === '1') {
            document.body.classList.add('sidebar-collapsed');
            if (sidebarToggle) sidebarToggle.checked = true;
        }
    } else {
        document.body.classList.remove('sidebar-collapsed');
    }

    // Toggle Function for "Buka - Tutup"
    const toggleSidebar = (e) => {
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }

        if (window.innerWidth <= 992) {
            // Mobile Mode: Toggle Mobile Drawer Overlay
            document.body.classList.remove('sidebar-collapsed');
            const isOpen = document.body.classList.toggle('sidebar-mobile-open');
            document.body.classList.toggle('sidebar-active', isOpen);
            if (sidebarToggle) sidebarToggle.checked = isOpen;
        } else {
            // Desktop Mode: Toggle Collapse / Expand
            document.body.classList.remove('sidebar-mobile-open', 'sidebar-active');
            const isCollapsed = document.body.classList.toggle('sidebar-collapsed');
            if (sidebarToggle) sidebarToggle.checked = isCollapsed;
            localStorage.setItem('xtik_admin_sidebar_collapsed', isCollapsed ? '1' : '0');
        }
    };

    // Attach click event to all hamburger buttons
    menuIcons.forEach(btn => {
        btn.addEventListener('click', toggleSidebar);
    });

    const closeMobileSidebar = () => {
        document.body.classList.remove('sidebar-mobile-open', 'sidebar-active');
        if (sidebarToggle) sidebarToggle.checked = false;
    };

    // Close on mobile backdrop click
    if (backdrop) {
        backdrop.addEventListener('click', (e) => {
            e.preventDefault();
            closeMobileSidebar();
        });
    }

    // Close sidebar on mobile when clicking outside
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 992 && document.body.classList.contains('sidebar-mobile-open')) {
            const isClickInsideSidebar = sidebar && sidebar.contains(e.target);
            const isClickOnToggle = Array.from(menuIcons).some(btn => btn.contains(e.target));
            
            if (!isClickInsideSidebar && !isClickOnToggle) {
                closeMobileSidebar();
            }
        }
    });

    // Close sidebar on mobile when clicking sidebar navigation links
    if (sidebar) {
        sidebar.querySelectorAll('nav a, .sidebar-bottom a, .sidebar-bottom button').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 992) {
                    closeMobileSidebar();
                }
            });
        });
    }

    // Handle Window Resize Responsively
    window.addEventListener('resize', () => {
        if (window.innerWidth > 992) {
            closeMobileSidebar();
            if (localStorage.getItem('xtik_admin_sidebar_collapsed') === '1') {
                document.body.classList.add('sidebar-collapsed');
            }
        } else {
            document.body.classList.remove('sidebar-collapsed');
        }
    });

    // 2. Auto Dismiss Flash Messages after 5 seconds
    const flashMessages = document.querySelectorAll('.flash-alert');
    if (flashMessages.length > 0) {
        setTimeout(() => {
            flashMessages.forEach(msg => {
                msg.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                msg.style.opacity = '0';
                msg.style.transform = 'translateY(-10px)';
                setTimeout(() => msg.remove(), 500);
            });
        }, 5000);
    }
});
