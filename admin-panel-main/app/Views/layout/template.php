<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo">
                    <p><strong>SlashRTC</strong></p>
                    <!-- <img class="img-fluid" src="https://imgs.search.brave.com/wi5HJslFHaXECdvzL46mrNP7_3PSPNOKYyXc4SDPxXQ/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly96ZW5w/cm9zcGVjdC1wcm9k/dWN0aW9uLnMzLmFt/YXpvbmF3cy5jb20v/dXBsb2Fkcy9waWN0/dXJlcy82MjE0YWVh/YTE4MjE4NTAwMDE1/NmIyODIvcGljdHVy/ZQ.jpeg" alt=""> -->
                </div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="ri-line-chart-fill" style="margin-right:5px"></i>
                                <i class=""></i>
                                Statistics
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                            <i class="ri-window-line" style="margin-right:5px"></i>
                                Projects
                            </a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                             <i class="ri-settings-3-line" style="margin-right:5px"></i>
                                Settings
                            </a>
                        </li>
                    </ul>        </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="" alt="">
                                            <i class="ri-user-line"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <button type="button" tabindex="0" class="dropdown-item">User Account</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                            <a href="<?= base_url("/logout")?>" type="button" tabindex="0" class="dropdown-item">Log Out</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?php echo session()->get('firstname')?>
                                    </div>
                                    <div class="widget-subheading">
                                        Admin
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                        <i class="ri-notification-line" style="padding:6px"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>        </div>
            </div>
        </div>         
        
        
        <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Dashboards</li>
                                <li>
                                    <a href="/users" class="mm-active">
                                        <i class="metismenu-icon"></i>
                                        Agent Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="/">
                                        <i class="metismenu-icon"></i>Team Lead Dasboard
                                    </a>
                                </li>
                                <li>
                                    <a href="/">
                                        <i class="metismenu-icon"></i>Supervisor Dashboard
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Operations</li>
                                <li>
                                    <a href="<?= base_url('/users') ?>">
                                        <i class="ri-group-line" style="margin-right:8px"></i>Users
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('/campaign') ?>">
                                        <i class="ri-calendar-event-line" style="margin-right:6px"></i> Campaign
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('/chat') ?>">
                                    <i class="ri-chat-ai-line" style="margin-right:6px" ></i> Chat
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('/access') ?>">
                                    <i class="ri-government-line" style="margin-right:6px"></i> Access Levels
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Reports</li>
                                <li>
                                    <a href="<?= base_url("/summaryReports/1")?>">
                                        <i class="ri-file-chart-line"  style="margin-right:6px"></i>
                                        Summarize Report
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url("/loggerReports/1")?>">
                                    <i class="ri-file-chart-2-line" style="margin-right:6px" ></i>
                                        </i>Logger Report
                                    </a>
                                </li>
                                <!-- <li>
                                    <a href="forms-controls.html">
                                        <i class="metismenu-icon pe-7s-mouse">
                                        </i>Supervisor Reports
                                    </a>
                                </li> -->
                                <li class="app-sidebar__heading">Contact</li>
                                <li>
                                    <a href="forms-controls.html">
                                        <i class="metismenu-icon">
                                        </i>Forms Validation
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Conversations</li>
                                <li>
                                    <a href="charts-chartjs.html">
                                        <i class="metismenu-icon ">
                                        </i>Sms
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Advanced Settings</li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon">
                                        </i>
                                        SMS
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="components-tabs.html">
                                                <i class="metismenu-icon">
                                                </i>State
                                            </a>
                                        </li>
                                        <li>
                                            <a href="components-tabs.html">
                                                <i class="metismenu-icon">
                                                </i>Call
                                            </a>
                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon">
                                        </i>Email
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Live Monitoring</li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon">
                                        </i>
                                        Call Recordings
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Custom Reports</li>
                            </ul>
                        </div>
                    </div>
</div>