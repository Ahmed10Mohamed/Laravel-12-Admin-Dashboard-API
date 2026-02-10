@extends('admin-panel.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce">

            <form method="POST" id="FormUpdate" action="{{ route('AboutSection.update') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="position" value="{{ $data->position }}">

                <div class="col-12 col-lg-12">

                    <!-- Personal Information -->
                    <div class="card mb-6">
                        <h5 class="card-header page_title">تعديل</h5>
                        <div class="card-body">
                            @php $langs = langs(); @endphp

                            @foreach ($langs as $lang)
                                @php $tr = $translations[$lang->locale] ?? null; @endphp

                                <div class="row mb-4">
                                    <div class="col">
                                        <label class="form-label">
                                            العنوان {{ $lang->name }} <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="title[{{ $lang->locale }}]"
                                            value="{{ old("title.$lang->locale", $tr->title ?? '') }}">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">التفاصيل {{ $lang->name }}</label>
                                    <textarea class="form-control " name="description[{{ $lang->locale }}]" rows="5">{{ old("description.$lang->locale", $tr->description ?? '') }}</textarea>
                                </div>
                                <hr>
                            @endforeach
                            @if ($data->position == 'aboutUs' ||$data->position == 'Family'|| $data->position == 'legalServices' )
                                <!-- Image -->
                                <div class="mb-4 row">
                                    <label class="col-md-2 col-form-label">صورة</label>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                    @if ($data->image)
                                        <div class="col-md-2">
                                            <img src="{{ asset($data->image) }}" width="60">
                                        </div>
                                    @endif
                                </div>
                            @endif
                              
                        </div>
                    </div>

                    <div class="mt-2">
                        <button type="submit" id="submitBtn" class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm d-none me-1" role="status"
                                aria-hidden="true"></span>
                            <span class="btn-text">تعديل</span>
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#FormUpdate').on('submit', function(e) {
                e.preventDefault();
                // for (let instance in CKEDITOR.instances) {
                //     CKEDITOR.instances[instance].updateElement();
                // }

                const form = $(this)[0];
                const formData = new FormData(form);
                const submitBtn = $('#submitBtn');
                const spinner = submitBtn.find('.spinner-border');
                const btnText = submitBtn.find('.btn-text');

                submitBtn.prop('disabled', true);
                spinner.removeClass('d-none');
                btnText.text('جاري الإرسال...');

                $.ajax({
                    url: "{{ route('AboutSection.update') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'تم بنجاح!',
                                text: 'تم تعديل البيانات بنجاح.',
                                confirmButtonText: 'حسناً'
                            }).then(() => {
                                window.location.href =
                                    "{{ route('AboutSection.edit', ['position' => $data->position]) }}";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'خطأ!',
                                text: response.message || "حدث خطأ أثناء تعديل البيانات.",
                                confirmButtonText: 'حسناً'
                            });
                        }
                    },
                    error(xhr) {
                        let message = "لقد حدث خطأ أثناء إرسال البيانات.";
                        if (xhr.responseJSON?.errors) {
                            message = Object.values(xhr.responseJSON.errors)
                                .flat()
                                .map(err => `• ${err}`)
                                .join('<br>');
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ!',
                            html: message,
                            confirmButtonText: 'حسناً'
                        });
                    },
                    complete() {
                        submitBtn.prop('disabled', false);
                        spinner.addClass('d-none');
                        btnText.text('تعديل');
                    }
                });
            });
        });
    </script>

    <!-- Page JS -->
    <script src="{{ asset('adminFiles/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('adminFiles/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('adminFiles/vendor/libs/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('adminFiles/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>

    <script src="{{ asset('adminFiles/js/app-ecommerce-product-add.js') }}"></script>
    <script src="{{ asset('adminFiles/js/forms-selects.js') }}"></script>
    <script src="{{ asset('adminFiles/js/forms-tagify.js') }}"></script>
    <script src="{{ asset('adminFiles/js/forms-typeahead.js') }}"></script>
@endsection
