<x-mail::message>
    #  {{ 'Hello ' . $name }}

    Message: {{ $message }}

    # Email: {{ $email }}
    # Phone Number: {{ $phone }}


     Thanks,
{{ config('app.name') }}
</x-mail::message>

