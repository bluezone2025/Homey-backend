<div class="message-box">

    <div class="message-box-scroll" id="ct">
        <div>
            <div class="mail-content-container mailInbox" data-mailfrom="info@mail.com" data-mailto="{{$contact->email}}" data-mailcc="">
                <div class="d-flex justify-content-between mb-5">
                    <div class="d-flex user-info">
                        <div class="f-body">
                            <div class="meta-title-tag">
                                <h4 class="mail-usr-name" data-mailtitle="{{$contact->title}}">{{$contact->name}}</h4>
                            </div>
                            <div class="meta-mail-time">
                                <p class="user-email" data-mailto="{{$contact->email}}">{{$contact->email}}</p>
                            </div>


                            <div class="meta-mail-time">
                                <p class="user-phone">{{$contact->phone}}</p>
                            </div>

                        </div>
                    </div>
                </div>

                <p class="mail-content" data-mailTitle="">
                    {{$contact->title}} <br>

                    {{$contact->message}}</p>
            </div>
        </div>
    </div>

</div>

