<!-- Header import -->
@extends('admin.layouts.main')
@section('content')

    <section class="py-4 py-lg-6 bg-primary bg-green">
        <div class="container">
            <div class="row">
                <div class="offset-lg-1 col-lg-10 col-md-12 col-12">
                    <div class="d-lg-flex align-items-center justify-content-between">
                        <!-- Content -->
                        <div class="mb-4 mb-lg-0">
                            <h1 class="mb-1 color-blue fw-bold">Section Content Management</h1>
                            <p class="mb-0 lead text-black">Edit and Manage section content from the Admin Panel</p>
                        </div>
                        <div>
                            <a href="{{ route('admin.course.section') }}" class="btn btn-white bg-blue color-green">Back to
                                Section</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- @php
print_r($sectionData[0]);
@endphp --}}
    {{-- {{$sectionData[0]}} --}}
    <!-- Container fluid -->
    <section class="container-fluid p-4">
        <div class="py-6">
            <!-- row -->
            <div class="row">
                <div class="offset-xl-2 col-xl-8 col-md-12 col-12">
                    <!-- card -->
                    <div class="card">

                        <!-- Organize Course Content -->
                        <div class="card-header">
                            <h3 class="mb-0">Organize Section Content</h3>
                        </div>
                        <div class="card-body">

                            <form class="row needs-validation" novalidate="">

                                <div class="col-lg-12 col-md-12 col-12">

                                    <label class="form-label" for="email">Section Name</label>
                                    <input type="text" name="email" class="form-control" placeholder="" required=""
                                        value="{{ isset($sectionData[0]['section_name']) ? $sectionData[0]['section_name'] : '' }}">
                                </div>

                            </form>

                        </div>

                        <!-- Choose Order header -->
                        <div class="card-header">
                            <h4 class="mb-0">Choose Order</h4>
                            <p class="mb-0">Arrange Your Section Content with Drag and Drop</p>

                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="bg-light rounded p-2 mb-4">
                                <div class="list-group list-group-flush border-top-0" id="courseList">
                                    <form id="sectionFormData">
                                        <div id="courseOne">
                                            <input type="text" name="section_id"
                                                value="{{ isset($sectionData[0]['id']) ? base64_encode($sectionData[0]['id']) : '' }}"
                                                hidden>
                                            {{-- Video List Section Show --}}

                                            @if (isset($sectionData[0]['course_video']) &&
                                                    is_array($sectionData[0]['course_video']) &&
                                                    count($sectionData[0]['course_video']) > 0)
                                                @foreach ($sectionData[0]['course_video'] as $section)
                                                    <div class="list-group-item rounded px-3 text-nowrap mb-1"
                                                        id="development">
                                                        <input type="text" name="content_id[]"
                                                            value="{{ isset($section['id']) ? base64_encode($section['id']) : '' }}"
                                                            hidden>
                                                        <input type="text" name="content_type_id[]"
                                                            value="{{ base64_encode(1) }}" hidden>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h5 class="mb-0 text-truncate">
                                                                <a href="#" class="text-inherit">
                                                                    <span class="align-middle fs-4"> <i
                                                                            class="bi bi-play-circle"></i>
                                                                        {{ isset($section['video_title']) ? $section['video_title'] : '' }}
                                                                    </span>
                                                                </a>
                                                            </h5>
                                                            <div>
                                                                <a href="#" class="me-1 text-inherit"
                                                                    data-bs-toggle="tooltip" data-placement="top"
                                                                    aria-label="Edit" data-bs-original-title="Edit">
                                                                    <i class="bi bi-pencil edit-icon fs-5"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editQuestion"></i>
                                                                </a>
                                                                <a href="javascript:void(0)" class="me-1 text-inherit deleteContent"
                                                                    data-bs-toggle="tooltip" data-placement="top"
                                                                    aria-label="Delete" data-bs-original-title="Delete">
                                                                    <i class="fe fe-trash-2 fs-5"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                            {{-- Docs Journal Articel Section --}}
                                            @if (isset($sectionData[0]['course_docs']) &&
                                                    is_array($sectionData[0]['course_docs']) &&
                                                    count($sectionData[0]['course_docs']) > 0)
                                                @foreach ($sectionData[0]['course_video'] as $section)
                                                    <input type="text" name="content_id[]"
                                                        value="{{ isset($section['id']) ? base64_encode($section['id']) : '' }}"
                                                        hidden>
                                                    <input type="text" name="content_type_id[]"
                                                        value="{{ base64_encode(2) }}" hidden>
                                                    <div class="list-group-item rounded px-3 text-nowrap mb-1"
                                                        id="development">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h5 class="mb-0 text-truncate">
                                                                <a href="#" class="text-inherit">
                                                                    <span class="align-middle fs-4"> <i
                                                                            class="bi bi-play-circle"></i>
                                                                        {{ isset($section['docs_title']) ? $section['docs_title'] : '' }}
                                                                    </span>
                                                                </a>
                                                            </h5>
                                                            <div>
                                                                <a href="#" class="me-1 text-inherit"
                                                                    data-bs-toggle="tooltip" data-placement="top"
                                                                    aria-label="Edit" data-bs-original-title="Edit">
                                                                    <i class="bi bi-pencil edit-icon fs-5"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editQuestion"></i>
                                                                </a>
                                                                <a href="#" class="me-1 text-inherit"
                                                                    data-bs-toggle="tooltip" data-placement="top"
                                                                    aria-label="Delete" data-bs-original-title="Delete">
                                                                    <i class="fe fe-trash-2 fs-5" data-bs-toggle="modal"
                                                                        data-bs-target="#delete-modal"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="button" id="assginContent">Save Now</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </main>

    {{-- Delete video  --}}
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    Are you really want to delete Content?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>

@endsection
