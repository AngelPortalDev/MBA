@extends('admin.layouts.main') 
<!-- Load app.js first -->
{{-- <script type="module" src="{{ env('APP_URL') . '/resources/js/app.js' }}" defer></script> --}}
<script type="module" src="https://{{ env('VITE_URL') }}:5173/resources/js/app.js" defer></script>
<!-- Load broadcasting.js -->
<script type="module" src="https://{{ env('VITE_URL') }}:5173/resources/js/broadcasting.js" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        function fetchDashboardData() {
            $.ajax({
                url: '/api/dashboard-data',
                method: 'GET',
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                success: function(data) {
                    $('#total-sales').text(`${data.totalSales}`);
                    $('#percentage-change').text(`${data.percentageChange}%`);
                    $('#total-students').text(`${data.totalActiveStudentsCount}`);
                    $('#enrolled-students').text(`${data.totalCourseSales}`);
                    $('#verified-students').text(`${data.verifiedStudentsCount}`);
                    if (data.latestCourse) {
                        $('#latest-course').text(data.latestCourse.course_title);
                        $('#published-on').text(data.latestCourse.published_on_text);
                        $('#course-ementor-name').text(data.latestCourse.ementor_name);
                    }
                    if (data.latestEnrolledStudent) {
                        $('#enrolled-student-name').text(data.latestEnrolledStudent.name);
                    }
                    if (data.ementorData) {
                        $('#ementor-name').text(data.ementorData.name);
                        $('#ementor-course-count').text(data.ementorData.assigned_course_count);
                        $('#ementor-enrolled-student').text(data.ementorData.total_enrollment_count);
                    }
                },
                error: function(error) {
                    console.error("Error fetching dashboard data:", error);
                }
            });
        }

        // fetchDashboardData(); // Fetch data on initial load

        if (typeof window.Echo !== 'undefined') {
            window.Echo.channel('dashboard')
                .listen('AdminDashboardUpdated', function(event) {
                    fetchDashboardData();
                });
        }
    });
</script>


@section('content')
@section('maintitle') Dashboard @endsection

<section class="container-fluid p-4">

</section>

<!-- Add this in your <head> section or before your custom chart script -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    let earningChartInstance; // Store chart instance globally

    function renderEarningChart() {
        const earningsData = @json($data['chart_data']['earnings']);
        const monthLabels = @json($data['chart_data']['labels']);

        // Remove old chart if exists
        if (earningChartInstance) {
            earningChartInstance.destroy();
        }

        const earningChartConfig = {
            series: [{
                name: "Earnings",
                data: earningsData
            }],
            chart: {
                type: "bar",
                height: 300
            },
            colors: ['#2B3990'],
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    columnWidth: '45%'
                }
            },
            dataLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    colors: ['#fff']
                },
                formatter: function (val) {
                    return val + " €";
                }
            },
            xaxis: {
                categories: monthLabels,
                labels: {
                    style: {
                        fontWeight: 'bold'
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value + " €"; // Format Y-axis
                    },
                    style: {
                        fontWeight: 'bold',
                    }
                }
            }
        };

        earningChartInstance = new ApexCharts(document.querySelector("#earning"), earningChartConfig);
        earningChartInstance.render();
    }

    document.addEventListener("DOMContentLoaded", function () {
        const interval = setInterval(() => {
            const el = document.querySelector("#earning");
            if (el) {
                clearInterval(interval);
                renderEarningChart();
            }
        }, 100); // check every 100ms until #earning exists
    });
</script>




@endsection