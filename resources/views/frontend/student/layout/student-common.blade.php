    <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    @include('frontend.student.layout.student-profile-top-menu', ['name' => isset($studentData->user->name) ?  $studentData->user->name : '','last_name' => isset($studentData->user->last_name) ? $studentData->user->last_name : '' ,'email'=> isset($studentData->user->email) ? $studentData->user->email : ''])
                </div>
            </div>
            <!-- Content -->
            <div class="row mt-0 mt-md-4">
            <div class="col-lg-3 col-md-4 col-12">
                     @include('frontend.student.layout.student-profile-left-menu')
            </div>