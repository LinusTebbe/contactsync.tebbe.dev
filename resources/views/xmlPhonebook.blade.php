<?='<?xml version="1.0" encoding="UTF-8"?>' ?>
<AddressBook>
    @foreach($contacts as $i => $contact)
        <Contact>
            <id>{{ $i + 1 }}</id>
            <FirstName>{{ $contact->getNames()[0]->getGivenName() }}</FirstName>
            <LastName>{{ $contact->getNames()[0]->getFamilyName() }}</LastName>
            <Frequent>0</Frequent>
            @foreach($contact->getPhoneNumbers() as $phoneIndex => $phoneNumber)
                <Phone type="{{ $phoneNumber->getFormattedType() }}">
                    <phonenumber>{{ $phoneNumber->getCanonicalForm() }}</phonenumber>
                    <accountindex>{{ $phoneIndex }}</accountindex>
                </Phone>
            @endforeach
            <Primary>0</Primary>
            @if(count($contact->getOrganizations()) > 0)
                <Job>{{ $contact->getOrganizations()[0]->getTitle() }}</Job>
                <Company>{{ $contact->getOrganizations()[0]->getName() }}</Company>
            @endif
        </Contact>
    @endforeach
</AddressBook>
