<?php require '../app/views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto p-5 sm:px-6">
    <div class="w-full sm:max-w-2xl mx-auto">
        <h1 class="mb-5 px-4 text-2xl">
            <?= $data['action'] == 'update' ? 'Update a Author' : 'Create a Author'; ?>
        </h1>

        <?php if (session_has('errors')) : ?>
            <div class="p-3">
                <?php foreach (session_once('errors') as $error) : ?>
                    <p class="first-letter:uppercase text-red-500">
                        <?= $error ?>
                    </p>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <form action="<?= $data['action'] == 'update' ? route('authors/update') : route('authors/store') ?>" method="POST">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-3">
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="<?= old('first_name') ?>">
                        </div>
                        <div class="col-span-3">
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="<?= old('last_name') ?>">
                        </div>
                        <div class="col-span-6">
                            <label for="bio" class="block text-sm font-medium text-gray-700"> Biography </label>
                            <div class="mt-1">
                                <textarea id="bio" name="bio" rows="4" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Author's biography"><?= old('bio') ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($data['action'] == 'update') : ?>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Update</button>
                        <a href="<?= route('authors/table') ?>" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>
                    </div>
                <?php else : ?>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create</button>
                    </div>
                <?php endif ?>

            </div>
        </form>
    </div>

</div>