<div class="content-box">
    <div class="d-flex msg-close">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left close-message"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        <h2 class="mail-title" data-selectedMailTitle=""></h2>
    </div>
    @foreach($contacts as $contact)
        <div id="mailCollapseFive-{{$loop->index}}" class="collapse" aria-labelledby="mailHeadingFive-{{$loop->index}}" data-parent="#ct">
            <div class="mail-content-container mailInbox" data-mailfrom="info@mail.com" data-mailto="{{$contact->email}}" data-mailcc="">
                <div class="d-flex justify-content-between mb-5">
                    <div class="d-flex user-info">
                        <div class="f-body">
                            <div class="meta-title-tag">
                                <h4 class="mail-usr-name" data-mailtitle="{{$contact->title}}">{{$contact->name}}</h4>
                            </div>
                            <div class="meta-mail-time">
                                <p class="user-email" data-mailto="{{$contact->email}}">{{$contact->email}}</p>-
                                <p class="meta-time align-self-center">{{$contact->created_at}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mail-content" data-mailTitle="{{$contact->title}}">{{$contact->message}}</p>
            </div>
        </div>
    @endforeach
</div>