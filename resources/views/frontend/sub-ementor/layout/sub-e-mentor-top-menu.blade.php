<div class="row align-items-center ">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
        <!-- Bg -->

        @php
        $ementorData = getData('users',['photo','profile_background','name','last_name','email'],['id' => Auth::user()->id]);
        @endphp
       <div style="height: 100px;background-repeat: no-repeat;position:relative;width:100%;">
        <form class="proflilImage" enctype="multipart/form-data" method="post">
            @if (!empty($ementorData[0]->profile_background))
            <img class="rounded-top img-fluid imagePreview prof-res" src="{{ Storage::url($ementorData[0]->profile_background) }}" style="width: 100%;height: 100px;">
             
            @else
            <img src="{{ Storage::url('ementorDocs/e-mentor-cover-photo-bg.jpg')}}" class="rounded-top img-fluid imagePreview prof-res" alt="avatar" style="width: 100%;height: 100px;" />
            @endif
            <div class="e-mentor-cover-photo-edit-pencil-icon">
                <input type="file" id="imageUpload_back" class="image profilePic" name="image_file" accept=".png, .jpg, .jpeg">
                <input type="text" value="{{base64_encode('PROFILE_BACKGORUND')}}" name="cat" hidden>
                <input type="text"  class='curr_img' value="{{ isset($ementorData[0]->photo) ? $ementorData[0]->photo : ''  }}" name='old_img_name' hidden>
                <label for="imageUpload_back"><i class="bi-pencil"></i></label>
            </div> 
       </form>
        </div>

        <div class="card px-4 pt-2 pb-4 shadow-sm rounded-top-0 rounded-bottom-0 rounded-bottom-md-2">
            <div class="d-flex align-items-end justify-content-between">
                <div class="d-flex align-items-center flex-wrap">
                    <div class="me-2 position-relative d-flex justify-content-end align-items-end mt-n5">
                        <form class="proflilImage" enctype="multipart/form-data" method="post">
                            @if (!empty($ementorData[0]->photo))
                            <img class="avatar-xl rounded-circle border border-4 border-white imagePreview" src="{{ Storage::url($ementorData[0]->photo) }}">
                            @else
                            <img src="{{ Storage::url('ementorDocs/e-mentor-profile-photo.png')}}" class="avatar-xl rounded-circle border border-1 bg-white border-light-subtle imagePreview" alt="avatar" />
                            @endif
                       
                            <div class="e-mentor-profile-photo-edit-pencil-icon">
                                <input type="file" id="imageUpload_profile" class="image profilePic" name="image_file" accept=".png, .jpg, .jpeg">
                                <input type="text" value="{{base64_encode('PROFILE')}}" name="cat" hidden>
                                <label for="imageUpload_profile"><i class="bi-pencil"></i></label>
                                <input type="text"  class='curr_img' value="{{ isset($ementorData[0]->photo) ? $ementorData[0]->photo : ''  }}" name='old_img_name' hidden>
                            </div>
                        </form>
                    </div>
                    <div class="lh-1">
                        <h2 class="mb-0">{{  isset($ementorData[0]->name) ? $ementorData[0]->name.' '.$ementorData[0]->last_name : 'NA'}}</h2>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fe fe-mail fs-4"></i>
                            <a class="ms-1" href="mailto:{{ isset($ementorData[0]->email) ? $ementorData[0]->email : '#' }}">
                                {{ isset($ementorData[0]->email) ? $ementorData[0]->email : 'Not Disclosed' }}
                            </a>
                        </div>
                    </div>
                </div>
                {{-- <div>
                    <a href="add-course.html" class="btn btn-primary d-none d-md-block">Create New Course</a>
                </div> --}}
            </div>
        </div>
    </div>
</div>