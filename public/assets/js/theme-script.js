
    // Apply the saved theme settings from local storage
    document.querySelector("html").setAttribute("data-theme", localStorage.getItem('theme') || 'light');
    document.querySelector("html").setAttribute('data-sidebar', localStorage.getItem('sidebarTheme') || 'light');
    document.querySelector("html").setAttribute('data-color', localStorage.getItem('color') || 'primary');
    document.querySelector("html").setAttribute('data-topbar', localStorage.getItem('topbar') || 'white');


    // let themesettings = `
    //
    //             `
    //
    // document.addEventListener("DOMContentLoaded", function() {
    //     $(".main-wrapper").append(themesettings)
    // });

    document.addEventListener("DOMContentLoaded", function(event) {
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const lightModeToggle = document.getElementById('light-mode-toggle');
        const darkMode = localStorage.getItem('darkMode');

        function enableDarkMode() {
            document.documentElement.setAttribute('data-theme', 'dark');
            darkModeToggle.classList.remove('activate');
            lightModeToggle.classList.add('activate');
            localStorage.setItem('darkMode', 'enabled');
        }

        function disableDarkMode() {
            document.documentElement.setAttribute('data-theme', 'light');
            lightModeToggle.classList.remove('activate');
            darkModeToggle.classList.add('activate');
            localStorage.removeItem('darkMode');
        }

            // Check if darkModeToggle and lightModeToggle exist before adding event listeners
            if (darkModeToggle && lightModeToggle) {
            // Check the current mode on page load
            if (darkMode === 'enabled') {
                enableDarkMode();
            } else {
                disableDarkMode();
            }

            // Add event listeners
            darkModeToggle.addEventListener('click', enableDarkMode);
            lightModeToggle.addEventListener('click', disableDarkMode);
        }
    });


    document.addEventListener("DOMContentLoaded", function() {
        // Your existing JavaScript code
        const themeRadios = document.querySelectorAll('input[name="theme"]');
        const sidebarRadios = document.querySelectorAll('input[name="sidebar"]');
        const colorRadios = document.querySelectorAll('input[name="color"]');
        const layoutRadios = document.querySelectorAll('input[name="LayoutTheme"]');
        const topbarRadios = document.querySelectorAll('input[name="topbar"]');
        const sidebarBgRadios = document.querySelectorAll('input[name="sidebarbg"]');
        const resetButton = document.getElementById('resetbutton');
        const sidebarBgContainer = document.getElementById('sidebarbgContainer');
        const sidebarElement = document.querySelector('.sidebar'); // Adjust this selector to match your sidebar element

        function setThemeAndSidebarTheme(theme, sidebarTheme, color, layout, topbar) {
            // Check if the sidebar element exists
            if (!sidebarElement) {
                console.error('Sidebar element not found');
                return;
            }

            // Setting data attributes and classes
            document.documentElement.setAttribute('data-theme', theme);
            document.documentElement.setAttribute('data-sidebar', sidebarTheme);
            document.documentElement.setAttribute('data-color', color);
            document.documentElement.setAttribute('data-layout', layout);
            document.documentElement.setAttribute('data-topbar', topbar);

            if (layout === 'mini') {
                document.body.classList.add("mini-sidebar");
                document.body.classList.remove("layout-box-mode");
            } else if (layout === 'box') {
                document.body.classList.add("layout-box-mode");
                document.body.classList.remove("mini-sidebar");
            } else {
                document.body.classList.remove("layout-box-mode", "mini-sidebar");
            }

            // Saving to localStorage
            localStorage.setItem('theme', theme);
            localStorage.setItem('sidebarTheme', sidebarTheme);
            localStorage.setItem('color', color);
            localStorage.setItem('layout', layout);
            localStorage.setItem('topbar', topbar);

            // Show/hide sidebar background options based on layout selection
            if (layout === 'box' && sidebarBgContainer) {
                sidebarBgContainer.classList.add('show');
            } else if (sidebarBgContainer) {
                sidebarBgContainer.classList.remove('show');
            }
        }

        function handleSidebarBgChange() {
            const sidebarBg = document.querySelector('input[name="sidebarbg"]:checked') ? document.querySelector('input[name="sidebarbg"]:checked').value : null;

            if (sidebarBg) {
                document.body.setAttribute('data-sidebarbg', sidebarBg);
                localStorage.setItem('sidebarBg', sidebarBg);
            } else {
                document.body.removeAttribute('data-sidebarbg');
                localStorage.removeItem('sidebarBg');
            }
        }

        function handleInputChange() {
            const theme = document.querySelector('input[name="theme"]:checked').value;
            const sidebarTheme = document.querySelector('input[name="sidebar"]:checked').value;
            const color = document.querySelector('input[name="color"]:checked').value;
            const layout = document.querySelector('input[name="LayoutTheme"]:checked').value;
            const topbar = document.querySelector('input[name="topbar"]:checked').value;

            setThemeAndSidebarTheme(theme, sidebarTheme, color, layout, topbar);
        }

        function resetThemeAndSidebarThemeAndColorAndBg() {
            setThemeAndSidebarTheme('light', 'light', 'primary', 'default', 'white');
            document.body.removeAttribute('data-sidebarbg');

            document.getElementById('lightTheme').checked = true;
            document.getElementById('lightSidebar').checked = true;
            document.getElementById('primaryColor').checked = true;
            document.getElementById('defaultLayout').checked = true;
            document.getElementById('whiteTopbar').checked = true;

            const checkedSidebarBg = document.querySelector('input[name="sidebarbg"]:checked');
            if (checkedSidebarBg) {
                checkedSidebarBg.checked = false;
            }

            localStorage.removeItem('sidebarBg');
        }

        // Adding event listeners
        themeRadios.forEach(radio => radio.addEventListener('change', handleInputChange));
        sidebarRadios.forEach(radio => radio.addEventListener('change', handleInputChange));
        colorRadios.forEach(radio => radio.addEventListener('change', handleInputChange));
        layoutRadios.forEach(radio => radio.addEventListener('change', handleInputChange));
        topbarRadios.forEach(radio => radio.addEventListener('change', handleInputChange));
        sidebarBgRadios.forEach(radio => radio.addEventListener('change', handleSidebarBgChange));
        resetButton.addEventListener('click', resetThemeAndSidebarThemeAndColorAndBg);

        // Initial setup from localStorage
        const savedTheme = localStorage.getItem('theme') || 'light';
        const savedSidebarTheme = localStorage.getItem('sidebarTheme') || 'light';
        const savedColor = localStorage.getItem('color') || 'primary';
        const savedLayout = localStorage.getItem('layout') || 'default';
        const savedTopbar = localStorage.getItem('topbar') || 'white';
        const savedSidebarBg = localStorage.getItem('sidebarBg') || null;

        setThemeAndSidebarTheme(savedTheme, savedSidebarTheme, savedColor, savedLayout, savedTopbar);

        if (savedSidebarBg) {
            document.body.setAttribute('data-sidebarbg', savedSidebarBg);
        } else {
            document.body.removeAttribute('data-sidebarbg');
        }

        // Check and set radio buttons based on saved preferences
        if (document.getElementById(`${savedTheme}Theme`)) {
            document.getElementById(`${savedTheme}Theme`).checked = true;
        }
        if (document.getElementById(`${savedSidebarTheme}Sidebar`)) {
            document.getElementById(`${savedSidebarTheme}Sidebar`).checked = true;
        }
        if (document.getElementById(`${savedColor}Color`)) {
            document.getElementById(`${savedColor}Color`).checked = true;
        }
        if (document.getElementById(`${savedLayout}Layout`)) {
            document.getElementById(`${savedLayout}Layout`).checked = true;
        }
        if (document.getElementById(`${savedTopbar}Topbar`)) {
            document.getElementById(`${savedTopbar}Topbar`).checked = true;
        }
        if (savedSidebarBg && document.getElementById(`${savedSidebarBg}`)) {
            document.getElementById(`${savedSidebarBg}`).checked = true;
        }

        // Initially hide sidebar background options based on layout
        if (savedLayout !== 'box' && sidebarBgContainer) {
            sidebarBgContainer.classList.remove('show');
        }

    });


















