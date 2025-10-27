$showForm = document.querySelector(".edit");
$dialog = document.querySelector("dialog");
$closeForm = document.querySelector("dialog button")

$showForm.addEventListener('submit', () => {
    $dialog.showModal();
});

$closeForm.addEventListener("submit", () => {
    $dialog.close();
});
