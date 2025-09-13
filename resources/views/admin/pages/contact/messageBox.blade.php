<div class="message-box">
    <div class="message-box-scroll" id="ct">
        @foreach($contacts as $contact)
            <div class="mail-item mailInbox">
                <div class="animated animatedFadeInUp fadeInUp" id="mailHeadingFive-{{$loop->index}}">
                    <div class="mb-0">
                        <div class="mail-item-heading collapsed" data-toggle="collapse" role="navigation" data-target="#mailCollapseFive-{{$loop->index}}" aria-expanded="false">
                            <div class="mail-item-inner">
                                <div class="d-flex">
                                    <div class="n-chk text-center">
                                        @can('role', 'contact.destroy')
                                            <a class="delete-message" href="{{route('admin.contact_delete', $contact->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                        @endcan


                                    </div>
                                    <div class="n-chk text-center">

                                        <a href="{{route('admin.contact.show' , $contact->id)}}" class=""> <i class="fas fa-eye"></i></a>
                                    </div>
                                    <div class="f-body">
                                        <div class="meta-mail-time">
                                            <p class="user-email" data-mailTo="{{$contact->email}}">{{$contact->name}}</p>
                                        </div>
                                        <div class="meta-title-tag">
                                            <p class="mail-content-excerpt"><span class="mail-title ml-3">{{$contact->title}} -</span> {{substr($contact->message, 0, 50)}}</p>
                                            <p class="meta-time align-self-center">{{$contact->created_at}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


    </div>
</div>