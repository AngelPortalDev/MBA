<!-- Header import -->
@extends('admin.layouts.main')
@section('content')
    <style>
        .verified-iconstyle {
            background: #E0F8F9;
            color: #2ECA6A;
            height: 66px;
            width: 66px;
            border-radius: 50%;
        }

        .verified-student-card {
            border: 1px solid transparent;
            transition: border 0.3s ease;
        }

        .verified-student-card:hover {
            border: 1px solid #2ECA6A;
        }

        .enrolled-iconstyle {
            background: #F6F6FE;
            color: #4154F1;
            height: 66px;
            width: 66px;
            border-radius: 50%;
        }

        .enrolledstudentCard {
            border: 1px solid transparent;
            transition: border 0.3s ease;
        }

        .enrolledstudentCard:hover {
            border: 1px solid #4154F1;
        }

        .excelIconstyle {
            background: #ffecdf;
            color: #ff771d;
            height: 66px;
            width: 66px;
            border-radius: 50%;
        }

        .excel-card {
            border: 1px solid transparent;
            transition: border 0.3s ease;
        }

        .excel-card:hover {
            border: 1px solid #ff771d;
        }

        .cardIconHeight {
            min-height: 190px;
        }
    </style>

    <!-- Container fluid -->
    <section class="container-fluid p-4">
        <div class="row justify-content-between ">
            <!-- Page Header -->
            <div class="col-lg-4 col-12">
                <div class=" pb-3 mb-3 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Students Reports
                            <span class="fs-5">({{ isset($data['totalStudentsCount']) ? $data['totalStudentsCount'] : 0 }})</span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Students Reports</a></li>
                                <!-- <li class="breadcrumb-item active" aria-current="page">All Admin</li> -->
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">


                    </div>
                </div>
            </div>
            <!-- <form class="d-flex align-items-center col-12 col-lg-3"> -->
            {{-- <div class="col-lg-8 col-12 text-end pt-2">
                    <div>
                          <!-- Button With Icon -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-modal">
                            Create <i class="fe fe-plus ms-1"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary ">
                            Delete <i class="fe fe-trash ms-1"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary ">
                            Import <i class="fe fe-download ms-1"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary ">
                            Export <i class="fe fe-upload ms-1"></i>
                        </button>

                    </div>
                </div> --}}

        </div>

        <div class="container p-4 mb-3">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card text-center shadow-lg enrolledstudentCard">
                        <div class="card-body cardIconHeight">
                            <div class="rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people fs-2 enrolled-iconstyle"></i>
                            </div>
                            <h5 class="card-title mt-3">Total Active Students</h5>
                            <p class="card-text fs-3 text-primary fw-semibold">
                                {{ isset($data['totalStudentsCount']) ? $data['totalStudentsCount'] : 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card text-center shadow-lg verified-student-card">
                        <div class="card-body cardIconHeight">
                            <div class="rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-check fs-2 verified-iconstyle"></i>
                            </div>
                            <h5 class="card-title mt-3">Verified Student</h5>
                            <p class="card-text fs-3 text-primary fw-semibold">
                                {{ isset($data['totalEnrolledStudentsCount']) ? $data['totalEnrolledStudentsCount'] : 0 }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card text-center shadow-lg excel-card">
                        <div class="card-body cardIconHeight">
                            <div class="rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-filetype-exe fs-2 excelIconstyle"></i>
                            </div>

                            <h5 class="card-title mt-3">
                                {{-- <button class="btn btn-primary"> Download Students Report <i
                                        class="bi bi-download ms-1"></i> </button> --}}
                                        
                                <form id="exportFormWithoutFilter" action="{{ route('export') }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="where" value="">
                                    <input type="hidden" name="export" value="studentReportData">
                                </form>
                                        
                                <button id="exportButtonWithoutFilter" class="btn btn-primary">
                                    Download Students Report <i class="bi bi-download ms-1"></i>
                                </button>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Card -->
                <div class="card rounded-3">
                    <!-- Card Header -->
                    <div class="p-4 row border-bottom">
                        <div class="card-header p-0 col-12 col-md-7 col-lg-2 border-bottom-0">
                            <!-- Card Header Content (if any) -->
                        </div>
                    
                        <!-- Form -->
                        <div class="col-12 col-md-8 col-lg-10 p-3">
                            <div class="row justify-content-end d-flex">
                                <!-- Search Form -->
                                <div class="col-auto">
                                    <form class="d-flex align-items-center mb-0 mb-xlx-2">
                                        <span class="position-absolute ps-3 search-icon">
                                            <i class="fe fe-search"></i>
                                        </span>
                                        <input type="search" class="form-control ps-6 searchStudent" id="searchInput" placeholder="Search Here">
                                    </form>
                                </div>
                    
                                <!-- Date Input and Export Button -->
                                <div class="col-auto d-flex align-items-center mt-2 mt-xxl-0">
                                    <form id="exportForm" action="{{ route('export') }}" method="POST" class="d-flex flex-column flex-md-row align-items-baseline">
                                        @csrf
                                        <div class="me-2 mb-2 mb-md-0">
                                            <input type="date" id="start_date" name="start_date" class="form-control" aria-label="Start Date" placeholder="From Date" required>
                                        </div>
                                        <div class="me-2 mb-2 mb-md-0">
                                            <input type="date" id="end_date" name="end_date" class="form-control" aria-label="End Date" placeholder="To Date" required>
                                        </div>
                                        <button type="button" id="clearButton" class="btn btn-outline-secondary mb-2 mb-md-0" style="width: max-content">
                                            Clear <i class="fe fe-x ms-1 "></i>
                                        </button>
                                        <input type="hidden" name="export" value="studentReportData">
                                        <button id="exportButton" class="btn btn-outline-primary ms-2" style="white-space: nowrap">
                                            Export <i class="fe fe-upload ms-1"></i>
                                        </button>
                                        
                                        
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    



                    <div>
                        <div class="tab-content" id="tabContent">
                            <!-- Tab -->

                            <!-- All Students Tab  -->
                            <div class="tab-pane fade active show" id="all-students" role="tabpanel"
                                aria-labelledby="all-students-tab">
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                    <table
                                        class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover studentList w-100">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Roll No.</th>
                                                <th>Name</th>
                                                <th>Identity Type</th>
                                                <th>Identity Number</th>
                                                <th>Status</th>
                                                <th>Enrolled</th>
                                                <th>Course Name</th>
                                                <th>Exam</th>
                                                <th>Is Expired</th>
                                                <th>Purchase Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
    </main>


    <script src="{{ asset('admin/js/export.js') }}"></script>
    <script>
        $(document).ready(function() {
            
            studentList();
            handleSearchInput('searchInput', studentList);
        });

        $('#checkAll').click(function (e) {
            $('.studentList tbody :checkbox').prop('checked', $(this).is(':checked'));
            e.stopImmediatePropagation();
        });
    
        function studentList(action = '') {
            $("#processingLoader").fadeIn();
            var baseUrl = window.location.origin + "/";
            $(".loader").removeClass("d-none");
            $.ajax({
                url: baseUrl + "admin/students-report-data",
                method: "GET",
                success: function(data) {
                    $("#processingLoader").fadeOut();
                    $('.studentList').DataTable().clear().destroy();
                    $("#count").html("(" + data.length + ")");
                    $(".studentList").DataTable({
                        data: data,
                        columns: [
                            {
                                data: "id",
                                render: function(data, type, full, meta) {
                                    return meta.row + 1 + '.';
                                },
                                width: '0%'
                            },
                            {
                                data: null,
                                render: function(data, type, full, row) {
                                    return data.roll_no;
                                },
                                width: '10%'
                            },
                            {
                                data: null,
                                render: function(row) {
                                    var Studentid = btoa(row.id);
                                    var name = row.name ? row.name + ' ' + row.last_name : '';
                                    var profileUrl = baseUrl + 'admin/students-edit-view/' +
                                        Studentid;
                                    var img = row.photo ? baseUrl + 'storage/' + row.photo :
                                        baseUrl +
                                        'storage/studentDocs/student-profile-photo.png';

                                    var statusBadge = row.is_active == 'Active' ?
                                        '<span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>' :
                                        '<span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>';

                                    return (
                                        "<div class='d-flex align-items-center'>" +
                                        "<img src='" + img +
                                        "' alt='' class='rounded-circle avatar-md me-2'>" +
                                        "<h5 class='mb-0'>" +
                                        "<a href='" + profileUrl + "'>" + name + "</a> " +
                                        statusBadge +
                                        "</h5></div>"
                                    );
                                },
                                width: '15%',
                            },
                            {
                                data: null,
                                render: function(data, type, full, row) {
                                    return data.identity_doc_type;
                                },
                                width: '10%'
                            },
                            {
                                data: null,
                                render: function(data, type, full, row) {
                                    return data.identity_doc_number;
                                },
                                width: '10%'
                            },
                            {
                                data: null,
                                render: function(data) {
                                    var status = data.is_verified ? data.is_verified : '';
                                    if (status === "Verified") {
                                        return (
                                            "<span class='badge text-success bg-light-success'>" +
                                            status +
                                            "</span>"
                                        );
                                    }
                                    if (status === "Pending") {
                                        return (
                                            '<span class="badge text-warning bg-light-warning">' +
                                            status +
                                            "</span>"
                                        );
                                    }
                                    if (status === "Unverified") {
                                        return (
                                            '<span class="badge text-danger bg-light-danger">' +
                                            status +
                                            "</span>"
                                        );
                                    } else {
                                        return (
                                            '<span class="badge text-secondary bg-light-secondary">' +
                                            status +
                                            "</span>"
                                        );
                                    }
                                },
                                width: '15%',
                            },
                            {
                                data: null,
                                render: function(row) {
                                    return row.allPaidCourses.length;
                                },
                                width: '30%',
                            },
                            {
                                data: null,
                                render: function(row) {
                                    var courseTitles = [];
                                    let badge = '';
                                    if (row.allPaidCourses && row.allPaidCourses.length > 0) {
                                        row.allPaidCourses.forEach(function(course, index) {
                                            // courseTitles += `<p class="pt-2 mb-1">${index + 1}. ${course.course_title}</p>`;
                                            courseTitles += `<div class="some-class"><p class="text-wrap-title" style="line-height:1.6rem">${index + 1}. ${course.course_title}</p></div>`;
                                            if (index < row.allPaidCourses.length - 1) {
                                                courseTitles += '';
                                            }
                                        });
                                    }
                                    return courseTitles;

                                },
                                width: '30%',
                            },
                            {
                                data: null,
                                render: function(row) {
                                    var courseTitles = '';
                                    let badge = '';
                                    if (row.allPaidCourses && row.allPaidCourses.length > 0) {
                                        row.allPaidCourses.forEach(function(course, index) {
                                            let examData = row.examResults && row.examResults[course.scmId] ? row.examResults[course.scmId] : null;

                                            if (examData) {
                                                badge = `<span class="badge bg-${examData.color}">${examData.result} ${examData.percent ? examData.percent + '%' : ''}</span>`;
                                            } else {
                                                badge = `<span class="badge bg-primary">Not Attempt</span>`;
                                            }

                                            // courseTitles += `${badge}`;
                                            // courseTitles += `${badge}`;
                                            // courseTitles += `<p class="pt-2 mb-1"> ${badge}</p>`;
                                            
                                            courseTitles += `<div class="wrapper-class" style="line-height:1.6rem"><p class="">${badge}</p></div>`;

                                            if (index < row.allPaidCourses.length - 1) {
                                                courseTitles += '';
                                            }
                                        });
                                    }
                                    return courseTitles;
                                },
                                width: '30%',
                            },
                            {
                                data: null,
                                render: function(row) {
                                    var expiries = '';
                                    let badge = '';
                                    if (row.allPaidCourses && row.allPaidCourses.length > 0) {
                                        row.allPaidCourses.forEach(function(course, index) {
                                            let today = new Date();
                                            let adjustedExpiryDate = new Date(course.adjusted_expiry);
                                            let isExpired = (adjustedExpiryDate < today) || 
                                                            (course.exam_attempt_remain === 0) ||
                                                            (course.exam_remark === '1');

                                            if (isExpired) {
                                                badge = `<span class="badge bg-primary">Yes</span>`;  // Expired
                                            } else {
                                                badge = `<span class="badge bg-primary">No</span>`;   // Not expired
                                            }

                                            // expiries += `${badge}`;
                                            // expiries += `<div class=""><p class="mb-1 pt-2">${badge}</p>`;
                                                expiries += `<div class="wrapper-class" style="line-height:1.6rem"><p class="">${badge}</p></div>`;

                                            if (index < row.allPaidCourses.length - 1) {
                                                expiries += '';
                                            }
                                        });
                                    }
                                    return expiries;
                                },
                                width: '30%',
                            },
                            {
                                data: null,
                                render: function(row) {
                                    var purchaseDates = '';
                                    if (row.allPaidCourses && row.allPaidCourses.length > 0) {
                                        row.allPaidCourses.forEach(function(course, index) {
                                            // purchaseDates += `<p class="pt-2 mb-1">${course.course_start_date}</p>`; 
                                            purchaseDates += `<div class="dateclass" style="line-height:1.6rem">` +
                                                                     `<p>${course.course_start_date}</p>` +
                                                              `</div>`;
                                            if (index < row.allPaidCourses.length - 1) {
                                                purchaseDates += '';
                                            }
                                        });
                                    }
                                    return purchaseDates;
                                },
                                width: '30%',
                            }

                        ],
                    });
                },
                error: function(xhr, status, error) {
                    $("#processingLoader").fadeOut();
                    console.error(error);
                },
            });
        }

        $('.searchStudent').on('keyup', function() {    
            var table = $('.studentList').DataTable();
            var searchTerm = $(this).val();
            table.search(searchTerm).draw();
        });
        $('#clearButton').on('click', function () {
            $('#exportForm')[0].reset();
            $('#exportForm input').removeClass('is-invalid');
            $('#exportForm .invalid-feedback').remove();
        });
    </script>
@endsection
