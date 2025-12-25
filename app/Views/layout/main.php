<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Pemesanan Tiket - Premium</title>
    <!-- Load Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Icon library (mdi) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.4.47/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* Base Configuration */
        :root {
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 80px;
            --header-height: 64px; /* h-16 */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #eef2f6; /* Very light background for content contrast */
        }

        /* 1. Layout Transitions */
        .sidebar, .content-wrapper, .topbar {
            transition: all 0.3s cubic-bezier(0.2, 0, 0, 1);
        }

        /* 2. Desktop: Sidebar Open State (Default) */
        .sidebar {
            width: var(--sidebar-width);
            z-index: 50;
        }
        .content-wrapper {
            margin-left: var(--sidebar-width);
            min-height: calc(100vh - var(--header-height));
        }
        .topbar {
            left: var(--sidebar-width); /* Header starts next to open sidebar */
            width: calc(100% - var(--sidebar-width));
        }
        
        /* 3. Desktop: Sidebar Collapsed State */
        .enlarged .sidebar {
            width: var(--sidebar-collapsed-width);
        }
        .enlarged .sidebar .logo-text,
        .enlarged .sidebar .menu-item-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
            transition: opacity 0.2s, width 0.2s;
        }
        .enlarged .sidebar .menu-icon {
            margin-right: 0 !important;
            min-width: 1.5rem;
            text-align: center;
        }
        .enlarged .content-wrapper {
            margin-left: var(--sidebar-collapsed-width);
        }
        .enlarged .topbar {
            left: var(--sidebar-collapsed-width);
            width: calc(100% - var(--sidebar-collapsed-width));
        }


        /* 4. Mobile: Sidebar Hidden (Start State) */
        @media (max-width: 1023px) {
            .sidebar {
                transform: translateX(calc(0px - var(--sidebar-width)));
                position: fixed;
                height: 100vh;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            }
            .enlarged .sidebar {
                transform: translateX(0); /* Show sidebar on mobile when 'enlarged' is active */
            }
            .content-wrapper {
                margin-left: 0; /* No margin on mobile */
            }
            .topbar {
                left: 0;
                width: 100%;
            }
        }

        /* Styling for the slimscroll-like effect in sidebar */
        .sidebar-scroll {
            scrollbar-width: thin;
            scrollbar-color: #5b21b6 #0e1627;
        }
        .sidebar-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar-scroll::-webkit-scrollbar-track {
            background: #0e1627;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background-color: #8b5cf6; /* Vibrant purple */
            border-radius: 20px;
        }
        
        /* Removed custom padding-top here. Now using pt-16 directly in HTML on the <main> element */
        .main-content-area {
            flex-grow: 1; /* Allows content to push footer down */
        }

        /* Dropdown custom styling */
        .custom-dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: opacity 0.2s, transform 0.2s;
        }
        .custom-dropdown-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        /* Highlight for active menu item */
        .menu-active {
            position: relative;
            background-color: #312e81; /* Indigo-800 */
        }
        .menu-active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: #8b5cf6; /* Vibrant Purple Indicator */
            border-radius: 0 4px 4px 0;
        }
    </style>
</head>

<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader" class="fixed inset-0 bg-white z-[9999] flex items-center justify-center hidden">
        <div class="spinner border-t-4 border-indigo-600 border-solid rounded-full w-12 h-12 animate-spin"></div>
    </div>

    <!-- Begin page -->
    <div id="wrapper" class="flex">

        <!-- ========== Left Sidebar Start ========== -->
        <!-- Deeper Indigo Background: bg-indigo-900 -->
        <div class="sidebar fixed top-0 left-0 h-full bg-indigo-900 text-white shadow-xl flex flex-col" id="sidebar">
            
            <!-- LOGO AREA - FIX: Now only shows a single text 'Ticket PRO' -->
            <div class="logo-area bg-indigo-800 h-16 flex items-center justify-start p-4 shadow-lg">
                <div class="flex items-center overflow-hidden">
                    <!-- Placeholder Icon (40x40) -->
                    <img src="https://placehold.co/40x40/4f46e5/ffffff?text=T" width="40" alt="Logo Icon" class="rounded-md logo-img">
                    <!-- Text part, which disappears when collapsed via JS/CSS -->
                    <span class="logo-text text-xl font-extrabold ml-2 whitespace-nowrap">Ticket PRO</span>
                </div>
            </div>

            <!-- Sidebar Content -->
            <div class="sidebar-scroll flex-grow overflow-y-auto p-4">
                
                <!-- Menu Toggle Button for Mobile (Visible only on mobile inside sidebar) -->
                <button id="close-sidebar-mobile" class="absolute top-3 right-3 text-white p-2 rounded-full hover:bg-indigo-700 lg:hidden focus:outline-none">
                    <i class="mdi mdi-close text-2xl"></i>
                </button>

                <!-- Menu Content Section -->
                <div id="sidebar-menu">
                    <ul class="space-y-1">
                        <!-- PHP MENU SECTION - UNMODIFIED -->
                        <?=$this->rendersection('menu') ?>
                        <!-- END OF PHP MENU SECTION -->

                    </ul>"
                </div>
                
            </div>
            
            <!-- Sidebar Footer (Optional) -->
            <div class="p-4 border-t border-indigo-800 text-xs text-indigo-400">
                <p>Versi 1.1.0 (Premium)</p>
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- Right Content Wrapper -->
        <div class="content-wrapper flex flex-col min-h-screen w-full">
            
            <!-- Top Bar Start (Fixed Header) -->
            <!-- Header is sticky/fixed on the content area, adjusting width based on sidebar state via JS -->
            <header class="topbar fixed h-16 bg-white shadow-lg z-40 flex items-center justify-between px-4 lg:px-8" id="header-bar">
                
                <!-- Left Menu/Toggle -->
                <div class="flex items-center">
                    <button id="toggle-sidebar-trigger" class="p-2 rounded-full text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <i class="mdi mdi-menu text-2xl"></i>
                    </button>
                    
                    <!-- Search Input (Hidden on extra small screens) -->
                    <div class="hidden sm:block ml-4">
                        <form role="search" class="relative">
                            <input type="text" placeholder="Cari data cepat..." class="rounded-full py-2 pl-10 pr-4 border border-gray-200 bg-gray-50 focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 ease-in-out w-48 md:w-64">
                            <i class="mdi mdi-magnify absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-xl"></i>
                        </form>
                    </div>
                </div>

                <!-- Right Notifications/User Menu -->
                <ul class="flex items-center space-x-2 sm:space-x-4">
                    
                    <!-- Language Dropdown -->
                    <li class="relative hidden md:block">
                        <button id="lang-dropdown-btn" class="p-2 rounded-full hover:bg-gray-100 text-gray-600 flex items-center">
                            <span class="mr-2 text-sm font-medium">ID</span>
                            <img src="https://placehold.co/18x12/00A950/ffffff?text=ID" class="rounded-sm" alt="ID Flag"/>
                        </button>
                        <div id="lang-menu" class="custom-dropdown-menu absolute right-0 mt-3 w-32 bg-white rounded-lg shadow-xl ring-1 ring-black ring-opacity-5 z-50">
                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white rounded-t-lg" href="#">English</a>
                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white rounded-b-lg" href="#">French</a>
                        </div>
                    </li>

                    <!-- Notifications (Bell) -->
                    <li class="relative">
                        <button id="bell-dropdown-btn" class="p-2 rounded-full hover:bg-gray-100 text-gray-600 relative">
                            <i class="mdi mdi-bell text-2xl"></i>
                            <span class="absolute top-1 right-1 h-3 w-3 bg-red-500 border-2 border-white rounded-full"></span>
                        </button>
                        <!-- Dropdown content omitted for brevity -->
                    </li>

                    <!-- User Profile Dropdown -->
                    <li class="relative">
                        <button id="profile-dropdown-btn" class="p-1 rounded-full hover:bg-gray-100 flex items-center focus:outline-none">
                            <img src="https://placehold.co/40x40/8b5cf6/ffffff?text=AD" alt="user" class="rounded-full h-10 w-10 object-cover border-2 border-indigo-500 ring-2 ring-indigo-200">
                            <span class="hidden sm:inline-block ml-3 text-gray-800 font-semibold text-sm">Admin</span>
                            <i class="mdi mdi-chevron-down text-gray-400 ml-1 hidden sm:inline-block"></i>
                        </button>
                        <div id="profile-menu" class="custom-dropdown-menu absolute right-0 mt-3 w-48 bg-white rounded-lg shadow-2xl ring-1 ring-black ring-opacity-5 z-50">
                             <div class="px-4 py-3 border-b border-gray-100">
                                <h5 class="text-sm font-bold text-gray-900">John Doe</h5>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white" href="#"><i class="mdi mdi-account-circle-outline mr-3"></i> Profil</a>
                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white" href="#"><i class="mdi mdi-cog-outline mr-3"></i> Pengaturan</a>
                            <div class="border-t border-gray-100"></div>
                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-600 hover:text-white rounded-b-lg" href="#"><i class="mdi mdi-power mr-3"></i> Keluar</a>
                        </div>
                    </li>
                </ul>

            </header>
            <!-- Top Bar End -->

            <!-- Main Content Area: Added pt-16 to ensure content starts below the h-16 fixed header -->
            <main class="main-content-area flex-grow pt-16 px-4 pb-4 md:px-8 md:pb-8">
                
                <!-- Content Container -->
                <div class="container-fluid mx-auto">

                    <div class="row">
                        <div class="col-sm-12 w-full">
                            <!-- Page Title/Breadcrumb Box -->
                            <div class="page-title-box bg-white p-6 rounded-xl-lg border-b-4 border-indigo-500 mb-8">
                                
                                <h4 class="page-title text-3xl font-extrabold text-gray-900">Dashboard Utama</h4>                    
                                <!-- PHP ISI SECTION - UNMODIFIED -->
                            </div>
                            
                    <div class="row">
                        <div class="col-sm-12 w-full">
                            <!-- Page Title/Breadcrumb Box -->
                            <div class="page-title-box bg-white p-6 rounded-xl shadow-lg border-b-4 border-indigo-500 mb-8">
                                 <?=$this->rendersection('isi') ?>
                                <!-- PHP ISI SECTION - UNMODIFIED -->
                            </div><!-- End of preserved inner content area -->
                            
                            <!-- PHP ADDITIONAL SECTIONS (Biodata/Kasir) - Placed logically here -->
                            <?=$this->rendersection('biodata')?>
                            <?=$this->rendersection('kasir')?>


                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer always at the bottom -->
            <footer class="mt-auto bg-white border-t border-gray-200 text-center p-4 text-sm text-gray-500 shadow-inner">
                &copy; 2025 Sistem Informasi Ticket PRO. Didesain dengan <span class="text-red-500">&hearts;</span> dan Tailwind CSS.
            </footer>

        </div>
        <!-- End Right content wrapper -->

    </div>
    <!-- END wrapper -->

    <!-- jQuery is loaded here as per original file structure -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom JavaScript for Menu and Dropdown Toggling -->
    <script>
        $(document).ready(function() {
            const $wrapper = $('#wrapper');
            const $sidebar = $('#sidebar');
            const $headerBar = $('#header-bar');
            const $toggleTrigger = $('#toggle-sidebar-trigger');
            const $closeMobile = $('#close-sidebar-mobile');
            const LG_BREAKPOINT = 1024;

            // Function to adjust header width based on sidebar state
            function adjustLayout() {
                const isDesktop = window.innerWidth >= LG_BREAKPOINT;
                const isEnlarged = $wrapper.hasClass('enlarged');

                if (isDesktop) {
                    const sidebarWidth = isEnlarged ? 80 : 260;
                    $headerBar.css('width', `calc(100% - ${sidebarWidth}px)`);
                    $headerBar.css('left', `${sidebarWidth}px`);
                } else {
                    $headerBar.css('width', '100%');
                    $headerBar.css('left', '0');
                }

                // If on mobile, ensure the sidebar is only visible when 'enlarged' is active
                if (!isDesktop) {
                     if ($wrapper.hasClass('enlarged')) {
                        $sidebar.addClass('translate-x-0').removeClass('-translate-x-full');
                    } else {
                        $sidebar.removeClass('translate-x-0').addClass('-translate-x-full');
                    }
                } else {
                    // On desktop, ensure visibility is correct
                    $sidebar.removeClass('-translate-x-full translate-x-0');
                }
            }

            // Toggle Sidebar Logic
            function toggleSidebar() {
                $wrapper.toggleClass('enlarged');
                adjustLayout();
            }

            // Desktop Toggle (Hamburger Menu)
            $toggleTrigger.on('click', function(e) {
                e.preventDefault();
                toggleSidebar();
            });

            // Mobile Toggle (Clicking Close button inside sidebar)
            $closeMobile.on('click', function(e) {
                e.preventDefault();
                // On mobile, removing 'enlarged' means hiding the sidebar
                $wrapper.removeClass('enlarged');
                adjustLayout();
            });

            // Handle Clicks outside the sidebar on mobile (to close it)
            $(document).on('click', function(e) {
                if (window.innerWidth < LG_BREAKPOINT && $wrapper.hasClass('enlarged')) {
                    // Check if the click is outside the sidebar AND not on the toggle button itself
                    if (!$sidebar.is(e.target) && $sidebar.has(e.target).length === 0 && !$toggleTrigger.is(e.target) && $toggleTrigger.has(e.target).length === 0) {
                        $wrapper.removeClass('enlarged');
                        adjustLayout();
                    }
                }
            });


            // --- Dropdown Logic (for Profile and Language) ---
            function setupDropdown(buttonId, menuId) {
                const $button = $(`#${buttonId}`);
                const $menu = $(`#${menuId}`);

                $button.on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Hide all other open dropdowns
                    $('.custom-dropdown-menu').not($menu).removeClass('active');
                    
                    // Toggle current menu
                    $menu.toggleClass('active');
                });

                // Close dropdown when clicking outside
                $(document).on('click', function(e) {
                    if (!$button.is(e.target) && $button.has(e.target).length === 0 && !$menu.is(e.target) && $menu.has(e.target).length === 0) {
                        $menu.removeClass('active');
                    }
                });
            }

            setupDropdown('lang-dropdown-btn', 'lang-menu');
            setupDropdown('profile-dropdown-btn', 'profile-menu');
            
            // Initial setup and resize handling
            $(window).on('resize', function() {
                adjustLayout();
            }).trigger('resize'); // Trigger resize on load for initial positioning
        });
    </script>

    <script>
let idleTime = 0;
const maxIdle = 3000; // 2 menit

// reset waktu jika ada aktivitas
window.onload = resetTimer;
document.onmousemove = resetTimer;
document.onkeypress = resetTimer;
document.onclick = resetTimer;
document.onscroll = resetTimer;

function resetTimer() {
    idleTime = 0;
}

// hitung waktu diam
setInterval(() => {
    idleTime++;
    if (idleTime >= maxIdle) {
        window.location.href = "<?= site_url('login') ?>";
    }
}, 1000);
</script>

</body>
</html>