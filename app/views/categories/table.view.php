<?php require '../app/views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto py-5 flex flex-wrap sm:flex-no-wrap items-center justify-between w-full sm:px-6"">
    <div class="w-full">

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="flex justify-between items-center px-4 py-5 sm:px-6">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Categories management</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Here you can add, delete and edit categories.</p>
                </div>

                <?php if (session_has('success')) : ?>
                    <div class="flex w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md">
                        <div class="flex items-center justify-center w-12 bg-emerald-500">
                            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
                            </svg>
                        </div>

                        <div class="px-4 py-2 -mx-3">
                            <div class="mx-3">
                                <span class="font-semibold text-emerald-500 dark:text-emerald-400">Success</span>
                                <p class="text-sm text-gray-600"><?= session_once('success') ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif ?>

                <div>
                    <a href="<?= route("categories/create") ?>" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer">
                        Add new category
                    </a>
                </div>
            </div>
            <div class="border-t border-gray-200">
                <div class="flex flex-wrap sm:flex-no-wrap w-full">
                    <div class="w-full sm:w-1/2">
                        <table class="leading-normal mx-auto mt-5 shadow">
                            <caption class="p-5 font-semibold text-lg text-gray-800  bg-green-200 mb-3 shadow rounded-md">Available</caption>
                            <thead>
                                <tr>
                                    <th scope="col" class="px-3 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        ID
                                    </th>
                                    <th scope="col" class="px-3 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        name
                                    </th>
                                    <th scope="col" class="px-3 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['categories'] as $category) : ?>

                                    <?php if (!(bool) $category->is_archived) : ?>
                                        <tr>
                                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    <?= $category->id ?>
                                                </p>
                                            </td>
                                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap first-letter:uppercase">
                                                    <?= $category->name ?>
                                                </p>
                                            </td>

                                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm flex gap-4">

                                                <!-- Edit button -->
                                                <a href="<?= route("categories/create/{$category->id}") ?>" class="flex items-center px-2 py-2 w-24 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    <span class="mx-1">Edit</span>
                                                </a>

                                                <!-- Delete button -->
                                                <a href="<?= route("categories/archieve/{$category->id}") ?>" class="flex items-center px-2 py-2 font-medium tracking-wide w-24 text-white capitalize transition-colors duration-200 transform bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    <span class="mx-1">Delete</span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endif ?>

                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="w-full sm:w-1/2">
                        <table class="leading-normal mx-auto mt-5 shadow">
                            <caption class="p-5 font-semibold text-lg text-gray-800  bg-red-200 mb-3 shadow rounded-md">Archieved</caption>
                            <thead>
                                <tr>
                                    <th scope="col" class="px-3 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        ID
                                    </th>
                                    <th scope="col" class="px-3 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        name
                                    </th>
                                    <th scope="col" class="px-3 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['categories'] as $category) : ?>
                                    <?php if ((bool) $category->is_archived) : ?>
                                        <tr>
                                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    <?= $category->id ?>
                                                </p>
                                            </td>
                                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap first-letter:uppercase">
                                                    <?= $category->name ?>
                                                </p>
                                            </td>

                                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm flex gap-4">

                                                <!-- Edit button -->
                                                <a href="<?= route("categories/create/{$category->id}") ?>" class="flex items-center px-2 py-2 w-24 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    <span class="mx-1">Edit</span>
                                                </a>

                                                <!-- Delete button -->
                                                <a href="<?= route("categories/restore/{$category->id}") ?>" class="flex items-center px-2 py-2 font-medium tracking-wide w-24 text-white capitalize transition-colors duration-200 transform bg-green-600 rounded-md hover:bg-green-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0019 16V8a1 1 0 00-1.6-.8l-5.333 4zM4.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0011 16V8a1 1 0 00-1.6-.8l-5.334 4z" />
                                                    </svg>
                                                    <span class="mx-1">Restore</span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>