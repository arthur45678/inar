<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">

            {{--Settings--}}
            <div class="sidenav-menu-heading">Կարգավորումներ</div>
            <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="nav-link-icon"><i data-feather="layout"></i></div>
                Կարգավորումներ
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
                    @can('settings-create')
                        <a class="nav-link" href="{{ route('admin.settings.generalSettings') }}">Գլխավոր կարգավորումները</a>
                    @endcan

                    @can('role-list')
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-role7" aria-expanded="false" aria-controls="collapse-role7">
                            Դերեր
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-role7" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.roles.index') }}">
                                    Բոլոր դերերը
                                </a>
                                @can('menu-create')
                                    <a class="nav-link" href="{{ route('admin.roles.create') }}">Ավելացնել դեր</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan

                    @can('menu-list')
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse--footerBottomMenu77" aria-expanded="false" aria-controls="collapse--footerBottomMenu77">
                            Մենյու
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse--footerBottomMenu77" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.menus.index') }}">
                                    Բոլոր հղումները
                                </a>
                                @can('menu-create')
                                    <a class="nav-link" href="{{ route('admin.menus.selectLanguage') }}">Ավելացնել նոր հղում</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan

                        {{--Menu--}}
                        @can('menu-list')
                            <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-menu_top" aria-expanded="false" aria-controls="collapse-menu_top">
                                Ներքևի Մենյու (Վերևի հատված)
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapse-menu_top" data-parent="#accordionSidenavLayout">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('admin.footerTopmenus.index') }}">
                                        Ներքևի Մենյու (Վերևի հատված)
                                    </a>
                                    @can('menu-create')
                                        <a class="nav-link" href="{{ route('admin.footerTopmenus.selectLanguage') }}">Ավելացնել նոր հղում</a>
                                    @endcan
                                </nav>
                            </div>
                        @endcan

                    {{--Menu--}}
                    @can('menu-list')
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-menu_top" aria-expanded="false" aria-controls="collapse-menu_top">
                            Ներքևի Մենյու (ներքևի հատված)
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-menu_top" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.footerBottomMenus.index') }}">
                                    Ներքևի Մենյու (ներքևի հատված)
                                </a>
                                @can('menu-create')
                                    <a class="nav-link" href="{{ route('admin.footerBottomMenus.selectLanguage') }}">Ավելացնել նոր հղում</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan
                    @can('menu-list')
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-footerSocialLinksMenus77" aria-expanded="false" aria-controls="collapse-footerSocialLinksMenus77">
                            Ներքևի Մենյու (սոցիալական ցանցի հղումներ)
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-footerSocialLinksMenus77" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.footerSocialLinksMenus.index') }}">
                                    Բոլոր հղումները
                                </a>
                                @can('menu-create')
                                    <a class="nav-link" href="{{ route('admin.footerSocialLinksMenus.index') }}">Ավելացնել նոր հղում</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan
                </nav>
            </div>

            {{--Settings  end--}}

            <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-homePages" aria-expanded="false" aria-controls="collapse-homePages">
                <div class="nav-link-icon"><i data-feather="layout"></i></div>
                Գլխավոր էջ
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapse-homePages" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-sliders" aria-expanded="false" aria-controls="collapse-sliders">
                        Սլայդեր
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    @can('sliders-list')
                        <div class="collapse" id="collapse-sliders" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.sliders.index') }}">Բոլոր սլայդերը</a>
                                @can('sliders-create')
                                    <a class="nav-link" href="{{ route('admin.sliders.create') }}">Նոր սլայդ</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan

                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-ourMissionsMenu" aria-expanded="false" aria-controls="collapse-ourMissionsMenu">
                        Our Missions Menu
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    @can('menu-list')
                        <div class="collapse" id="collapse-ourMissionsMenu" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.home.ourMissionsMenus.index') }}">Բոլորը</a>
                                @can('menu-create')
                                    <a class="nav-link" href="{{ route('admin.home.ourMissionsMenus.selectLanguage') }}">Ավելացնել</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan

                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-discovery-armenia" aria-expanded="false" aria-controls="collapse-discovery-armenia">
                        Բացահայտել Հայաստանը
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    @can('posts-list')
                        <div class="collapse" id="collapse-discovery-armenia" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.home.discovery-armenia.index') }}">Բոլորը</a>
                                @can('posts-create')
                                    <a class="nav-link" href="{{ route('admin.home.discovery-armenia.create') }}">Ավելացնել</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan
                    <a class="nav-link" href="{{ route('admin.tweets.index') }}">Twitter</a>
                </nav>
            </div>

            @can('posts-list')
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-galleries" aria-expanded="false" aria-controls="collapse-galleries">
                    <div class="nav-link-icon"><i data-feather="tool"></i></div>
                    Տեսադարան
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapse-galleries" data-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.galleries.index') }}">Բոլոր</a>
                        @can('posts-create')
                            <a class="nav-link" href="{{ route('admin.galleries.create') }}">
                                Ավելացնել
                            </a>
                        @endcan
                    </nav>
                </div>
            @endcan

            @can('posts-list')
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-youtubes" aria-expanded="false" aria-controls="collapse-youtubes">
                    <div class="nav-link-icon"><i data-feather="tool"></i></div>
                    Վիդեոդարան (Youtube)
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapse-youtubes" data-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.youtubes.index') }}">Բոլոր</a>
                        @can('posts-create')
                            <a class="nav-link" href="{{ route('admin.youtubes.create') }}">
                                Ավելացնել
                            </a>
                        @endcan
                    </nav>
                </div>
            @endcan

            @can('posts-list')
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-galleryvideos" aria-expanded="false" aria-controls="collapse-galleryvideos">
                    <div class="nav-link-icon"><i data-feather="tool"></i></div>
                    Վիդեոդարան
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapse-galleryvideos" data-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.videos.index') }}">Բոլոր</a>
                        @can('posts-create')
                            <a class="nav-link" href="{{ route('admin.videos.create') }}">
                                Ավելացնել
                            </a>
                        @endcan
                    </nav>
                </div>
            @endcan

           {{-- --}}{{--Tags--}}{{--
            @can('tags-list')
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseTags" aria-expanded="false" aria-controls="collapseTags">
                    <div class="nav-link-icon"><i data-feather="tool"></i></div>
                    Թեգեր
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseTags" data-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.tags.index') }}">Բոլոր թեգերը</a>
                        @can('tags-create')
                            <a class="nav-link" href="{{ route('admin.tags.create') }}">
                                Ավելացնել թեգ
                            </a>
                        @endcan
                    </nav>
                </div>
            @endcan--}}
            {{--Utilities end--}}
            {{--Utilities--}}
            @can('categories-list')
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-categories" aria-expanded="false" aria-controls="collapse-categories">
                    <div class="nav-link-icon"><i data-feather="tool"></i></div>
                    Բաժիններ
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapse-categories" data-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.categories.index') }}">Բոլոր բաժինները</a>
                        @can('categories-create')
                            <a class="nav-link" href="{{ route('admin.categories.create') }}">
                                Ավելացնել բաժին
                            </a>
                        @endcan
                    </nav>
                </div>
            @endcan
            {{--Utilities end--}}


            {{--Utilities--}}
            @can('posts-list')
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-posts" aria-expanded="false" aria-controls="collapse-posts">
                    <div class="nav-link-icon"><i data-feather="tool"></i></div>
                    Նորություններ <br> Պրեսս-Ռելիզներ
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapse-posts" data-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.articles.index') }}">Բոլոր Նորությունները</a>
                        <a class="nav-link" href="{{ route('admin.articles.pressReleases') }}">Բոլոր Պրեսս-Ռելիզները</a>
                        <a class="nav-link" href="{{ route('newsPage') }}">Գլխավոր Նորությունները</a>
                        <a class="nav-link" href="{{ route('pressReleases') }}">Գլխավոր Պրեսս-Ռելիզները</a>
                        @can('posts-create')
                            <a class="nav-link" href="{{ route('admin.articles.create') }}">
                                Ավելացնել
                            </a>
                        @endcan
                    </nav>
                </div>
            @endcan
            {{--Utilities end--}}


            {{--Utilities--}}
            @can('posts-list')
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-events" aria-expanded="false" aria-controls="collapse-events">
                    <div class="nav-link-icon"><i data-feather="tool"></i></div>
                    Միջոցառումներ
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapse-events" data-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.events.index') }}">Բոլոր միջոցառումները</a>
                        @can('posts-create')
                            <a class="nav-link" href="{{ route('admin.events.create') }}">
                                Ավելացնել Միջոցառում
                            </a>
                        @endcan
                    </nav>
                </div>
            @endcan
            {{--Utilities end--}}


            {{--Utilities--}}
            @can('user-list')
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-user" aria-expanded="false" aria-controls="collapse-user">
                    <div class="nav-link-icon"><i data-feather="tool"></i></div>
                    Ադմիններ
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapse-user" data-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">Բոլոր ադմինները</a>
                        @can('user-create')
                            <a class="nav-link" href="{{ route('admin.users.create') }}">
                                Նոր ադմին
                            </a>
                        @endcan
                    </nav>
                </div>
            @endcan
            {{--Utilities end--}}



            {{--Managers--}}
            @can('managers-list')
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-managers" aria-expanded="false" aria-controls="collapse-managers">
                    <div class="nav-link-icon"><i data-feather="tool"></i></div>
                    Մենեջերներ
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapse-managers" data-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.managers.index') }}">Բոլոր մենեջերները</a>
                        @can('managers-create')
                            <a class="nav-link" href="{{ route('admin.managers.create') }}">
                                Նոր մենեջեր
                            </a>
                        @endcan
                    </nav>
                </div>
            @endcan
            {{--Managers end--}}

            {{--Investors--}}
            @can('investors-list')
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-investors" aria-expanded="false" aria-controls="collapse-investors">
                    <div class="nav-link-icon"><i data-feather="tool"></i></div>
                    Ներդրողներ
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapse-investors" data-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.investors.index') }}">Բոլոր ներդրողները</a>
                        @can('investors-create')
                            <a class="nav-link" href="{{ route('admin.investors.create') }}">
                                Նոր ներդրող
                            </a>
                        @endcan
                    </nav>
                </div>
            @endcan
            {{--Investors end--}}



            {{--notifications--}}
            @can('notifications-view')
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-notifications" aria-expanded="false" aria-controls="collapse-notifications">
                    <div class="nav-link-icon"><i data-feather="tool"></i></div>
                    Ծանուցումներ
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapse-notifications" data-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.notifications.index') }}">Բոլորը</a>
                        @can('notifications-create')
                            <a class="nav-link" href="{{ route('admin.notifications.sendNotification') }}">
                                Ուղարկել ծանուցում
                            </a>
                        @endcan
                    </nav>
                </div>
            @endcan
            {{--notifications end--}}


            <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-pages" aria-expanded="false" aria-controls="collapse-pages">
                <div class="nav-link-icon"><i data-feather="layout"></i></div>
                էջեր
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapse-pages" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-pages-pages-posts" aria-expanded="false" aria-controls="collapse-pages-pages-posts">
                        Սովորական էջ հոդվածների համար նախատեսված
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    @can('posts-list')
                        <div class="collapse" id="collapse-pages-pages-posts" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.pages.pages-posts.index') }}">Բոլորը</a>
                                @can('posts-list')
                                    <a class="nav-link" href="{{ route('admin.pages.pages-posts.create') }}">Ավելացնել</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan

                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-pages-simples" aria-expanded="false" aria-controls="collapse-pages-simples">
                        Սովորական էջ
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    @can('posts-list')
                        <div class="collapse" id="collapse-pages-simples" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.pages.simples.index') }}">Բոլորը</a>
                                @can('posts-list')
                                    <a class="nav-link" href="{{ route('admin.pages.simples.create') }}">Ավելացնել</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan

                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-pages-simples-2" aria-expanded="false" aria-controls="collapse-pages-simples">
                        Սովորական էջ 2
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    @can('posts-list')
                        <div class="collapse" id="collapse-pages-simples-2" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.pages.simples-2.index') }}">Բոլորը</a>
                                @can('posts-list')
                                    <a class="nav-link" href="{{ route('admin.pages.simples-2.create') }}">Ավելացնել</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan


                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-pages-qualities" aria-expanded="false" aria-controls="collapse-pages-qualities">
                        Quality էջ
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    @can('posts-list')
                        <div class="collapse" id="collapse-pages-qualities" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.pages.qualities.index') }}">Բոլորը</a>
                                @can('posts-list')
                                    <a class="nav-link" href="{{ route('admin.pages.qualities.create') }}">Ավելացնել</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan

                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-pages-pageinnovations" aria-expanded="false" aria-controls="collapse-pages-pageinnovations">
                        Innovation էջ
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    @can('posts-list')
                        <div class="collapse" id="collapse-pages-pageinnovations" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.pages.pageinnovations.index') }}">Բոլորը</a>
                                @can('posts-list')
                                    <a class="nav-link" href="{{ route('admin.pages.pageinnovations.create') }}">Ավելացնել</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan

                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-pages-aboutusDepartment" aria-expanded="false" aria-controls="collapse-pages-aboutusDepartment">
                        About Us էջի աշխատակիցների համար ավելացնել բաժանմունք
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    @can('posts-list')
                        <div class="collapse" id="collapse-pages-aboutusDepartment" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.pages.aboutusDepartment.index') }}">Բոլորը</a>
                                @can('posts-list')
                                    <a class="nav-link" href="{{ route('admin.pages.aboutusDepartment.create') }}">Ավելացնել</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan

                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-pages-aboutus" aria-expanded="false" aria-controls="collapse-pages-aboutus">
                        About Us
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    @can('posts-list')
                        <div class="collapse" id="collapse-pages-aboutus" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.pages.aboutus.index') }}">Բոլորը</a>
                                @can('posts-list')
                                    <a class="nav-link" href="{{ route('admin.pages.aboutus.create') }}">Ավելացնել</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan
                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-pages-boardOfTrusteesTeam" aria-expanded="false" aria-controls="collapse-pages-boardOfTrusteesTeam">
                        About Us Our Board of Trustees
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    @can('posts-list')
                        <div class="collapse" id="collapse-pages-boardOfTrusteesTeam" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.pages.boardOfTrusteesTeam.index') }}">Բոլորը</a>
                                @can('posts-list')
                                    <a class="nav-link" href="{{ route('admin.pages.boardOfTrusteesTeam.create') }}">Ավելացնել</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan

                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-pages-talents" aria-expanded="false" aria-controls="collapse-pages-talents">
                        Talents
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    @can('posts-list')
                        <div class="collapse" id="collapse-pages-talents" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.pages.talents.index') }}">Բոլորը</a>
                                @can('posts-list')
                                    <a class="nav-link" href="{{ route('admin.pages.talents.create') }}">Ավելացնել</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan


                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-pages-buisnessEnvioirments" aria-expanded="false" aria-controls="collapse-pages-simples">
                        Business Environment
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    @can('posts-list')
                        <div class="collapse" id="collapse-pages-buisnessEnvioirments" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.pages.buisnessEnvioirments.index') }}">Բոլորը</a>
                                @can('posts-list')
                                    <a class="nav-link" href="{{ route('admin.pages.buisnessEnvioirments.create') }}">Ավելացնել</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan

                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-pages-broshyures" aria-expanded="false" aria-controls="collapse-pages-broshyures">
                        Corporate Brochure
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    @can('posts-list')
                        <div class="collapse" id="collapse-pages-broshyures" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.broshyures.index') }}">Բոլորը</a>
                                @can('posts-list')
                                    <a class="nav-link" href="{{ route('admin.broshyures.create') }}">Ավելացնել</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan
                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-pages-investmentBrochure" aria-expanded="false" aria-controls="collapse-pages-investmentBrochure">
                        Investment Brochure
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    @can('posts-list')
                        <div class="collapse" id="collapse-pages-investmentBrochure" data-parent="#accordionSidenavLayout">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.investmentBrochure.index') }}">Բոլորը</a>
                                @can('posts-list')
                                    <a class="nav-link" href="{{ route('admin.investmentBrochure.create') }}">Ավելացնել</a>
                                @endcan
                            </nav>
                        </div>
                    @endcan

                </nav>
            </div>


            {{--Utilities end--}}
            <a class="nav-link" href="{{ route('admin.charts.index') }}">
                <div class="nav-link-icon"><i data-feather="bar-chart"></i></div>
                Գրաֆիկներ
            </a>
            <a class="nav-link" href="{{ route('admin.map.index') }}">
                <div class="nav-link-icon"><i data-feather="map"></i></div>
                Քարտեզ
            </a>
            <a class="nav-link" href="{{route('admin.region.index')}}">
                <div class="nav-link-icon"><i data-feather="filter"></i></div>
                Մարզեր
            </a>
            <a class="nav-link" href="{{route('admin.calendar.index')}}"  >
                <div class="nav-link-icon"><i data-feather="grid"></i></div>
                Օրացույց
            </a>
            <a class="nav-link" href="{{route('admin.subscribe.index')}}"  >
                <div class="nav-link-icon"><i data-feather="mail"></i></div>
                Subscribe
            </a>
        </div>
    </div>
    <div class="sidenav-footer">
        <!-- <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">Valerie Luna</div>
        </div> -->
    </div>
</nav>
