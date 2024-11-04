

<aside id="sidebar" class="sidebar">


    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ url()->current() == route('admin.dashboard') ? '' : 'collapsed' }}"
                href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @if ($profileData->controller_role != 'General')
            <li class="nav-item">
                <a class="nav-link {{ url()->current() == route('notice.create') || url()->current() == route('notice.index') ? '' : 'collapsed' }}"
                    data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Notice</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav"
                    class="nav-content {{ url()->current() == route('notice.create') || url()->current() == route('notice.index') ? '' : 'collapse' }} "
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="{{ url()->current() == route('notice.create') ? 'active' : '' }}"
                            href="{{ route('notice.create') }}">
                            <i class="bi bi-circle"></i><span>Add Notice</span>
                        </a>
                    </li>
                    <li>
                        <a class=" {{ url()->current() == route('notice.index') ? 'active' : '' }}"
                            href="{{ route('notice.index') }}">
                            <i class="bi bi-circle"></i><span>Update Notice</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Notice Nav -->

            <li class="nav-item">
                <a class="nav-link {{ url()->current() == route('event.create') || url()->current() == route('event.index') ? '' : 'collapsed' }}"
                    data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-calendar-date"></i><span>Events</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav"
                    class="nav-content {{ url()->current() == route('event.create') || url()->current() == route('event.index') ? '' : 'collapse' }}  "
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a class=" {{ url()->current() == route('event.create') ? 'active' : '' }}"
                            href="{{ route('event.create') }}">
                            <i class="bi bi-circle"></i><span>Add Events</span>
                        </a>
                    </li>
                    <li>
                        <a class=" {{ url()->current() == route('event.index') ? 'active' : '' }}"
                            href="{{ route('event.index') }}">
                            <i class="bi bi-circle"></i><span>Update Events</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Events Nav -->

            <li class="nav-item">
                <a class="nav-link nav-link {{ url()->current() == route('questionPaper.index') || url()->current() == route('questionPaper.create') ? '' : 'collapsed' }}"
                    data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Question Bank</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>


                <ul id="tables-nav"
                    class="nav-content {{ url()->current() == route('questionPaper.index') || url()->current() == route('questionPaper.create') ? '' : 'collapse' }}  "
                    data-bs-parent="#sidebar-nav">


                    <li>
                        <a class="{{ url()->current() == route('questionPaper.create') ? 'active' : '' }}"
                            href="{{ route('questionPaper.create') }}">
                            <i class="bi bi-circle"></i><span>Add Question Papers</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ url()->current() == route('questionPaper.index') ? 'active' : '' }}"
                            href="{{ route('questionPaper.index') }}">
                            <i class="bi bi-circle"></i><span>Update Question Papers</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Academic Nav -->


            <li class="nav-item">
                <a class="nav-link nav-link {{ url()->current() == route('admin.carousel-img') || url()->current() == route('admin.carousel-img.add') ? '' : 'collapsed' }}"
                    data-bs-target="#components-nav-carousel" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-card-image"></i><span>Homepage Images</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav-carousel"
                    class="nav-content {{ url()->current() == route('admin.carousel-img') || url()->current() == route('admin.carousel-img.add') ? '' : 'collapse' }}  "
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="{{ url()->current() == route('admin.carousel-img.add') ? 'active' : '' }}"
                            href="{{ route('admin.carousel-img.add') }}">
                            <i class="bi bi-circle"></i><span>Add Homepage Image</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ url()->current() == route('admin.carousel-img') ? 'active' : '' }}"
                            href="{{ route('admin.carousel-img') }}">
                            <i class="bi bi-circle"></i><span>Update Homepage Images</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Notice Nav -->

            <li class="nav-item">
                <a class="nav-link {{ url()->current() == route('admin.specialNews') ? '' : 'collapsed' }}"
                    href="{{ route('admin.specialNews') }}">
                    <i class=" bi bi-newspaper"></i>
                    <span>Special News</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ url()->current() == route('DeptInfo') ? '' : 'collapsed' }}"
                    href="{{ route('DeptInfo') }}">
                    <i class="ri-coin-line"></i>
                    <span>Dept Attributes</span>
                </a>
            </li>
        @endif


        <!-- End Icons Nav -->

        <li class="nav-heading">Profile Settings</li>

        <li class="nav-item">
            <a class="nav-link {{ url()->current() == route('admin.profile') ? '' : 'collapsed' }}"
                href="{{ route('admin.profile') }}">
                <i class="ri-account-circle-line"></i>
                <span>Profile</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ url()->current() == route('awards.index') || url()->current() == route('awards.create') ? '' : 'collapsed' }}"
                href="{{ route('awards.index') }}">
                <i class="bi bi-award"></i>
                <span>Awards</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ url()->current() == route('educations.index') || url()->current() == route('educations.create') ? '' : 'collapsed' }}"
                href="{{ route('educations.index') }}">
                <i class="bi bi-journal-bookmark-fill"></i>
                <span>Education</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ url()->current() == route('ShowAllExperience') || url()->current() == route('addExperience') || url()->current() == route('addOtherExperience') ? '' : 'collapsed' }}"
                href="{{ route('ShowAllExperience') }}">
                <i class="bi bi-briefcase"></i>
                <span>Experience</span>
            </a>
        </li>



        <li class="nav-item">
            <a class="nav-link {{ url()->current() == route('publications.index') || url()->current() == route('publications.create') || url()->current() == route('AllResearchProfile') || url()->current() == route('admin.researchInt') ? '' : 'collapsed' }} "
                data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="ri-search-eye-line"></i><span>Research</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav"
                class="nav-content {{ url()->current() == route('publications.index') || url()->current() == route('publications.create') || url()->current() == route('AllResearchProfile') || url()->current() == route('admin.researchInt') ? '' : 'collapse' }} "
                data-bs-parent="#sidebar-nav">

                {{-- <li>
                        <a href="{{ route('ShowAllExperience') }}">
                            <i class="bi bi-circle"></i><span>Experiences</span>
                        </a>
                    </li> --}}
                <li>
                    <a class=" {{ url()->current() == route('publications.index') || url()->current() == route('publications.create') ? 'active' : '' }}"
                        href="{{ route('publications.index') }}">
                        <i class="bi bi-circle"></i><span>Publication/Project</span>
                    </a>
                </li>
                <li>
                    <a class="{{ url()->current() == route('AllResearchProfile') ? 'active' : '' }}"
                        href="{{ route('AllResearchProfile') }}">
                        <i class="bi bi-circle"></i><span>Research Profile</span>
                    </a>
                </li>

                <li>
                    <a class="{{ url()->current() == route('admin.researchInt') ? 'active' : '' }}"
                        href="{{ route('admin.researchInt') }}">
                        <i class="bi bi-circle"></i><span>Research Interest</span>
                    </a>
                </li>
            </ul>
        </li>


        @if ($profileData->controller_role == 'Admin')
            <br>
            <li class="nav-heading">Administration</li>

            <li class="nav-item">
                <a class="nav-link {{ url()->current() == route('admin.ControlAllUser') ? '' : 'collapsed' }}"
                    href="{{ route('admin.ControlAllUser') }}">
                    <i class="ri-admin-line"></i>
                    <span>User Menagement</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link {{ url()->current() == route('chairmanMessage') ? '' : 'collapsed' }}"
                    href="{{ route('chairmanMessage') }}">
                    <i class="ri-message-3-line"></i>
                    <span>Chairman Info</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ url()->current() == route('filerepository.index') || url()->current() == route('filerepository.create') ? '' : 'collapsed' }}"
                    href="{{ route('filerepository.index') }}">
                    <i class="ri-file-cloud-line"></i>
                    <span>File Repository</span>
                </a>
            </li>

<br><br>
        @endif



    </ul>

</aside>
