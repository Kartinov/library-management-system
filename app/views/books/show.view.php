<?php require '../app/views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-5">

    <div class="flex flex-wrap sm:flex-no-wrap w-full max-w-4xl mx-auto">

        <!-- Book cover image -->
        <div class="w-full sm:w-1/2 sm:p-5 rounded-t sm:rounded-l sm:rounded-t-none">
            <img class="object-cover w-full rounded-md shadow-xl" src="<?= $data['book']->image_url ?>" alt="<?= $data['book']->title ?>">
        </div>

        <div class="w-full sm:w-1/2 sm:p-5 prose">
            <h3 class="font-semibold text-3xl lg:text-4xl lg:leading-9 leading-7 text-gray-800 mt-4"><?= $data['book']->title ?></h3>
            <h3 class="text-xl text-gray-500 uppercase mb-12"><?= $data['book']->a_first_name . ' ' . $data['book']->a_last_name ?></h3>

            <p>Published: <?= $data['book']->year_of_publication ?></p>
            <p>Pages: <?= $data['book']->num_of_pages ?></p>
            <p>Category: <?= $data['book']->c_name ?></p>
        </div>
    </div>

    <?php require '../app/views/books/components/_comments.php'; ?>

</div>


<?php require '../app/views/partials/footer.php' ?>