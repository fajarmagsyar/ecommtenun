<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="https://lh3.googleusercontent.com/a-/AOh14GhAqE-eI-z585nmxPlRdVs806Y7vY4XNkrtUShM=s288-p-no"
                    class="logo" alt="Laravel Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
