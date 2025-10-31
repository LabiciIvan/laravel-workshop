
<x-layout>

<x-slot:headings>Register account</x-slot:headings>


<form method="POST" action="{{route('register.register')}}" >
    @csrf
    <x-form-field>
        <x-form-label>First name</x-form-label>
        <x-form-input name="first_name" placeholder="John..."/>
        <x-form-error fieldName="first_name"></x-form-error>
    </x-form-field>

    <x-form-field>
        <x-form-label>Last name</x-form-label>
        <x-form-input name="last_name" placeholder="Doe..."/>
        <x-form-error fieldName="last_name"></x-form-error>
    </x-form-field>

    <x-form-field>
        <x-form-label>Password</x-form-label>
        <x-form-input name="password" type="password"/>
        <x-form-error fieldName="password"></x-form-error>
    </x-form-field>

    <x-form-field>
        <x-form-label>Confirm password</x-form-label>
        <x-form-input name="password_confirmation" type="password"/>
        <x-form-error fieldName="password_confirmation"></x-form-error>
    </x-form-field>

    <x-form-field>
        <x-form-label>Email</x-form-label>
        <x-form-input name="email" placeholder="john@doe.com"/>
        <x-form-error fieldName="email"></x-form-error>
    </x-form-field>

    <x-form-button type="submit" InnerHtml="Submit"/>
</form>

</x-layout>