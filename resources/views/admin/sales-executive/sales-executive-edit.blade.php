<!-- Header import -->
@extends('admin.layouts.main')
@section('content')

<style>
    .assignmnetquestiontitle p{
        display: inline-block;
    }
</style>

<!-- Container fluid -->
<section class="p-4">
    <div class="container">
        <div id="courseForm" class="bs-stepper">
            <div class="row justify-content-center">
                <div class="col-md-10 col-12">
                    <form class="w-100 salesExecutiveForm">
                        <!-- Card -->
                        <div class="card mb-4">
                            <!-- Card body -->
                            <div class="card-body">
                                <!-- Assignment -->
                                <div class="row">
                                    <div class="d-lg-flex justify-content-between align-items-end col-12 mb-2">
                                        <div class="w-100 d-flex justify-content-between">
                                            <h3 class="mb-2"><a href="#" class="text-inherit editExamTitle">Edit Sales Executive</a></h3>
                                                <a href="{{ route('admin.sales-executive') }}" class="btn btn-outline-primary custum-btn-mobile">Back</a>
                                        </div>
                                    </div>
                                    <hr>
                                    
                                    <!-- first Name -->
                                    <div class="col-md-12 col-sm-12 col-lg-6 ">
                                        <div class="w-100">
                                            <label class="form-label" for="name">First Name <span class="text-danger">*</span></label>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="First Name" required="" value="{{ isset($salesExecutiveData[0]['name']) ? html_entity_decode($salesExecutiveData[0]['name'], ENT_QUOTES, 'UTF-8') : '' }}" >
                                            <input type="text" id="id" name="id" value="{{isset($salesExecutiveData[0]['id']) ? base64_encode($salesExecutiveData[0]['id']) : 0}}" hidden>
                                            <div class="invalid-feedback" id="name_error">Please enter first name</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Last Name -->
                                    <div class="col-md-12 col-sm-12 col-lg-6 ">
                                        <div class="w-100">
                                            <label class="form-label" for="last_name">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" required="" value="{{ isset($salesExecutiveData[0]['last_name']) ? html_entity_decode($salesExecutiveData[0]['last_name'], ENT_QUOTES, 'UTF-8') : '' }}" >
                                            <div class="invalid-feedback" id="last_name_error">Please enter last name</div>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-12 col-sm-12 col-lg-6 mt-3">
                                        <div class="w-100">
                                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="" value="{{ isset($salesExecutiveData[0]['email']) ? html_entity_decode($salesExecutiveData[0]['email'], ENT_QUOTES, 'UTF-8') : '' }}" >
                                            <div class="invalid-feedback" id="last_name_error">Please enter email</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Mobile -->
                                    <div class="mb-3 col-md-6 mt-3">
                                        <label class="form-label">Mobile No. <span
                                                class="text-danger">*</span></label>
                                        <div class="d-flex gap-2">
                                            <!-- Country Code -->
                                            <select name="mob_code" id="mob_code"
                                                class="form-select w-25">
                                                <option value="" selected>Choose Code</option>
                                                @foreach (getDropDownlist('country_master', ['id', 'country_code', 'country_flag', 'country_name']) as $mob_code)
                                                    <option value="+{{ $mob_code->country_code }}"
                                                        {{ old('mob_code', $salesExecutiveData[0]->mob_code) == "+$mob_code->country_code" ? 'selected' : '' }}>
                                                        +{{ $mob_code->country_code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="number" id="mobile" class="form-control"
                                                name="mobile" required placeholder="123 4567 890"
                                                value="{{ isset($salesExecutiveData[0]->phone) ? $salesExecutiveData[0]->phone : '' }}">
                                        </div>
                                        <div class="invalid-feedback" id="mob_code_error">Please
                                            enter Mobile code.</div>
                                        <div class="invalid-feedback" id="mobile_error">Please
                                            enter Mobile no.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <button type="button" class="btn btn-primary editSalesExecutive">Save Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</main>


@endsection