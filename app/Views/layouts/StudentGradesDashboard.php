<div class="grade-container">
    <div class="buttons-container">
        <button class="edit-grades">Edit</button>
        <button class="add-grades">Add</button>
    </div>
    <div class="table-container">
        <table class="table table-striped-columns">
            <tr style="text-align: center;">
                <th class="table-dark" colspan="9">All Students' Grades</th>
            </tr>
            <tr style="text-align: center;">
                <th class="table-dark" rowspan="2">Student ID</th>
                <th class="table-dark" rowspan="2">Full Name</th>
                <th class="table-dark" rowspan="2">Subject</th>
                <th class="table-dark" colspan="4">Quarter</th>
                <th class="table-dark" rowspan="2">Final Grade</th>
                <th class="table-dark" rowspan="2">Remarks</th>
            </tr>
            <tr style="text-align: center;">
                <th class="table-dark" colspan="1">1st</th>
                <th class="table-dark" colspan="1">2nd</th>
                <th class="table-dark" colspan="1">3rd</th>
                <th class="table-dark" colspan="1">4th</th>
            </tr>
            
            <?php foreach($grades as $studentGrade): ?>
                <tr style="text-align: center;">
                    <td><?= htmlspecialchars($studentGrade['student_id']) ?></td>
                    <td><?= htmlspecialchars($studentGrade['full_name']) ?></td>
                    <td><?= htmlspecialchars($studentGrade['subject_code']) ?></td>
                    <td><?= htmlspecialchars($studentGrade['q1'] ?? '') ?></td>
                    <td><?= htmlspecialchars($studentGrade['q2'] ?? '') ?></td>
                    <td><?= htmlspecialchars($studentGrade['q3'] ?? '') ?></td>
                    <td><?= htmlspecialchars($studentGrade['q4'] ?? '') ?></td>
                    <td><?= htmlspecialchars($studentGrade['final_grade']) ?></td>
                    <?php if ($studentGrade['final_grade'] >= 70): ?>
                    <td style="color: green;"><?= htmlspecialchars($studentGrade['remarks']) ?></td>
                    <?php else: ?>
                    <td style="color: red;"><?= htmlspecialchars($studentGrade['remarks']) ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>    
        </table>
    </div>

    <dialog class="grade-dialog">
        <button class="close-dialog">Close</button>
        <form class="row g-3" method="post">
            <div class="col-12">
                <label class="form-label">Choose Student to Assign</label>
                <select class="form-select" name="student-id" required>
                    <?php foreach($students as $student): ?>
                        <option value="<?= htmlspecialchars($student['student_id']) ?>"><?= htmlspecialchars($student['full_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>   
            <div class="col-md-6">
                <label class="form-label">Choose Subject to Assign</label>
                <select class="form-select" name="subject-id" required>
                    <?php foreach($subjects as $subject): ?>
                        <option value="<?= htmlspecialchars($subject['id']) ?>"><?= htmlspecialchars($subject['subject_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>   
            <div class="col-md-6">
                <label class="form-label">Choose Quarter to Grade</label>
                <select class="form-select" name="quarter" required>
                    <option value="1st">1st Quarter</option>
                    <option value="2nd">2nd Quarter</option>
                    <option value="3rd">3rd Quarter</option>
                    <option value="4th">4th Quarter</option>
                </select>
            </div>    
            <div class="col-md-6">
                <label class="form-label">Input Grade</label>
                <input type="number" step="any" class="form-control" name="grade" min="60" max="100" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Create Student</button>
            </div>
        </form>
    </dialog>
</div>



