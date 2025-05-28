@extends('frontend.master')
@section('content')
    <style>
        .card {
            min-height: 165px;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    </style>
    <!-- Wrapper -->
    <div class="course-video-player-page">
        <!-- Sidebar -->
        <nav class="navbar-vertical navbar bg-white customeNavbar">
        </nav>
        <!-- Page Content -->
        <main id="page-content">
            <!-- Page Header -->
            <!-- Container fluid -->
            <div>
                <h4 id="selected-title" style="padding-left: 24px; padding-bottom:0.9rem"></h4>
            </div>
            <section class="pb-8">
                <div class="container">
                    <div class="card" style="min-height: auto !important">
                        <!-- Card body -->
                        <div class="p-4">
                            <h4 class="mb-0">Sub E-Mentors Name - {{$data['subEmentorName']}}</h4>
                            <div>
                                <div class="d-flex justify-content-between">
                                    <h3 class="mb-0">Sub E-Mentors Exams </h3>
                                    <a href="{{route('sub-ementors-list')}}" class="btn btn-outline-primary btn-sm me-2" style="height: fit-content">Back</a>
                                    {{-- <button class="btn btn-outline-primary btn-sm">back</Base></button> --}}
                                </div>
                                <span>View the list of exams that have been checked and are pending approval, as well as the exams that have been approved.</span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="container mt-3">

                    <div class="row mb-4">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card flex-grow-1 mt-2">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Total Amounts</h5>
                                    <p class="student-card-number text-primary">€{{ $data['totalAmounts'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card flex-grow-1 mt-2">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Approved Amounts</h5>
                                    <p class="student-card-number text-success">€{{ $data['approvedAmounts'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card flex-grow-1 mt-2">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Pending Amounts</h5>
                                    <p class="student-card-number text-danger">€{{ $data['pendingAmounts'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 mb-4 mb-lg-0">
                            <!-- Card -->
                            <div class="card rounded-3">
                                <!-- Card header -->
                                <div class="card-header border-bottom-0 p-0">
                                    <div>
                                        <div class="table-responsive">
                                            <!-- Nav tabs with existing classes -->
                                            <ul class="nav nav-lb-tab studentTab" id="tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" id="pending-tab" data-bs-toggle="tab"
                                                        href="#pending" role="tab" aria-controls="pending"
                                                        aria-selected="true">Pending</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="approved-tab" data-bs-toggle="tab"
                                                        href="#approved" role="tab" aria-controls="approved"
                                                        aria-selected="true">Approved</a>
                                                </li>
                                            </ul>
                                            <div class="container">
                                                <div class="row justify-content-start mt-3">
                                                    <div class="col-12 col-md-6 col-lg-4 mt-2 mt-lg-0">
                                                        <form class="d-flex align-items-center">
                                                            <span class="position-absolute ps-3 search-icon">
                                                                <i class="fe fe-search"></i>
                                                            </span>
                                                            <input type="search" class="form-control ps-6 searchSection"
                                                                placeholder="Search Here" id="searchInput">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-between">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="tab-content" id="tabContent">
                                        <!-- Pending Tab -->
                                        <div class="tab-pane fade show active" id="pending" role="tabpanel"
                                            aria-labelledby="pending-tab">
                                            <div class="table-responsive">
                                                <table
                                                    class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 pendingExamList"
                                                    width="100%">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Exam</th>
                                                            <th>Student Name</th>
                                                            <th>Amount</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Approved Tab -->
                                        <div class="tab-pane fade" id="approved" role="tabpanel"
                                            aria-labelledby="approved-tab">
                                            <div class="table-responsive">
                                                <table
                                                    class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 approvedExamList"
                                                    width="100%">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Exam</th>
                                                            <th>Student Name</th>
                                                            <th>Amount</th>
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
                </div>  
            </section>
        </main>

        <!-- Approve Modal -->
        <div class="modal fade" id="approveExamModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="approveModalLabel">Approve Exam</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Enter Amount</label>
                            <input type="number" class="form-control w-auto" id="amount" placeholder="Enter Amount" />
                        </div>
                    </div>
                    <input type="text" id="scmId" hidden>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary ApproveExam">Done</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reject Modal -->
        <div class="modal fade" id="rejectExamModal" tabindex="-1" aria-labelledby="rejectReasonModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectReasonModalLabel">Reject Exam</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="rejectExamId">
                        <div class="mb-3">
                            <label for="rejectReason" class="form-label">Reason for Rejection</label>
                            <textarea class="form-control" id="rejectReason" rows="3" name="rejectReason"
                                placeholder="Enter reason here"></textarea>
                        </div>
                        <input type="text" id="student_course_master_id" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="rejectExam">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/js/examCommon.js') }}"></script>
    <script>
        $(document).ready(function() {
            var subEmentorId = @json($subEmentorId);
            getExamPendingForApprovalList(subEmentorId);

            $("#pending-tab").on("click", function(event) {
                getExamPendingForApprovalList(subEmentorId);
            });
            $("#approved-tab").on("click", function(event) {
                getExamApprovedList(subEmentorId);
            });
        });

        // Pending For Approval
        function getExamPendingForApprovalList(subEmentorId) {
            $.ajax({
                url: "/ementor/subementor-checked-exams/" + subEmentorId,
                type: "GET",
                success: function(data) {
                    $(".pendingExamList").DataTable().destroy();
                    $(".pendingExamList").DataTable({
                        data: data.checkedExams,

                        columns: [{
                                data: null,
                                render: function(data, type, full, row) {
                                    i = row.row + 1;
                                    return i;
                                }
                            },
                            {
                                data: null,
                                render: function(data, type, full, row) {
                                    if (data.exam_title) {
                                        var examTitle = data.exam_title;

                                        return examTitle;
                                    } else {
                                        return '<span class="text-muted">No Data Available</span>';
                                    }
                                },
                            },
                            {
                                data: null,
                                render: function(data, type, full, row) {
                                    if (data.student_name) {
                                        var studentName = data.student_name;

                                        return studentName;
                                    } else {
                                        return '';
                                    }
                                },
                            },
                            {
                                data: null,
                                render: function(data, type, full, row) {
                                    if (data.exam_amount) {
                                        var examAmount = data.exam_amount;

                                        return examAmount;
                                    } else {
                                        return '<span class="text-muted">Amount Not Added</span>';
                                    }
                                },
                            },
                            {
                                data: null,
                                render: function(data, type, full, row) {
                                    if (data.exam_amount) {
                                        let acceptButton = `
                                        <button class="btn btn-outline-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#approveExamModal" 
                                            data-exam-id="${data.id}"  
                                            data-exam-amount="${data.exam_amount}" 
                                            onclick="setAmount(this)">
                                            Accept
                                        </button>
                                    `;

                                        let rejectButton = '';
                                        if (data.approved_status !== 2) {
                                            rejectButton = `
                                            <button class="btn btn-outline-primary"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#rejectExamModal" 
                                                data-exam-id="${data.id}"  
                                                onclick="examReject(this)">
                                                Reject
                                            </button>
                                        `;
                                        }

                                        return `
                                        <td>
                                            <span>${acceptButton}</span>
                                            <span>${rejectButton}</span>
                                        </td>
                                    `;
                                    } else {
                                        return '<span class="text-muted">Amount Not Added</span>';
                                    }
                                },
                                orderable: false,
                            }
                        ],
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Approved Exam
        function getExamApprovedList(subEmentorId) {
            $.ajax({
                url: "/ementor/subementor-approved-exams/" + subEmentorId,
                type: "GET",
                success: function(data) {
                    $(".approvedExamList").DataTable().destroy();
                    $(".approvedExamList").DataTable({
                        data: data.approvedExams,

                        columns: [{
                                data: null,
                                render: function(data, type, full, row) {
                                    i = row.row + 1;
                                    return i;
                                }
                            },
                            {
                                data: null,
                                render: function(data, type, full, row) {
                                    if (data.exam_title) {
                                        var examTitle = data.exam_title;

                                        return examTitle;
                                    } else {
                                        return '<span class="text-muted">No Data Available</span>';
                                    }
                                },
                            },
                            {
                                data: null,
                                render: function(data, type, full, row) {
                                    if (data.student_name) {
                                        var studentName = data.student_name;

                                        return studentName;
                                    } else {
                                        return '';
                                    }
                                },
                            },
                            {
                                data: null,
                                render: function(data, type, full, row) {
                                    if (data.approved_amount) {
                                        var approvedAmount = data.approved_amount;

                                        return approvedAmount;
                                    } else {
                                        return '<span class="text-muted">Amount Not Added</span>';
                                    }
                                },
                            },
                        ],
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // set approve amount
        function setAmount(button) {
            var examId = $(button).data('exam-id');
            var examAmount = $(button).data('exam-amount');

            $('#amount').val(examAmount);
            $('#amount').attr('max', examAmount);
            $('#scmId').val(examId);

            // $('#amount').on('input', function () {
            //     var currentValue = parseFloat($(this).val());
            //     var maxValue = parseFloat($(this).attr('max'));

            //     if (currentValue > maxValue) {
            //         swal("Error!", "The entered amount cannot be greater than " + maxValue, "error");
            //         $(this).val(maxValue);
            //     }
            // });
        }

        // exam reject
        function examReject(button) {
            var scmId = $(button).data('exam-id');
            $('#student_course_master_id').val(btoa(scmId));
        }

        $('.searchSection').on('keyup', function() {
            var table = $('.pendingExamList').DataTable();
            var searchTerm = $(this).val();
            table.search(searchTerm).draw();
        });

        $('.searchSection').on('keyup', function() {
            var table = $('.approvedExamList').DataTable();
            var searchTerm = $(this).val();
            table.search(searchTerm).draw();
        });
    </script>
@endsection
