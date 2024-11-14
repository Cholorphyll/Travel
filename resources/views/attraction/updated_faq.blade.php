@if(!$getfaq->isEmpty())

<!-- <form class="" action="{{route('update_faq')}}" method="POST"> -->
@csrf

<div class="row">
  <div class="col-xs-6 col-sm-6 col-md-6">
    <div class="form-group mt-3">
      <span id="Success"></span>
      <strong>Attraction</strong>
      <div class="form-search form-search-icon-right">
        <input type="text" id="search_attractionfaq" name="sightname"
          value="{{ $getfaq[0]->Title }}" class="search_attractionfaqs form-control rounded-3"
          placeholder="Search Attraction" disabled>
      </div>
      <input type="hidden" name='attrid' id="selected_att_id" value="{{ $getfaq[0]->SightId }}"
        class="form-control rounded-3" required>

      @foreach($getfaq as $getfaq)

      <div class="form-group getdata-{{ $getfaq->SightQuestionId }} mt-3">
        <span class="badge bg-dark edit-btn fa-pull-right mt-3" id="edit-btn" value="0"
          onclick="editsightfaq({{ $getfaq->SightQuestionId }})">Edit</span>
        <strong>Question</strong>
        <div id="questionmsg-{{ $getfaq->SightQuestionId }}"></div>
        <textarea type="text" name="question" data-original-value="{{ $getfaq->Question }}"
          id="question{{ $getfaq->SightQuestionId }}" class="form-control rounded-3"
          disabled>{{ $getfaq->Question }}</textarea>
      </div>

      <div class="form-group">
        <strong>Answer</strong>
        <div id="answer-{{ $getfaq->SightQuestionId }}"></div>
        <textarea type="text" name="answer" data-original-value="{{ $getfaq->Answer }}"
          id="Answer{{ $getfaq->SightQuestionId }}" class="form-control rounded-3" placeholder=""
          disabled>{{ $getfaq->Answer }}</textarea>
      </div>

      <span id="buttonsContainer-{{ $getfaq->SightQuestionId }}"
        class="buttons-container-dd d-none mb-3 " data-colid="{{ $getfaq->SightQuestionId }}">
        <button type="button" value="1"
          class="reviewField- btn btn-dark save-button px-4 updatesightfaq"
          data-id="{{ $getfaq->SightQuestionId }}">Save</button>
        <button type="button" value="2" id="cancel-1"
          onclick="cancelbtn({{ $getfaq->SightQuestionId }})"
          class=" btn btn-dark cancel-button px-4">Cancel</button>
      </span>

      @endforeach

    </div>
  </div>
</div>
</form>
@else
<p>FAQ Not Found.</p>
@endif