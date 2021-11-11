<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('student_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.student.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('Unverified_student_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student.Unverified") }}" class="c-sidebar-nav-link {{ request()->is("admin/Unverified-student") || request()->is("admin/Unverified-student/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.student.Unverified') }}
                            </a>
                        </li>
                    @endcan
                    @can('unchecked_student_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student.Unchecked") }}" class="c-sidebar-nav-link {{ request()->is("admin/Unchecked-student") || request()->is("admin/Unchecked-student/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.student.Unchecked') }}
                            </a>
                        </li>
                    @endcan
                    @can('binding_student_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student.binding") }}" class="c-sidebar-nav-link {{ request()->is("admin/binding-student") || request()->is("admin/binding-student/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.student.binding') }}
                            </a>
                        </li>
                    @endcan
                    @can('withdrawal_student_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student.withdrawal") }}" class="c-sidebar-nav-link {{ request()->is("admin/withdrawal-student") || request()->is("admin/withdrawal-student/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.student.withdrawal') }}
                            </a>
                        </li>
                    @endcan

                    @can('approved_student_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.student.approved") }}" class="c-sidebar-nav-link {{ request()->is("admin/approved-student") || request()->is("admin/approved-student/*") ? "active" : "" }}">
                                    <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                    </i>
                                    {{ trans('cruds.student.approved') }}
                                </a>
                            </li>
                        @endcan
                    @can('disapproved_student_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.student.disapproved") }}" class="c-sidebar-nav-link {{ request()->is("admin/disapproved-student") || request()->is("admin/disapproved-student/*") ? "active" : "" }}">
                                    <i class="fas fa-mortar-pestle c-sidebar-nav-icon">

                                    </i>
                                    {{ trans('cruds.student.disapproved') }}
                                </a>
                            </li>
                        @endcan
                </ul>
            </li>
        @endcan
        @can('programme_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.programmes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/programmes") || request()->is("admin/programmes/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-clipboard-check c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.programme.title') }}
                </a>
            </li>
        @endcan

        @can('lecture_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.lectures.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/lectures") || request()->is("admin/lectures/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-graduation-cap c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.lecture.title') }}
                </a>
            </li>
        @endcan

        @can('student_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.visitor.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('Unverified_student_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.visitor.Unverified") }}" class="c-sidebar-nav-link {{ request()->is("admin/Unverified-visitor") || request()->is("admin/Unverified-student/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.visitor.Unverified') }}
                            </a>
                        </li>
                    @endcan
                    @can('unchecked_student_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.visitor.Unchecked") }}" class="c-sidebar-nav-link {{ request()->is("admin/Unchecked-visitor") || request()->is("admin/Unchecked-student/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.visitor.Unchecked') }}
                            </a>
                        </li>
                    @endcan
                    @can('approved_student_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.visitor.approved") }}" class="c-sidebar-nav-link {{ request()->is("admin/approved-visitor") || request()->is("admin/approved-visitor/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.visitor.approved') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan




        @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        @can('user_log_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-logs") || request()->is("admin/user-logs/*") ? "active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    Users Log
                </a>
            </li>
        @endcan

        @can('faq_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.faqManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('faq_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('faq_question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqQuestion.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('student_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fas fa-money-bill-wave fa-fw mr-1"></i>
                    {{ trans('cruds.payment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('Unverified_student_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.payments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/payments") || request()->is("admin/payments/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.payment.programs') }}
                            </a>
                        </li>
                    @endcan

                    @can('approved_student_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.payments.lectures") }}" class="c-sidebar-nav-link {{ request()->is("admin/payments") || request()->is("admin/payments/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.payment.lectures') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('content_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/content-categories*") ? "c-show" : "" }} {{ request()->is("admin/content-tags*") ? "c-show" : "" }} {{ request()->is("admin/content-pages*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contentManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('content_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-categories") || request()->is("admin/content-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-tags") || request()->is("admin/content-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentTag.title') }}
                            </a>
                        </li>
                    @endcan

                        @can('blog_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.blogs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/blogs") || request()->is("admin/blogs/*") ? "c-active" : "" }}">
                                    <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                                    </i>
                                    {{ trans('cruds.blog.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('blogscomment_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.blogscomments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/blogscomments") || request()->is("admin/blogscomments/*") ? "c-active" : "" }}">
                                    <i class="fa-fw fas fa-comments c-sidebar-nav-icon">

                                    </i>
                                    {{ trans('cruds.blogscomment.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('content_page_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.content-pages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-pages") || request()->is("admin/content-pages/*") ? "c-active" : "" }}">
                                    <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                                    </i>
                                    {{ trans('cruds.contentPage.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('job_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.jobs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/jobs") || request()->is("admin/jobs/*") ? "c-active" : "" }}">
                                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                    </i>
                                    {{ trans('cruds.job.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('job_application_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.job-applications.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/job-applications") || request()->is("admin/job-applications/*") ? "c-active" : "" }}">
                                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                    </i>
                                    {{ trans('cruds.jobApplication.title') }}
                                </a>
                            </li>
                        @endcan

                </ul>
            </li>
        @endcan

        @can('website_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/headers*") ? "c-show" : "" }} {{ request()->is("admin/home-page-sliders*") ? "c-show" : "" }} {{ request()->is("admin/snippets*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fab fa-adversal c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.website.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">



                    @can('home_page_slider_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.home-page-sliders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/home-page-sliders") || request()->is("admin/home-page-sliders/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-adversal c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.homePageSlider.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('snippet_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.snippets.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/snippets") || request()->is("admin/snippets/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-adversal c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.snippet.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('founder_access')
                        <li class="c-sidebar-nav-item">
                           <a href="{{ route("admin.founders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/founders") || request()->is("admin/founders/*") ? "c-active" : "" }}">
                               <i class="fa-fw fas fa-handshake c-sidebar-nav-icon">
                               </i>
                               {{ trans('cruds.founder.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('coming_soon_access')
                       <li class="c-sidebar-nav-item">
                          <a href="{{ route("admin.coming-soons.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/coming-soons") || request()->is("admin/coming-soons/*") ? "c-active" : "" }}">
                              <i class="fa-fw fab fa-contao c-sidebar-nav-icon">
                              </i>
                              {{ trans('cruds.comingSoon.title') }}
                          </a>
                       </li>
                    @endcan
                        @can('enquiry_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.enquiries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/enquiries") || request()->is("admin/enquiries/*") ? "c-active" : "" }}">
                                    <i class="fa-fw fas fa-question-circle c-sidebar-nav-icon">

                                    </i>
                                    {{ trans('cruds.enquiry.title') }}
                                </a>
                            </li>
                        @endcan
                </ul>
            </li>
        @endcan

        @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">
                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif
                </a>
            </li>
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif


           
            @can('system_email_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fas fa-money-bill-wave fa-fw mr-1"></i>
                    System E-Mails
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('system_email_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.system-emails.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-emails") || request()->is("admin/system-emails/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                List System E-mails
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>
            @endcan



            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>
