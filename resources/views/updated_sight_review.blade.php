@forelse($sightreviews as $review)

<div class="testmonial py-4">

  <div class="d-flex align-items-center">
    <img class="rounded-circle" src="{{asset('public/images/person.png')}}" width="50px" height="50px" alt="">
    <div class=" mx-2">
      <div class="d-flex justify-content-between align-items-center">

        <h6 class="mb-0">
          <span>{{$review->Name}}</span>
        </h6>

        @if($review->IsRecommend =='1')
        <div class="">
          <i class="fas fa-heart text-main mx-2  "></i>
          <span class="text-center text-secondary">recommends</span>

          {{$review->ReviewRating}}</span></span>
        </div>
        @else
        <div class="">
          <i class="fas fa-heartbeat text-secondary mx-2  "></i>
          <span class="text-center text-secondary">doesn't recommend</span>
        </div>
        @endif
      </div>
      <p class="mb-0 text-secondary small">{{$review->CreatedDate}} <?php   
          ?>
      </p>
    </div>

  </div>

  <p class="my-3 ls-0">{{$review->ReviewDescription}}</p>
  <div class="d-flex align-items-center justify-content-between">
    <a data-bs-toggle="collapse" href="#rev2" role="button" aria-expanded="false" aria-controls="rev2"
      class="text-dark showmore">Show More</a>
    <span>
      <img class="me-2" src="{{asset('public//images/share.png')}}" width="16px" alt="share">
      Share</span>
  </div>
</div>

@empty
<div class="testmonial py-4">
  <p class="ls-0">No Reviews found. Be the first one to reviews. </p>
</div>
@endforelse