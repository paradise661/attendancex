   <header class="app-header">
       <nav class="main-header !h-[3.75rem]" aria-label="Global">
           <div class="main-header-container ps-[0.725rem] pe-[1rem] ">
               <div class="header-content-left">
                   <div class="header-element">
                       <div class="horizontal-logo">
                           <a class="header-logo" href="{{ route('dashboard') }}">
                               <img class="desktop-logo" src="{{ asset('assets/images/brand-logos/desktop-logo.png') }}"
                                   alt="logo">
                               <img class="toggle-logo" src="{{ asset('assets/images/brand-logos/toggle-logo.png') }}"
                                   alt="logo">
                               <img class="desktop-dark" src="{{ asset('assets/images/logo.png') }}" alt="logo">
                               <img class="toggle-dark" src="{{ asset('assets/images/brand-logos/toggle-dark.png') }}"
                                   alt="logo">
                               <img class="desktop-white"
                                   src="{{ asset('assets/images/brand-logos/desktop-white.png') }}" alt="logo">
                               <img class="toggle-white" src="{{ asset('assets/images/brand-logos/toggle-white.png') }}"
                                   alt="logo">
                           </a>
                       </div>
                   </div>
                   <div class="header-element md:px-[0.325rem] !items-center">
                       <a class="sidemenu-toggle animated-arrow  hor-toggle horizontal-navtoggle inline-flex items-center"
                           aria-label="Hide Sidebar" href="javascript:void(0);"><span></span></a>
                   </div>
               </div>

               <div class="header-content-right">
                   <!-- light and dark theme -->
                   <div
                       class="header-element header-theme-mode hidden !items-center sm:block !py-[1rem] md:!px-[0.65rem] px-2">
                       <a class="hs-dark-mode-active:hidden flex hs-dark-mode group flex-shrink-0 justify-center items-center gap-2  rounded-full font-medium transition-all text-xs dark:bg-bgdark dark:hover:bg-black/20 dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10"
                           data-hs-theme-click-value="dark" aria-label="anchor" href="javascript:void(0);">
                           <i class="bx bx-moon header-link-icon"></i>
                       </a>
                       <a class="hs-dark-mode-active:flex hidden hs-dark-mode group flex-shrink-0 justify-center items-center gap-2  rounded-full font-medium text-defaulttextcolor  transition-all text-xs dark:bg-bodybg dark:bg-bgdark dark:hover:bg-black/20 dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10"
                           data-hs-theme-click-value="light" aria-label="anchor" href="javascript:void(0);">
                           <i class="bx bx-sun header-link-icon"></i>
                       </a>
                   </div>
                   <!-- End light and dark theme -->

                   <!--Header Notifictaion -->
                   @php $notifications = getNotification() @endphp
                   <div
                       class="header-element py-[1rem] md:px-[0.65rem] px-2 notifications-dropdown header-notification hs-dropdown ti-dropdown !hidden md:!block [--placement:bottom-left]">
                       <button
                           class="hs-dropdown-toggle relative ti-dropdown-toggle !p-0 !border-0 flex-shrink-0  !rounded-full !shadow-none align-middle text-xs"
                           id="dropdown-notification" type="button">
                           <i class="bx bx-bell header-link-icon  text-[1.125rem]"></i>
                           @if (getNotification()->where('is_seen', 0)->count() > 0)
                               <span class="flex absolute h-5 w-5 -top-[0.25rem] end-0  -me-[0.6rem]">
                                   <span
                                       class="animate-slow-ping absolute inline-flex -top-[2px] -start-[2px] h-full w-full rounded-full bg-secondary/40 opacity-75"></span>
                                   <span
                                       class="relative inline-flex justify-center items-center rounded-full  h-[14.7px] w-[14px] bg-secondary text-[0.625rem] text-white"
                                       id="notification-icon-badge">{{ getNotification()->where('is_seen', 0)->count() }}
                                   </span>
                           @endif
                       </button>
                       <div class="main-header-dropdown !-mt-3 !p-0 hs-dropdown-menu ti-dropdown-menu bg-white !w-[22rem] border-0 border-defaultborder hidden !m-0"
                           aria-labelledby="dropdown-notification">

                           <div class="ti-dropdown-header !m-0 !p-4 !bg-transparent flex justify-between items-center">
                               <p
                                   class="mb-0 text-[1.0625rem] text-defaulttextcolor font-semibold dark:text-[#8c9097] dark:text-white/50">
                                   Notifications</p>
                               @if (getNotification()->where('is_seen', 0)->count() > 0)
                                   <span
                                       class="text-[0.75em] py-[0.25rem/2] px-[0.45rem] font-[600] rounded-sm bg-secondary/10 text-secondary"
                                       id="notifiation-data">{{ getNotification()->where('is_seen', 0)->count() }}
                                       Unread</span>
                               @endif
                           </div>
                           <div class="dropdown-divider"></div>
                           @if (getNotification()->count() > 0)
                               <ul class="list-none !m-0 !p-0 end-0" id="header-notification-scroll">
                                   @foreach (getNotification(limit: 5) as $notification)
                                       <li
                                           class="ti-dropdown-item dropdown-item !block  {{ $notification->is_seen == 0 ? 'bg-gray-200' : 'bg-transparent' }}">
                                           <div class="flex items-start">
                                               <div class="pe-2">
                                                   <span
                                                       class="inline-flex text-pinkmain justify-center items-center !w-[2.5rem] !h-[2.5rem] !leading-[2.5rem] !text-[0.8rem]  bg-pinkmain/10 rounded-[50%]">
                                                       <i class="ti ti-bell text-[1.125rem]"></i></span>
                                               </div>
                                               <div class="grow flex items-center justify-between">
                                                   <div>
                                                       <p
                                                           class="mb-0 text-defaulttextcolor dark:text-white text-[0.8125rem] font-semibold">
                                                           <a
                                                               href="{{ $notification->type == 'Attendance'
                                                                   ? route('attendance.request.edit', $notification->entity_id) . '?notification_id=' . $notification->id
                                                                   : route('leaves.edit', $notification->entity_id) . '?notification_id=' . $notification->id }}">
                                                               {{ $notification->message ?? '' }}
                                                           </a>
                                                       </p>
                                                       <span
                                                           class="text-[#8c9097] dark:text-white/50 font-normal text-[0.75rem] header-notification-text">{{ $notification->created_at ? $notification->created_at->diffForHumans() : '' }}</span>
                                                   </div>
                                                   <div>
                                                       <a class="min-w-fit text-[#8c9097] dark:text-white/50 me-1 dropdown-item-close1"
                                                           aria-label="anchor"
                                                           href="{{ $notification->type == 'Attendance'
                                                               ? route('attendance.request.edit', $notification->entity_id) . '?notification_id=' . $notification->id
                                                               : route('leaves.edit', $notification->entity_id) . '?notification_id=' . $notification->id }}"></a>
                                                   </div>
                                               </div>
                                           </div>
                                       </li>
                                   @endforeach
                               </ul>

                               <div class="p-4 empty-header-item1 border-t mt-2">
                                   <div class="grid">
                                       <a class="ti-btn ti-btn-primary-full !m-0 w-full p-2"
                                           href="{{ route('notification.index') }}">View
                                           All</a>
                                   </div>
                               </div>
                           @else
                               <div class="p-[3rem] empty-item1">
                                   <div class="text-center">
                                       <span
                                           class="!h-[4rem]  !w-[4rem] avatar !leading-[4rem] !rounded-full !bg-secondary/10 !text-secondary">
                                           <i class="ri-notification-off-line text-[2rem]  "></i>
                                       </span>
                                       <h6 class="font-semibold mt-3 text-defaulttextcolor dark:text-white text-[1rem]">
                                           No New Notifications</h6>
                                   </div>
                               </div>
                           @endif
                       </div>
                   </div>
                   <!--End Header Notifictaion -->

                   <!-- Header Profile -->
                   <div
                       class="header-element md:!px-[0.65rem] px-2 hs-dropdown !items-center ti-dropdown [--placement:bottom-left]">

                       <button
                           class="hs-dropdown-toggle ti-dropdown-toggle !gap-2 !p-0 flex-shrink-0 sm:me-2 me-0 !rounded-full !shadow-none text-xs align-middle !border-0 !shadow-transparent "
                           id="dropdown-profile" type="button">
                           <img class="inline-block rounded-full" src="{{ asset('assets/images/faces/9.jpg') }}"
                               width="32" height="32" alt="Image Description">
                       </button>
                       <div class="md:block hidden dropdown-profile">
                           <p class="font-semibold mb-0 leading-none text-[#536485] text-[0.813rem] ">
                               {{ Auth::user()->first_name ?? '' }} {{ Auth::user()->last_name ?? '' }}
                           </p>
                       </div>
                       <div class="hs-dropdown-menu ti-dropdown-menu !-mt-3 border-0 w-[11rem] !p-0 border-defaultborder hidden main-header-dropdown  pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                           aria-labelledby="dropdown-profile">

                           <ul class="text-defaulttextcolor font-medium dark:text-[#8c9097] dark:text-white/50">
                               @can('change password')
                                   <li>
                                       <a class="w-full ti-dropdown-item !text-[0.8125rem] !gap-x-0  !p-[0.65rem] !inline-flex"
                                           href="{{ route('change.password') }}">
                                           <i class="ti ti-lock text-[1.125rem] me-2 opacity-[0.7]"></i>Change
                                           Password
                                       </a>
                                   </li>
                               @endcan

                               <li>
                                   <a class="w-full ti-dropdown-item !text-[0.8125rem] !p-[0.65rem] !gap-x-0 !inline-flex"
                                       href="javascript:void(0)"><i
                                           class="ti ti-headset text-[1.125rem] me-2 opacity-[0.7]"></i>Support</a>
                               </li>
                               <li>
                                   <a class="w-full ti-dropdown-item !text-[0.8125rem] !p-[0.65rem] !gap-x-0 !inline-flex"
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                           class="ti ti-logout text-[1.125rem] me-2 opacity-[0.7]"></i>Log
                                       Out</a>
                               </li>
                               <form class="d-none" id="logout-form" action="{{ route('logout') }}" method="POST">
                                   @csrf
                               </form>
                           </ul>
                       </div>
                   </div>
                   <!-- End Header Profile -->

                   <!-- Switcher Icon -->
                   <div class="header-element md:px-[0.48rem]">
                       <button
                           class="hs-dropdown-toggle switcher-icon inline-flex flex-shrink-0 justify-center items-center gap-2  rounded-full font-medium  align-middle transition-all text-xs dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10"
                           data-hs-overlay="#hs-overlay-switcher" aria-label="button" type="button">
                           <i class="bx bx-cog header-link-icon animate-spin-slow"></i>
                       </button>
                   </div>
                   <!-- Switcher Icon -->

                   <!-- End::header-element -->
               </div>
           </div>
       </nav>
   </header>
