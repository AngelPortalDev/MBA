                    <!-- Bg -->
                    <div style="height: 100px;background-repeat: no-repeat;position:relative;width:100%;">
                         <form class="proflilImage" enctype="multipart/form-data" method="post">
                                     @php
                                    $file_name = getData('users',['photo','profile_background','university_code'],['id' => Auth::user()->id]);
                                    @endphp
                                        @if (!empty($file_name[0]->profile_background))
                                    <img class="rounded-top img-fluid imagePreview prof-res" src="{{ Storage::url($file_name[0]->profile_background) }}" style="width: 100%;height: 100px;">
                                     
                                    @else
                                    <img src="{{ Storage::url('studentDocs/student-cover-photo-bg.jpg')}}" class="rounded-top img-fluid imagePreview prof-res" alt="avatar" style="width: 100%;height: 100px;" />
                                    @endif
                                   <div class="student-cover-photo-edit-pencil-icon">
                                    <input type="file" id="imageUpload_back" class="image profilePic" name="image_file" accept=".png, .jpg, .jpeg">
                                    <input type="text" value="{{base64_encode('PROFILE_BACKGORUND')}}" name="cat" hidden>
                                    <input type="text"  class='curr_img' value="{{ isset($file_name[0]->photo) ? $file_name[0]->photo : ''  }}" name='old_img_name' hidden>
                            <label for="imageUpload_back"><i class="bi-pencil"></i></label>
                                 </form>
                        </div>
                    </div>



                    <div class="card px-4 pt-2 pb-4 shadow-sm rounded-top-0 rounded-bottom-0 rounded-bottom-md-2">
                        <div class="d-flex align-items-end justify-content-between flex-wrap">
                            <div class="d-flex align-items-center">
                                <div class="me-2 position-relative d-flex justify-content-end align-items-end mt-n5">
                                    <form class="proflilImage" enctype="multipart/form-data" method="post">
                                    @if (!empty($file_name[0]->photo))
                                    <img class="avatar-xl rounded-circle border border-4 border-white imagePreview" src="{{ Storage::url($file_name[0]->photo) }}">
                                    @else
                                    <img src="{{ Storage::url('studentDocs/student-profile-photo.png')}}" class="avatar-xl rounded-circle border border-1 bg-white border-light-subtle imagePreview" alt="avatar" />
                                    @endif
                               

                                    <div class="student-profile-photo-edit-pencil-icon">
                                       
                                        {{-- <form class="proflilImage" enctype="multipart/form-data">
												<input type="file" id="imageUpload" class="update-flie image profilePic" name='com_logo' id="com_logo" accept=".png,.jpg,.jpeg">
												
												<i class="fas fa-pencil-alt"></i>
												</form> --}}
                                              
                                        <input type="file" id="imageUpload_profile" class="image profilePic" name="image_file" accept=".png, .jpg, .jpeg">
                                        <input type="text" value="{{base64_encode('PROFILE')}}" name="cat" hidden>
                                        <label for="imageUpload_profile"><i class="bi-pencil"></i></label>
                                        <input type="text"  class='curr_img' value="{{ isset($file_name[0]->photo) ? $file_name[0]->photo : ''  }}" name='old_img_name' hidden>
                                                </form>
                                    </div>

                                </div>
                                <div class="lh-1">
                                    <h2 class="mb-0">
                                        {{  isset($name) ? $name." ".$last_name :'NA'}}
                                    </h2>
                                    <p class="mb-0 d-block">
                                        @if(isset($email))
                                        <i class="fe fe-mail fs-4"></i>
                                            <a href="mailto:{{ $email }}">{{ $email }}</a>
                                        @else
                                            Not Disclose
                                        @endif
                                    </p>
                                    
 
                                </div>
                                
                            </div>
                                @if(!empty($file_name) && isset($file_name[0]->university_code) && !empty($file_name[0]->university_code))
                                    <div class="mt-3">
                                        <div class="d-flex align-items-center" style="padding: 10px 20px; background-color: #f1f5f9">
                                            <h4 class="mb-0 text-capitalize">
                                                <span>Institute Code:</span>
                                                <span class="fw-bold" style="letter-spacing: 1px">
                                                   {{$file_name[0]->university_code}}
                                                </span>
                                            </h4>
                                        </div>
                                    </div>
                                @endif
                          
                        </div>
                    </div>