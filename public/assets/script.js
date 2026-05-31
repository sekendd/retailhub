document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const toggleBtn = document.getElementById('sidebarCollapse');

            // Check if elements exist to avoid console errors
            if (toggleBtn && sidebar && content) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    content.classList.toggle('active');
                    console.log("Sidebar toggled!"); // Helps you debug in VS Code console
                });
            }
        });