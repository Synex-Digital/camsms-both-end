<!DOCTYPE html>
<html lang="en">
<head>
    @include('dashboard.layouts.headerlink')
</head>
<body>

    @include('dashboard.layouts.header')

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        @include('dashboard.layouts.footer')

        <!--**********************************
        Support ticket button start
        ***********************************-->

        <!--**********************************
        Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    @yield('script')
    @include('dashboard.layouts.footerlink')
    
</body>
</html>