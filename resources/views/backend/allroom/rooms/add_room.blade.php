@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">

				<div class="container">
					<div class="main-body">
						<div class="row">




<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs nav-primary" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="bx bx-home font-18 me-1"></i>
                        </div>
                        <div class="tab-title">Add Room </div>
                    </div>
                </a>
            </li>
        </ul>
        <div class="tab-content py-3">
            <div class="tab-pane fade active show" id="primaryhome" role="tabpanel">

                <div class="col-xl-12 mx-auto">

                    <div class="card">
                        <div class="card-body p-4">
                            <h5 class="mb-4">Add Room </h5>

    <form class="row g-3" action="{{ route('store.room') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="col-md-4">
            <label for="input1" class="form-label">Room Type Name </label>
            <input type="text" name="roomtype" class="form-control {{ $errors->has('roomtype') ? 'is-invalid':'' }}" id="input1" value="{{ old('roomtype', '') }}" >
            @error('roomtype')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="input2" class="form-label">Total Adult</label>
            <input type="text" name="total_adult" class="form-control {{ $errors->has('total_adult') ? 'is-invalid':'' }}" id="input2"  value="{{ old('total_adult', '') }}">
            @error('total_adult')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="input2" class="form-label">Total Child </label>
            <input type="text" name="total_child" class="form-control {{ $errors->has('total_child') ? 'is-invalid':'' }}" id="input2" value="{{ old('total_child') }}">
            @error('total_child')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6">
            <label for="input3" class="form-label">Main Image </label>
            <input type="file" name="image" class="form-control" id="image"  >

            <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Admin" class="bg-primary" width="70" height="50">
        </div>


        <div class="col-md-3">
            <label for="input1" class="form-label">Room Price  </label>
            <input type="text" name="price" class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}" id="input1" value="{{ old('price', '') }}" >
            @error('price')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-3">
            <label for="input2" class="form-label">Size </label>
            <input type="text" name="size" class="form-control {{ $errors->has('size') ? 'is-invalid':'' }}" id="input2"  value="{{ old('size', '') }}">
            @error('size')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-3">
            <label for="input2" class="form-label">Discount ( % )</label>
            <input type="text" name="discount" class="form-control {{ $errors->has('discount') ? 'is-invalid':'' }}" id="input2"  value="{{ old('discount', '') }}">
            @error('discount')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-3">
            <label for="input2" class="form-label">Room Capacity </label>
            <input type="text" name="room_capacity" class="form-control {{ $errors->has('room_capacity') ? 'is-invalid':'' }}" id="input2" value="{{ old('room_capacity', '') }}">
            @error('room_capacity')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="input7" class="form-label">Room View </label>
            <select name="view" id="input7" class="form-select {{ $errors->has('view') ? 'is-invalid':'' }}">
                <option value="">Choose...</option>
                <option value="Sea View" {{ (old('view', '') == 'Sea View') ? 'selected':'' }}>Sea View </option>
                <option value="Hill View" {{ (old('view', '') == 'Hill View') ? 'selected':'' }}>Hill View </option>
            </select>
            @error('view')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="input7" class="form-label">Bed Style</label>
            <select name="bed_style" id="input7" class="form-select {{ $errors->has('bed_style') ? 'is-invalid':'' }}">
                <option value="">Choose...</option>
                <option value="Queen Bed" {{ (old('bed_style', '') == 'Queen Bed') ? 'selected':'' }}> Queen Bed </option>
                <option value="Twin Bed" {{ (old('bed_style', '') == 'Twin Bed') ? 'selected':'' }}>Twin Bed </option>
                <option value="King Bed" {{ (old('bed_style', '') == 'King Bed') ? 'selected':'' }}>King Bed </option>
            </select>
            @error('bed_style')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12">
            <label for="input11" class="form-label">Short Description </label>
            <textarea name="short_desc" class="form-control" id="input11" placeholder="Short description...." rows="3">{{ old('short_desc', '') }}</textarea>
        </div>

        <div class="row mt-2">
            <div class="col-md-12 mb-3">
                <div class="basic_facility_section_remove" id="basic_facility_section_remove">
                    <div class="row add_item">
                        <div class="col-md-6">
                            <label for="basic_facility_name" class="form-label">Room Facilities </label>
<select name="facility_name[]" id="basic_facility_name" class="form-control">
        <option value="">Select Facility</option>
        <option value="Complimentary Breakfast">Complimentary Breakfast</option>
        <option value="32/42 inch LED TV" > 32/42 inch LED TV</option>
        <option value="Smoke alarms" >Smoke alarms</option>
        <option value="Minibar"> Minibar</option>
        <option value="Work Desk" >Work Desk</option>
        <option value="Free Wi-Fi">Free Wi-Fi</option>
        <option value="Safety box" >Safety box</option>
        <option value="Rain Shower" >Rain Shower</option>
        <option value="Slippers" >Slippers</option>
        <option value="Hair dryer" >Hair dryer</option>
        <option value="Wake-up service" >Wake-up service</option>
        <option value="Laundry & Dry Cleaning" >Laundry & Dry Cleaning</option>
        <option value="Electronic door lock" >Electronic door lock</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="padding-top: 30px;">
                <a class="btn btn-success addeventmore"><i class="lni lni-circle-plus"></i></a>

               <span class="btn btn-danger removeeventmore"><i class="lni lni-circle-minus"></i></span>
                            </div>
                        </div>
                    </div>
                    @error('facility_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <label for="input11" class="form-label"> Description </label>
            <textarea name="description" class="form-control" id="myeditorinstance" >{{ old('description', '') }}</textarea>
        </div>


        <div class="row mt-2">
            <div class="col-md-12 mb-3">
            <div class="col-md-12">
                <div class="d-md-flex d-grid align-items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                </div>
            </div>
        </form>
                        </div>
                    </div>

                </div>


            </div>

        </div>
    </div>
</div>

						</div>
					</div>
				</div>
 </div>


        <script type="text/javascript">

        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

        </script>


        <!--------===Show MultiImage ========------->
<script>
    $(document).ready(function(){
     $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data

            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                    .height(80); //create image element
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });

        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
 </script>


<!--========== Start of add Basic Plan Facilities ==============-->
<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
       <div class="basic_facility_section_remove" id="basic_facility_section_remove">
          <div class="container mt-2">
             <div class="row">
                <div class="form-group col-md-6">
                   <label for="basic_facility_name">Room Facilities</label>
                   <select name="facility_name[]" id="basic_facility_name" class="form-control">
                         <option value="">Select Facility</option>
  <option value="Complimentary Breakfast">Complimentary Breakfast</option>
  <option value="32/42 inch LED TV" > 32/42 inch LED TV</option>
  <option value="Smoke alarms" >Smoke alarms</option>
  <option value="Minibar"> Minibar</option>
  <option value="Work Desk" >Work Desk</option>
  <option value="Free Wi-Fi">Free Wi-Fi</option>
  <option value="Safety box" >Safety box</option>
  <option value="Rain Shower" >Rain Shower</option>
  <option value="Slippers" >Slippers</option>
  <option value="Hair dryer" >Hair dryer</option>
  <option value="Wake-up service" >Wake-up service</option>
  <option value="Laundry & Dry Cleaning" >Laundry & Dry Cleaning</option>
  <option value="Electronic door lock" >Electronic door lock</option>
                   </select>
                </div>
                <div class="form-group col-md-6" style="padding-top: 20px">
                   <span class="btn btn-success addeventmore"><i class="lni lni-circle-plus"></i></span>
                   <span class="btn btn-danger removeeventmore"><i class="lni lni-circle-minus"></i></span>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>

 <script type="text/javascript">
    $(document).ready(function(){
       var counter = 0;
       $(document).on("click",".addeventmore",function(){
             var whole_extra_item_add = $("#whole_extra_item_add").html();
             $(this).closest(".add_item").append(whole_extra_item_add);
             counter++;
       });
       $(document).on("click",".removeeventmore",function(event){
             $(this).closest("#basic_facility_section_remove").remove();
             counter -= 1
       });
    });
 </script>
 <!--========== End of Basic Plan Facilities ==============-->

  <!--========== Start Room Number Add ==============-->
    <script>
        $('#roomnoHide').hide();
        $('#roomview').show();

        function addRoomNo(){
            $('#roomnoHide').show();
            $('#roomview').hide();
            $('#addRoomNo').hide();
        }

    </script>

   <!--========== End Room Number Add ==============-->


@endsection