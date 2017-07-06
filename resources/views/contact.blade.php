<li data-id= "{{ $contact->getKey() }}" class="avatar">
    <div class="collapsible-header">
        <img class="circle user_image_list" src="{{ url('storage/images') }}/{{ $contact->image_url }}" alt="">
        <div class="text_content">
            <p class="user_text name user_name_list">{{ $contact->name }}</p>
            <p class="user_text phone user_phone_list">{{ $contact->phone }}</p>
        </div>
        <a href="#!" class="secondary-content dropdown-button" href='#' data-activates="contact_{{ $contact->getKey() }}">
            <i class="material-icons">more_vert</i>
        </a>
        <div style="clear:both"></div>
    </div>
    <div class="collapsible-body">
        <ul class="collection details">

            <li class="collection-item ">
                <i class="material-icons">email</i>
                <span class="title user_mail_list">{{ $contact->email }}</span>
            </li>

            <li class="collection-item ">
                <i class="material-icons">location_on</i>
                <span class="title user_locaion_list">{{ $contact->address }}</span>
            </li>

            <li class="collection-item ">
                <i class="material-icons">date_range</i>
                <span value="{{ $contact->birthday->toDateString() }}"
                      class="title user_date_list">
                    {{ $contact->birthday->diff(\Carbon\Carbon::now())->format('%y years') }}</span>
                </span>
            </li>

            <li class="collection-item ">
                <i class="material-icons">work</i>
                <span class="title user_company_list">{{ $contact->company }}</span>
            </li>

        </ul>
    </div>

    <ul id='contact_{{ $contact->getKey() }}' class='dropdown-content'>
        <li data-id="{{ $contact->getKey() }}" class="edit_data_btn"><a  href="#editModal">Edit</a></li>
        <li><a class="deleteItem" onclick="setContactId(event)" data-id="{{ $contact->getKey() }}"
               href="#deleteModal">Delete</a></li>
    </ul>
</li>