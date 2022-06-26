<?php require '../app/views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto p-5 sm:px-6">
    <div class="w-full sm:max-w-2xl mx-auto">
        <h1 class="mb-5 px-4 text-2xl">
            <?= $data['action'] == 'update' ? 'Update a Book' : 'Create a Book'; ?>
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

        <form action="<?= $data['action'] == 'update' ? route('books/update') : route('books/store') ?>" method="POST">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="<?= old('title') ?>">
                        </div>

                        <div class=" col-span-6">
                            <label for="image_url" class="block text-sm font-medium text-gray-700">Image URL</label>
                            <input type="text" name="image_url" id="image_url" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="<?= old('image_url') ?>">
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="author_id" class="block text-sm font-medium text-gray-700">Author</label>
                            <select id="author_id" name="author_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                                <?php $oldAuthor = old('author_id') ?? ''; ?>

                                <option value="">Choose author</option>
                                <?php foreach ($data['authors'] as $author) : ?>
                                    <option value="<?= $author->id; ?>" 
                                    <?= $author->id == $oldAuthor ? 'selected' : ''; ?>>
                                        <?= $author->first_name . ' ' . $author->last_name; ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-3">

                            <?php $oldCategory = old('categorie_id') ?? ''; ?>

                            <label for="categorie_id" class="block text-sm font-medium text-gray-700">Category</label>
                            <select id="categorie_id" name="categorie_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Choose categery</option>

                                <?php foreach ($data['categories'] as $category) :  ?>
                                    <option class="first-letter:uppercase" value="<?= $category->id; ?>" <?= $category->id == $oldCategory ? 'selected' : ''; ?>>
                                        <?= $category->name; ?></option>
                                <?php endforeach ?>

                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="num_of_pages" class="block text-sm font-medium text-gray-700">Number of Pages</label>
                            <input type="text" name="num_of_pages" id="num_of_pages" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="<?= old('num_of_pages') ?>">
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="year_of_publication" class="block text-sm font-medium text-gray-700">Year of Publication</label>
                            <input type="text" name="year_of_publication" id="year_of_publication" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="2022" value="<?= old('year_of_publication') ?>">
                        </div>
                    </div>
                </div>

                <?php if ($data['action'] == 'update') : ?>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Update</button>
                        <a href="<?= route('books/table') ?>" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>
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