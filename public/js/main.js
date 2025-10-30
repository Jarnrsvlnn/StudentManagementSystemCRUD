document.addEventListener("DOMContentLoaded", () => {
  const addGrade = document.querySelector(".buttons-container .add-grades");
  const gradeDialog = document.querySelector(".grade-container .grade-dialog");
  const closeGradeForm = document.querySelector(".grade-container .grade-dialog .close-dialog");
  const gradeForm = document.querySelector(".grade-container .grade-dialog form")

  if (addGrade && gradeDialog && closeGradeForm) {
    console.log("JS connected properly ✅");
    addGrade.addEventListener("click", () => {
      console.log("Opening dialog...");
      gradeDialog.showModal();
    });
    closeGradeForm.addEventListener("click", () => gradeDialog.close());
  } else {
    console.warn("Dialog or button not found in DOM ❌");
  }
});
