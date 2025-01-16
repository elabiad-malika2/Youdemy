<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white border-b">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="./index.php">
                        <img src="/api/placeholder/150/50" alt="Youdemy Logo">
                    </a>
                    <h1 class="text-2xl font-bold text-gray-800">Teacher Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="p-2 text-gray-600 hover:text-blue-500">
                        <i class="ri-notification-3-line text-xl"></i>
                    </button>
                    <div class="flex items-center space-x-2">
                        <img src="/api/placeholder/32/32" alt="Profile" class="w-8 h-8 rounded-full">
                        <span class="text-gray-700">John Teacher</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-blue-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total Courses</p>
                        <h3 class="text-2xl font-bold text-gray-800">6</h3>
                    </div>
                    <i class="ri-book-open-line text-2xl text-blue-400"></i>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-sm border border-blue-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total Students</p>
                        <h3 class="text-2xl font-bold text-gray-800">128</h3>
                    </div>
                    <i class="ri-user-line text-2xl text-blue-400"></i>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-sm border border-blue-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total Revenue</p>
                        <h3 class="text-2xl font-bold text-gray-800">$2,450</h3>
                    </div>
                    <i class="ri-money-dollar-circle-line text-2xl text-blue-400"></i>
                </div>
            </div>
        </div>

        <!-- Courses Section -->
        <div class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">My Courses</h2>
                <button class="flex items-center space-x-2 bg-blue-400 text-white px-4 py-2 rounded-full hover:bg-blue-500 transition-colors" onclick="toggleModal(true)">
                    <i class="ri-add-circle-line"></i>
                    <span>Add New Course</span>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Course Card -->
                <div class="bg-white rounded-lg shadow-sm border border-blue-400 overflow-hidden hover:shadow-md transition-shadow">
                    <img src="/api/placeholder/400/200" alt="Course Image" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-semibold text-gray-800">Master Web Development</h3>
                            <button class="text-gray-500 hover:text-blue-500">
                                <i class="ri-more-2-fill"></i>
                            </button>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="ri-user-line mr-2"></i>
                            <span>25 Students</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-400 font-bold">$49.99</span>
                            <div class="flex items-center text-blue-400">
                                <i class="ri-star-fill mr-1"></i>
                                4.8
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add more course cards here -->
            </div>
        </div>
        <!-- Modal for Adding a Course -->
    <div id="addCourseModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-[80%] p-6 overflow-y-auto h-[80%]">
            <h2 class="text-lg font-semibold text-gray-800">Add New Course</h2>
            <form id="addCourseForm" class="mt-4 space-y-4"  enctype="multipart/form-data">
                <div>
                    <label for="courseTitle" class="block text-sm font-medium text-gray-700">Title</label>
                    <input 
                        type="text" 
                        id="courseTitle" 
                        name="title" 
                        class="block w-full  px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="courseDescription" class="block  text-sm font-medium text-gray-700">Description</label>
                    <textarea 
                        id="courseDescription" 
                        name="description" 
                        class="block w-full mt-1 border px-3 py-2 h-32 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </textarea>
                </div>
                <div>
                    <label for="courseImage" class="block  text-sm font-medium text-gray-700">Image</label>
                    <input 
                        type="file" 
                        id="courseImage" 
                        name="image" 
                        accept="image/*"
                        class="block w-full mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">                </div>
                <div>
                    <label for="courseTags" class="block text-sm font-medium text-gray-700">Tags</label>
                    <input 
                        type="text" 
                        id="courseTags" 
                        name="tags" 
                        class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                        placeholder="Type and press Enter to add tags">
                    <div id="tagsList" class="hidden bg-white border mt-1 rounded-md shadow-md overflow-y-auto max-h-32 w-full"></div>
                    <div id="selectedTags" class="mt-2 flex flex-wrap gap-2"></div>
                    <!-- <input type="hidden" name="tags[]" id="tags"> -->
                </div>
                <div>
                    <label for="courseCategorie" class="block text-sm font-medium text-gray-700">Categorie</label>
                    <select 
                        id="courseCategorie" 
                        name="categorie" 
                        class="block px-3 py-2 w-full mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                       
                    </select>
                </div>
                <div>
                    <label for="courseType" class="block text-sm font-medium text-gray-700">Type</label>
                    <select 
                        id="courseType" 
                        name="type" 
                        class="block px-3 py-2 w-full mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        onchange="toggleContentField()">
                        <option value="text">Text</option>
                        <option value="video">Video</option>
                    </select>
                </div>
                <div id="textContentField" class="hidden">
                    <label for="courseText" class="block text-sm font-medium text-gray-700">Text Content</label>
                    <textarea 
                        id="courseText" 
                        name="content" 
                        class="block w-full mt-1 border x-3 py-2 h-32 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </textarea>
                </div>
                <div id="videoContentField" class="hidden">
                    <label for="courseVideo" class="block text-sm font-medium text-gray-700">Video File</label>
                    <input 
                        type="file" 
                        id="courseVideo" 
                        name="video" 
                        accept="video/*"
                        class="block w-full mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="flex justify-end space-x-4">
                    <button 
                        type="button" 
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow-md hover:bg-gray-400 transition"
                        onclick="toggleModal(false)">
                        Cancel
                    </button>
                    <button 
                    id="addCours"
                        type="submit" 
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition">
                        Add Course
                    </button>
                </div>
            </form>
        </div>
    </div>

        <!-- Students Section -->
        <div>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Enrolled Students</h2>
                <div class="relative">
                    <i class="ri-search-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" placeholder="Search students..." 
                           class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-400">
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-blue-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 text-left">
                            <tr>
                                <th class="px-6 py-3 text-gray-500 font-medium">Student</th>
                                <th class="px-6 py-3 text-gray-500 font-medium">Course</th>
                                <th class="px-6 py-3 text-gray-500 font-medium">Progress</th>
                                <th class="px-6 py-3 text-gray-500 font-medium">Enrolled Date</th>
                                <th class="px-6 py-3 text-gray-500 font-medium">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <img src="/api/placeholder/32/32" alt="Student" class="w-8 h-8 rounded-full">
                                        <div>
                                            <p class="font-medium text-gray-800">John Doe</p>
                                            <p class="text-sm text-gray-500">john@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-800">Master Web Development</td>
                                <td class="px-6 py-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-400 h-2.5 rounded-full" style="width: 75%"></div>
                                    </div>
                                    <span class="text-sm text-gray-500">75%</span>
                                </td>
                                <td class="px-6 py-4 text-gray-800">Jan 15, 2024</td>
                                <td class="px-6 py-4">
                                    <button class="text-blue-400 hover:text-blue-500">
                                        <i class="ri-more-2-fill"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Add more student rows here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleModal(show) {
            const modal = document.getElementById('addCourseModal');
            modal.classList.toggle('hidden', !show);
        }
        function toggleContentField() {
            const type = document.getElementById('courseType').value;
            const textField = document.getElementById('textContentField');
            const videoField = document.getElementById('videoContentField');
            
            if (type === 'text') {
                textField.classList.remove('hidden');
                videoField.classList.add('hidden');
            } else if (type === 'video') {
                textField.classList.add('hidden');
                videoField.classList.remove('hidden');
            }
        }
    </script>

</body>

</html>