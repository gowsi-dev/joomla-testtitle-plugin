document.addEventListener('DOMContentLoaded', function () {
  
    // Only run in admin article form
    let titleField = document.querySelector('#jform_title');
      console.log("JS Loaded");
    if (!titleField) return;

    fetch('index.php?option=com_ajax&plugin=testtitle&group=content&format=json')
    .then(res => res.json())
    .then(response => {
        console.log("AJAX Response:", response);

        let titleField = document.querySelector('#jform_title');

        // 🔥 Access correct nested data
        let result = response.data[0];

        if (result.success && result.data.title) {
            titleField.value = result.data.title;
        }
    })
    .catch(err => console.error(err));

});