@extends('frontend.master')
@section('content')
<section class="container d-flex flex-column my-6">
       <div class="row align-items-center justify-content-between g-0 h-lg-100 py-10">
      <!-- Docs -->
      <div class="col-lg-6 col-md-12 col-12">
        <h2 class="display-4 mb-3">Oops! Something Went Wrong</h2>

        <p class="mb-5 lead px-md-0">
            It seems we've hit a snag. But don't worry, we're here to help you get back on track!</p>
            <h3>What You Can Do:</h3>  

            <ul>
            <li>Check the URL: Make sure the web address is correct.</li>
            <li>Go to the Home Page: Start fresh and explore our site from the beginning.</li>
            <li>Search Our Site: Use the search bar above to find what you're looking for.</li>
            
            
            </ul>

        </p>
      </div>
      <!-- img -->
      <div class="col-lg-4 col-md-12 col-12 mt-8 mt-lg-0 text-lg-start">
        <img src="{{ asset('frontend/images/404-error.png')}}" alt="error" class="" style="width: 100%" />
      </div>
    </div>

  </section>



@endsection