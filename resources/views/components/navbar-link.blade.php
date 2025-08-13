@props(['active' => false])

<li style="display:inline; margin-right:10px;">
    <a {{ $attributes }} style="padding:5px 10px; text-decoration:none; border-radius:4px; {{ $active ? 'background-color:#007bff; color:white;' : 'color:#333;' }}">
        {{ $slot }}
    </a>
</li>