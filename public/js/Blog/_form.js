let canContinue = false;

function validate() {
    const dataErrorDiv = document.querySelector("#data-error");

    const titleInput = document.querySelector("#input-title");
    const contentInput = document.querySelector("#input-content");
    const categoryOptions = document.querySelector("#select-category").getElementsByTagName("option");
    let categorySelected = undefined;
    for (let i = 0; i < categoryOptions.length; i++) {
        if (categoryOptions[i].selected && !categoryOptions[i].disabled) categorySelected = categoryOptions[i].value;
    }

    if (titleInput.value && contentInput.value && categorySelected) canContinue = true;
    
    if (!titleInput.value) {
        titleInput.focus();
    }
    else if (!contentInput.value) {
        contentInput.focus();
    }
    else if (!categorySelected) {
        dataErrorDiv.innerHTML = "A category option must to be selected.";
    }
}