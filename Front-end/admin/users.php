<?php
require_once('../../Back-end/Classes/User.php');
$users = User::afficherUsers();
var_dump($users);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <aside class="fixed top-0 left-0 h-screen w-64 bg-white border-r shadow-sm">
        <div class="p-4">
            <img src="/api/placeholder/150/50" alt="Youdemy Logo" class="mb-8">
            <nav class="space-y-2">
                <a href="#" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <i class="ri-dashboard-line text-lg"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <i class="ri-user-follow-line text-lg"></i>
                    <span>Teacher Validation</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-blue-500 bg-blue-50 rounded-lg">
                    <i class="ri-user-settings-line text-lg"></i>
                    <span>User Management</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <i class="ri-book-open-line text-lg"></i>
                    <span>Courses & Categories</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <i class="ri-price-tag-3-line text-lg"></i>
                    <span>Tags Management</span>
                </a>
            </nav>
        </div>
    </aside>

    <main class="ml-64 p-8">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">User Management</h1>
            <div class="flex items-center space-x-4">
                <button class="p-2 text-gray-600 hover:text-blue-500">
                    <i class="ri-notification-3-line text-xl"></i>
                </button>
                <div class="flex items-center space-x-2">
                    <img src="/api/placeholder/32/32" alt="Admin" class="w-8 h-8 rounded-full">
                    <span class="text-gray-700">Admin</span>
                </div>
            </div>
        </header>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-lg shadow-sm border border-blue-100 p-6 mb-8">
            <div class="flex space-x-4 mb-6">
                <div class="flex-1">
                    <input type="text" placeholder="Search users..." class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-400">
                </div>
                <select class="p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-400">
                    <option>All Roles</option>
                    <option>Student</option>
                    <option>Teacher</option>
                    <option>Admin</option>
                </select>
                <select class="p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-400">
                    <option>All Status</option>
                    <option>Active</option>
                    <option>Suspended</option>
                    <option>Pending</option>
                </select>
            </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-lg shadow-sm border border-blue-100 p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-500 font-medium">User</th>
                            <th class="px-6 py-3 text-left text-gray-500 font-medium">Email</th>
                            <th class="px-6 py-3 text-left text-gray-500 font-medium">Role</th>
                            <th class="px-6 py-3 text-left text-gray-500 font-medium">Status</th>
                            <th class="px-6 py-3 text-left text-gray-500 font-medium">Joined Date</th>
                            <th class="px-6 py-3 text-left text-gray-500 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <!-- Example User Row 1 -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <img src="/api/placeholder/40/40" alt="User" class="w-10 h-10 rounded-full">
                                    <div>
                                        <p class="font-medium text-gray-800">John Doe</p>
                                        <p class="text-sm text-gray-500">@johndoe</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-800">john.doe@example.com</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Teacher</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Active</span>
                            </td>
                            <td class="px-6 py-4 text-gray-800">Jan 15, 2024</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <button class="p-2 text-yellow-400 hover:text-yellow-600" title="Suspend">
                                        <i class="ri-pause-circle-line text-lg"></i>
                                    </button>
                                    <button class="p-2 text-red-400 hover:text-red-600" title="Delete">
                                        <i class="ri-delete-bin-line text-lg"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Example User Row 2 -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <img src="/api/placeholder/40/40" alt="User" class="w-10 h-10 rounded-full">
                                    <div>
                                        <p class="font-medium text-gray-800">Jane Smith</p>
                                        <p class="text-sm text-gray-500">@janesmith</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-800">jane.smith@example.com</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">Student</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">Suspended</span>
                            </td>
                            <td class="px-6 py-4 text-gray-800">Dec 20, 2023</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <button class="p-2 text-green-400 hover:text-green-600" title="Activate">
                                        <i class="ri-play-circle-line text-lg"></i>
                                    </button>
                                    <button class="p-2 text-red-400 hover:text-red-600" title="Delete">
                                        <i class="ri-delete-bin-line text-lg"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>