@props(['type' => 'success', 'message' => null, 'autodismiss' => 4000])

@if(session()->has($type) || $message)
    <div {{ $attributes->merge(['class' => "alert alert-{$type} alert-dismissible fade show"]) }} role="alert">
        {{ $message ?? session($type) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    @if($autodismiss > 0)
        @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const alert = document.querySelector('.alert');
                if (alert) {
                    setTimeout(() => {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }, {{ $autodismiss }});
                }
            });
        </script>
        @endpush
    @endif
@endif
