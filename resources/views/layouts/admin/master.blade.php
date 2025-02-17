 <!DOCTYPE html>
 <html class="light" data-nav-layout="vertical" data-header-styles="light" data-menu-styles="dark" data-toggled="close"
     lang="en" dir="ltr">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title> Sajilo Attendance </title>
     <meta name="description"
         content="Paradise Infotech Sajilo Attendance system is a cutting-edge solution for managing employee attendance efficiently. Designed for accuracy, scalability, and ease of use.">
     <meta name="keywords"
         content="Paradise Infotech, Sajilo Attendance system, attendance management, employee attendance software, time tracking, admin dashboard, responsive system, attendance solutions, Paradise attendance system, AttendanceX">

     <!-- Favicon -->
     <link rel="shortcut icon" href="{{ asset('assets/images/brand-logos/fav.jpg') }}">

     <!-- Main JS -->
     <script src="{{ asset('assets/js/main.js') }}"></script>

     <!-- Style Css -->
     <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

     <!-- Simplebar Css -->
     <link rel="stylesheet" href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}">

     <!-- Color Picker Css -->
     <link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}">
     <!-- FlatPickr CSS -->
     <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/fancybox.min.css') }}">
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
     @livewireStyles

 </head>

 <body>

     <!-- ========== Switcher  ========== -->
     <div class="hs-overlay hidden ti-offcanvas ti-offcanvas-right" id="hs-overlay-switcher" tabindex="-1">
         <div class="ti-offcanvas-header z-10 relative">
             <h5 class="ti-offcanvas-title">
                 Switcher
             </h5>
             <button
                 class="ti-btn flex-shrink-0 p-0 !mb-0  transition-none text-defaulttextcolor dark:text-defaulttextcolor/70 hover:text-gray-700 focus:ring-gray-400 focus:ring-offset-white  dark:hover:text-white/80 dark:focus:ring-white/10 dark:focus:ring-offset-white/10"
                 data-hs-overlay="#hs-overlay-switcher" type="button">
                 <span class="sr-only">Close modal</span>
                 <i class="ri-close-circle-line leading-none text-lg"></i>
             </button>
         </div>
         <div class="ti-offcanvas-body !p-0 !border-b dark:border-white/10 z-10 relative !h-auto">
             <div class="flex rtl:space-x-reverse" aria-label="Tabs" role="tablist">
                 <button
                     class="hs-tab-active:bg-success/20 w-full !py-2 !px-4 hs-tab-active:border-b-transparent text-defaultsize border-0 hs-tab-active:text-success dark:hs-tab-active:bg-success/20 dark:hs-tab-active:border-b-white/10 dark:hs-tab-active:text-success -mb-px bg-white font-semibold text-center  text-defaulttextcolor dark:text-defaulttextcolor/70 rounded-none hover:text-gray-700 dark:bg-bodybg dark:border-white/10  active"
                     id="switcher-item-1" data-hs-tab="#switcher-1" type="button" aria-controls="switcher-1"
                     role="tab">
                     Theme Style
                 </button>
                 <button
                     class="hs-tab-active:bg-success/20 w-full !py-2 !px-4 hs-tab-active:border-b-transparent text-defaultsize border-0 hs-tab-active:text-success dark:hs-tab-active:bg-success/20 dark:hs-tab-active:border-b-white/10 dark:hs-tab-active:text-success -mb-px  bg-white font-semibold text-center  text-defaulttextcolor dark:text-defaulttextcolor/70 rounded-none hover:text-gray-700 dark:bg-bodybg dark:border-white/10  dark:hover:text-gray-300"
                     id="switcher-item-2" data-hs-tab="#switcher-2" type="button" aria-controls="switcher-2"
                     role="tab">
                     Theme Colors
                 </button>
             </div>
         </div>
         <div class="ti-offcanvas-body" id="switcher-body">
             <div class="" id="switcher-1" role="tabpanel" aria-labelledby="switcher-item-1">
                 <div class="">
                     <p class="switcher-style-head">Theme Color Mode:</p>
                     <div class="grid grid-cols-3 switcher-style">
                         <div class="flex items-center">
                             <input class="ti-form-radio" id="switcher-light-theme" type="radio" name="theme-style"
                                 checked>
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-light-theme">Light</label>
                         </div>
                         <div class="flex items-center">
                             <input class="ti-form-radio" id="switcher-dark-theme" type="radio" name="theme-style">
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-dark-theme">Dark</label>
                         </div>
                     </div>
                 </div>
                 <div>
                     <p class="switcher-style-head">Directions:</p>
                     <div class="grid grid-cols-3  switcher-style">
                         <div class="flex items-center">
                             <input class="ti-form-radio" id="switcher-ltr" type="radio" name="direction" checked>
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-ltr">LTR</label>
                         </div>
                         <div class="flex items-center">
                             <input class="ti-form-radio" id="switcher-rtl" type="radio" name="direction">
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-rtl">RTL</label>
                         </div>
                     </div>
                 </div>
                 <div>
                     <p class="switcher-style-head">Navigation Styles:</p>
                     <div class="grid grid-cols-3  switcher-style">
                         <div class="flex items-center">
                             <input class="ti-form-radio" id="switcher-vertical" type="radio" name="navigation-style"
                                 checked>
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-vertical">Vertical</label>
                         </div>
                         <div class="flex items-center">
                             <input class="ti-form-radio" id="switcher-horizontal" type="radio"
                                 name="navigation-style">
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-horizontal">Horizontal</label>
                         </div>
                     </div>
                 </div>
                 <div>
                     <p class="switcher-style-head">Navigation Menu Style:</p>
                     <div class="grid grid-cols-2 gap-2 switcher-style">
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-menu-click" type="radio"
                                 name="navigation-data-menu-styles" checked>
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-menu-click">Menu
                                 Click</label>
                         </div>
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-menu-hover" type="radio"
                                 name="navigation-data-menu-styles">
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-menu-hover">Menu
                                 Hover</label>
                         </div>
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-icon-click" type="radio"
                                 name="navigation-data-menu-styles">
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-icon-click">Icon
                                 Click</label>
                         </div>
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-icon-hover" type="radio"
                                 name="navigation-data-menu-styles">
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-icon-hover">Icon
                                 Hover</label>
                         </div>
                     </div>
                     <div class="px-4 text-secondary text-xs"><b class="me-2">Note:</b>Works same for both Vertical
                         and
                         Horizontal
                     </div>
                 </div>
                 <div class=" sidemenu-layout-styles">
                     <p class="switcher-style-head">Sidemenu Layout Syles:</p>
                     <div class="grid grid-cols-2 gap-2 switcher-style">
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-default-menu" type="radio"
                                 name="sidemenu-layout-styles" checked>
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold "
                                 for="switcher-default-menu">Default
                                 Menu</label>
                         </div>
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-closed-menu" type="radio"
                                 name="sidemenu-layout-styles">
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold "
                                 for="switcher-closed-menu">
                                 Closed
                                 Menu</label>
                         </div>
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-icontext-menu" type="radio"
                                 name="sidemenu-layout-styles">
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold "
                                 for="switcher-icontext-menu">Icon
                                 Text</label>
                         </div>
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-icon-overlay" type="radio"
                                 name="sidemenu-layout-styles">
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold "
                                 for="switcher-icon-overlay">Icon
                                 Overlay</label>
                         </div>
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-detached" type="radio"
                                 name="sidemenu-layout-styles">
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold "
                                 for="switcher-detached">Detached</label>
                         </div>
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-double-menu" type="radio"
                                 name="sidemenu-layout-styles">
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-double-menu">Double
                                 Menu</label>
                         </div>
                     </div>
                     <div class="px-4 text-secondary text-xs"><b class="me-2">Note:</b>Navigation menu styles won't
                         work
                         here.</div>
                 </div>
                 <div>
                     <p class="switcher-style-head">Page Styles:</p>
                     <div class="grid grid-cols-3  switcher-style">
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-regular" type="radio"
                                 name="data-page-styles" checked>
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-regular">Regular</label>
                         </div>
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-classic" type="radio"
                                 name="data-page-styles">
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-classic">Classic</label>
                         </div>
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-modern" type="radio"
                                 name="data-page-styles">
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-modern"> Modern</label>
                         </div>
                     </div>
                 </div>
                 <div>
                     <p class="switcher-style-head">Layout Width Styles:</p>
                     <div class="grid grid-cols-3 switcher-style">
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-full-width" type="radio"
                                 name="layout-width" checked>
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-full-width">FullWidth</label>
                         </div>
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-boxed" type="radio" name="layout-width">
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-boxed">Boxed</label>
                         </div>
                     </div>
                 </div>
                 <div>
                     <p class="switcher-style-head">Menu Positions:</p>
                     <div class="grid grid-cols-3  switcher-style">
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-menu-fixed" type="radio"
                                 name="data-menu-positions" checked>
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-menu-fixed">Fixed</label>
                         </div>
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-menu-scroll" type="radio"
                                 name="data-menu-positions">
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-menu-scroll">Scrollable </label>
                         </div>
                     </div>
                 </div>
                 <div>
                     <p class="switcher-style-head">Header Positions:</p>
                     <div class="grid grid-cols-3 switcher-style">
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-header-fixed" type="radio"
                                 name="data-header-positions" checked>
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-header-fixed">
                                 Fixed</label>
                         </div>
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-header-scroll" type="radio"
                                 name="data-header-positions">
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-header-scroll">Scrollable
                             </label>
                         </div>
                     </div>
                 </div>
                 <div class="">
                     <p class="switcher-style-head">Loader:</p>
                     <div class="grid grid-cols-3 switcher-style">
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-loader-enable" type="radio"
                                 name="page-loader" checked>
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-loader-enable">
                                 Enable</label>
                         </div>
                         <div class="flex">
                             <input class="ti-form-radio" id="switcher-loader-disable" type="radio"
                                 name="page-loader">
                             <label
                                 class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"
                                 for="switcher-loader-disable">Disable
                             </label>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="hidden" id="switcher-2" role="tabpanel" aria-labelledby="switcher-item-2">
                 <div class="theme-colors">
                     <p class="switcher-style-head">Menu Colors:</p>
                     <div class="flex switcher-style space-x-3 rtl:space-x-reverse">
                         <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                             <input class="hs-tooltip-toggle ti-form-radio color-input color-white"
                                 id="switcher-menu-light" type="radio" name="menu-colors" checked>
                             <span
                                 class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                 role="tooltip">
                                 Light Menu
                             </span>
                         </div>
                         <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                             <input class="hs-tooltip-toggle ti-form-radio color-input color-dark"
                                 id="switcher-menu-dark" type="radio" name="menu-colors" checked>
                             <span
                                 class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                 role="tooltip">
                                 Dark Menu
                             </span>
                         </div>
                         <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                             <input class="hs-tooltip-toggle ti-form-radio color-input color-primary"
                                 id="switcher-menu-primary" type="radio" name="menu-colors">
                             <span
                                 class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                 role="tooltip">
                                 Color Menu
                             </span>
                         </div>
                         <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                             <input class="hs-tooltip-toggle ti-form-radio color-input color-gradient"
                                 id="switcher-menu-gradient" type="radio" name="menu-colors">
                             <span
                                 class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                 role="tooltip">
                                 Gradient Menu
                             </span>
                         </div>
                         <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                             <input class="hs-tooltip-toggle ti-form-radio color-input color-transparent"
                                 id="switcher-menu-transparent" type="radio" name="menu-colors">
                             <span
                                 class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                 role="tooltip">
                                 Transparent Menu
                             </span>
                         </div>
                     </div>
                     <div class="px-4 text-[#8c9097] dark:text-white/50 text-[.6875rem]"><b class="me-2">Note:</b>If
                         you want to change color Menu
                         dynamically
                         change from below Theme Primary color picker.</div>
                 </div>
                 <div class="theme-colors">
                     <p class="switcher-style-head">Header Colors:</p>
                     <div class="flex switcher-style space-x-3 rtl:space-x-reverse">
                         <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                             <input class="hs-tooltip-toggle ti-form-radio color-input color-white !border"
                                 id="switcher-header-light" type="radio" name="header-colors" checked>
                             <span
                                 class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                 role="tooltip">
                                 Light Header
                             </span>
                         </div>
                         <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                             <input class="hs-tooltip-toggle ti-form-radio color-input color-dark"
                                 id="switcher-header-dark" type="radio" name="header-colors">
                             <span
                                 class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                 role="tooltip">
                                 Dark Header
                             </span>
                         </div>
                         <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                             <input class="hs-tooltip-toggle ti-form-radio color-input color-primary"
                                 id="switcher-header-primary" type="radio" name="header-colors">
                             <span
                                 class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                 role="tooltip">
                                 Color Header
                             </span>
                         </div>
                         <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                             <input class="hs-tooltip-toggle ti-form-radio color-input color-gradient"
                                 id="switcher-header-gradient" type="radio" name="header-colors">
                             <span
                                 class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                 role="tooltip">
                                 Gradient Header
                             </span>
                         </div>
                         <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                             <input class="hs-tooltip-toggle ti-form-radio color-input color-transparent"
                                 id="switcher-header-transparent" type="radio" name="header-colors">
                             <span
                                 class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                 role="tooltip">
                                 Transparent Header
                             </span>
                         </div>
                     </div>
                     <div class="px-4 text-[#8c9097] dark:text-white/50 text-[.6875rem]"><b class="me-2">Note:</b>If
                         you want to change color
                         Header dynamically
                         change from below Theme Primary color picker.</div>
                 </div>
                 <div class="theme-colors">
                     <p class="switcher-style-head">Theme Primary:</p>
                     <div class="flex switcher-style space-x-3 rtl:space-x-reverse">
                         <div class="ti-form-radio switch-select">
                             <input class="ti-form-radio color-input color-primary-1" id="switcher-primary"
                                 type="radio" name="theme-primary" checked>
                         </div>
                         <div class="ti-form-radio switch-select">
                             <input class="ti-form-radio color-input color-primary-2" id="switcher-primary1"
                                 type="radio" name="theme-primary">
                         </div>
                         <div class="ti-form-radio switch-select">
                             <input class="ti-form-radio color-input color-primary-3" id="switcher-primary2"
                                 type="radio" name="theme-primary">
                         </div>
                         <div class="ti-form-radio switch-select">
                             <input class="ti-form-radio color-input color-primary-4" id="switcher-primary3"
                                 type="radio" name="theme-primary">
                         </div>
                         <div class="ti-form-radio switch-select">
                             <input class="ti-form-radio color-input color-primary-5" id="switcher-primary4"
                                 type="radio" name="theme-primary">
                         </div>
                         <div class="ti-form-radio switch-select ps-0 mt-1 color-primary-light">
                             <div class="theme-container-primary"></div>
                             <div class="pickr-container-primary"></div>
                         </div>
                     </div>
                 </div>
                 <div class="theme-colors">
                     <p class="switcher-style-head">Theme Background:</p>
                     <div class="flex switcher-style space-x-3 rtl:space-x-reverse">
                         <div class="ti-form-radio switch-select">
                             <input class="ti-form-radio color-input color-bg-1" id="switcher-background"
                                 type="radio" name="theme-background" checked>
                         </div>
                         <div class="ti-form-radio switch-select">
                             <input class="ti-form-radio color-input color-bg-2" id="switcher-background1"
                                 type="radio" name="theme-background">
                         </div>
                         <div class="ti-form-radio switch-select">
                             <input class="ti-form-radio color-input color-bg-3" id="switcher-background2"
                                 type="radio" name="theme-background">
                         </div>
                         <div class="ti-form-radio switch-select">
                             <input class="ti-form-radio color-input color-bg-4" id="switcher-background3"
                                 type="radio" name="theme-background">
                         </div>
                         <div class="ti-form-radio switch-select">
                             <input class="ti-form-radio color-input color-bg-5" id="switcher-background4"
                                 type="radio" name="theme-background">
                         </div>
                         <div class="ti-form-radio switch-select ps-0 mt-1 color-bg-transparent">
                             <div class="theme-container-background hidden"></div>
                             <div class="pickr-container-background"></div>
                         </div>
                     </div>
                 </div>
                 <div class="menu-image theme-colors">
                     <p class="switcher-style-head">Menu With Background Image:</p>
                     <div class="flex switcher-style space-x-3 rtl:space-x-reverse flex-wrap gap-3">
                         <div class="ti-form-radio switch-select">
                             <input class="ti-form-radio bgimage-input bg-img1" id="switcher-bg-img" type="radio"
                                 name="theme-images">
                         </div>
                         <div class="ti-form-radio switch-select">
                             <input class="ti-form-radio bgimage-input bg-img2" id="switcher-bg-img1" type="radio"
                                 name="theme-images">
                         </div>
                         <div class="ti-form-radio switch-select">
                             <input class="ti-form-radio bgimage-input bg-img3" id="switcher-bg-img2" type="radio"
                                 name="theme-images">
                         </div>
                         <div class="ti-form-radio switch-select">
                             <input class="ti-form-radio bgimage-input bg-img4" id="switcher-bg-img3" type="radio"
                                 name="theme-images">
                         </div>
                         <div class="ti-form-radio switch-select">
                             <input class="ti-form-radio bgimage-input bg-img5" id="switcher-bg-img4" type="radio"
                                 name="theme-images">
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="ti-offcanvas-footer sm:flex justify-between">
             <a class="w-full ti-btn ti-btn-danger-full m-1" id="reset-all" href="javascript:void(0);">Reset</a>
         </div>
     </div>
     <!-- ========== END Switcher  ========== -->

     <!-- Loader -->
     <div id="loader">
         <img src="{{ asset('assets/images/media/loader.svg') }}" alt="loader">
     </div>
     <!-- Loader -->

     <div class="page">

         <!-- Start::Header -->
         @include('layouts.admin.header')
         <!-- End::Header -->

         <!-- Start::app-sidebar -->
         @include('layouts.admin.sidebar')
         <!-- End::app-sidebar -->

         <div class="content main-index">

             <!-- Start::main-content -->
             <div class="main-content">
                 @yield('content')

             </div>
             <!-- end::main-content -->

         </div>
         <!-- ========== Search Modal ========== -->
         <div class="hs-overlay ti-modal hidden mt-[1.75rem]" id="search-modal">
             <div class="ti-modal-box">
                 <div
                     class="ti-modal-content !border !border-defaultborder dark:!border-defaultborder/10 !rounded-[0.5rem]">
                     <div class="ti-modal-body">

                         <div class="input-group border-[2px] border-primary rounded-[0.25rem] w-full flex">
                             <a class="input-group-text flex items-center bg-light border-e-[#dee2e6] !py-[0.375rem] !px-[0.75rem] !rounded-none !text-[0.875rem]"
                                 id="Search-Grid" aria-label="anchor" href="javascript:void(0);"><i
                                     class="fe fe-search header-link-icon text-[0.875rem]"></i></a>

                             <input class="form-control border-0 px-2 !text-[0.8rem] w-full focus:ring-transparent"
                                 type="search" placeholder="Search" aria-label="Username">

                             <a class="flex items-center input-group-text bg-light !py-[0.375rem] !px-[0.75rem] !border-e-0"
                                 id="voice-search" aria-label="anchor" href="javascript:void(0);"><i
                                     class="fe fe-mic header-link-icon"></i></a>
                             <div class="hs-dropdown ti-dropdown">
                                 <a class="flex items-center hs-dropdown-toggle ti-dropdown-toggle btn btn-light btn-icon !bg-light !py-[0.375rem] !rounded-none !px-[0.75rem] text-[0.95rem] h-[2.413rem] w-[2.313rem]"
                                     aria-label="anchor" href="javascript:void(0);">
                                     <i class="fe fe-more-vertical"></i>
                                 </a>

                                 <ul class="absolute hs-dropdown-menu ti-dropdown-menu !-mt-2 !p-0 hidden">
                                     <li><a class="ti-dropdown-item flex text-defaulttextcolor dark:text-defaulttextcolor/70 !py-[0.5rem] !px-[0.9375rem] !text-[0.8125rem] font-medium"
                                             href="javascript:void(0);">Action</a></li>
                                     <li><a class="ti-dropdown-item flex text-defaulttextcolor dark:text-defaulttextcolor/70 !py-[0.5rem] !px-[0.9375rem] !text-[0.8125rem] font-medium"
                                             href="javascript:void(0);">Another action</a></li>
                                     <li><a class="ti-dropdown-item flex text-defaulttextcolor dark:text-defaulttextcolor/70 !py-[0.5rem] !px-[0.9375rem] !text-[0.8125rem] font-medium"
                                             href="javascript:void(0);">Something else here</a></li>
                                     <li>
                                         <hr class="dropdown-divider">
                                     </li>
                                     <li><a class="ti-dropdown-item flex text-defaulttextcolor dark:text-defaulttextcolor/70 !py-[0.5rem] !px-[0.9375rem] !text-[0.8125rem] font-medium"
                                             href="javascript:void(0);">Separated link</a></li>
                                 </ul>
                             </div>
                         </div>
                         <div class="mt-5">
                             <p
                                 class="font-normal  text-[#8c9097] dark:text-white/50 text-[0.813rem] dark:text-gray-200 mb-2">
                                 Are You Looking For...</p>

                             <span
                                 class="search-tags text-[0.75rem] !py-[0rem] !px-[0.55rem] dark:border-defaultborder/10"><i
                                     class="fe fe-user me-2"></i>People<a class="tag-addon header-remove-btn"
                                     href="javascript:void(0)"><span class="sr-only">Remove badge</span><i
                                         class="fe fe-x"></i></a></span>
                             <span
                                 class="search-tags text-[0.75rem] !py-[0rem] !px-[0.55rem] dark:border-defaultborder/10"><i
                                     class="fe fe-file-text me-2"></i>Pages<a class="tag-addon header-remove-btn"
                                     href="javascript:void(0)"><span class="sr-only">Remove badge</span><i
                                         class="fe fe-x"></i></a></span>
                             <span
                                 class="search-tags text-[0.75rem] !py-[0rem] !px-[0.55rem] dark:border-defaultborder/10"><i
                                     class="fe fe-align-left me-2"></i>Articles<a class="tag-addon header-remove-btn"
                                     href="javascript:void(0)"><span class="sr-only">Remove badge</span><i
                                         class="fe fe-x"></i></a></span>
                             <span
                                 class="search-tags text-[0.75rem] !py-[0rem] !px-[0.55rem] dark:border-defaultborder/10"><i
                                     class="fe fe-server me-2"></i>Tags<a class="tag-addon header-remove-btn"
                                     href="javascript:void(0)"><span class="sr-only">Remove badge</span><i
                                         class="fe fe-x"></i></a></span>

                         </div>

                         <div class="my-[1.5rem]">
                             <p class="font-normal  text-[#8c9097] dark:text-white/50 text-[0.813rem] mb-2">Recent
                                 Search :</p>

                             <div class="!p-2 border dark:border-defaultborder/10 rounded-[0.3125rem] flex items-center text-defaulttextcolor dark:text-defaulttextcolor/70 !mb-2 !text-[0.8125rem] alert"
                                 id="dismiss-alert" role="alert">
                                 <a href="notifications.html"><span>Notifications</span></a>
                                 <a class="ms-auto leading-none" data-hs-remove-element="#dismiss-alert"
                                     aria-label="anchor" href="javascript:void(0);"><i
                                         class="fe fe-x !text-[0.8125rem] text-[#8c9097] dark:text-white/50"></i></a>
                             </div>

                             <div class="!p-2 border dark:border-defaultborder/10 rounded-[0.3125rem] flex items-center text-defaulttextcolor dark:text-defaulttextcolor/70 !mb-2 !text-[0.8125rem] alert"
                                 id="dismiss-alert-1" role="alert">
                                 <a href="alerts.html"><span>Alerts</span></a>
                                 <a class="ms-auto leading-none" data-hs-remove-element="#dismiss-alert-1"
                                     aria-label="anchor" href="javascript:void(0);"><i
                                         class="fe fe-x !text-[0.8125rem] text-[#8c9097] dark:text-white/50"></i></a>
                             </div>

                             <div class="!p-2 border dark:border-defaultborder/10 rounded-[0.3125rem] flex items-center text-defaulttextcolor dark:text-defaulttextcolor/70 !mb-0 !text-[0.8125rem] alert"
                                 id="dismiss-alert-2" role="alert">
                                 <a href="mail.html"><span>Mail</span></a>
                                 <a class="ms-auto lh-1" data-hs-remove-element="#dismiss-alert-2"
                                     aria-label="anchor" href="javascript:void(0);"><i
                                         class="fe fe-x !text-[0.8125rem] text-[#8c9097] dark:text-white/50"></i></a>
                             </div>
                         </div>
                     </div>

                     <div class="ti-modal-footer !py-[1rem] !px-[1.25rem]">
                         <div class="inline-flex rounded-md  shadow-sm">
                             <button
                                 class="ti-btn-group !px-[0.75rem] !py-[0.45rem]  rounded-s-[0.25rem] !rounded-e-none ti-btn-primary !text-[0.75rem] dark:border-white/10"
                                 type="button">
                                 Search
                             </button>
                             <button
                                 class="ti-btn-group  ti-btn-primary-full rounded-e-[0.25rem] dark:border-white/10 !text-[0.75rem] !rounded-s-none !px-[0.75rem] !py-[0.45rem]"
                                 type="button">
                                 Clear Recents
                             </button>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!-- ========== END Search Modal ========== -->

         <!-- Footer Start -->
         @include('layouts.admin.footer')
         <!-- Footer End -->

     </div>

     <!-- Back To Top -->
     <div class="scrollToTop">
         <span class="arrow"><i class="ri-arrow-up-s-fill text-xl"></i></span>
     </div>

     <div id="responsive-overlay"></div>

     <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

     <script src="{{ asset('assets/libs/preline/preline.js') }}"></script>

     <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>

     <script src="{{ asset('assets/js/defaultmenu.js') }}"></script>

     <script src="{{ asset('assets\libs\apexcharts\apexcharts.min.js') }}"></script>

     <script src="{{ asset('assets\libs\chart.js\chart.min.js') }}"></script>

     <script src="{{ asset('assets/js/custom-switcher.js') }}"></script>

     <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
     <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
     <script src="{{ asset('assets/js/date-time_pickers.js') }}"></script>
     <script src="{{ asset('assets/js/fancybox.min.js') }}"></script>
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
     <script src="{{ asset('assets/js/select2.js') }}"></script>
     @livewireScripts

     <script>
         $('.delete_button').click(function(e) {
             e.preventDefault();
             swal({
                     title: `Are you sure?`,
                     text: "If you delete this, it will be gone forever.",
                     icon: "warning",
                     buttons: true,
                     dangerMode: true,
                 })
                 .then((willDelete) => {
                     if (willDelete) {
                         $(this).closest("form").submit();
                     }
                 });

         });

         $(function() {
             $(".image").on("change", function() {
                 var nthis = $(this);
                 if (nthis.siblings('.old-image').length) {
                     nthis.siblings('.old-image').hide();
                 }
                 if (this.files && this.files[0]) {
                     var reader = new FileReader();
                     reader.onload = function(e) {
                         nthis.siblings('.view-image').attr('src', e.target.result);
                     };
                     reader.readAsDataURL(this.files[0]);
                 }
             });
         });
     </script>

     @yield('scripts')

 </body>

 </html>
