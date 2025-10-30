document.addEventListener("DOMContentLoaded", () => {
  const $addGrade = document.querySelector(".buttons-container .add-grades");
  const $gradeForm = document.querySelector(".grade-container .grade-dialog");
  const $closeGradeForm = document.querySelector(".grade-container .grade-dialog .close-dialog");

  if ($addGrade && $gradeForm && $closeGradeForm) {
    console.log("JS connected properly ✅");
    $addGrade.addEventListener("click", () => {
      console.log("Opening dialog...");
      $gradeForm.showModal();
    });
    $closeGradeForm.addEventListener("click", () => $gradeForm.close());
  } else {
    console.warn("Dialog or button not found in DOM ❌");
  }
});
