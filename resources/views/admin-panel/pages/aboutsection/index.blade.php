@extends('admin-panel.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4 fw-bold"><span class="text-muted fw-light">عن النادي /</span>
                تعديل عن النادي
            </h4>
            {{-- start row --}}
            <div class="mb-4 row">
                <!-- Browser Default -->
                <div class="mb-4 col-md mb-md-0">
                  <div class="card">
                    <h5 class="card-header">
                             تعديل عن النادي

                    </h5>
                    <div class="card-body">


                        <form class="browser-default-validation" method="post" action="{{url('Dashboard-Admin/About-Section')}}" enctype="multipart/form-data">
                              {{csrf_field()}}
                                        <input type="hidden" name="position" value="{{$data->position}}" />

                                    @if($data->position == 'socialMedia')
                                    <div class="row">

                                      {{-- telegram--}}
                                      <div class="col-12 col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="telegram"> telegram <span style="color:#f00">*</span></label>
                                        <input type="text" class="form-control " value="{{$data->telegram}}" required name="telegram" id="telegram"  />

                                        </div>
                                    </div>
                                      {{-- tiktok--}}
                                      <div class="col-12 col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="tiktok"> tiktok <span style="color:#f00">*</span></label>
                                        <input type="text" class="form-control " value="{{$data->tiktok}}" required name="tiktok" id="tiktok"  />

                                        </div>
                                    </div>
                                     {{-- snapchat--}}
                                     <div class="col-12 col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="snapchat"> snapchat <span style="color:#f00">*</span></label>
                                        <input type="text" class="form-control " value="{{$data->snapchat}}" required name="snapchat" id="snapchat"  />

                                        </div>
                                    </div>
                                      {{-- youtube--}}
                                      <div class="col-12 col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="youtube"> youtube <span style="color:#f00">*</span></label>
                                        <input type="text" class="form-control " value="{{$data->youtube}}" required name="youtube" id="youtube"  />

                                        </div>
                                    </div>
                                    {{-- facebook--}}
                                    <div class="col-12 col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="facebook"> facebook <span style="color:#f00">*</span></label>
                                        <input type="text" class="form-control " value="{{$data->facebook}}" required name="facebook" id="facebook"  />

                                        </div>
                                    </div>
                                     {{-- twitter--}}
                                     <div class="col-12 col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="twitter"> twitter <span style="color:#f00">*</span></label>
                                        <input type="text" class="form-control" value="{{$data->twitter}}" required name="twitter" id="twitter"  />

                                        </div>
                                    </div>
                                                                         {{-- insta--}}
                                    <div class="col-12 col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="instagram"> instagram <span style="color:#f00">*</span></label>
                                        <input type="text" class="form-control" value="{{$data->instagram}}" required name="instagram" id="instagram"  />

                                        </div>
                                    </div>
                                </div>
                                 @elseif($data->position == 'contactUs')
                                 <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="phone"> رقم الهاتف <span style="color:#f00">*</span></label>
                                        <input type="text" class="form-control" value="{{$data->phone}}" required name="phone" id="phone"  />

                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="email"> البريد الإلكتروني <span style="color:#f00">*</span></label>
                                        <input type="text" class="form-control" value="{{$data->email}}" required name="email" id="email"  />

                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="address"> العنوان <span style="color:#f00">*</span></label>
                                        <input type="text" class="form-control" value="{{$data->address}}" required name="address" id="address"  />

                                        </div>
                                    </div>

                                    </div>

                                    @else
                                    @if($data->position != 'Footer')
                                            <div class="row">

                                                {{-- ar title--}}
                                                <div class="col-12 col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="ar_titles">العنوان الرئيسى (Ar)  <span style="color:#f00">*</span></label>
                                                    <input type="text" class="form-control" value="{{$data->ar_title}}" required name="ar_title" id="ar_titles"  />

                                                    </div>
                                                </div>



                                                {{-- en_title--}}
                                                <div class="col-12 col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="en_titles">العنوان الرئيسى (En)  <span style="color:#f00">*</span></label>
                                                    <input type="text" class="form-control" value="{{$data->en_title}}" required name="en_title" id="en_titles"  />

                                                    </div>
                                                </div>

                                            </div>
                                        @endif

                                            <div class="row">
                                                <div class="col-12">
                                                <div class="mb-3">
                                                        <label class="form-label" for="ar_desc">تفاصيل (Ar)   </label>
                                                        <textarea name="ar_desc" class="form-control ckeditor" required cols="30" rows="10"  id="ar_desc" >{{$data->ar_desc}}</textarea>
                                                    </div>

                                                </div>
                                            </div>
                                              <div class="row">
                                                <div class="col-12">
                                                <div class="mb-3">
                                                        <label class="form-label" for="en_desc">تفاصيل (En)   </label>
                                                        <textarea name="en_desc" class="form-control ckeditor" required cols="30" rows="10"  id="en_desc" >{{$data->en_desc}}</textarea>
                                                    </div>

                                                </div>
                                            </div>

                                        @endif

                                        <hr>





                          <div class="row">
                              <div class="col-12">
                              <button type="submit" class="btn btn-primary">إرسال</button>
                              </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /Browser Default -->


              </div>

            {{-- end --}}

        </div>
        <!-- Content -->
@endsection
@section('script')
<script>
    // Select All checkbox click
    const selectAll = document.querySelector('#selectAll'),
      checkboxList = document.querySelectorAll('[type="checkbox"]');
    selectAll.addEventListener('change', t => {
      checkboxList.forEach(e => {
        e.checked = t.target.checked;
      });
    });

</script>

@endsection
