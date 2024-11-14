// Ensure DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {
    // Select the form element
    const form = document.getElementById("noteForm");

    // Add submit event listener to the form
    form.addEventListener("submit", function (event) {
        // Select form elements to validate
        const textNote = document.querySelector("textarea[name='note_text']").value.trim();
        const imageFile = document.querySelector("input[name='note_image']").files.length;
        const videoFile = document.querySelector("input[name='note_video']").files.length;
        const audioFile = document.querySelector("input[name='note_audio']").files.length;

        // Check if all fields are empty
        if (!textNote && !imageFile && !videoFile && !audioFile) {
            alert("Please enter text or upload at least one file.");
            event.preventDefault(); // Prevent form from submitting
        }
    });
});
