@if(!$restreview->isEmpty())

<div class="row">
  <div class="col-xs-9 col-sm-9 col-md-9">
    <div class="form-group mt-3">

      <div class="col-md-6 form-group ">
        <span id="Success"></span>
      </div>

      <div class="historical-place mb-3">

        <h5>Primary Images</h5>
        @php
        $primaryImageFound = false;
        @endphp

        @foreach($restreview as $value)
        @if($value->IsPrimary == 1)
        <div class="image-container"
          style="display: inline-block; margin: 10px; text-align: center;">
          <img src="{{ asset('/public/review-images/' . $value->Image) }}" alt="Image"
            style="width: 160px; height: 130px; margin-top: 20px; border-radius: 10%;">
          <br>
          <span class="crop">
            <i class="material-icons-two-tone" data-id="{{ $value->Id }}"
              onclick="deleteImage({{ $value->Id }})" style="color: red;">delete</i>
          </span>
        </div>


        @php
        $primaryImageFound = true;
        @endphp

        @endif
        @endforeach

        @if (!$primaryImageFound)
        <p class="margin-l">No primary images found.</p>
        @endif
        <hr>
        <h5 class="mt-5">Guest Images</h5>

        @php
        $GuestImage = false;
        @endphp


        @foreach($restreview as $value)
        @if($value->IsPrimary != 1)
        <div class="image-container"
          style="display: inline-block; margin: 10px; text-align: center;">
          <img src="{{ asset('/public/review-images/' . $value->Image) }}" alt="Image"
            style="width: 160px; height: 130px; margin-top: 20px; border-radius: 10%;">
          <br>
          <span class="crop">
            <i class="material-icons-two-tone" data-id="{{ $value->Id }}"
              onclick="deleteImage({{ $value->Id }})" style="color: red;">delete</i>
          </span>
        </div>

        @php
        $GuestImage = true;
        @endphp
        @endif
        @endforeach

        @if (!$GuestImage)
        <p class="margin-l">No guest images found.</p>
        @endif

      </div>

    </div>
  </div>
</div>
</form>
@else
<p>Image Not Found.</p>
@endif