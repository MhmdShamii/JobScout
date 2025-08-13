@props(["role" => "user"])

@if ($role === 'admin')
    <span class="text-xs font-semibold bg-red-300 px-2 py-1 rounded-full text-red-700">Admin</span>
@elseif ($role === 'company')
    <span class="text-xs font-semibold bg-blue-300 px-2 py-1 rounded-full text-blue-700">Company</span>
@elseif ($role === 'user')
    <span class="text-xs font-semibold bg-gray-300 px-2 py-1 rounded-full text-gray-700">User</span>
@endif