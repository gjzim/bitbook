@props([
    'title' => '',
])

<div
    {{ $attributes->merge([
        'class' =>
            'inline-block align-bottom bg-white text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle',
    ]) }}>
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="text-center sm:mt-0 sm:text-left">
            <h3 class="text-xl text-center font-bold leading-5 text-gray-900" id="modal-title">
                {{ $title }}
            </h3>
            <div class="mt-5 overflow-hidden">
                {{ $body }}
            </div>
        </div>
    </div>

    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        {{ $footer }}
    </div>
</div>
