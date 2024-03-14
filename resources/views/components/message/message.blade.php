@if(session('success'))
    <div class="container">
        <x-message.successMessage class="alert alert-success">
            {{ session('success') }}
        </x-message.successMessage>
    </div>
@elseif(session('error'))
    <div class="container">
        <x-message.errorMessage class="alert alert-danger">
            {{ session('error') }}
        </x-message.errorMessage>
    </div>
@endif
