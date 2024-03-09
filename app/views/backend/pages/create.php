<?php include __DIR__ . '/../inc/header.php'; ?>

<div class="container mb-5">

    <?php include __DIR__ . '/../inc/message.php'; ?>

    <h1>Create Page</h1>
    <div class="mt-4">
        <form id="pageForm" action="/page/store" method="POST" autocomplete="off" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="page_url" class="form-label">Page Url</label>
                <div class="input-group">
                    <span class="input-group-text"><?= \App\Helpers\Helper::baseUrl() . '/' ?></span>
                    <input type="text" class="form-control" id="page_url" name="page_url" required>
                </div>
            </div>


            <div>
                <h1 class="float-start">Add Section</h1>
                <button class="btn btn-success float-end btn-add" type="button">+</button>
            </div>
            <br>
            <hr>
            <br>
            <div class="section-section">
                <div class="section">
                    <h2 class="float-start">Section 1</h2>
                    <div class="mb-3">
                        <label for="title_1" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title_1" name="section_title[]" required>
                    </div>
                    <div class="mb-3">
                        <label for="image_1" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image_1" name="image_url[]">
                    </div>
                    <div class="mb-3">
                        <label for="content_1" class="form-label">Content</label>
                        <textarea class="form-control summernote" name="section_content[]"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../inc/footer.php'; ?>

<script>
    let sectionIndex = 1;

    $('.btn-add').click(function() {
        sectionIndex++;
        const sectionDiv = $('.section-section').find('.section').first().clone();


        sectionDiv.find('input[type="text"]').val('');
        sectionDiv.find('input[type="file"]').val('');
        sectionDiv.find('.note-editable').html('');


        sectionDiv.find('h2').text('Section ' + sectionIndex);
        sectionDiv.find('.btn-delete').removeClass('btn-add').addClass('btn-delete');
        sectionDiv.find('h2').append('<button class="btn btn-danger btn-sm float-end btn-delete">-</button>');
        $('.section-section').append(sectionDiv);
    });

    $(document).on('click', '.btn-delete', function() {
        $(this).closest('.section').remove();
    });
</script>