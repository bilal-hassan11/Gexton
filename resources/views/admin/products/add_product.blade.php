@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.properties') }}">Properties</a></li>
                    <li class="breadcrumb-item active">{{ isset($property) ? 'Edit' : 'Add'}} Property</li>
                </ol>
            </div>
            <h4 class="page-title">{{ isset($property) ? 'Edit' : 'Add'}} Property</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <h4 class="header-title m-t-0">{{ isset($property) ? 'Edit' : 'Add'}} Property</h4>
            <p class="text-muted font-14 m-b-20">
                Here you can {{ isset($property) ? 'edit' : 'add'}} properties.
            </p>

            <form action="{{ route('admin.properties.save') }}" class="ajaxForm" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                @if(isset($property) && $property->image)
                    <div class="form-group my-3">
                        <img src="{{check_file($property->image, 'property')}}" alt="{{ $property->property_code ?? 'No Image' }}" class="img-fluid fit-image avatar-xl rounded-circle">
                    </div>
                @endif
                <div class="form-group mb-3">
                    <label>Property Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="profile_img" accept=".gif, .jpg, .png">
                            <label class="custom-file-label profile_img_label" for="image">Choose file</label>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="owner">Property Owner<span class="text-danger">*</span></label>
                    <select class="form-control" data-parsley-required name="owner" id="owner">
                        <option value="">Select Property Owner</option>
                        @foreach($owners as $owner)
                            <option {{isset($property) && $property->user_id == $owner->id ? 'selected' : ''}} value="{{$owner->id}}">{{$owner->complete_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="property_code">Property Code<span class="text-danger">*</span></label>
                    <input type="text" name="property_code" parsley-trigger="change" data-parsley-required placeholder="Enter Property Code" class="form-control" id="property_code" value="{{ $property->property_code ?? '' }}">
                </div>
                <div class="form-group mb-3">
                    <label for="address">Address<span class="text-danger">*</span></label>
                    <input type="text" name="address" parsley-trigger="change" data-parsley-required placeholder="Enter Address" class="form-control" id="address" value="{{ $property->address ?? '' }}">
                </div>

                <div class="form-group mb-3">
                    <label for="street">Street Address</label>
                    <input type="text" name="street" placeholder="Enter Street Address" class="form-control" id="street" value="{{ $property->street ?? '' }}">
                </div>
                
                <div class="form-group mb-3">
                    <label for="city">City</label>
                    <input type="text" name="city" placeholder="Enter City" class="form-control" id="city" value="{{ $property->city ?? '' }}">
                </div>

                <div class="form-group mb-3">
                    <label for="state">State</label>
                    <input type="text" name="state" placeholder="Enter State" class="form-control" id="state" value="{{ $property->state ?? '' }}">
                </div>

                <div class="form-group mb-3">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" name="zipcode" placeholder="Enter Zipcode" class="form-control" id="zipcode" value="{{ $property->zipcode ?? '' }}">
                </div>

                <div class="form-group mb-3">
                    <label for="country">Country</label>
                    <input type="text" name="country" placeholder="Enter Country" class="form-control" id="country" value="{{ $property->country ?? '' }}">
                </div>

                <div class="form-group mb-3">
                    <label for="contact_person">Contact Person</label>
                    <input type="text" name="contact_person" placeholder="Enter Contact Person" parsley-trigger="change" data-parsley-required class="form-control" id="contact_person" value="{{ $property->contact_person ?? '' }}">
                </div>

                <div class="form-group mb-3">
                    <label for="contact_person_email">Contact Person Email</label>
                    <input type="email" placeholder="Enter Contact Person Email" class="form-control" id="contact_person_email" name="contact_person_email" value="{{ $property->contact_person_email ?? '' }}">
                </div>

                <div class="form-group mb-3">
                    <label for="contact_person_phone">Contact Person Phone</label>
                    <input type="text" placeholder="Enter Contact Person Phone" class="form-control" id="contact_person_phone" name="contact_person_phone" value="{{ $property->contact_person_phone ?? '' }}">
                </div>

                @if(isset($property))
                    <input type="hidden" value="{{ $property->hashid }}" name="property_id" />
                @endif

                <div class="form-group mb-3 text-right">
                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                        Submit
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
<script>
    $('#profile_img').change(function() {
        var filename = $('#profile_img').val();
        if (filename.substring(3,11) == 'fakepath') {
            filename = filename.substring(12);
        }
        if(filename && filename != ''){
            $('.profile_img_label').html(filename);
        }else{
            $('.profile_img_label').html('Choose file');
        }
   });
</script>
@endsection