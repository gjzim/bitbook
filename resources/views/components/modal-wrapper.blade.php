<div
    {{ $attributes->merge([
        'class' => 'fixed z-10 inset-0 overflow-y-auto',
        'aria-labelledby' => 'modal-title',
        'role' => 'dialog',
        'aria-modal' => 'true',
    ]) }}>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        {{ $slot }}
    </div>
</div>
