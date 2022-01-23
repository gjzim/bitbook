<div class="flex items-center bg-green-600 pl-3 pr-2 text-white" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
    {{ session('message') }}

    <span @click="show = false" class="ml-3 cursor-pointer">
        <i class="fa fa-times-circle" aria-hidden="true"></i>
    </span>
</div>
