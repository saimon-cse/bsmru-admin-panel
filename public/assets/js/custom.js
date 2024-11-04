// DOMContentLoaded event for form validation and file handling
document.addEventListener('DOMContentLoaded', function() {
    // Get all forms on the page
    var forms = document.querySelectorAll('form');

    forms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            var valid = true;
            var requiredFields = form.querySelectorAll('[required]');
            var fileInputs = form.querySelectorAll('input[type="file"]');

            // Check required fields
            requiredFields.forEach(function(field) {
                if (!field.value) {
                    valid = false;
                    alert('Please fill out all required fields.');
                }
            });

            // Check file inputs for valid extensions
            fileInputs.forEach(function(fileInput) {
                var accept = fileInput.getAttribute('accept');
                if (accept && fileInput.value) {
                    var allowedExtensions = accept.split(',').map(function(ext) {
                        return ext.trim().toLowerCase().replace('.', '');
                    });
                    var filePath = fileInput.value;
                    var fileExtension = filePath.split('.').pop().toLowerCase();

                    if (!allowedExtensions.includes(fileExtension)) {
                        valid = false;
                        alert('Only the following file types are allowed: ' +
                            allowedExtensions.join(', '));
                    } else if (fileExtension === 'jpeg') {
                        // Handle renaming for .jpeg files to .jpg
                        var file = fileInput.files[0];
                        var newFileName = file.name.replace(/\.jpeg$/i, '.jpg');
                        var renamedFile = new File([file], newFileName, {
                            type: file.type
                        });
                        var dataTransfer = new DataTransfer();
                        dataTransfer.items.add(renamedFile);
                        fileInput.files = dataTransfer.files;
                    } else {
                        // Rename the file extension to lowercase for other files
                        var file = fileInput.files[0];
                        var renamedFile = new File([file], file.name.replace(
                            /\.[^/.]+$/,
                            function(ext) {
                                return ext.toLowerCase();
                            }), {
                            type: file.type
                        });
                        var dataTransfer = new DataTransfer();
                        dataTransfer.items.add(renamedFile);
                        fileInput.files = dataTransfer.files;
                    }
                }
            });

            if (!valid) {
                event.preventDefault();
            }
        });
    });
});

// CKEditor initialization
ClassicEditor
    .create(document.querySelector('.editor'), {
        ckfinder: {
            uploadUrl: "ckfileupload.php",
        }
    })
    .then(editor => {
        console.log(editor);
    })
    .catch(error => {
        console.error(error);
    });

// Delete confirmation
document.addEventListener('DOMContentLoaded', function() {
    // Get all delete links
    var deleteLinks = document.querySelectorAll('.delete-link');

    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default action
            var confirmation = confirm('Are you sure you want to delete this item?');

            if (confirmation) {
                // If the user confirms, proceed with the deletion
                window.location.href = link.href;
            }
        });
    });
});

// Sanitize input fields to remove HTML tags
function sanitizeInputs() {
    const inputs = document.querySelectorAll('input[type="text"]');

    inputs.forEach(input => {
        input.value = input.value.replace(/<[^>]*>?/gm, '');
    });
}
