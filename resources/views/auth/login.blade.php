
<x-layout>

<x-slot:headings>Login account</x-slot:headings>


<form method="POST" action="{{route('login.login')}}" >
    @csrf

    <x-form-field>
        <x-form-label>Email</x-form-label>
        <x-form-input name="email" placeholder="john@doe.com" value="{{old('email')}}"/>
        <x-form-error fieldName="email"></x-form-error>
    </x-form-field>

    <x-form-field>
        <x-form-label>Password</x-form-label>
        <x-form-input name="password" placeholder="Doe..."/>
        <x-form-error fieldName="password"></x-form-error>
    </x-form-field>

    <x-form-button type="submit" InnerHtml="Submit"/>
</form>

</x-layout>