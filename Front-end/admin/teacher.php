<?php
require_once('../../Back-end/Classes/Enseignant.php');

$teachers=Enseignant::afficherTeacher();
var_dump($teachers);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Validation - Youdemy</title>
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
                <a href="#" class="flex items-center space-x-3 p-3 text-blue-500 bg-blue-50 rounded-lg">
                    <i class="ri-user-follow-line text-lg"></i>
                    <span>Teacher Validation</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-50 rounded-lg">
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
            <h1 class="text-2xl font-bold text-gray-800">Teacher Account Validation</h1>
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

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow-sm border border-blue-100 p-6 mb-8">
            <div class="flex space-x-4">
                <div class="flex-1">
                    <input type="text" placeholder="Search teachers..." class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-400">
                </div>
                <select class="p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-400">
                    <option>All Status</option>
                    <option>Pending</option>
                    <option>Approved</option>
                    <option>Rejected</option>
                </select>
            </div>
        </div>

        <!-- Teachers Table -->
        <div class="bg-white rounded-lg shadow-sm border border-blue-100 p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-500 font-medium">Teacher</th>
                            <th class="px-6 py-3 text-left text-gray-500 font-medium">Role</th>
                            <th class="px-6 py-3 text-left text-gray-500 font-medium">Documents</th>
                            <th class="px-6 py-3 text-left text-gray-500 font-medium">Status</th>
                            <th class="px-6 py-3 text-left text-gray-500 font-medium">Actions</th>
                        </tr>
                    </thead>
                        <tbody class="divide-y divide-gray-100">
                                <?php foreach ($teachers as $teacher): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <img src="/api/placeholder/40/40" alt="Teacher" class="w-10 h-10 rounded-full">
                                            <div>
                                                <p class="font-medium text-gray-800"><?php echo $teacher->getNom(); ?></p>
                                                <p class="text-sm text-gray-500"><?php echo $teacher->getEmail(); ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-800"><?php echo $teacher->getRole(); ?></td> 
                                    <td class="px-6 py-4">
                                        <button class="text-blue-500 hover:text-blue-700">
                                            <i class="ri-file-text-line mr-2"></i>View Files
                                        </button>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">Pending</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <a href="../../Back-end/Actions/User/ActiveTeacher.php?idT=<?=$teacher->getId()?>" class="p-2 text-green-400 hover:text-green-600" title="Approve">
                                                <i class="ri-check-line text-lg"></i>
                                            </a>
                                            <button class="p-2 text-red-400 hover:text-red-600" title="Reject">
                                                <i class="ri-close-line text-lg"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                        </tbody>

                    </table>
            </div>
        </div>
    </main>
</body>
</html>