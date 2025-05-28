@extends('frontend.master')
@section('content')
    <style>
        .sidenav.navbar .navbar-nav .e-men-9>.nav-link {
            background-color: var(--gk-gray-200);
        }
        .view-details:hover{
            color: white !important;
        }
    </style>

    <main>
        <section class="pt-5 pb-5">
            <div class="container">

                <!-- Top Menubar -->
                @include('frontend.teacher.layout.e-mentor-common')

                <div class="col-lg-9 col-md-8 col-12">
                    <!-- Card -->
                    <div class="card mb-4">
                        <!-- Card body -->
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">Sub E-Mentors</h3>
                                <span>Meet the sub-mentors to whom you assign exams.</span>
                            </div>

                        </div>
                    </div>
                    <!-- Tab content -->

                    <!-- Tab pane -->
                    <div class="card">
                        <div class="card-header border-bottom-0">
                            <div>
                                <div>
                                    <form class="row gx-3">
                                        <div class="col-lg-4 col-md-7 col-12 mb-lg-0 mb-2">
                                            <input type="search" class="form-control searchSubementor" placeholder="Search by name">
                                        </div>
                                        {{-- <div class="col-lg-3 col-md-5 col-12">
                                            <select class="form-select">
                                                <option value="">Date Created</option>
                                                <option value="Newest">Newest</option>
                                                <option value="High Earned">Award</option>
                                                <option value="High Earned">Certificate</option>
                                                <option value="High Earned">Diploma</option>
                                                <option value="High Earned">Masters</option>
                                            </select>
                                        </div> --}}
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover table-centered text-nowrap subEmentorList">
                                <thead class="table-light">
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<script>

    $(document).ready(function () {
        subEmentorList();
    });
    
    function subEmentorList() {
        $(".dataTables_filter").css('display', 'none');
        var baseUrl = window.location.origin;
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var userRole = "{{ Auth::user()->role }}";

        let url;
        if (userRole === 'instructor') {
            url = baseUrl + "/ementor/get-subementor-list";
        }
        $("#processingLoader").fadeIn();

        $.ajax({
            url: url,
            method: 'GET',
            success: function(data) {
                $("#processingLoader").fadeOut();
                $(".subEmentorList").DataTable().destroy();
                $(".subEmentorList").DataTable({
                    data: data.subEmentors, 

                    columns: [
                        {
                            data: null,
                            render: function(data, type, full, row) {
                                i = row.row + 1;
                                return i;
                            }
                        },
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                if (userRole === "sub-instructor") {
                                    data = data["user_data"];
                                }

                                if (data && data.user.name) {
                                    var firstName = data.user.name || "";
                                    var lastName = data.user.last_name || "";
                                    var imageUrl = data.photo
                                        ? baseUrl + "/storage/" + data.user.photo
                                        : baseUrl + "/storage/studentDocs/student-profile-photo.png";

                                    return `
                                        <div class="d-flex align-items-center">
                                            <img src="${imageUrl}" alt="" class="rounded-circle avatar-md me-2">
                                            <h5 class="mb-0 color-blue" style="margin-top:-10px;">${firstName} ${lastName}</h5>
                                        </div>
                                    `;
                                } else {
                                    return '<span class="text-muted">No Data Available</span>';
                                }
                            },
                            width: "80%",
                        },
                        {
                            data: null,
                            render: function (data, type, full, meta) {
                                var id = btoa(data.sub_ementor_id);
                                
                                return `
                                    <button class="btn btn-outline-primary" style="padding: 6px 12px;">
                                        <a href="sub-ementors-exam-list-details/${id}" class="view-details" style="text-decoration: none; color: inherit;">
                                            View
                                        </a>
                                    </button>
                                `;
                            },
                            orderable: false,
                            width: "10%",
                        },
                    ],
                });
            },
            error: function(xhr, status, error) {
                $("#processingLoader").fadeOut();
                console.error(error);
            }
        });
    }
    
    $('.searchSubementor').on('keyup', function() {
        var table = $('.subEmentorList').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });

</script>
@endsection
