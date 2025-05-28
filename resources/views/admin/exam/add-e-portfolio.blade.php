<!-- Header import -->
@extends('admin.layouts.main')
@section('content')
    <!-- Container fluid -->
    <section class="p-4">
        <div class="container">
            <div id="courseForm" class="bs-stepper">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-12">
                        <!-- Card -->
                        <div class="card mb-4">
                            <!-- Card body -->
                            <div class="card-body">
                                <!-- quiz -->
                                <div class="row">
                                    <div class="d-lg-flex justify-content-between align-items-end col-md-6">
                                        <!-- quiz img -->

                                        <!-- quiz content -->
                                        <div class="w-100 ">
                                            <h3 class="mb-2"><a href="#" class="text-inherit">Create E-portfolio</a>
                                            </h3>
                                            <form class="w-100 ">
                                                <label class="form-label" for="editState">Select Award</label>
                                                <select class="form-select" id="editsection" required="">
                                                    <option value="">Award in Recruitment and Employee Selection
                                                    </option>
                                                    <option value="1">Award in Human Resource Management</option>
                                                    <option value="2">Award in Human Resource Management</option>
                                                    <option value="3">Award in Human Resource Management</option>
                                                </select>
                                                <div class="invalid-feedback">Please choose Award.</div>



                                            </form>
                                        </div>

                                    </div>


                                    <div class="d-lg-flex justify-content-between align-items-end col-md-6">
                                        <!-- quiz img -->

                                        <!-- quiz content -->
                                        <div class="w-100 ">
                                            <form class="w-100 ">
                                                <label class="form-label" for="editState">E-portfolio Title</label>
                                                <input type="text" name="E-portfolio Title" class="form-control"
                                                    placeholder="E-portfolio Title" required="" value="">

                                            </form>
                                        </div>

                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="form-label">Instructions</label>
                                        <textarea class="form-control" id="instruction-editor" rows="5"> </textarea>

                                    </div>
                                </div>

                                <a href="#" class="btn btn-primary mt-5">Save Now</a>
                            </div>

                        </div>

                        

                    </div>
                </div>

                
            </div>
        </div>
    </section>
    </main>




    <script>
        CKEDITOR.replace('instruction-editor');
    </script>



@endsection
