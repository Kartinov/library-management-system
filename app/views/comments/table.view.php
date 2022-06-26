<?php require '../app/views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto py-5 flex flex-wrap sm:flex-no-wrap items-center justify-between w-full sm:px-6">
    <div class=" w-full">

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="flex justify-between items-center px-4 py-5 sm:px-6">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Comments management</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Here you can approve comments.
                    </p>
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

            </div>
            <div class="border-t border-gray-200">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th scope="col" class="px-3 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                Book
                            </th>
                            <th scope="col" class="px-3 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                Client
                            </th>
                            <th scope="col" class="px-3 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                Comment
                            </th>
                            <th scope="col" class="px-3 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                Created At
                            </th>
                            <th scope="col" class="px-3 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['comments'] as $comment) : ?>
                            <tr>
                                <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <a href="#" class="block relative">
                                                <img src="<?= $comment->image_url ?>" alt="cover" class="mx-auto object-cover h-12 w-8 " />
                                            </a>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                <?= $comment->title  ?>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap capitalize">
                                        <?= $comment->u_first_name . ' ' . $comment->u_last_name ?>
                                    </p>
                                </td>
                                <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        <?= $comment->comment_text ?>
                                    </p>
                                </td>
                                <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        <?= $comment->created_at ?>
                                    </p>
                                </td>
                                <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                    <a href="<?= route("comments/approve/{$comment->id}") ?>" class="flex items-center px-2 py-2 w-24  font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-green-600 rounded-md hover:bg-green-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <span class="mx-1">Aprove</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>