<!-- form -->
<style>
    #drop-area {
        border: 2px dashed #ccc;
        padding: 20px;
        text-align: center;
    }

    #drag-label {
        display: block;
        margin-bottom: 10px;
        font-size: 16px;
        color: #666;
    }

    #preview-image {
        max-width: 100%;
        max-height: 300px;
        margin-top: 10px;
        display: none;
    }
</style>
<div class="row">
    <div class="col-md-3 text-center">
        <h3>{{ trans('common.image') }} </h3>
        <div id="drop-area">
            <input type="file" id="image-input" accept="image/*" name="image" />
            <label for="image-input" id="drag-label">
                Drag and drop an image or paste it here
            </label>
            <img id="preview-image" src="#" alt="Preview Image" />
        </div>

        <script>
            var dropArea = document.getElementById('drop-area');
            var imageInput = document.getElementById('image-input');
            var previewImage = document.getElementById('preview-image');

            dropArea.addEventListener('dragover', function (e) {
                e.preventDefault();
                dropArea.classList.add('drag-over');
            });

            dropArea.addEventListener('dragleave', function (e) {
                e.preventDefault();
                dropArea.classList.remove('drag-over');
            });

            dropArea.addEventListener('drop', function (e) {
                e.preventDefault();
                dropArea.classList.remove('drag-over');
                handleFiles(e.dataTransfer.files);
            });

            imageInput.addEventListener('change', function (e) {
                handleFiles(e.target.files);
            });

            document.addEventListener('paste', function (e) {
                var items = e.clipboardData.items;
                for (var i = 0; i < items.length; i++) {
                    if (items[i].type.indexOf('image') !== -1) {
                        var file = items[i].getAsFile();
                        handleFiles([file]);
                        break;
                    }
                }
            });

            function handleFiles(files) {
                if (files && files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                        var dataTransfer = new DataTransfer();
                        dataTransfer.items.add(files[0]);

                        imageInput.files = dataTransfer.files;
                        previewImage.style.display = 'block';
                    };
                    reader.readAsDataURL(files[0]);
                }
            }
        </script>
    </div>

    <div class="row pt-2">
        <div class="divider col-11 col-sm-11">
            <div class="divider-text">{{ trans('common.additionalImages') }}</div>
        </div>
        <div class="col-1 col-sm-1">
            <div class="btn btn-primary mt-1 me-1 btn-create-images"> <i data-feather="plus"></i></div>
        </div>
    </div>
    <div class="row pt-1 images-section">
    </div>
</div>
<!--/ form -->
