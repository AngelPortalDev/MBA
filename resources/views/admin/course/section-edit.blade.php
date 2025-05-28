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
                            @php  
                                $previousUrl = url()->previous();
                                $searchString = "award-course-get-data"; @endphp
                            @if (strpos($previousUrl , $searchString) !== false) 
                                <a href="{{ url()->previous().'#section-selection-3' }}" class="btn btn-white bg-blue color-green">Back to
                                    Section</a>
                            @else
                                <a href="{{ route('admin.course.section') }}" class="btn btn-white bg-blue color-green">Back to
                                    Section</a>
                            @endif
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
                    <form  id="sectionFormData">

                        <div class="card-body">


                                <div class="col-lg-12 col-md-12 col-12">

                                    <label class="form-label" for="email">Section Name</label>
                                    <input type="text" name="section_title" class="form-control" placeholder="" required=""
                                        value="{{ isset($sectionData['section_name'][0]->section_name) ? htmlspecialchars_decode($sectionData['section_name'][0]->section_name) : '' }}">
                                </div>

                         

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
                                    {{-- <form id="sectionFormData"> --}}
                                        <div id="courseOne">
                                            
                                          
                                            <input type="text" name="section_id"
                                                value="{{ isset($sectionData['section_name'][0]->id) ? base64_encode($sectionData['section_name'][0]->id) : '' }}"
                                                hidden>

                                            @php
                                                echo htmlspecialchars_decode($sectionData['content'])
                                            @endphp
                                     
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
                    <h5 class="modal-title" id="exampleModalLabel">Remove Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    Are you really want to delete content?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>

@endsection
