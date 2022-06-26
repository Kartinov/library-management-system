<div class="w-full max-w-4xl mx-auto">
    <?php if (session_has('success')) : ?>
        <div class="flex w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-md mb-5">
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
    <h2 class="text-2xl font-semibold mb-5">Comments</h2>

    <?php if (!$data['authenticated']) : ?>
        <!-- Message if client is not registered -->
        <div class="bg-blue-200 border-blue-700 text-blue-700 border-l-4 p-4 flex items-center" role="alert">
            <div class="w-10 text-">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <p>
                Only registered clients can comment. Please <a class="text-red-700 font-bold" href="<?= route('home/login') ?>">Login</a> or <a class="text-red-700 font-bold" href="<?= route('home/register') ?>">Register a profile</a>
            </p>
        </div>
    <?php else : ?>
        <!-- comments -->
        <div>
            <?php if (empty($data['comments'])) : ?>
                <h4>There is no comments for this book</h4>
            <?php else : ?>
                <?php foreach ($data['comments'] as $comment) : ?>
                    <div class="bg-white w-full rounded-lg shadow-xl sm:inline-block mb-5">
                        <div class="p-6">
                            <p class="text-gray-600 font-bold">
                                Dimche Kartinov
                            </p>

                            <p class="mt-3">
                                <?= $comment->comment_text ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif ?>
        </div>

        <?php if (!$data['commented']) : ?>

            <form action="<?= route("comments/store/{$data['bookId']}") ?>" method="POST">
                <div class="mb-3">
                    <?php if (session_has('errors')) : ?>
                        <div class="p-3">
                            <?php foreach (session_once('errors') as $error) : ?>
                                <p class="first-letter:uppercase text-red-500">
                                    <?= $error ?>
                                </p>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>
                </div>
                <label class="text-gray-700 mb-3 block" for="comment_text">Add a comment:</label>
                <textarea class="appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" id="comment_text" placeholder="Enter your comment" name="comment_text" rows="3" cols="30"></textarea>
                <button type="submit" class="inline-flex justify-center py-2 px-4 mt-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
            </form>

        <?php else : ?>
            <?php if (!$data['commented']->is_approved) : ?>
                <div class="bg-yellow-200 w-full rounded-lg shadow-xl sm:inline-block mb-5">
                    <div class="p-6">
                        <div class="flex flex-nowrap">
                            <div class="h-10 mr-3 text-yellow-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                </svg>
                            </div>
                            <span>Your comment is awaiting approval</span>
                        </div>
                        <p class="text-gray-600 font-bold mb-3 capitalize">
                            <?= session_get('user')->first_name . ' ' . session_get('user')->last_name ?>
                        </p>


                        <p class="mt-3">
                            <?= $data['commented']->comment_text; ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="bg-green-200 border-green-700 text-green-700 border-l-4 p-4 flex items-center" role="alert">
                <div class="w-10 text-">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p>
                    You have already commented on this book. To renew your comment you have to delete your old one. <a href="<?= route("comments/delete/{$data['commented']->id}") ?>" class="text-red-700 font-bold">Delete it</a>
                </p>
            </div>
        <?php endif; ?>

    <?php endif;  ?>

</div>