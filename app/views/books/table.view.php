<?php require '../app/views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto py-5 flex flex-wrap sm:flex-no-wrap items-center justify-between w-full sm:px-6" x-data="{ deleteModal: false }">
    <div class="w-full">

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="flex flex-col sm:flex-row justify-center sm:justify-between items-center px-4 py-5 sm:px-6">
                <div class="mb-3 sm:mb-0 text-center sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Books management</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Here you can add, delete and edit books.</p>
                </div>


                <?php if (session_has('success')) : ?>
                    <div class="flex w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md mb-3 sm:mb-0">
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
                    <a href="<?= route("books/create") ?>" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer">
                        Add book
                    </a>
                </div>
            </div>

            <div class="border-t border-gray-200 overflow-x-auto">
                <table class="table-auto w-full mx-auto leading-normal shadow-lg mt-5">
                    <thead>
                        <tr>
                            <th scope="col" class="px-3 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                title
                            </th>
                            <th scope="col" class="px-3 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                author
                            </th>
                            <th scope="col" class="px-3 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                published
                            </th>
                            <th scope="col" class="px-3 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                pages
                            </th>
                            <th scope="col" class="px-3 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                category
                            </th>
                            <th scope="col" class="px-3 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['books'] as $book) : ?>
                            <tr>
                                <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <a href="#" class="block relative">
                                                <img src="<?= $book->image_url; ?>" alt="cover" class="mx-auto object-cover h-12 w-8 " />
                                            </a>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                <?= $book->title; ?>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        <?= $book->a_first_name . ' ' . $book->a_last_name; ?>
                                    </p>
                                </td>
                                <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        <?= $book->year_of_publication; ?>
                                    </p>
                                </td>
                                <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        <?= $book->num_of_pages; ?>
                                    </p>
                                </td>
                                <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap first-letter:uppercase">
                                        <?= $book->c_name; ?>
                                    </p>
                                </td>

                                <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex">

                                        <a href="<?= route("books/create/{$book->id}") ?>" class="flex items-center px-2 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-500 mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <span class="mx-1">Edit</span>
                                        </a>

                                        <button @click="deleteModal = true" data-book-id="<?= $book->id ?>" class="deleteBookBtn flex items-center px-2 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-600 rounded-md hover:bg-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <span class="mx-1">Delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div x-show="deleteModal" class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
            <div x-cloak @click="deleteModal = false" x-show="deleteModal" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"></div>

            <div x-cloak x-show="deleteModal" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xs p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">



                <div class="w-full h-full text-center">
                    <div class="flex h-full flex-col justify-between">
                        <svg width="40" height="40" class="mt-4 w-12 h-12 m-auto text-red-500" fill="currentColor" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                            <path d="M704 1376v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm-544-992h448l-48-117q-7-9-17-11h-317q-10 2-17 11zm928 32v64q0 14-9 23t-23 9h-96v948q0 83-47 143.5t-113 60.5h-832q-66 0-113-58.5t-47-141.5v-952h-96q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h309l70-167q15-37 54-63t79-26h320q40 0 79 26t54 63l70 167h309q14 0 23 9t9 23z">
                            </path>
                        </svg>
                        <p class="text-gray-800 text-xl font-bold mt-4">
                            Remove book
                        </p>
                        <p class="text-gray-600 dark:text-gray-400 text-xs py-2 px-6">
                            All the users comments and notes about this book will be deleted
                        </p>
                        <div class="flex items-center justify-between gap-4 w-full mt-8">
                            <a id="deleteBookBtn" href="#" class="py-2 px-4  bg-red-600 hover:bg-red-700 focus:ring-red-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg ">
                                Delete
                            </a>
                            <button @click="deleteModal = false" type="button" class="py-2 px-4  bg-white hover:bg-gray-100 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-indigo-500 w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>

<script>
    const deleteRouteUrl = "<?= route('books/delete'); ?>"
    const deleteBookBtn = document.querySelectorAll('.deleteBookBtn');
    const deleteBookBtnModal = document.getElementById('deleteBookBtn');

    deleteBookBtn.forEach(element => {
        element.addEventListener('click', function() {
            const bookId = this.getAttribute('data-book-id')

            deleteBookBtnModal.href = deleteRouteUrl + '/' + bookId
        });
    });
</script>