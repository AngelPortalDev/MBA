<div class="row align-items-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
        @include('frontend.institute.layout.institute-top-menu', ['name' => isset($instituteData[0]->user['name']) ?  $instituteData[0]->user['name'] : '','last_name' => isset($instituteData[0]->user['last_name']) ? $instituteData[0]->user['last_name'] : '' ,'email'=> isset($instituteData[0]->user['email']) ? $instituteData[0]->user['email'] : ''])
    </div>
</div>
<!-- Content -->
<div class="row mt-0 mt-md-4">

<div class="col-lg-3 col-md-4 col-12">
         @include('frontend.institute.layout.institute-left-menu')
</div>