    <div class="flex flex-wrap w-full max-w-4xl mx-auto sm:flex-no-wrap mb-6">
        <!-- Book cover image -->
        <div class="w-full rounded shadow-lg sm:w-1/2 mb-5 sm:mb-0">
            <img class="object-cover w-full rounded-md shadow-xl" src="<?= $data['book']->image_url ?>" alt="<?= $data['book']->title ?>">
        </div>

        <div class="w-full prose sm:w-1/2 py-5 sm:py-0 px-5 shadow-lg sm:shadow-none">
            <h3 class="font-bold text-3xl lg:text-4xl lg:leading-9 leading-7 text-gray-800 mt-4"><?= $data['book']->title ?></h3>
            <h3 class="text-xl text-gray-500 uppercase mb-12">
                <?= $data['book']->a_first_name . ' ' . $data['book']->a_last_name ?>
            </h3>

            <p>Published: <?= $data['book']->year_of_publication ?></p>
            <p>Pages: <?= $data['book']->num_of_pages ?></p>
            <p>Category:
                <span class="capitalize">
                    <?= $data['book']->c_name ?>
                </span>
            </p>
        </div>
    </div>