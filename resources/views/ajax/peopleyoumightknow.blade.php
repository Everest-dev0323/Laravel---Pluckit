 @if($getPeopleYouMightKnow[0])
 @foreach($getPeopleYouMightKnow as $yowMightKnow)
 @php $socialUserType = !empty($socialUserType) ? $socialUserType : '';@endphp
    <li class="media display-people-you-might-know" id="select_user_{{ $yowMightKnow['id'] }}">
    <figure class="figure2 mr-3">
        <img class="img-fluid" src="{{ url('public/') }}/front-assets/images/user.png" alt="Avatar"> 
    </figure>
    <div class="media-body">
        <h6>{{ $yowMightKnow['name'] }}</h6>
        <p><a href="javascript:;" class="user_add_to_contact" id="user_add_to_contact_{{ $yowMightKnow['id'] }}" onClick="clickUserAddToContact({{ $yowMightKnow['id'] }},{{ $socialUserType }})"><i class="fas fa-user-plus mr-1"></i>Add to my Network</a></p>
    </div>
    </li>
    @endforeach
@endif